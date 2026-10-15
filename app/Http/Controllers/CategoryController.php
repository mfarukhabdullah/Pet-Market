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
        // Robust Price Range Parsing
        $parsePrice = function ($val) {
            if ($val === null || $val === '') return null;
            $val = trim((string) $val);
            $val = str_ireplace(['pkr', 'rs', 'rs.', '/-'], '', $val);
            $val = str_replace(',', '', $val);
            $val = trim($val);
            if (preg_match('/^(\d+(?:\.\d+)?)\s*k$/i', $val, $m)) {
                return (float) $m[1] * 1000;
            }
            if (preg_match('/^(\d+(?:\.\d+)?)\s*m$/i', $val, $m)) {
                return (float) $m[1] * 1000000;
            }
            if (is_numeric($val)) {
                $num = (float) $val;
                // Auto-scale compact values (e.g. 50 or 60 for thousands, since all pet prices >= 4,500 PKR)
                if ($num > 0 && $num < 1000) {
                    return $num * 1000;
                }
                return $num;
            }
            return null;
        };

        $rawMinPrice = $request->query('min_price', $request->query('price_min'));
        $rawMaxPrice = $request->query('max_price', $request->query('price_max'));

        // Support legacy 'price' range parameter (e.g., '0-20000' or '50000+')
        $legacyPrice = $request->query('price');
        if ($legacyPrice && !$rawMinPrice && !$rawMaxPrice) {
            if (str_ends_with($legacyPrice, '+')) {
                $rawMinPrice = rtrim($legacyPrice, '+');
            } elseif (str_contains($legacyPrice, '-')) {
                $parts = explode('-', $legacyPrice, 2);
                $rawMinPrice = $parts[0] ?? null;
                $rawMaxPrice = $parts[1] ?? null;
            }
        }

        $minPrice = $parsePrice($rawMinPrice);
        $maxPrice = $parsePrice($rawMaxPrice);

        // Auto-swap if min > max
        if ($minPrice !== null && $maxPrice !== null && $minPrice > $maxPrice) {
            $tempPrice = $minPrice;
            $minPrice = $maxPrice;
            $maxPrice = $tempPrice;
        }

        // All categories with active listings count
        $categories = Cache::remember('catalog_categories_tree', 1800, function () {
            return Category::with(['breeds'])->withCount('activeListings')->orderBy('sort_order', 'asc')->get();
        });

        $categoryAliases = [
            'fish' => 'fish',
            'fishes' => 'fish',
            'reptile' => 'reptiles',
            'reptiles' => 'reptiles',
            'horse' => 'horses-farm',
            'horses' => 'horses-farm',
            'horses-farm' => 'horses-farm',
            'horse-farm' => 'horses-farm',
            'farm' => 'horses-farm',
            'exotic' => 'exotic',
            'exotic-pets' => 'exotic',
            'exotic-pet' => 'exotic',
            'exotics' => 'exotic',
            'dog' => 'dogs',
            'dogs' => 'dogs',
            'cat' => 'cats',
            'cats' => 'cats',
            'bird' => 'birds',
            'birds' => 'birds',
            'rabbit' => 'rabbits',
            'rabbits' => 'rabbits',
        ];

        $selectedCategory = null;
        if ($categoryParam !== 'all' && !empty($categoryParam)) {
            $normalizedSlug = $categoryAliases[strtolower(trim($categoryParam))] ?? strtolower(trim($categoryParam));
            $selectedCategory = $categories->firstWhere('slug', $normalizedSlug) 
                ?: $categories->firstWhere('slug', $categoryParam)
                ?: $categories->firstWhere('id', $categoryParam);
        }

        // All breeds with category for dynamic dropdown
        $allBreeds = Cache::remember('catalog_all_breeds', 1800, function () {
            return Breed::with('category')->orderBy('name', 'asc')->get();
        });

        // Available breeds for filter (defaults to selected category or all)
        $breeds = $selectedCategory ? $selectedCategory->breeds : $allBreeds;

        // Parse Age Filter (convert to months)
        $ageMin = $request->query('age_min');
        $ageMax = $request->query('age_max');
        $ageMinUnit = $request->query('age_min_unit', 'months');
        $ageMaxUnit = $request->query('age_max_unit', 'months');

        $minAgeMonths = null;
        if ($ageMin !== null && $ageMin !== '') {
            $minVal = (float) $ageMin;
            if ($ageMinUnit === 'years') $minAgeMonths = $minVal * 12;
            elseif ($ageMinUnit === 'days') $minAgeMonths = $minVal / 30;
            else $minAgeMonths = $minVal;
        }

        $maxAgeMonths = null;
        if ($ageMax !== null && $ageMax !== '') {
            $maxVal = (float) $ageMax;
            if ($ageMaxUnit === 'years') $maxAgeMonths = $maxVal * 12;
            elseif ($ageMaxUnit === 'days') $maxAgeMonths = $maxVal / 30;
            else $maxAgeMonths = $maxVal;
        }

        // Build listings query
        $query = Listing::live()->with(['images', 'category', 'breed', 'user']);

        // Apply filters
        $isFeatured = $request->boolean('featured') || $request->query('featured') === 'true' || $request->query('featured') === '1';

        // When a category is requested, strictly filter by its ID. If not found, use -1 so no other pets leak through.
        $categoryFilterId = null;
        if ($categoryParam !== 'all' && !empty($categoryParam)) {
            $categoryFilterId = $selectedCategory ? $selectedCategory->id : -1;
        }

        $genderParam = $request->query('gender');

        $filters = [
            'category' => $categoryFilterId,
            'breed' => $breedParam,
            'city' => $cityParam,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'min_age_months' => $minAgeMonths,
            'max_age_months' => $maxAgeMonths,
            'vaccinated' => $request->boolean('vaccinated') || $request->query('health') === 'vaccinated',
            'dewormed' => $request->boolean('dewormed'),
            'gender' => $genderParam,
            'date' => $request->query('date'),
            'search' => $searchParam,
            'featured' => $isFeatured,
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

        $listings = $query->paginate(24)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'total' => $listings->total(),
                'listings' => $listings,
            ]);
        }

        $user = auth()->user();
        $favoritedListingIds = $user ? $user->favorites()->pluck('listing_id')->map(function ($id) {
            return (int) $id;
        })->toArray() : [];

        return response()
            ->view('category', compact(
                'listings',
                'categories',
                'selectedCategory',
                'breeds',
                'allBreeds',
                'categoryParam',
                'breedParam',
                'cityParam',
                'sortParam',
                'searchParam',
                'favoritedListingIds',
                'minPrice',
                'maxPrice'
            ))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
