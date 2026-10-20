<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Listing;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request, $param1 = null, $param2 = null, $param3 = null)
    {
        // 1. Featured query parameter redirect on /category route
        if ($request->query('featured') === 'true' && !$request->ajax() && !$request->wantsJson() && optional($request->route())->getName() === 'category') {
            return redirect()->route('featured.pets', $request->except('featured'));
        }

        // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
        $dynamicCategorySlugs = Cache::remember('all_category_slugs_list', 1800, function () {
            return Category::pluck('slug')->map(fn($s) => strtolower(trim((string)$s)))->toArray();
        });
        $knownCategories = array_values(array_unique(array_merge(
            ['birds', 'cats', 'dogs', 'exotic', 'exotic-pets', 'fish', 'fishes', 'horses-farm', 'horse', 'horses', 'rabbits', 'reptiles', 'reptile'],
            $dynamicCategorySlugs
        )));
        // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
        $dynamicCities = \App\Models\SiteSetting::getLocationsList();
        $knownCities = array_values(array_unique(array_merge(
            ['islamabad', 'karachi', 'lahore', 'rawalpindi', 'faisalabad', 'multan', 'sialkot', 'peshawar'],
            array_map(fn($c) => strtolower(trim((string)$c)), $dynamicCities)
        )));
        $priceRanges = \App\Models\SiteSetting::getPriceRanges();

        $allBreedSlugs = Cache::remember('all_breed_slugs_list', 1800, function () {
            return Breed::pluck('slug')->map(fn($s) => strtolower(trim($s)))->toArray();
        });

        $routeCategory = null;
        $routeBreed = null;
        $routeCity = null;

        $rawSegments = array_values(array_filter([$param1, $param2, $param3]));
        foreach ($rawSegments as $seg) {
            $segLower = strtolower(trim($seg));
            if (!$routeCategory && in_array($segLower, $knownCategories)) {
                $routeCategory = $segLower;
            } elseif (!$routeCity && (in_array($segLower, $knownCities) || Listing::where('city', 'like', "%{$segLower}%")->exists())) {
                $routeCity = $segLower;
            // USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this"
            } elseif (!$routeBreed && (in_array($segLower, $allBreedSlugs) || Breed::where('slug', $segLower)->exists() || Listing::where('breed_name', 'like', str_replace('-', ' ', $segLower))->exists())) {
                $routeBreed = $segLower;
            }
        }

        // 2. Clean up query parameters & redirect query string to clean route paths
        if (!$request->ajax() && !$request->wantsJson()) {
            $rawQuery = $request->query();
            $needsRedirect = false;
            $cleanQuery = [];

            // Target category
            $targetCategory = $routeCategory;
            if (isset($rawQuery['category'])) {
                $cVal = trim((string) $rawQuery['category']);
                if (!empty($cVal) && $cVal !== 'all' && empty($targetCategory)) {
                    $targetCategory = $cVal;
                }
                $needsRedirect = true;
            }

            // Target breed
            $targetBreed = $routeBreed;
            if (isset($rawQuery['breed'])) {
                $bVal = trim((string) $rawQuery['breed']);
                if (!empty($bVal) && $bVal !== 'all' && empty($targetBreed)) {
                    $targetBreed = $bVal;
                }
                $needsRedirect = true;
            }

            // Target city
            $targetCity = $routeCity;
            if (isset($rawQuery['location']) || isset($rawQuery['city'])) {
                $lVal = trim((string) ($rawQuery['location'] ?? $rawQuery['city']));
                if (!empty($lVal) && $lVal !== 'all' && empty($targetCity)) {
                    $targetCity = $lVal;
                }
                $needsRedirect = true;
            }

            foreach ($rawQuery as $key => $val) {
                if ($key === 'category' || $key === 'breed' || $key === 'location' || $key === 'city') continue;

                // Handle gender[] or gender array
                if ($key === 'gender') {
                    if (is_array($val)) {
                        $cleanGenders = array_filter(array_map('trim', $val), fn($g) => !empty($g) && $g !== 'all');
                        if (!empty($cleanGenders)) {
                            $cleanQuery['gender'] = implode(',', $cleanGenders);
                        }
                        $needsRedirect = true;
                        continue;
                    } elseif (empty($val) || $val === 'all') {
                        $needsRedirect = true;
                        continue;
                    }
                }

                // Handle age units: remove if corresponding age value is missing or if unit is default 'months'
                if ($key === 'age_min_unit') {
                    $hasAgeMin = isset($rawQuery['age_min']) && $rawQuery['age_min'] !== '';
                    if (!$hasAgeMin || $val === 'months') {
                        $needsRedirect = true;
                        continue;
                    }
                }
                if ($key === 'age_max_unit') {
                    $hasAgeMax = isset($rawQuery['age_max']) && $rawQuery['age_max'] !== '';
                    if (!$hasAgeMax || $val === 'months') {
                        $needsRedirect = true;
                        continue;
                    }
                }

                // Remove empty strings or null values
                if ($val === '' || $val === null) {
                    $needsRedirect = true;
                    continue;
                }

                $cleanQuery[$key] = $val;
            }

            if ($needsRedirect) {
                if (optional($request->route())->getName() === 'featured.pets') {
                    return redirect()->route('featured.pets', $cleanQuery);
                }

                $pathParts = [];
                if ($targetCategory && $targetCategory !== 'all') $pathParts[] = $targetCategory;
                if ($targetBreed && $targetBreed !== 'all') $pathParts[] = $targetBreed;
                if ($targetCity && $targetCity !== 'all') $pathParts[] = $targetCity;

                $routeParams = [];
                if (isset($pathParts[0])) $routeParams['param1'] = $pathParts[0];
                if (isset($pathParts[1])) $routeParams['param2'] = $pathParts[1];
                if (isset($pathParts[2])) $routeParams['param3'] = $pathParts[2];

                return redirect()->route('category', array_merge($routeParams, $cleanQuery));
            }
        }

        $categoryParam = $routeCategory ?: 'all';
        $breedParam = $routeBreed ?: $request->query('breed');
        $cityParam = $routeCity ?: $request->query('city', $request->query('location', 'all'));
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

        // When breed is present but category is not specified, auto-resolve category from breed
        if (!$selectedCategory && !empty($breedParam) && $breedParam !== 'all') {
            $matchedBreed = $allBreeds->first(function ($b) use ($breedParam) {
                return strtolower($b->slug) === strtolower($breedParam) || strtolower($b->name) === strtolower($breedParam);
            });
            if ($matchedBreed && $matchedBreed->category) {
                $selectedCategory = $matchedBreed->category;
                $categoryParam = $selectedCategory->slug;
            }
        }

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
        if (is_string($genderParam) && str_contains($genderParam, ',')) {
            $genderParam = array_filter(array_map('trim', explode(',', $genderParam)));
        }

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
                'maxPrice',
                // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
                'dynamicCities',
                'priceRanges'
            ))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function featured(Request $request)
    {
        $request->merge(['featured' => 'true']);
        return $this->index($request);
    }

    // USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this"
    public function breeds(Request $request)
    {
        $categories = Category::with(['breeds' => function ($q) {
            $q->withCount(['listings' => function ($l) {
                $l->where('status', 'live');
            }]);
        }])->get();

        $liveListings = Listing::live()->with(['images', 'category', 'breed'])->get();

        return view('breeds', compact('categories', 'liveListings'));
    }

    // USER PROMPT: "when user create a pet list like if am select category as Dog and when i came to breed section there is drop down that show all the breeds of dogs that came from admin panel and user select breed from this drop down offfering breeds"
    public function getBreedsByCategory($id)
    {
        $category = null;
        if (is_numeric($id)) {
            $category = Category::find($id);
        }
        if (!$category) {
            $category = Category::where('slug', $id)->orWhere('name', $id)->first();
        }

        if (!$category) {
            return response()->json([
                'success' => false,
                'breeds' => [],
            ], 404);
        }

        $breeds = Breed::where('category_id', $category->id)
            ->orderBy('name', 'asc')
            ->get(['id', 'category_id', 'name', 'slug']);

        return response()->json([
            'success' => true,
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ],
            'breeds' => $breeds,
        ]);
    }
}
