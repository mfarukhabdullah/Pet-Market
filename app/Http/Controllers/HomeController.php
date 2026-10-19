<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    // USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi"
    public function index()
    {
        \App\Models\SiteSetting::seedDefaults();

        // Cached active categories tree (1 hour)
        $categories = Cache::remember('home_categories', 3600, function () {
            return Category::where('is_active', true)->withCount('activeListings')->orderBy('sort_order', 'asc')->get();
        });

        // Cached breeds with category for hero search dropdown (1 hour)
        $breeds = Cache::remember('home_breeds', 3600, function () {
            return \App\Models\Breed::with('category')->whereHas('category', function ($q) {
                $q->where('is_active', true);
            })->orderBy('name', 'asc')->get();
        });

        // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
        // Dynamic Cities for Hero Location dropdown (Synchronized with Admin Settings + live listings)
        $dynamicCities = \App\Models\SiteSetting::getLocationsList();

        // Dynamic Price Ranges for Hero Search dropdown
        $priceRanges = \App\Models\SiteSetting::getPriceRanges();

        // Featured live listings (15 mins cache)
        $featuredListings = Cache::remember('home_featured_listings', 900, function () {
            return Listing::live()
                ->featured()
                ->with(['images', 'category', 'breed', 'user'])
                ->latest()
                ->take(6)
                ->get();
        });

        // Recent live listings
        $recentListings = Listing::live()
            ->with(['images', 'category', 'breed', 'user'])
            ->latest()
            ->take(8)
            ->get();

        $user = auth()->user();
        $favoritedListingIds = $user ? $user->favorites()->pluck('listing_id')->map(function ($id) {
            return (int) $id;
        })->toArray() : [];

        // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
        $popularBreeds = Cache::remember('home_popular_breeds', 3600, function () {
            return \App\Models\Breed::with(['category', 'listings' => function ($q) {
                $q->where('status', 'live');
            }])
            ->whereHas('category', function ($q) {
                $q->where('is_active', true);
            })
            ->withCount('activeListings')
            ->orderBy('active_listings_count', 'desc')
            ->orderBy('name', 'asc')
            ->take(4)
            ->get();
        });

        // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
        return response()
            ->view('index', compact('categories', 'breeds', 'popularBreeds', 'dynamicCities', 'priceRanges', 'featuredListings', 'recentListings', 'favoritedListingIds'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
