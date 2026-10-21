<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
    @php
        $isFeaturedView = (request()->routeIs('featured.pets') || request('featured') === 'true' || request('featured') === '1');
        $catHeroTitle = $isFeaturedView 
            ? \App\Models\SiteSetting::get('featured_hero_title', 'Featured Pet Listings')
            : \App\Models\SiteSetting::get('category_hero_title', 'Browse Pet Listings');
        $catHeroDesc = $isFeaturedView 
            ? \App\Models\SiteSetting::get('featured_hero_desc', 'Discover premium and featured pet listings from top verified sellers.')
            : \App\Models\SiteSetting::get('category_hero_desc', 'Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.');
        $catHeroImage = \App\Models\SiteSetting::get('category_hero_image', 'images/category-hero-img.png');
    @endphp
    <title>{{ $catHeroTitle }} - Pet Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    {{-- USER PROMPT: "yr idher robot tag do roebot text ni" --}}
    <meta name="robots" content="{{ \App\Models\SiteSetting::get('seo_robots', 'index, follow') }}">
    <meta name="description" content="Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    {{-- USER PROMPT: "i want that when i click on any of these opton it directly goes to pet card no scrol up no scrool down just goes to that specific Pet card with out any scrolling" --}}
    <script>
        if (window.location.hash === '#petCardsGrid') {
            document.documentElement.style.scrollBehavior = 'auto';
        }
    </script>
    <style>
        html:has(:target),
        html.instant-scroll {
            scroll-behavior: auto !important;
        }

        {{-- USER PROMPT: "1st pic is of my breed page set same margin bottom on my featured page and categories page as 2nd pic and 3rd pic are pf my featured page and categories page set this" --}}
        .category-listings-section {
            padding-bottom: 60px !important;
        }
    </style>
