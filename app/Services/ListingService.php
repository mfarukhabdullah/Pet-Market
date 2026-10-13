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
            $listing = Listing::where('user_id', $seller->id)->findOrFail($listingId);
            $listing->update($data);
            return $listing;
        }

        $data['user_id'] = $seller->id;
        $data['status'] = 'draft';
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        }

        return Listing::create($data);
    }

    /**
     * Submit listing for publishing.
     * Verified sellers get immediate live listing, unverified go to pending approval.
     */
    public function publishListing(User $seller, ?int $listingId = null, array $finalData = []): Listing
    {
        $newStatus = $seller->is_verified ? 'live' : 'pending';
        $finalData['status'] = $newStatus;

        if ($listingId) {
            $listing = Listing::where('user_id', $seller->id)->findOrFail($listingId);
            $listing->update($finalData);
            return $listing;
        }

        $finalData['user_id'] = $seller->id;
        if (empty($finalData['slug']) && !empty($finalData['title'])) {
            $finalData['slug'] = Str::slug($finalData['title']) . '-' . Str::random(6);
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
        \App\Jobs\ProcessListingImageHash::dispatch($listingImage->id);

        return $listingImage;
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
