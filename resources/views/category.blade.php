<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ (request('featured') === 'true' || request('featured') === '1') ? 'Featured Pet Listings' : 'Browse Pet Listings' }} - Pet Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
</head>
<body>

    <!-- HEADER COMPONENT (Built-in component included cleanly as requested) -->
    <x-header />

    <!-- PAGE BODY SHELL (Strict 1440px Outer Shell) -->
    <main class="site-wrapper">

        <!-- HERO BANNER SECTION (#FAF7F2 / Cream background, 1440px shell -> 1250px container) -->
        <x-hero :title="(request('featured') === 'true' || request('featured') === '1') ? 'Featured Pet Listings' : 'Browse Pet Listings'" :description="(request('featured') === 'true' || request('featured') === '1') ? 'Discover premium and featured pet listings from top verified sellers.' : 'Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.'">
            <!-- Floating Search Card Container -->
            <div class="shell-1440">
                <div class="container">
                    <div class="category-search-card">
                        <form action="{{ route('category') }}" method="GET" class="category-search-form" id="searchFilterForm">
                            
                            <!-- Search Input Field -->
                            <div class="search-input-group">
                                <i class="fas fa-search search-group-icon"></i>
                                <input type="text" name="q" value="{{ request('q', request('search')) }}" placeholder="Search pets or breed" class="search-form-input">
                            </div>

                            <!-- Category Dropdown Field -->
                            <div class="search-input-group">
                                <i class="fas fa-paw search-group-icon"></i>
                                <select name="category" class="search-form-select">
                                    <option value="">Any category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}" {{ (request('category') == $cat->slug || (isset($selectedCategory) && $selectedCategory && $selectedCategory->id == $cat->id)) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down select-arrow-icon"></i>
                            </div>

                            <!-- Location Dropdown Field -->
                            <div class="search-input-group">
                                <i class="fas fa-map-marker-alt search-group-icon"></i>
                                <select name="location" class="search-form-select">
                                    <option value="">Any location</option>
                                    <option value="islamabad" {{ request('location') == 'islamabad' ? 'selected' : '' }}>Islamabad</option>
                                    <option value="karachi" {{ request('location') == 'karachi' ? 'selected' : '' }}>Karachi</option>
                                    <option value="lahore" {{ request('location') == 'lahore' ? 'selected' : '' }}>Lahore</option>
                                    <option value="rawalpindi" {{ request('location') == 'rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                                    <option value="faisalabad" {{ request('location') == 'faisalabad' ? 'selected' : '' }}>Faisalabad</option>
                                    <option value="multan" {{ request('location') == 'multan' ? 'selected' : '' }}>Multan</option>
                                    <option value="sialkot" {{ request('location') == 'sialkot' ? 'selected' : '' }}>Sialkot</option>
                                    <option value="peshawar" {{ request('location') == 'peshawar' ? 'selected' : '' }}>Peshawar</option>
                                </select>
                                <i class="fas fa-chevron-down select-arrow-icon"></i>
                            </div>

                            <!-- Find a Pet Submit Button -->
                            <button type="submit" class="btn-find-pets">
                                <i class="fas fa-search"></i>
                                <span>Find a Pet</span>
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
                                    <a href="{{ route('category') }}" class="btn-reset-filters" id="resetFiltersBtn" style="{{ request()->hasAny(['category', 'breed', 'location', 'city', 'price_min', 'price_max', 'min_price', 'max_price', 'age_min', 'age_max', 'gender', 'health', 'date', 'featured', 'search', 'q']) ? 'display: inline-block;' : 'display: none;' }} text-decoration: none;">Reset all</a>
                                    <button type="button" class="close-sidebar-btn" id="closeFiltersBtn" aria-label="Close Filters"><i class="fas fa-times"></i></button>
                                </div>
                            </div>

                            <form id="sidebarFiltersForm" action="{{ route('category') }}" method="GET" autocomplete="off">
                                
                                <!-- 1. Pet Category -->
                                <div class="filter-group">
                                    <label class="filter-label" for="filterCategory">Pet Category</label>
                                    <div class="filter-select-wrapper">
                                        <select id="filterCategory" name="category" class="filter-select">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->slug }}" {{ (request('category') == $cat->slug || (isset($selectedCategory) && $selectedCategory && $selectedCategory->id == $cat->id)) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down select-chevron"></i>
                                    </div>
                                </div>

                                <!-- 2. Breed -->
                                <div class="filter-group">
                                    <label class="filter-label" for="filterBreed">Breed</label>
                                    <div class="filter-select-wrapper">
                                        <select id="filterBreed" name="breed" class="filter-select">
                                            <option value="">All Breeds</option>
                                            @php
                                                $selectedBreedVal = strtolower(trim(request('breed', '')));
                                            @endphp
                                            @foreach($allBreeds as $b)
                                                <option value="{{ $b->slug }}" 
                                                        data-category-slug="{{ $b->category ? $b->category->slug : '' }}"
                                                        data-category-id="{{ $b->category_id }}"
                                                        {{ ($selectedBreedVal === strtolower($b->slug) || $selectedBreedVal === strtolower($b->name)) ? 'selected' : '' }}>
                                                    {{ $b->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down select-chevron"></i>
                                    </div>
                                </div>

                                <!-- 3. Location / City -->
                                <div class="filter-group">
                                    <label class="filter-label" for="filterLocation">Location / City</label>
                                    <div class="filter-select-wrapper">
                                        <select id="filterLocation" name="location" class="filter-select">
                                            <option value="">All Locations</option>
                                            @php $currLoc = strtolower(request('location', request('city', ''))); @endphp
                                            <option value="islamabad" {{ $currLoc == 'islamabad' ? 'selected' : '' }}>Islamabad</option>
                                            <option value="karachi" {{ $currLoc == 'karachi' ? 'selected' : '' }}>Karachi</option>
                                            <option value="lahore" {{ $currLoc == 'lahore' ? 'selected' : '' }}>Lahore</option>
                                            <option value="rawalpindi" {{ $currLoc == 'rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                                            <option value="faisalabad" {{ $currLoc == 'faisalabad' ? 'selected' : '' }}>Faisalabad</option>
                                            <option value="multan" {{ $currLoc == 'multan' ? 'selected' : '' }}>Multan</option>
                                            <option value="sialkot" {{ $currLoc == 'sialkot' ? 'selected' : '' }}>Sialkot</option>
                                            <option value="peshawar" {{ $currLoc == 'peshawar' ? 'selected' : '' }}>Peshawar</option>
                                        </select>
                                        <i class="fas fa-chevron-down select-chevron"></i>
                                    </div>
                                </div>

                                <!-- 4. Price Range -->
                                <div class="filter-group">
                                    <label class="filter-label">Price Range (PKR)</label>
                                    <div class="min-max-inputs-row">
                                        <input type="text" inputmode="numeric" name="price_min" placeholder="Min (e.g. 5,000)" class="filter-number-input" id="priceMin" value="{{ isset($minPrice) && $minPrice !== null ? number_format($minPrice, 0, '', '') : request('price_min', request('min_price')) }}" autocomplete="off">
                                        <input type="text" inputmode="numeric" name="price_max" placeholder="Max (e.g. 60,000)" class="filter-number-input" id="priceMax" value="{{ isset($maxPrice) && $maxPrice !== null ? number_format($maxPrice, 0, '', '') : request('price_max', request('max_price')) }}" autocomplete="off">
                                    </div>
                                </div>

                                <!-- 5. Age Range -->
                                <div class="filter-group">
                                    <label class="filter-label">Age Range</label>
                                    <div class="age-inputs-container" style="display: flex; flex-direction: column; gap: 8px;">
                                        <div style="display: flex; gap: 8px;">
                                            <input type="number" name="age_min" placeholder="Min" class="filter-number-input" id="ageMin" value="{{ request('age_min') }}" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <select name="age_min_unit" id="ageMinUnit" class="filter-select" style="width: 100px; padding: 0 10px; min-height: 44px; border-radius: 8px; border: 1px solid #E5E7EB; background-color: #fff;">
                                                <option value="days" {{ request('age_min_unit') == 'days' ? 'selected' : '' }}>Days</option>
                                                <option value="months" {{ (!request('age_min_unit') || request('age_min_unit') == 'months') ? 'selected' : '' }}>Months</option>
                                                <option value="years" {{ request('age_min_unit') == 'years' ? 'selected' : '' }}>Years</option>
                                            </select>
                                        </div>
                                        <div style="display: flex; gap: 8px;">
                                            <input type="number" name="age_max" placeholder="Max" class="filter-number-input" id="ageMax" value="{{ request('age_max') }}" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <select name="age_max_unit" id="ageMaxUnit" class="filter-select" style="width: 100px; padding: 0 10px; min-height: 44px; border-radius: 8px; border: 1px solid #E5E7EB; background-color: #fff;">
                                                <option value="days" {{ request('age_max_unit') == 'days' ? 'selected' : '' }}>Days</option>
                                                <option value="months" {{ (!request('age_max_unit') || request('age_max_unit') == 'months') ? 'selected' : '' }}>Months</option>
                                                <option value="years" {{ request('age_max_unit') == 'years' ? 'selected' : '' }}>Years</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Gender -->
                                <div class="filter-group">
                                    <label class="filter-label">Gender</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender[]" value="male" {{ (is_array(request('gender')) ? in_array('male', request('gender')) : request('gender') == 'male') ? 'checked' : '' }}>
                                            <span class="label-text">Male</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender[]" value="female" {{ (is_array(request('gender')) ? in_array('female', request('gender')) : request('gender') == 'female') ? 'checked' : '' }}>
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
                                <div class="filter-group filter-group-last">
                                    <label class="filter-label" for="filterDate">Date Posted</label>
                                    <div class="filter-select-wrapper">
                                        <select id="filterDate" name="date" class="filter-select">
                                            <option value="">Any Time</option>
                                            <option value="24h" {{ request('date') == '24h' ? 'selected' : '' }}>Past 24 Hours</option>
                                            <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Past Week</option>
                                            <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Past Month</option>
                                        </select>
                                        <i class="fas fa-chevron-down select-chevron"></i>
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
                                    <p class="listings-subtitle">Showing {{ $listings->total() }} matching pet listings</p>
                                </div>
    
                                <!-- Header Controls Row (Mobile Filter Button + View & Sort Controls) -->
                                <div class="listings-controls-header">
                                    <button type="button" class="mobile-filter-trigger" id="mobileFilterToggleBtn">
                                        <i class="fas fa-sliders-h"></i>
                                        <span>Filters</span>
                                    </button>

                                <div class="listings-controls-right">
                                    <div class="view-toggle-group">
                                        <span class="view-label">View:</span>
                                        <button type="button" class="view-toggle-btn" aria-label="List View">
                                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none">
                                                <circle cx="2.2" cy="3" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="3" x2="21" y2="3" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                                <circle cx="2.2" cy="9" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="9" x2="21" y2="9" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                                <circle cx="2.2" cy="15" r="1.8" fill="#000000"/>
                                                <line x1="7" y1="15" x2="21" y2="15" stroke="#000000" stroke-width="2.5" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="view-toggle-btn active" aria-label="Grid View">
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

                                    <div class="sort-control-group">
                                        <span class="sort-label">Sort:</span>
                                        <div class="sort-select-wrapper">
                                            <select class="sort-select-input" onchange="const url = new URL(window.location); url.searchParams.set('sort', this.value); window.location = url.toString();">
                                                <option value="newest" {{ (!request('sort') || request('sort') == 'newest') ? 'selected' : '' }}>Newest First</option>
                                                <option value="price_asc" {{ (request('sort') == 'price_asc' || request('sort') == 'price_low') ? 'selected' : '' }}>Price: Low to High</option>
                                                <option value="price_desc" {{ (request('sort') == 'price_desc' || request('sort') == 'price_high') ? 'selected' : '' }}>Price: High to Low</option>
                                                <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Most Viewed</option>
                                            </select>
                                            <i class="fas fa-chevron-down sort-chevron"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <!-- Active Filters Container -->
                            <div id="activeFiltersContainer" class="active-filters-container">
                                <!-- Chips will be injected here via JS -->
                            </div>

                            <!-- PET CARDS GRID (2 Columns on Mobile, 3 Columns on Desktop) -->
                            <div class="pet-cards-grid" id="petCardsGrid" style="scroll-margin-top: 100px;">
                                @forelse($listings as $pet)
                                    <article class="pet-card" 
                                             id="listing-{{ $pet->id }}" 
                                             data-category="{{ $pet->category ? $pet->category->slug : '' }}" 
                                             data-breed="{{ Str::slug($pet->breed_name ?: ($pet->breed ? $pet->breed->name : '')) }}" 
                                             data-breed-name="{{ strtolower($pet->breed_name ?: ($pet->breed ? $pet->breed->name : '')) }}" 
                                             data-gender="{{ strtolower($pet->gender) }}" 
                                             data-location="{{ strtolower($pet->city) }}" 
                                             data-price="{{ (int) $pet->price }}" 
                                             data-age-months="{{ (int) $pet->age_months }}" 
                                             onclick="window.location='{{ route('pet.details', ['id' => $pet->id]) }}'" 
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

        // Auto-scroll directly to pets cards if arriving with #petCardsGrid anchor
        if (window.location.hash === '#petCardsGrid') {
            const target = document.getElementById('petCardsGrid');
            if (target) {
                setTimeout(() => {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setTimeout(() => {
                        if (window.location.hash === '#petCardsGrid') {
                            history.replaceState(null, document.title, window.location.pathname + window.location.search);
                        }
                    }, 1000);
                }, 100);
            }
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
    </script>
</body>
</html>

