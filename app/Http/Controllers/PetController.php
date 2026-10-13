<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class PetController extends Controller
{
    public function details(Request $request)
    {
        $id = $request->query('id');
        $slug = $request->query('slug');

        $query = Listing::with(['images', 'category', 'breed', 'user.reviewsReceived']);

        if ($slug) {
            $listing = $query->where('slug', $slug)->first();
        } elseif ($id) {
            $listing = $query->where('id', $id)->first();
        } else {
            // Default to first live featured or recent listing for demo preview
            $listing = $query->live()->first();
        }

        if (!$listing) {
            abort(404, 'Pet listing not found');
        }

        // Increment views count (atomic)
        $listing->increment('views_count');

        // Similar pets in same category
        $similarListings = Listing::live()
            ->where('category_id', $listing->category_id)
            ->where('id', '!=', $listing->id)
            ->with(['images', 'breed', 'user'])
            ->take(4)
            ->get();

        // Seller summary stats
        $seller = $listing->user;
        $sellerActiveCount = Listing::where('user_id', $seller->id)->where('status', 'live')->count();
        $sellerSoldCount = Listing::where('user_id', $seller->id)->where('status', 'sold')->count();

        return view('pet-details', compact(
            'listing',
            'similarListings',
            'seller',
            'sellerActiveCount',
            'sellerSoldCount'
        ));
    }

    /**
     * Anti-Scraping / Lead tracking: Reveal seller phone number
     */
    public function revealPhone($id)
    {
        $listing = Listing::with('user')->findOrFail($id);
        $phone = $listing->user->phone ?: '0300-1234567';

        return response()->json([
            'success' => true,
            'phone' => $phone,
        ]);
    }
}
