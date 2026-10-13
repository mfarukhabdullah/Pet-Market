<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Listing;
use App\Models\Report;
use App\Models\User;

class InteractionActionController extends Controller
{
    protected function getActiveUser()
    {
        return auth()->user() ?: User::where('email', 'buyer@petmarket.pk')->first() ?: User::first();
    }

    /**
     * Toggle listing favorite (wishlist).
     */
    public function toggleFavorite($listingId)
    {
        $user = $this->getActiveUser();
        $listing = Listing::findOrFail($listingId);

        $existing = Favorite::where('user_id', $user->id)->where('listing_id', $listing->id)->first();

        if ($existing) {
            $existing->delete();
            $isFavorited = false;
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'listing_id' => $listing->id,
            ]);
            $isFavorited = true;
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_favorited' => $isFavorited,
                'message' => $isFavorited ? 'Added to favorites' : 'Removed from favorites',
            ]);
        }

        return redirect()->back();
    }

    /**
     * Submit fraud or scam report on a listing or seller.
     */
    public function submitReport(Request $request)
    {
        $user = $this->getActiveUser();

        $data = $request->validate([
            'listing_id' => 'nullable|exists:listings,id',
            'seller_id' => 'nullable|exists:users,id',
            'reason' => 'required|string|max:150',
            'details' => 'nullable|string|max:2000',
        ]);

        $data['reporter_id'] = $user->id;
        $data['status'] = 'pending';

        $report = Report::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Report submitted successfully. Our safety team will review this shortly.',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for reporting. Our moderation team has been notified.');
    }
}
