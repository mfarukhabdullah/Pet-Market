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

        return view('index', compact('categories', 'featuredListings', 'recentListings'));
    }
}
