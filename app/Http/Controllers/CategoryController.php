<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categoryParam = $request->query('category', 'all');
        $breedParam = $request->query('breed');
        $cityParam = $request->query('city', $request->query('location', 'all'));
        $sortParam = $request->query('sort', 'newest');
        $searchParam = $request->query('search', $request->query('q'));
        $minPrice = $request->query('min_price', $request->query('price_min'));
        $maxPrice = $request->query('max_price', $request->query('price_max'));

        // All categories with active listings count
        $categories = Cache::remember('catalog_categories_tree', 1800, function () {
            return Category::with(['breeds'])->withCount('activeListings')->orderBy('sort_order', 'asc')->get();
        });

        $selectedCategory = null;
        if ($categoryParam !== 'all' && !empty($categoryParam)) {
            $selectedCategory = $categories->firstWhere('slug', $categoryParam) 
                ?: $categories->firstWhere('id', $categoryParam);
        }

        // Available breeds for filter
        $breeds = $selectedCategory ? $selectedCategory->breeds : Breed::all();

        // Build listings query
        $query = Listing::live()->with(['images', 'category', 'breed', 'user']);

        // Apply filters
        $filters = [
            'category' => $selectedCategory ? $selectedCategory->id : null,
            'breed' => $breedParam,
            'city' => $cityParam,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'vaccinated' => $request->boolean('vaccinated') || $request->query('health') === 'vaccinated',
            'dewormed' => $request->boolean('dewormed'),
            'gender' => $request->query('gender'),
            'search' => $searchParam,
        ];

        $query->filter($filters);

        // Sorting
        switch ($sortParam) {
            case 'price_low':
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'views':
                $query->orderBy('views_count', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $listings = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'total' => $listings->total(),
                'listings' => $listings,
            ]);
        }

        return view('category', compact(
            'listings',
            'categories',
            'selectedCategory',
            'breeds',
            'categoryParam',
            'breedParam',
            'cityParam',
            'sortParam',
            'searchParam'
        ));
    }
}
