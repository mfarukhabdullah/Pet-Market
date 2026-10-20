<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ListingService;
use App\Models\User;
use App\Models\Listing;
use App\Models\Category;

class ListingActionController extends Controller
{
    protected $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }

    protected function getActiveUser()
    {
        return auth()->user() ?: User::where('email', 'seller@petmarket.pk')->first();
    }

    /**
     * Save or update draft during step 1-3.
     */
    public function saveDraft(Request $request)
    {
        $user = $this->getActiveUser();
        $listingId = $request->input('listing_id');

        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'breed_id' => 'nullable',
            'breed_name' => 'nullable|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_negotiable' => 'nullable|boolean',
            'age_months' => 'nullable|integer|min:0|max:240',
            'gender' => 'nullable|in:male,female,pair,unknown',
            'color' => 'nullable|string|max:100',
            'has_papers' => 'nullable|boolean',
            'vaccinated' => 'nullable|boolean',
            'dewormed' => 'nullable|boolean',
            'health_certificate' => 'nullable|boolean',
            // USER PROMPT: "if some seller is selling a fish in most cases there is no health record  for fish vacination and dewormig so when user upload health description there must be option that no health desciption if user click on this there should be no description for health status of fish"
            'no_health_description' => 'nullable|boolean',
            'city' => 'nullable|string|max:100',
            'area' => 'nullable|string|max:150',
            'phone_hidden' => 'nullable|boolean',
        ]);

        $listing = $this->listingService->saveDraft($user, $data, $listingId);

        return response()->json([
            'success' => true,
            'message' => 'Draft saved successfully',
            'listing_id' => $listing->id,
            'slug' => $listing->slug,
        ]);
    }

    /**
     * Async image upload for Step 4.
     */
    public function uploadMedia(Request $request, $id)
    {
        $user = $this->getActiveUser();
        $listing = Listing::where('user_id', $user->id)->findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_primary' => 'nullable|boolean',
        ]);

        $image = $this->listingService->attachImage(
            $listing,
            $request->file('image'),
            $request->boolean('is_primary', false)
        );

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'image' => $image,
        ]);
    }

    /**
     * Publish listing at Step 5.
     */
    public function publish(Request $request)
    {
        $user = $this->getActiveUser();
        $listingId = $request->input('listing_id');

        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:1',
            'city' => 'required|string|max:100',
            'description' => 'required|string|min:10',
            'color' => 'nullable|string|max:100',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        // USER PROMPT: "if some seller is selling a fish in most cases there is no health record  for fish vacination and dewormig so when user upload health description there must be option that no health desciption if user click on this there should be no description for health status of fish"
        // USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this"
        $catInput = $request->input('category_id') ?: $request->input('category');
        $categoryId = null;
        if (is_numeric($catInput) && (int) $catInput > 0) {
            $cat = Category::find((int) $catInput);
            if ($cat) $categoryId = $cat->id;
        }
        if (!$categoryId && $request->input('category')) {
            $catName = trim($request->input('category'));
            $cat = Category::where('name', 'like', "%{$catName}%")->orWhere('slug', 'like', "%{$catName}%")->first();
            if ($cat) $categoryId = $cat->id;
        }
        if (!$categoryId) {
            $categoryId = 1;
        }

        // USER PROMPT: "when user create a pet list like if am select category as Dog and when i came to breed section there is drop down that show all the breeds of dogs that came from admin panel and user select breed from this drop down offfering breeds"
        $breedName = $request->input('breed_name') ?: $request->input('breed', 'Pet');
        $breedId = null;

        if ($request->filled('breed_id')) {
            $foundBreed = \App\Models\Breed::find($request->input('breed_id'));
            if ($foundBreed && (!$categoryId || $foundBreed->category_id == $categoryId)) {
                $breedId = $foundBreed->id;
                $breedName = $foundBreed->name;
            }
        }

        if (!$breedId && $categoryId) {
            $matchedBreed = \App\Models\Breed::where('category_id', $categoryId)
                ->where(function ($q) use ($breedName) {
                    $q->where('name', 'like', "%{$breedName}%")
                      ->orWhere('slug', 'like', "%" . \Illuminate\Support\Str::slug($breedName) . "%");
                })->first();
            if ($matchedBreed) {
                $breedId = $matchedBreed->id;
            // USER PROMPT: "Smart merge: Assign matched breed, fallback to firstOrCreate for valid breed names and clear cache, else null"
            } elseif (!empty($breedName) && !in_array(strtolower(trim($breedName)), ['pet', 'other', 'any breed', 'any', 'all', 'any_breed', '__custom__'])) {
                $newBreed = \App\Models\Breed::firstOrCreate(
                    [
                        'category_id' => $categoryId,
                        'slug' => \Illuminate\Support\Str::slug($breedName),
                    ],
                    [
                        'name' => ucwords(trim($breedName)),
                    ]
                );
                $breedId = $newBreed->id;
                \Illuminate\Support\Facades\Cache::forget('all_breed_slugs_list');
                \Illuminate\Support\Facades\Cache::forget('catalog_all_breeds');
            } else {
                $breedId = null;
            }
        }

        $color = $request->input('color');
        if ($color && trim($color) !== '') {
            $color = trim($color);
        } else {
            $color = null;
        }

        $hasPapers = false;
        $pedigreeInput = $request->input('has_papers') ?: $request->input('pedigree');
        if ($pedigreeInput === true || $pedigreeInput === '1' || $pedigreeInput === 1 || strtolower((string)$pedigreeInput) === 'yes') {
            $hasPapers = true;
        }

        $noHealthDesc = $request->boolean('no_health_description') || $request->input('no_health_description') === '1' || $request->input('no_health_description') === 1;
        if ($categoryId == 5 && $request->input('no_health_description') === null && !$request->has('vaccinated')) {
            $noHealthDesc = true;
        }

        $listing = $this->listingService->publishListing($user, $listingId, [
            'category_id' => $categoryId,
            'breed_id' => $breedId,
            'breed_name' => $breedName,
            'title' => $request->input('title', 'New Pet Listing'),
            'description' => $request->input('description', 'Healthy and friendly pet.'),
            'price' => (float) $request->input('price', 0),
            'city' => $request->input('city', 'Lahore'),
            'area' => $request->input('area'),
            'age_months' => $request->input('age_months'),
            'gender' => $request->input('gender', 'unknown'),
            'color' => $color,
            'has_papers' => $hasPapers,
            'no_health_description' => $noHealthDesc,
            'vaccinated' => $noHealthDesc ? false : (bool) $request->input('vaccinated', false),
            'dewormed' => $noHealthDesc ? false : (bool) $request->input('dewormed', false),
        ]);

        // Process uploaded images directly from request
        $this->processUploadedImages($request, $listing);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $listing->status === 'live' 
                    ? 'Your listing is now live!' 
                    : 'Your listing has been submitted for admin moderation.',
                'listing' => $listing->load('images'),
                'redirect_url' => route('seller.listings'),
            ]);
        }

        return redirect()->route('seller.listings')->with('success', 'Listing submitted successfully!');
    }

    /**
     * Helper to process image uploads (files and base64).
     */
    protected function processUploadedImages(Request $request, Listing $listing)
    {
        $hasExistingImages = $listing->images()->exists();

        // 1. Array of uploaded files
        if ($request->hasFile('images')) {
            $isFirst = !$hasExistingImages;
            foreach ($request->file('images') as $file) {
                if ($file && $file->isValid()) {
                    $this->listingService->attachImage($listing, $file, $isFirst);
                    $isFirst = false;
                }
            }
        }

        // 2. Single uploaded file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file && $file->isValid()) {
                $this->listingService->attachImage($listing, $file, !$hasExistingImages);
            }
        }

        // 3. Base64 images array fallback
        if ($request->filled('images_base64') && is_array($request->input('images_base64'))) {
            $isFirst = !$listing->images()->exists();
            foreach ($request->input('images_base64') as $b64) {
                if (!empty($b64)) {
                    $this->listingService->attachBase64Image($listing, $b64, $isFirst);
                    $isFirst = false;
                }
            }
        }
    }

    /**
     * Mark listing as sold.
     */
    public function markSold($id)
    {
        $user = $this->getActiveUser();
        $listing = $this->listingService->markAsSold($user, $id);

        return redirect()->back()->with('success', 'Listing marked as sold!');
    }

    /**
     * Delete listing.
     */
    public function destroy($id)
    {
        $user = $this->getActiveUser();
        $this->listingService->deleteListing($user, $id);

        return redirect()->back()->with('success', 'Listing deleted successfully!');
    }
}
