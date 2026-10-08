<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Pet Listings - Pet Marketplace</title>

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
        <x-hero title="Browse Pet Listings" description="Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.">
            <!-- Floating Search Card Container -->
            <div class="shell-1440">
                <div class="container">
                    <div class="category-search-card">
                        <form action="#" method="GET" class="category-search-form" id="searchFilterForm">
                            
                            <!-- Search Input Field -->
                            <div class="search-input-group">
                                <i class="fas fa-search search-group-icon"></i>
                                <input type="text" name="q" placeholder="Search pets or breed" class="search-form-input">
                            </div>

                            <!-- Category Dropdown Field -->
                            <div class="search-input-group">
                                <i class="fas fa-paw search-group-icon"></i>
                                <select name="category" class="search-form-select">
                                    <option value="">Any category</option>
                                    <option value="dogs">Dogs</option>
                                    <option value="cats">Cats</option>
                                    <option value="birds">Birds</option>
                                    <option value="rabbits">Rabbits</option>
                                    <option value="fish">Fish</option>
                                    <option value="reptiles">Reptiles</option>
                                    <option value="horses-farm">Horses & Farm</option>
                                    <option value="exotic">Exotic Pets</option>
                                </select>
                                <i class="fas fa-chevron-down select-arrow-icon"></i>
                            </div>

                            <!-- Location Dropdown Field -->
                            <div class="search-input-group">
                                <i class="fas fa-map-marker-alt search-group-icon"></i>
                                <select name="location" class="search-form-select">
                                    <option value="">Any location</option>
                                    <option value="islamabad">Islamabad</option>
                                    <option value="karachi">Karachi</option>
                                    <option value="lahore">Lahore</option>
                                    <option value="rawalpindi">Rawalpindi</option>
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
                                    <button type="button" class="btn-reset-filters" id="resetFiltersBtn" style="display: none;">Reset all</button>
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
                                            <option value="cats">Cats</option>
                                            <option value="dogs">Dogs</option>
                                            <option value="birds">Birds</option>
                                            <option value="rabbits">Rabbits</option>
                                            <option value="fish">Fish</option>
                                            <option value="reptiles">Reptiles</option>
                                            <option value="horses-farm">Horses & Farm</option>
                                            <option value="exotic">Exotic Pets</option>
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
                                            <option value="british-shorthair">British Shorthair</option>
                                            <option value="shih-tzu">Shih Tzu</option>
                                            <option value="lovebird">Lovebird</option>
                                            <option value="golden-retriever">Golden Retriever</option>
                                            <option value="persian">Persian</option>
                                            <option value="african-grey">African Grey</option>
                                            <option value="german-shepherd">German Shepherd</option>
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
                                            <option value="islamabad">Islamabad</option>
                                            <option value="karachi">Karachi</option>
                                            <option value="lahore">Lahore</option>
                                        </select>
                                        <i class="fas fa-chevron-down select-chevron"></i>
                                    </div>
                                </div>

                                <!-- 4. Price Range -->
                                <div class="filter-group">
                                    <label class="filter-label">Price Range</label>
                                    <div class="min-max-inputs-row">
                                        <input type="number" name="price_min" placeholder="Min" class="filter-number-input" id="priceMin" autocomplete="off">
                                        <input type="number" name="price_max" placeholder="Max" class="filter-number-input" id="priceMax" autocomplete="off">
                                    </div>
                                </div>

                                <!-- 5. Age Range -->
                                <div class="filter-group">
                                    <label class="filter-label">Age Range</label>
                                    <div class="age-inputs-container" style="display: flex; flex-direction: column; gap: 8px;">
                                        <div style="display: flex; gap: 8px;">
                                            <input type="number" name="age_min" placeholder="Min" class="filter-number-input" id="ageMin" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <select name="age_min_unit" id="ageMinUnit" class="filter-select" style="width: 100px; padding: 0 10px; min-height: 44px; border-radius: 8px; border: 1px solid #E5E7EB; background-color: #fff;">
                                                <option value="days">Days</option>
                                                <option value="months" selected>Months</option>
                                                <option value="years">Years</option>
                                            </select>
                                        </div>
                                        <div style="display: flex; gap: 8px;">
                                            <input type="number" name="age_max" placeholder="Max" class="filter-number-input" id="ageMax" autocomplete="off" style="flex: 1; min-width: 0;">
                                            <select name="age_max_unit" id="ageMaxUnit" class="filter-select" style="width: 100px; padding: 0 10px; min-height: 44px; border-radius: 8px; border: 1px solid #E5E7EB; background-color: #fff;">
                                                <option value="days">Days</option>
                                                <option value="months" selected>Months</option>
                                                <option value="years">Years</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Gender -->
                                <div class="filter-group">
                                    <label class="filter-label">Gender</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender" value="male">
                                            <span class="label-text">Male</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="gender" value="female">
                                            <span class="label-text">Female</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 7. Health -->
                                <div class="filter-group">
                                    <label class="filter-label">Health</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="health" value="vaccinated">
                                            <span class="label-text">Vaccinated</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="health" value="health_info">
                                            <span class="label-text">Health information available</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 8. Pedigree / Papers -->
                                <div class="filter-group">
                                    <label class="filter-label">Pedigree / Papers</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="yes">
                                            <span class="label-text">Yes</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="no">
                                            <span class="label-text">No</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="pedigree" value="na">
                                            <span class="label-text">Not applicable</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- 9. Seller Type -->
                                <div class="filter-group">
                                    <label class="filter-label">Seller Type</label>
                                    <div class="checkbox-options-list">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="individual">
                                            <span class="label-text">Individual Seller</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="breeder">
                                            <span class="label-text">Breeder / Business</span>
                                        </label>
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="seller_type" value="verified">
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
                                            <option value="24h">Past 24 Hours</option>
                                            <option value="week">Past Week</option>
                                            <option value="month">Past Month</option>
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
                                    <p class="listings-subtitle">Showing matching pet listings</p>
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
                                            <select class="sort-select-input">
                                                <option value="relevant">Relevant</option>
                                                <option value="newest">Newest First</option>
                                                <option value="price_asc">Price: Low to High</option>
                                                <option value="price_desc">Price: High to Low</option>
                                            </select>
                                            <i class="fas fa-chevron-down sort-chevron"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <!-- PET CARDS GRID (2 Columns on Mobile, 3 Columns on Desktop) -->
                            <div class="pet-cards-grid" id="petCardsGrid">

                                <!-- CARD 1: Golden Retriever Puppy (FEATURED) -->
                                <article class="pet-card" data-breed="golden-retriever" data-gender="male" data-location="lahore">
                                    <div class="pet-card-image-box">
                                        <span class="featured-badge">FEATURED</span>
                                        <img src="{{ asset('images/pets/golden-retriever.jpg') }}" alt="Golden Retriever Puppy" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">Golden Retriever Puppy</h3>
                                        <span class="pet-breed-tag">Golden Retriever</span>
                                        <div class="pet-price">Rs. 85,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 3 Months</span>
                                            <span class="meta-item"><i class="fas fa-mars"></i> Male</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lahore</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 2: Persian Cat -->
                                <article class="pet-card" data-breed="persian" data-gender="female" data-location="islamabad">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/persian-cat.jpg') }}" alt="Persian Cat" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">Persian Cat</h3>
                                        <span class="pet-breed-tag">Persian</span>
                                        <div class="pet-price">Rs. 42,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 7 Months</span>
                                            <span class="meta-item"><i class="fas fa-venus"></i> Female</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Islamabad</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 3: African Grey Parrot -->
                                <article class="pet-card" data-breed="african-grey" data-gender="male" data-location="karachi">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/african-grey.jpg') }}" alt="African Grey Parrot" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">African Grey Parrot</h3>
                                        <span class="pet-breed-tag">African Grey</span>
                                        <div class="pet-price">Rs. 65,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 1 Year</span>
                                            <span class="meta-item"><i class="fas fa-mars"></i> Male</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Karachi</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 4: Mini Lop Rabbit (FEATURED) -->
                                <article class="pet-card" data-breed="mini-lop" data-gender="female" data-location="lahore">
                                    <div class="pet-card-image-box">
                                        <span class="featured-badge">FEATURED</span>
                                        <img src="{{ asset('images/pets/mini-lop.jpg') }}" alt="Mini Lop Rabbit" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">Mini Lop Rabbit</h3>
                                        <span class="pet-breed-tag">Mini Lop</span>
                                        <div class="pet-price">Rs. 12,500</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 5 Months</span>
                                            <span class="meta-item"><i class="fas fa-venus"></i> Female</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lahore</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 5: German Shepherd -->
                                <article class="pet-card" data-breed="german-shepherd" data-gender="male" data-location="rawalpindi">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/german-shepherd.jpg') }}" alt="German Shepherd" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">German Shepherd</h3>
                                        <span class="pet-breed-tag">German Shepherd</span>
                                        <div class="pet-price">Rs. 70,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 4 Months</span>
                                            <span class="meta-item"><i class="fas fa-mars"></i> Male</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Rawalpindi</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 6: British Shorthair -->
                                <article class="pet-card" data-breed="british-shorthair" data-gender="female" data-location="lahore">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/british-shorthair.jpg') }}" alt="British Shorthair" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">British Shorthair</h3>
                                        <span class="pet-breed-tag">British Shorthair</span>
                                        <div class="pet-price">Rs. 55,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 6 Months</span>
                                            <span class="meta-item"><i class="fas fa-venus"></i> Female</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Lahore</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 7: Shih Tzu Puppy -->
                                <article class="pet-card" data-breed="shih-tzu" data-gender="female" data-location="faisalabad">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/shih-tzu.jpg') }}" alt="Shih Tzu Puppy" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">Shih Tzu Puppy</h3>
                                        <span class="pet-breed-tag">Shih Tzu</span>
                                        <div class="pet-price">Rs. 48,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 2 Months</span>
                                            <span class="meta-item"><i class="fas fa-venus"></i> Female</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Faisalabad</span>
                                        </div>
                                    </div>
                                </article>

                                <!-- CARD 8: Lovebird Pair -->
                                <article class="pet-card" data-breed="lovebird" data-gender="female" data-location="sialkot">
                                    <div class="pet-card-image-box">
                                        <img src="{{ asset('images/pets/lovebird.jpg') }}" alt="Lovebird Pair" class="pet-card-img">
                                        <button type="button" class="btn-wishlist-heart" aria-label="Add to Favorites">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="pet-card-content">
                                        <h3 class="pet-name">Lovebird Pair</h3>
                                        <span class="pet-breed-tag">Lovebird</span>
                                        <div class="pet-price">Rs. 18,000</div>
                                        <div class="pet-meta-row">
                                            <span class="meta-item"><i class="far fa-clock"></i> 8 Months</span>
                                            <span class="meta-item"><i class="fas fa-venus"></i> Female</span>
                                        </div>
                                        <div class="pet-meta-row location-row">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> Sialkot</span>
                                        </div>
                                    </div>
                                </article>

                            </div>
                            
                            <!-- NO RESULTS MESSAGE -->
                            <div id="noResultsMessage" style="display: none; text-align: center; padding: 60px 20px; color: #666; font-size: 1.2rem; background: #f9f9f9; border-radius: 16px; margin-top: 20px;">
                                <i class="fas fa-search" style="font-size: 2.5rem; color: #ccc; margin-bottom: 16px; display: block;"></i>
                                No pets found matching your filters.
                            </div>

                            <!-- PAGINATION COMPONENT -->
                            <div class="category-pagination-row">
                                <button type="button" class="page-nav-arrow" aria-label="Previous Page">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                                <button type="button" class="page-num-btn active">1</button>
                                <button type="button" class="page-num-btn">2</button>
                                <button type="button" class="page-num-btn">3</button>
                                <button type="button" class="page-num-btn">4</button>
                                <button type="button" class="page-num-btn">5</button>
                                <span class="page-dots">...</span>
                                <button type="button" class="page-num-btn">28</button>
                                <button type="button" class="page-nav-arrow" aria-label="Next Page">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>

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
</body>
</html>