</head>
<body>

    <!-- HEADER COMPONENT (Built-in component included cleanly as requested) -->
    <x-header />

    <!-- PAGE BODY SHELL (Strict 1440px Outer Shell) -->
    <main class="site-wrapper">

        {{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
        <!-- HERO BANNER SECTION (#FAF7F2 / Cream background, 1440px shell -> 1250px container) -->
        <x-hero :title="$catHeroTitle" :description="$catHeroDesc" :image="$catHeroImage">
            <!-- Floating Search Card Container -->
            <div class="shell-1440">
                <div class="container">
                    <div class="category-search-card">
                        {{-- USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view" --}}
                        <form action="{{ request()->routeIs('featured.pets') ? route('featured.pets') : route('category') }}" method="GET" class="category-search-form" id="searchFilterForm">
                            
                            <!-- Search Input Field -->
                            <div class="search-input-group">
                                <i class="fas fa-search search-group-icon"></i>
                                <input type="text" name="q" value="{{ request('q', request('search')) }}" placeholder="Search pets or breed" class="search-form-input" autocomplete="off">
                            </div>

                            @php
                                $topCatPlaceholder = \App\Models\SiteSetting::get('filter_cat_placeholder', 'Any category');
                                $topCatLabel = \App\Models\SiteSetting::get('filter_cat_label', 'PET CATEGORY');
                                $topSelectedCatSlug = request('category', isset($selectedCategory) && $selectedCategory ? $selectedCategory->slug : '');
                                $topSelectedCatName = $topCatPlaceholder;
                                if ($topSelectedCatSlug) {
                                    $matchedCat = $categories->firstWhere('slug', $topSelectedCatSlug);
                                    if ($matchedCat) $topSelectedCatName = $matchedCat->name;
                                }

                                // USER PROMPT: "yr ya filters sai kaam ni kr rahy hain authentic bnao in ko"
                                $topLocPlaceholder = \App\Models\SiteSetting::get('filter_loc_placeholder', 'Any location');
                                $topLocLabel = \App\Models\SiteSetting::get('filter_loc_label', 'LOCATION');
                                $currLocTop = strtolower($cityParam ?? request('location', request('city', '')));
                                if ($currLocTop === 'all') $currLocTop = '';
                                $topDynamicCities = $dynamicCities ?? \App\Models\SiteSetting::getLocationsList();
                                $topSelectedLocName = $topLocPlaceholder;
                                if ($currLocTop) {
                                    foreach ($topDynamicCities as $cItem) {
                                        if (strtolower(trim($cItem)) === $currLocTop) {
                                            $topSelectedLocName = $cItem;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <!-- Category Dropdown Field (Home Page Style) -->
                            <div class="home-filter custom-dropdown-wrap" data-filter="category" data-default="{{ $topCatPlaceholder }}" tabindex="0">
                                <input type="hidden" name="category" value="{{ $topSelectedCatSlug }}">
                                <div class="home-filter-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                        <circle cx="7" cy="7.5" r="2.2"/>
                                        <circle cx="12" cy="5.5" r="2.2"/>
                                        <circle cx="17" cy="7.5" r="2.2"/>
                                        <circle cx="4.5" cy="12" r="2"/>
                                        <path d="M12 10.5c-3.2 0-5.5 2.4-5.5 5.2 0 1.8 1.4 3.3 3.2 3.3 1 0 1.6-.4 2.3-.4s1.3.4 2.3.4c1.8 0 3.2-1.5 3.2-3.3 0-2.8-2.3-5.2-5.5-5.2z"/>
                                    </svg>
                                    <div class="home-filter-text-col">
                                        <span class="home-filter-label">{{ $topCatLabel }}</span>
                                        <span class="home-filter-value">{{ $topSelectedCatName }}</span>
                                    </div>
                                </div>
                                <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                <div class="custom-dropdown-menu">
                                    <div class="custom-dropdown-item {{ empty($topSelectedCatSlug) ? 'is-selected' : '' }}" data-value="">
                                        <span>{{ $topCatPlaceholder }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                    @foreach($categories as $cat)
                                        <div class="custom-dropdown-item {{ $topSelectedCatSlug == $cat->slug ? 'is-selected' : '' }}" data-value="{{ $cat->slug }}">
                                            <span>{{ $cat->name }}</span>
                                            <i class="fa-solid fa-check opt-check"></i>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Location Dropdown Field (Home Page Style) -->
                            <div class="home-filter custom-dropdown-wrap" data-filter="location" data-default="{{ $topLocPlaceholder }}" tabindex="0">
                                <input type="hidden" name="location" value="{{ $currLocTop }}">
                                <div class="home-filter-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                    <div class="home-filter-text-col">
                                        <span class="home-filter-label">{{ $topLocLabel }}</span>
                                        <span class="home-filter-value">{{ $topSelectedLocName }}</span>
                                    </div>
                                </div>
                                <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                <div class="custom-dropdown-menu">
                                    <div class="custom-dropdown-item {{ empty($currLocTop) ? 'is-selected' : '' }}" data-value="">
                                        <span>{{ $topLocPlaceholder }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                    @foreach($topDynamicCities as $city)
                                        @php $cSlug = strtolower(trim($city)); @endphp
                                        <div class="custom-dropdown-item {{ $currLocTop == $cSlug ? 'is-selected' : '' }}" data-value="{{ $cSlug }}">
                                            <span>{{ $city }}</span>
                                            <i class="fa-solid fa-check opt-check"></i>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Find a Pet Submit Button -->
                            <button type="submit" class="btn-find-pets">
                                <i class="fas fa-search"></i>
                                <span>{{ \App\Models\SiteSetting::get('filter_btn_text', 'Find a Pet') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </x-hero>

        <!-- MAIN CATEGORY LISTINGS & SIDEBAR FILTERS SECTION -->
        <section class="category-listings-section">
            <div class="shell-1440">
                <div class="container">
                    
                    <div class="category-main-layout">
                        
                        <!-- LEFT COLUMN: SIDEBAR FILTERS (Slide-over drawer on Mobile) -->
                        <aside class="filters-sidebar-card" id="filtersSidebarCard">
                            <div class="filters-sidebar-header">
                                <h3 class="filters-title">Filters</h3>
                                <div class="filters-header-actions">
                                    {{-- USER PROMPT: "yr ya filters sai kaam ni kr rahy hain authentic bnao in ko" --}}
                                    @php
                                        $hasActiveFilterServer = ($categoryParam && $categoryParam !== 'all') 
                                            || (!empty($breedParam) && $breedParam !== 'all')
                                            || (!empty($cityParam) && $cityParam !== 'all')
                                            || request()->hasAny(['category', 'breed', 'location', 'city', 'price_min', 'price_max', 'min_price', 'max_price', 'age_min', 'age_max', 'gender', 'health', 'date', 'featured', 'search', 'q']);
                                    @endphp
                                    <a href="{{ request()->routeIs('featured.pets') ? route('featured.pets') : route('category') }}" class="btn-reset-filters" id="resetFiltersBtn" style="{{ $hasActiveFilterServer ? 'display: inline-block;' : 'display: none;' }} text-decoration: none;">Reset all</a>
                                    <button type="button" class="close-sidebar-btn" id="closeFiltersBtn" aria-label="Close Filters"><i class="fas fa-times"></i></button>
                                </div>
                            </div>

                            {{-- USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main" --}}
                            <form id="sidebarFiltersForm" action="{{ request()->routeIs('featured.pets') ? route('featured.pets') : (isset($selectedCategory) && $selectedCategory ? route('category', ['param1' => $selectedCategory->slug]) : route('category')) }}" method="GET" autocomplete="off">
                                
                                {{-- USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view" --}}
                                @php
                                    $sidebarSelectedCatSlug = request('category', isset($selectedCategory) && $selectedCategory ? $selectedCategory->slug : '');
                                    $sidebarSelectedCatName = 'All Categories';
                                    if ($sidebarSelectedCatSlug) {
                                        $matchedSideCat = $categories->firstWhere('slug', $sidebarSelectedCatSlug);
                                        if ($matchedSideCat) $sidebarSelectedCatName = $matchedSideCat->name;
                                    }
                                @endphp
                                <!-- 1. Pet Category -->
                                <div class="filter-group">
                                    <label class="filter-label" for="filterCategory">Pet Category</label>
                                    <div class="sidebar-filter-dropdown custom-dropdown-wrap" data-filter="category" data-default="All Categories" tabindex="0">
                                        <input type="hidden" id="filterCategory" name="category" value="{{ $sidebarSelectedCatSlug }}">
                                        <div class="home-filter-left">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#14794A">
                                                <circle cx="7" cy="7.5" r="2.2"/>
                                                <circle cx="12" cy="5.5" r="2.2"/>
                                                <circle cx="17" cy="7.5" r="2.2"/>
                                                <circle cx="4.5" cy="12" r="2"/>
                                                <path d="M12 10.5c-3.2 0-5.5 2.4-5.5 5.2 0 1.8 1.4 3.3 3.2 3.3 1 0 1.6-.4 2.3-.4s1.3.4 2.3.4c1.8 0 3.2-1.5 3.2-3.3 0-2.8-2.3-5.2-5.5-5.2z"/>
                                            </svg>
                                            <span class="custom-filter-display-val">{{ $sidebarSelectedCatName }}</span>
                                        </div>
                                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        <div class="custom-dropdown-menu">
                                            <div class="custom-dropdown-item {{ empty($sidebarSelectedCatSlug) ? 'is-selected' : '' }}" data-value="">
                                                <span>All Categories</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            @foreach($categories as $cat)
                                                <div class="custom-dropdown-item {{ $sidebarSelectedCatSlug == $cat->slug ? 'is-selected' : '' }}" data-value="{{ $cat->slug }}">
                                                    <span>{{ $cat->name }}</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $selectedBreedVal = strtolower(trim(request('breed', '')));
                                    $sidebarSelectedBreedName = 'All Breeds';
                                    if ($selectedBreedVal) {
                                        $matchedBreed = $allBreeds->first(function($b) use ($selectedBreedVal) {
                                            return strtolower($b->slug) === $selectedBreedVal || strtolower($b->name) === $selectedBreedVal;
                                        });
                                        if ($matchedBreed) $sidebarSelectedBreedName = $matchedBreed->name;
                                    }
                                @endphp
                                <!-- 2. Breed -->
                                <div class="filter-group">
                                    <label class="filter-label" for="filterBreed">Breed</label>
                                    <div class="sidebar-filter-dropdown custom-dropdown-wrap" data-filter="breed" data-default="All Breeds" tabindex="0">
                                        <input type="hidden" id="filterBreed" name="breed" value="{{ $selectedBreedVal }}">
                                        <div class="home-filter-left">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#14794A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8 3v2c0 3 8 5 8 8v8"/>
                                                <path d="M16 3v2c0 3-8 5-8 8v8"/>
                                                <path d="M8 6h8"/>
                                                <path d="M10 12h4"/>
                                                <path d="M8 18h8"/>
                                            </svg>
                                            <span class="custom-filter-display-val">{{ $sidebarSelectedBreedName }}</span>
                                        </div>
                                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        <div class="custom-dropdown-menu" id="sidebarBreedMenu">
                                            <div class="custom-dropdown-item {{ empty($selectedBreedVal) ? 'is-selected' : '' }}" data-value="" data-category-slug="" data-category-id="">
                                                <span>All Breeds</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            @foreach($allBreeds as $b)
                                                @php
                                                    $isBSelected = ($selectedBreedVal === strtolower($b->slug) || $selectedBreedVal === strtolower($b->name));
                                                @endphp
                                                <div class="custom-dropdown-item {{ $isBSelected ? 'is-selected' : '' }}" 
                                                     data-value="{{ $b->slug }}" 
                                                     data-category-slug="{{ $b->category ? $b->category->slug : '' }}"
                                                     data-category-id="{{ $b->category_id }}">
                                                    <span>{{ $b->name }}</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Location / City (Dynamic Locations Synchronized with Admin & Home Hero) -->
                                {{-- USER PROMPT: "yr ya filters sai kaam ni kr rahy hain authentic bnao in ko" --}}
                                @php 
                                    $currLoc = strtolower($cityParam ?: request('location', request('city', ''))); 
                                    if ($currLoc === 'all') $currLoc = '';
                                    $sidebarCities = $dynamicCities ?? \App\Models\SiteSetting::getLocationsList();
                                    $sidebarSelectedLocName = 'All Locations';
                                    if ($currLoc) {
                                        foreach ($sidebarCities as $cCity) {
                                            if (strtolower(trim($cCity)) === $currLoc) {
                                                $sidebarSelectedLocName = $cCity;
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="filter-group">
                                    <label class="filter-label" for="filterLocation">{{ \App\Models\SiteSetting::get('filter_loc_label', 'Location / City') }}</label>
                                    <div class="sidebar-filter-dropdown custom-dropdown-wrap" data-filter="location" data-default="All Locations" tabindex="0">
                                        <input type="hidden" id="filterLocation" name="location" value="{{ $currLoc }}">
                                        <div class="home-filter-left">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#14794A">
                                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                            </svg>
                                            <span class="custom-filter-display-val">{{ $sidebarSelectedLocName }}</span>
                                        </div>
                                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        <div class="custom-dropdown-menu">
                                            <div class="custom-dropdown-item {{ empty($currLoc) ? 'is-selected' : '' }}" data-value="">
                                                <span>All Locations</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            @foreach($sidebarCities as $city)
                                                @php $cSlug = strtolower(trim($city)); @endphp
                                                <div class="custom-dropdown-item {{ $currLoc == $cSlug ? 'is-selected' : '' }}" data-value="{{ $cSlug }}">
                                                    <span>{{ $city }}</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Price Range (Dynamic Quick Price Preset Chips Synchronized with Admin) -->
                                <div class="filter-group">
                                    <label class="filter-label">{{ \App\Models\SiteSetting::get('filter_price_label', 'Price Range (PKR)') }}</label>
                                    <div class="min-max-inputs-row">
                                        <input type="text" inputmode="numeric" name="price_min" placeholder="Min (e.g. 5,000)" class="filter-number-input" id="priceMin" value="{{ isset($minPrice) && $minPrice !== null ? number_format($minPrice, 0, '', '') : request('price_min', request('min_price')) }}" autocomplete="off">
                                        <input type="text" inputmode="numeric" name="price_max" placeholder="Max (e.g. 60,000)" class="filter-number-input" id="priceMax" value="{{ isset($maxPrice) && $maxPrice !== null ? number_format($maxPrice, 0, '', '') : request('price_max', request('max_price')) }}" autocomplete="off">
                                    </div>
                                    @php
                                        $sidebarPriceRanges = $priceRanges ?? \App\Models\SiteSetting::getPriceRanges();
                                    @endphp
                                    @if(!empty($sidebarPriceRanges))
                                        <div class="category-quick-price-chips" style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px;">
                                            @foreach($sidebarPriceRanges as $pRange)
                                                @php
                                                    $pMin = (string)($pRange['min'] ?? '');
                                                    $pMax = (string)($pRange['max'] ?? '');
                                                    $curMinStr = (string)(isset($minPrice) && $minPrice !== null ? (int)$minPrice : request('price_min', ''));
                                                    $curMaxStr = (string)(isset($maxPrice) && $maxPrice !== null ? (int)$maxPrice : request('price_max', ''));
                                                    $isActivePrice = ($curMinStr === $pMin && $curMaxStr === $pMax) || request('price') === $pRange['val'];
                                                @endphp
                                                <button type="button" 
                                                        class="quick-price-chip {{ $isActivePrice ? 'active-chip' : '' }}" 
                                                        data-min="{{ $pMin }}" 
                                                        data-max="{{ $pMax }}"
                                                        onclick="selectQuickPrice('{{ $pMin }}', '{{ $pMax }}', this)"
                                                        style="border: 1px solid {{ $isActivePrice ? '#14794A' : '#E5E7EB' }}; background: {{ $isActivePrice ? '#EAF5EF' : '#FFFFFF' }}; color: {{ $isActivePrice ? '#14794A' : '#4B5563' }}; font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 6px; cursor: pointer; transition: all 0.2s ease;">
                                                    {{ $pRange['label'] }}
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- 5. Age Range -->
                                {{-- USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view" --}}
                                @php
                                    $minAgeUnit = request('age_min_unit', 'months') ?: 'months';
                                    $maxAgeUnit = request('age_max_unit', 'months') ?: 'months';
                                    $unitLabels = ['days' => 'Days', 'months' => 'Months', 'years' => 'Years'];
                                @endphp
                                <div class="filter-group">
                                    <label class="filter-label">Age Range</label>
                                    <div class="age-inputs-container" style="display: flex; flex-direction: column; gap: 8px;">
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <input type="number" name="age_min" placeholder="Min" class="filter-number-input" id="ageMin" value="{{ request('age_min') }}" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <div class="age-unit-dropdown-wrap custom-dropdown-wrap" tabindex="0">
                                                <input type="hidden" name="age_min_unit" id="ageMinUnit" value="{{ $minAgeUnit }}">
                                                <span class="age-unit-display-val">{{ $unitLabels[$minAgeUnit] ?? 'Months' }}</span>
                                                <svg class="home-filter-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <div class="custom-dropdown-menu" style="min-width: 110px;">
                                                    <div class="custom-dropdown-item {{ $minAgeUnit == 'days' ? 'is-selected' : '' }}" data-value="days">
                                                        <span>Days</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                    <div class="custom-dropdown-item {{ $minAgeUnit == 'months' ? 'is-selected' : '' }}" data-value="months">
                                                        <span>Months</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                    <div class="custom-dropdown-item {{ $minAgeUnit == 'years' ? 'is-selected' : '' }}" data-value="years">
                                                        <span>Years</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <input type="number" name="age_max" placeholder="Max" class="filter-number-input" id="ageMax" value="{{ request('age_max') }}" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <div class="age-unit-dropdown-wrap custom-dropdown-wrap" tabindex="0">
                                                <input type="hidden" name="age_max_unit" id="ageMaxUnit" value="{{ $maxAgeUnit }}">
                                                <span class="age-unit-display-val">{{ $unitLabels[$maxAgeUnit] ?? 'Months' }}</span>
                                                <svg class="home-filter-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <div class="custom-dropdown-menu" style="min-width: 110px;">
                                                    <div class="custom-dropdown-item {{ $maxAgeUnit == 'days' ? 'is-selected' : '' }}" data-value="days">
                                                        <span>Days</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                    <div class="custom-dropdown-item {{ $maxAgeUnit == 'months' ? 'is-selected' : '' }}" data-value="months">
                                                        <span>Months</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                    <div class="custom-dropdown-item {{ $maxAgeUnit == 'years' ? 'is-selected' : '' }}" data-value="years">
                                                        <span>Years</span>
                                                        <i class="fa-solid fa-check opt-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Gender -->
                                <div class="filter-group">
                                    <label class="filter-label">Gender</label>
                                    @php
                                        $reqGender = request('gender');
                                        $selectedGenders = [];
                                        if (is_array($reqGender)) {
                                            $selectedGenders = $reqGender;
                                        } elseif (is_string($reqGender) && trim($reqGender) !== '') {
                                            $selectedGenders = array_filter(array_map('trim', explode(',', strtolower($reqGender))));
                                        }
                                    @endphp
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender" value="male" {{ in_array('male', $selectedGenders) ? 'checked' : '' }}>
                                            <span class="label-text">Male</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender" value="female" {{ in_array('female', $selectedGenders) ? 'checked' : '' }}>
                                            <span class="label-text">Female</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 7. Health -->
                                <div class="filter-group">
                                    <label class="filter-label">Health</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="health" value="vaccinated" {{ (request('health') == 'vaccinated' || request('vaccinated')) ? 'checked' : '' }}>
                                            <span class="label-text">Vaccinated</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="health_info" value="1" {{ request('health_info') ? 'checked' : '' }}>
                                            <span class="label-text">Health information available</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 8. Pedigree / Papers -->
                                <div class="filter-group">
                                    <label class="filter-label">Pedigree / Papers</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="yes" {{ request('pedigree') == 'yes' ? 'checked' : '' }}>
                                            <span class="label-text">Yes</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="no" {{ request('pedigree') == 'no' ? 'checked' : '' }}>
                                            <span class="label-text">No</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="na" {{ request('pedigree') == 'na' ? 'checked' : '' }}>
                                            <span class="label-text">Not applicable</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 9. Seller Type -->
                                <div class="filter-group">
                                    <label class="filter-label">Seller Type</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="individual" {{ request('seller_type') == 'individual' ? 'checked' : '' }}>
                                            <span class="label-text">Individual Seller</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="breeder" {{ request('seller_type') == 'breeder' ? 'checked' : '' }}>
                                            <span class="label-text">Breeder / Business</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="verified" {{ request('seller_type') == 'verified' ? 'checked' : '' }}>
                                            <span class="label-text">Verified Seller</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 10. Date Posted -->
                                {{-- USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view" --}}
                                @php
                                    $currentDateVal = request('date', '');
                                    $dateLabels = [
                                        '' => 'Any Time',
                                        '24h' => 'Past 24 Hours',
                                        'week' => 'Past Week',
                                        'month' => 'Past Month'
                                    ];
                                    $currentDateLabel = $dateLabels[$currentDateVal] ?? 'Any Time';
                                @endphp
                                <div class="filter-group filter-group-last">
                                    <label class="filter-label" for="filterDate">Date Posted</label>
                                    {{-- USER PROMPT: "yr is ka sirf drop down oper sy open howa kry" --}}
                                    <div class="sidebar-filter-dropdown custom-dropdown-wrap dropdown-up" data-filter="date" data-default="Any Time" tabindex="0">
                                        <input type="hidden" id="filterDate" name="date" value="{{ $currentDateVal }}">
                                        <div class="home-filter-left">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#14794A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span class="custom-filter-display-val">{{ $currentDateLabel }}</span>
                                        </div>
                                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        <div class="custom-dropdown-menu">
                                            <div class="custom-dropdown-item {{ empty($currentDateVal) ? 'is-selected' : '' }}" data-value="">
                                                <span>Any Time</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            <div class="custom-dropdown-item {{ $currentDateVal == '24h' ? 'is-selected' : '' }}" data-value="24h">
                                                <span>Past 24 Hours</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            <div class="custom-dropdown-item {{ $currentDateVal == 'week' ? 'is-selected' : '' }}" data-value="week">
                                                <span>Past Week</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                            <div class="custom-dropdown-item {{ $currentDateVal == 'month' ? 'is-selected' : '' }}" data-value="month">
                                                <span>Past Month</span>
                                                <i class="fa-solid fa-check opt-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Filters Button -->
                                <button type="submit" class="btn-apply-filters" id="applyFiltersBtn">Apply Filters</button>

                            </form>
                        </aside>

                        <!-- RIGHT COLUMN: PET LISTINGS GRID & CONTROLS -->
                        <div class="listings-main-area">
                            
                            <div class="listings-header-wrapper">
                                <!-- Section Title -->
                                <div class="listings-title-block">
                                    <h2 class="listings-section-title">Pet Listings</h2>
                                    {{-- USER PROMPT: "yr ya filters sai kaam ni kr rahy hain authentic bnao in ko" --}}
                                    <p class="listings-subtitle">Showing <span id="listingsCountDisplay">{{ $listings->total() }}</span> matching pet listings</p>
                                </div>
    
                                <!-- Header Controls Row (Mobile Filter Button + View & Sort Controls) -->
                                <div class="listings-controls-header">
                                    <button type="button" class="mobile-filter-trigger" id="mobileFilterToggleBtn">
                                        <i class="fas fa-sliders-h"></i>
                                        <span>Filters</span>
                                    </button>

                                {{-- USER PROMPT: "category main to ink chalao" --}}
                                <div class="listings-controls-right">
                                    <div class="view-toggle-group">
                                        <span class="view-label">View:</span>
                                        <button type="button" class="view-toggle-btn" id="viewListBtn" aria-label="List View" title="List View">
                                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none">
                                                <circle cx="2.2" cy="3" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="3" x2="21" y2="3" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                                <circle cx="2.2" cy="9" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="9" x2="21" y2="9" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                                <circle cx="2.2" cy="15" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="15" x2="21" y2="15" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="view-toggle-btn active" id="viewGridBtn" aria-label="Grid View" title="Grid View">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="#000000">
                                                <rect x="0" y="0" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="6.75" y="0" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="13.5" y="0" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="0" y="6.75" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="6.75" y="6.75" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="13.5" y="6.75" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="0" y="13.5" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="6.75" y="13.5" width="4.5" height="4.5" rx="1.2"/>
                                                <rect x="13.5" y="13.5" width="4.5" height="4.5" rx="1.2"/>
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view" --}}
                                    @php
                                        $currentSortVal = request('sort', 'newest');
                                        $sortLabels = [
                                            'newest' => 'Newest First',
                                            'price_asc' => 'Price: Low to High',
                                            'price_low' => 'Price: Low to High',
                                            'price_desc' => 'Price: High to Low',
                                            'price_high' => 'Price: High to Low',
                                            'views' => 'Most Viewed'
                                        ];
                                        $currentSortLabel = $sortLabels[$currentSortVal] ?? 'Newest First';
                                    @endphp
                                    <div class="sort-control-group">
                                        <span class="sort-label">Sort:</span>
                                        <div class="sort-custom-dropdown-wrap custom-dropdown-wrap" tabindex="0">
                                            <input type="hidden" id="sortSelectInput" name="sort" value="{{ $currentSortVal }}">
                                            <div class="sort-trigger-btn">
                                                <span class="sort-current-val">{{ $currentSortLabel }}</span>
                                                <svg class="home-filter-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                            </div>
                                            <div class="custom-dropdown-menu sort-dropdown-menu">
                                                <div class="custom-dropdown-item {{ ($currentSortVal == 'newest' || empty($currentSortVal)) ? 'is-selected' : '' }}" data-value="newest">
                                                    <span>Newest First</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                                <div class="custom-dropdown-item {{ ($currentSortVal == 'price_asc' || $currentSortVal == 'price_low') ? 'is-selected' : '' }}" data-value="price_asc">
                                                    <span>Price: Low to High</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                                <div class="custom-dropdown-item {{ ($currentSortVal == 'price_desc' || $currentSortVal == 'price_high') ? 'is-selected' : '' }}" data-value="price_desc">
                                                    <span>Price: High to Low</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                                <div class="custom-dropdown-item {{ $currentSortVal == 'views' ? 'is-selected' : '' }}" data-value="views">
                                                    <span>Most Viewed</span>
                                                    <i class="fa-solid fa-check opt-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <!-- PET CARDS GRID (2 Columns on Mobile, 3 Columns on Desktop) -->
                            <div class="pet-cards-grid" id="petCardsGrid" style="scroll-margin-top: 100px;">
                                {{-- USER PROMPT: Direct instant scroll without animation when navigating to pet cards --}}
                                <script>
                                    if (window.location.hash === '#petCardsGrid') {
                                        var targetGrid = document.getElementById('petCardsGrid');
                                        if (targetGrid) {
                                            targetGrid.scrollIntoView({ behavior: 'instant', block: 'start' });
                                        }
                                    }
                                </script>
                                 @forelse($listings as $pet)
                                    {{-- USER PROMPT: "yr ya filters sai kaam ni kr rahy hain authentic bnao in ko" --}}
                                    <article class="pet-card" 
                                             id="listing-{{ $pet->id }}" 
                                             data-category="{{ $pet->category ? $pet->category->slug : '' }}" 
                                             data-breed="{{ Str::slug($pet->breed_name ?: ($pet->breed ? $pet->breed->name : '')) }}" 
                                             data-breed-name="{{ strtolower($pet->breed_name ?: ($pet->breed ? $pet->breed->name : '')) }}" 
                                             data-gender="{{ strtolower($pet->gender) }}" 
                                             data-location="{{ strtolower($pet->city) }}" 
                                             data-price="{{ (int) $pet->price }}" 
                                             data-age-months="{{ (int) $pet->age_months }}" 
                                             data-vaccinated="{{ $pet->vaccinated ? '1' : '0' }}" 
                                             data-created-at="{{ $pet->created_at ? $pet->created_at->timestamp : 0 }}" 
                                             onclick="window.location='{{ route('pet.details', ['slug' => $pet->slug ?: $pet->id]) }}'" 
                                             style="scroll-margin-top: 110px; cursor: pointer;">
                                        <div class="pet-card-image-box">
                                            @if($pet->is_featured)
                                                <span class="featured-badge">FEATURED</span>
                                            @endif
                                            <img src="{{ $pet->primary_image_url }}" alt="{{ $pet->title }}" class="pet-card-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                            @php
                                                $isFav = in_array($pet->id, $favoritedListingIds ?? []);
                                            @endphp
                                            <button type="button" 
                                                    class="btn-wishlist-heart {{ $isFav ? 'active favorited' : '' }}" 
                                                    data-url="{{ route('favorites.toggle', ['listingId' => $pet->id]) }}" 
                                                    data-id="{{ $pet->id }}" 
                                                    onclick="toggleCategoryFavorite(this, event);"
                                                    style="border:none; cursor:pointer;"
                                                    title="{{ $isFav ? 'Remove from favorites' : 'Add to favorites' }}" 
                                                    aria-label="Add to favorites">
                                                <i class="{{ $isFav ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isFav ? 'color: #ff4b68;' : '' }}"></i>
                                            </button>
                                        </div>
                                        <div class="pet-card-content">
                                            <h3 class="pet-name">{{ $pet->title }}</h3>
                                            <span class="pet-breed-tag">{{ $pet->breed_name ?: ($pet->breed ? $pet->breed->name : 'Pet') }}</span>
                                            <div class="pet-price">{{ $pet->formatted_price }}</div>
                                            <div class="pet-meta-row">
                                                <span class="meta-item"><i class="far fa-clock"></i> {{ $pet->age_text }}</span>
                                                <span class="meta-item"><i class="fas fa-{{ $pet->gender == 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($pet->gender) }}</span>
                                            </div>
                                            <div class="pet-meta-row location-row">
                                                <span class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ $pet->city }}</span>
                                                <span class="meta-item"><i class="far fa-clock"></i> {{ $pet->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #666; font-size: 1.2rem; background: #f9f9f9; border-radius: 16px;">
                                        <i class="fas fa-search" style="font-size: 2.5rem; color: #ccc; margin-bottom: 16px; display: block;"></i>
                                        No pets found matching your filters.
                                    </div>
                                @endforelse
                            </div>
                            
                            <!-- NO RESULTS MESSAGE -->
                            <div id="noResultsMessage" style="display: none; text-align: center; padding: 60px 20px; color: #666; font-size: 1.2rem; background: #f9f9f9; border-radius: 16px; margin-top: 20px;">
                                <i class="fas fa-search" style="font-size: 2.5rem; color: #ccc; margin-bottom: 16px; display: block;"></i>
                                No pets found matching your filters.
                            </div>

                            <!-- PAGINATION COMPONENT -->
                            @if($listings->hasPages())
                                <div class="category-pagination-row">
                                    {{-- Previous Page Link --}}
                                    @if ($listings->onFirstPage())
                                        <span class="page-nav-arrow" style="opacity: 0.4; cursor: default;"><i class="fas fa-arrow-left"></i></span>
                                    @else
                                        <a href="{{ $listings->previousPageUrl() }}" class="page-nav-arrow" aria-label="Previous Page"><i class="fas fa-arrow-left"></i></a>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($listings->getUrlRange(1, $listings->lastPage()) as $page => $url)
                                        @if ($page == $listings->currentPage())
                                            <span class="page-num-btn active">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="page-num-btn" style="text-decoration: none;">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($listings->hasMorePages())
                                        <a href="{{ $listings->nextPageUrl() }}" class="page-nav-arrow" aria-label="Next Page"><i class="fas fa-arrow-right"></i></a>
                                    @else
                                        <span class="page-nav-arrow" style="opacity: 0.4; cursor: default;"><i class="fas fa-arrow-right"></i></span>
                                    @endif
                                </div>
                            @endif

                        </div>

                    </div>

                </div>
            </div>
        </section>

    </main><!-- END PAGE BODY SHELL -->

    <!-- FOOTER COMPONENT (Built-in component included cleanly as requested) -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
    <script>
    function updateHeartUI(btn, isFav) {
        if (!btn) return;
        const icon = btn.querySelector('i');
        if (isFav) {
            btn.classList.add('active', 'favorited');
            btn.setAttribute('title', 'Remove from favorites');
            if (icon) {
                icon.classList.remove('fa-regular', 'far');
                icon.classList.add('fa-solid', 'fas');
                icon.style.color = '#ff4b68';
            }
        } else {
            btn.classList.remove('active', 'favorited');
            btn.setAttribute('title', 'Add to favorites');
            if (icon) {
                icon.classList.remove('fa-solid', 'fas');
                icon.classList.add('fa-regular', 'far');
                icon.style.color = '';
            }
        }
    }

    function setListingFavoriteState(listingId, isFav) {
        if (!listingId) return;
        document.querySelectorAll('.btn-wishlist-heart[data-id="' + listingId + '"]').forEach(b => {
            updateHeartUI(b, isFav);
        });
    }

    window.toggleCategoryFavorite = function(btn, e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        if (!btn) return;
        if (btn._isToggling) return;
        btn._isToggling = true;
        setTimeout(() => { btn._isToggling = false; }, 300);

        const icon = btn.querySelector('i');
        const isSolid = icon && (icon.classList.contains('fa-solid') || icon.classList.contains('fas'));
        const url = btn.getAttribute('data-url');
        const listingId = btn.getAttribute('data-id');
        const willBeFav = !isSolid;

        // Instant optimistic visual update
        setListingFavoriteState(listingId, willBeFav);

        // Bounce micro-animation
        btn.style.transition = 'transform 0.15s ease-in-out';
        btn.style.transform = 'scale(1.25)';
        setTimeout(() => { btn.style.transform = 'scale(1)'; }, 150);

        if (url) {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const token = (csrfMeta ? csrfMeta.getAttribute('content') : '') || '{{ csrf_token() }}';
            const returnUrl = window.location.pathname + window.location.search + '#listing-' + listingId;
            const fullUrl = url + (url.includes('?') ? '&' : '?') + 'redirect=' + encodeURIComponent(returnUrl);
            fetch(fullUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ redirect: returnUrl })
            })
            .then(r => {
                if (r.status === 401) {
                    return r.json().then(data => {
                        window.location.href = (data && data.redirect) ? data.redirect : ('{{ route('login') }}?favorite_listing=' + listingId + '&redirect=' + encodeURIComponent(returnUrl));
                    }).catch(() => {
                        window.location.href = '{{ route('login') }}?favorite_listing=' + listingId + '&redirect=' + encodeURIComponent(returnUrl);
                    });
                }
                return r.json();
            })
            .then(data => {
                if (data && typeof data.is_favorited !== 'undefined') {
                    setListingFavoriteState(listingId, data.is_favorited);
                }
            })
            .catch(err => {
                console.warn('Favorite toggle error:', err);
                window.syncCategoryFavorites();
            });
        }
    };

    window.syncCategoryFavorites = function() {
        fetch('{{ route('favorites.ids') }}', {
            headers: { 'Accept': 'application/json' },
            cache: 'no-store'
        })
        .then(r => r.json())
        .then(data => {
            if (data && Array.isArray(data.favorite_ids)) {
                const favSet = new Set(data.favorite_ids.map(String));
                document.querySelectorAll('.btn-wishlist-heart').forEach(btn => {
                    const id = btn.getAttribute('data-id');
                    const isFav = id && favSet.has(String(id));
                    updateHeartUI(btn, isFav);
                });
            }
        })
        .catch(err => console.warn('Category fav sync error:', err));
    };

    // Always sync on page load
    window.syncCategoryFavorites();

    // Always sync on pageshow (e.g. browser back/forward from /seller/favorites)
    window.addEventListener('pageshow', function() {
        window.syncCategoryFavorites();
    });

    // Sync on visibility change
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
            window.syncCategoryFavorites();
        }
    });

    // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
    window.selectQuickPrice = function(min, max, btn) {
        const minInput = document.getElementById('priceMin');
        const maxInput = document.getElementById('priceMax');
        const isAlreadyActive = btn && btn.classList.contains('active-chip');

        if (isAlreadyActive) {
            // Deselect
            if (minInput) minInput.value = '';
            if (maxInput) maxInput.value = '';
            btn.classList.remove('active-chip');
            btn.style.borderColor = '#E5E7EB';
            btn.style.background = '#FFFFFF';
            btn.style.color = '#4B5563';
        } else {
            if (minInput) minInput.value = min || '';
            if (maxInput) maxInput.value = max || '';
            document.querySelectorAll('.quick-price-chip').forEach(c => {
                c.classList.remove('active-chip');
                c.style.borderColor = '#E5E7EB';
                c.style.background = '#FFFFFF';
                c.style.color = '#4B5563';
            });
            if (btn) {
                btn.classList.add('active-chip');
                btn.style.borderColor = '#14794A';
                btn.style.background = '#EAF5EF';
                btn.style.color = '#14794A';
            }
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const soldPets = JSON.parse(localStorage.getItem('sold_pets') || '{}');
        const deletedPets = JSON.parse(localStorage.getItem('deleted_pets') || '{}');
        document.querySelectorAll('.pet-card').forEach(card => {
            const titleEl = card.querySelector('.pet-name');
            if (titleEl) {
                const key = titleEl.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
                if (soldPets[key] || deletedPets[key]) {
                    card.style.display = 'none';
                }
            }
        });

        // Direct event listener attachment
        document.querySelectorAll('.btn-wishlist-heart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                window.toggleCategoryFavorite(this, e);
            });
        });

        // Directly jump to pet cards if arriving with #petCardsGrid anchor without any scrolling animation
        // USER PROMPT: "directly goes to pet card no scrol up no scrool down just goes to that specific Pet card with out any scrolling"
        if (window.location.hash === '#petCardsGrid') {
            const target = document.getElementById('petCardsGrid');
            if (target) {
                target.scrollIntoView({ behavior: 'instant', block: 'start' });
            }
            requestAnimationFrame(() => {
                document.documentElement.style.scrollBehavior = '';
            });
        }

        // Scroll to card if returning from login/register with anchor
        if (window.location.hash && window.location.hash.startsWith('#listing-')) {
            const targetCard = document.querySelector(window.location.hash);
            if (targetCard) {
                setTimeout(() => {
                    targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    targetCard.style.transition = 'box-shadow 0.4s ease';
                    targetCard.style.boxShadow = '0 0 0 3px #147A4D';
                    setTimeout(() => {
                        targetCard.style.boxShadow = '';
                        if (window.location.hash && window.location.hash.startsWith('#listing-')) {
                            history.replaceState(null, document.title, window.location.pathname + window.location.search);
                        }
                    }, 1500);
                }, 300);
            }
        }
    });

    // USER PROMPT: "yr is main kitny bhi filters drop down hain un ka design same as home page kr do mb vw and desk top view"
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownWraps = document.querySelectorAll('.custom-dropdown-wrap');

        dropdownWraps.forEach(wrap => {
            const input = wrap.querySelector('input[type="hidden"]');
            const displayVal = wrap.querySelector('.home-filter-value, .custom-filter-display-val, .age-unit-display-val, .sort-current-val');
            const items = wrap.querySelectorAll('.custom-dropdown-item');

            wrap.addEventListener('click', function (e) {
                if (e.target.closest('.custom-dropdown-item')) return;
                const isOpen = wrap.classList.contains('is-open');
                dropdownWraps.forEach(w => w.classList.remove('is-open'));
                if (!isOpen) {
                    wrap.classList.add('is-open');
                }
            });

            items.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const val = item.getAttribute('data-value') ?? '';
                    const span = item.querySelector('span');
                    const text = span ? span.innerText.trim() : '';

                    if (input) {
                        input.value = val;
                        // Fire change event so form listeners / sorting handlers trigger
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    if (displayVal && text) {
                        displayVal.innerText = text;
                    }

                    items.forEach(it => it.classList.remove('is-selected'));
                    item.classList.add('is-selected');
                    wrap.classList.remove('is-open');

                    // If Category changed in Sidebar: filter Breed items in #sidebarBreedMenu
                    if (wrap.classList.contains('sidebar-filter-dropdown') && wrap.dataset.filter === 'category') {
                        const breedMenu = document.getElementById('sidebarBreedMenu');
                        const breedInput = document.getElementById('filterBreed');
                        const breedWrap = breedMenu ? breedMenu.closest('.sidebar-filter-dropdown') : null;
                        const breedDisplay = breedWrap ? breedWrap.querySelector('.custom-filter-display-val') : null;

                        if (breedMenu) {
                            const bItems = breedMenu.querySelectorAll('.custom-dropdown-item');
                            const normVal = (val || '').toLowerCase().trim();
                            let isCurrentBreedStillValid = false;
                            const currentBreedVal = breedInput ? (breedInput.value || '').toLowerCase().trim() : '';

                            bItems.forEach(bItem => {
                                const bVal = (bItem.getAttribute('data-value') || '').toLowerCase().trim();
                                const bCat = (bItem.getAttribute('data-category-slug') || '').toLowerCase().trim();

                                if (!bVal) {
                                    bItem.style.display = 'flex';
                                } else if (!normVal || bCat === normVal || (normVal === 'dogs' && bCat === 'dog') || (normVal === 'cats' && bCat === 'cat') || (normVal === 'birds' && bCat === 'bird') || (normVal === 'rabbits' && bCat === 'rabbit') || (normVal === 'reptiles' && bCat === 'reptile') || (normVal === 'fish' && bCat === 'fishes')) {
                                    bItem.style.display = 'flex';
                                    if (bVal === currentBreedVal) isCurrentBreedStillValid = true;
                                } else {
                                    bItem.style.display = 'none';
                                }
                            });

                            if (!isCurrentBreedStillValid && currentBreedVal) {
                                if (breedInput) {
                                    breedInput.value = '';
                                    breedInput.dispatchEvent(new Event('change', { bubbles: true }));
                                }
                                if (breedDisplay) breedDisplay.innerText = 'All Breeds';
                                bItems.forEach(bi => {
                                    if (!bi.getAttribute('data-value')) bi.classList.add('is-selected');
                                    else bi.classList.remove('is-selected');
                                });
                            }
                        }
                    }
                });
            });
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.custom-dropdown-wrap')) {
                dropdownWraps.forEach(w => w.classList.remove('is-open'));
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                dropdownWraps.forEach(w => w.classList.remove('is-open'));
            }
        });
    });

    window.addEventListener('load', function() {
        if (window.location.hash === '#petCardsGrid') {
            const target = document.getElementById('petCardsGrid');
            if (target) {
                target.scrollIntoView({ behavior: 'instant', block: 'start' });
            }
        }
    });
    </script>
</body>
</html>

