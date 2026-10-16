<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class PetController extends Controller
{
    public function details(Request $request, $slug = null)
    {
        $identifier = $slug ?: $request->query('slug', $request->query('id'));

        // If numeric ID was passed in query or URL, redirect to clean slug URL (e.g. /pet-details/29 -> /pet-details/labrodor-dog)
        if ($identifier && is_numeric($identifier) && !$request->ajax() && optional($request->route())->getName() === 'pet.details') {
            $found = Listing::find($identifier);
            if ($found && !empty($found->slug)) {
                return redirect()->route('pet.details', ['slug' => $found->slug]);
            }
        }

        // If accessed via query param /pet-details?slug=..., redirect to clean URL /pet-details/{slug}
        if ($request->query('slug') && !$slug && !$request->ajax() && optional($request->route())->getName() === 'pet.details') {
            return redirect()->route('pet.details', array_merge(['slug' => $request->query('slug')], $request->except(['slug', 'id'])));
        }

        $query = Listing::with(['images', 'category', 'breed', 'user.reviewsReceived']);

        if ($identifier) {
            $listing = $query->where('slug', $identifier)->first()
                ?: (is_numeric($identifier) ? $query->where('id', $identifier)->first() : null);
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

        // Seller's other listings
        $sellerOtherListings = Listing::live()
            ->where('user_id', $seller->id)
            ->where('id', '!=', $listing->id)
            ->with(['images', 'breed', 'user'])
            ->take(4)
            ->get();

        if ($sellerOtherListings->isEmpty()) {
            // Fallback to other live marketplace listings if this seller only has 1 listing
            $sellerOtherListings = Listing::live()
                ->where('id', '!=', $listing->id)
                ->with(['images', 'breed', 'user'])
                ->take(4)
                ->get();
        }

        return view('pet-details', compact(
            'listing',
            'similarListings',
            'sellerOtherListings',
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
