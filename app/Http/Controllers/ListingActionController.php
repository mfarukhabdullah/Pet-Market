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
            'vaccinated' => 'nullable|boolean',
            'dewormed' => 'nullable|boolean',
            'health_certificate' => 'nullable|boolean',
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

        $catInput = $request->input('category_id') ?: $request->input('category');
        $categoryId = 1;
        if (is_numeric($catInput)) {
            $categoryId = (int) $catInput;
        } elseif (is_string($catInput)) {
            $cat = Category::where('name', 'like', "%{$catInput}%")->first();
            if ($cat) $categoryId = $cat->id;
        }

        $listing = $this->listingService->publishListing($user, $listingId, [
            'category_id' => $categoryId,
            'breed_name' => $request->input('breed_name') ?: $request->input('breed', 'Pet'),
            'title' => $request->input('title', 'New Pet Listing'),
            'description' => $request->input('description', 'Healthy and friendly pet.'),
            'price' => (float) $request->input('price', 0),
            'city' => $request->input('city', 'Lahore'),
            'area' => $request->input('area'),
            'age_months' => $request->input('age_months'),
            'gender' => $request->input('gender', 'unknown'),
            'vaccinated' => (bool) $request->input('vaccinated', false),
            'dewormed' => (bool) $request->input('dewormed', false),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $listing->status === 'live' 
                    ? 'Your listing is now live!' 
                    : 'Your listing has been submitted for admin moderation.',
                'listing' => $listing,
                'redirect_url' => route('seller.listings'),
            ]);
        }

        return redirect()->route('seller.listings')->with('success', 'Listing submitted successfully!');
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
