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

        // Dynamic Cities for Hero Location dropdown (Site settings + live listings)
        $dynamicCities = Cache::remember('home_locations_list', 1800, function () {
            $configured = \App\Models\SiteSetting::get('hero_locations');
            $cities = [];
            if (!empty($configured)) {
                $cities = array_values(array_filter(array_map('trim', explode(',', $configured))));
            }
            if (empty($cities)) {
                $cities = ['Islamabad', 'Karachi', 'Lahore', 'Rawalpindi', 'Faisalabad', 'Multan', 'Sialkot', 'Peshawar', 'Gujranwala', 'Quetta'];
            }
            $listingCities = Listing::live()->whereNotNull('city')->distinct()->pluck('city')->toArray();
            foreach ($listingCities as $c) {
                $trimmed = trim($c);
                if (!empty($trimmed) && !in_array(strtolower($trimmed), array_map('strtolower', $cities))) {
                    $cities[] = $trimmed;
                }
            }
            return $cities;
        });

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

        return response()
            ->view('index', compact('categories', 'breeds', 'dynamicCities', 'featuredListings', 'recentListings', 'favoritedListingIds'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
