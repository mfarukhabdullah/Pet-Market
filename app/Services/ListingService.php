<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ListingService
{
    /**
     * Create or update a draft listing for a seller.
     */
    public function saveDraft(User $seller, array $data, ?int $listingId = null): Listing
    {
        if ($listingId) {
            // USER PROMPT: "in my listing page if user want to edit his pet listing we wil navigate him to create listing page do edit his listing"
            $listing = Listing::where('user_id', $seller->id)->find($listingId) ?: Listing::find($listingId);
            if ($listing) {
                $listing->update($data);
                return $listing;
            }
        }

        $data['user_id'] = $seller->id;
        $data['status'] = 'draft';
        // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
        if (empty($data['slug']) && !empty($data['title'])) {
            $baseSlug = Str::slug($data['title']) ?: 'pet';
            $slug = $baseSlug;
            $counter = 1;
            while (Listing::where('slug', $slug)->exists()) {
                $counter++;
                $slug = "{$baseSlug}-{$counter}";
            }
            $data['slug'] = $slug;
        }

        return Listing::create($data);
    }

    /**
     * Submit listing for publishing.
     * All seller listings require admin approval before going live.
     */
    // USER PROMPT: "jb koi seller listing bna dy pehly vo admin sy approve ho gy"
    public function publishListing(User $seller, ?int $listingId = null, array $finalData = []): Listing
    {
        // USER PROMPT: "jb koi seller listing bna dy pehly vo admin sy approve ho gy"
        $autoApprove = \App\Models\SiteSetting::get('site_auto_approve_listings', '0') === '1';
        $newStatus = $autoApprove ? 'live' : 'pending';
        $finalData['status'] = $newStatus;

        \Illuminate\Support\Facades\Cache::forget('home_featured_listings');
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('catalog_categories_tree');
        \Illuminate\Support\Facades\Cache::forget('catalog_all_breeds');

        if ($listingId) {
            // USER PROMPT: "in my listing page if user want to edit his pet listing we wil navigate him to create listing page do edit his listing"
            $listing = Listing::where('user_id', $seller->id)->find($listingId) ?: Listing::find($listingId);
            if ($listing) {
                $listing->update($finalData);
                return $listing;
            }
        }

        $finalData['user_id'] = $seller->id;
        // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
        if (empty($finalData['slug']) && !empty($finalData['title'])) {
            $baseSlug = Str::slug($finalData['title']) ?: 'pet';
            $slug = $baseSlug;
            $counter = 1;
            while (Listing::where('slug', $slug)->exists()) {
                $counter++;
                $slug = "{$baseSlug}-{$counter}";
            }
            $finalData['slug'] = $slug;
        }

        return Listing::create($finalData);
    }

    /**
     * Attach image to listing.
     */
    public function attachImage(Listing $listing, UploadedFile $file, bool $isPrimary = false): ListingImage
    {
        $filename = 'pet_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('images/pets');
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);
        $relativePath = 'images/pets/' . $filename;

        // If primary, clear existing primary
        if ($isPrimary) {
            $listing->images()->update(['is_primary' => false]);
        }

        $listingImage = ListingImage::create([
            'listing_id' => $listing->id,
            'image_path' => $relativePath,
            'thumb_path' => $relativePath,
            'is_primary' => $isPrimary,
            'sort_order' => $listing->images()->count() + 1,
        ]);

        // Dispatch background queue job for async perceptual hash computation
        try {
            \App\Jobs\ProcessListingImageHash::dispatch($listingImage->id);
        } catch (\Throwable $e) {
            \Log::warning("Could not dispatch image hash job: " . $e->getMessage());
        }

        return $listingImage;
    }

    /**
     * Attach a base64 encoded image to listing.
     */
    public function attachBase64Image(Listing $listing, string $base64Data, bool $isPrimary = false): ?ListingImage
    {
        if (empty($base64Data)) return null;

        // Extract mime type and base64 string
        $extension = 'jpg';
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
            $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
            $extension = strtolower($type[1]);
            if ($extension === 'jpeg') $extension = 'jpg';
        }

        $decodedData = base64_decode($base64Data);
        if ($decodedData === false) return null;

        $filename = 'pet_' . time() . '_' . Str::random(8) . '.' . $extension;
        $destinationPath = public_path('images/pets');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        file_put_contents($destinationPath . DIRECTORY_SEPARATOR . $filename, $decodedData);
        $relativePath = 'images/pets/' . $filename;

        if ($isPrimary) {
            $listing->images()->update(['is_primary' => false]);
        }

        return ListingImage::create([
            'listing_id' => $listing->id,
            'image_path' => $relativePath,
            'thumb_path' => $relativePath,
            'is_primary' => $isPrimary,
            'sort_order' => $listing->images()->count() + 1,
        ]);
    }

    /**
     * Mark listing as sold.
     */
    public function markAsSold(User $seller, int $listingId): Listing
    {
        $listing = Listing::where('user_id', $seller->id)->findOrFail($listingId);
        $listing->update(['status' => 'sold']);
        return $listing;
    }

    /**
     * Soft delete listing.
     */
    public function deleteListing(User $seller, int $listingId): bool
    {
        $listing = Listing::where('user_id', $seller->id)->findOrFail($listingId);
        return (bool) $listing->delete();
    }
}
