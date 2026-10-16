<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cached categories tree (1 hour)
        $categories = Cache::remember('home_categories', 3600, function () {
            return Category::withCount('activeListings')->orderBy('sort_order', 'asc')->get();
        });

        // Cached breeds with category for hero search dropdown (1 hour)
        $breeds = Cache::remember('home_breeds', 3600, function () {
            return \App\Models\Breed::with('category')->orderBy('name', 'asc')->get();
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
            ->view('index', compact('categories', 'breeds', 'featuredListings', 'recentListings', 'favoritedListingIds'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
