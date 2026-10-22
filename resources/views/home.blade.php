    <main class="site-wrapper">

        <!-- HERO SECTION WRAPPER -->
        <section class="home-hero">

            <!-- Background Decorative Shapes Container (Clipped so shapes don't overflow) -->
            <div class="home-hero-shapes">

                <!-- Bottom-left soft beige hill shape -->
                <img src="{{ asset('images/herobottom.svg') }}" class="home-hero-hill" alt="">

                <!-- Center small floating diamond accents -->
                <div class="home-hero-diamond-1"></div>
                <div class="home-hero-diamond-2"></div>
                <div class="home-hero-diamond-3"></div>

                <!-- Right-side Green organic shape -->
                <div class="home-hero-shape-green"></div>

                <!-- Right-side Warm Yellow tilted rectangle shape -->
                <div class="home-hero-shape-yellow"></div>
                
                <!-- Bottom-left Warm Yellow tilted shape (mobile only) -->
                <div class="home-hero-shape-yellow-bottom"></div>
            </div>

            {{-- USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai" --}}
            <!-- HERO MAIN CONTENT (Dynamic Headline, Description & Visual Image) -->
            <div class="home-hero-inner">

                <!-- Left Column: Heading & Subtitle -->
                <div class="home-hero-text">
                    {{-- USER PROMPT: "yr idher koi html code na ho" --}}
                    <h1 class="home-hero-title">
                        {{ \App\Models\SiteSetting::get('hero_title', 'Find the right pet for your family.') }}
                    </h1>
                    <p class="home-hero-desc">
                        {{ \App\Models\SiteSetting::get('hero_desc', 'Search pets by category, breed, location and price, then review the listing and seller before making contact.') }}
                    </p>
                </div>

                <!-- Right Column: Dog & Owner Image -->
                <div class="home-hero-visual">
                    <div class="home-hero-visual-inner">
                        <!-- Comic Excitement Lines SVG near the dog head -->
                        <svg class="home-hero-excite" width="38" height="38" viewBox="0 0 40 40" fill="none">
                            <path d="M5 14L18 8" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M12 25L22 17" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M27 32L29 19" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>

                        <!-- Dynamic Pet Hero Image -->
                        <img
                            src="{{ asset(\App\Models\SiteSetting::get('hero_image', 'images/home-hero-image.png')) }}"
                            alt="Happy pet owner"
                            class="home-hero-img"
                        />
                    </div>
                </div>

            </div>

            {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
            @php
                $heroCatLabel = \App\Models\SiteSetting::get('filter_cat_label', 'PET CATEGORY');
                $heroCatPlaceholder = \App\Models\SiteSetting::get('filter_cat_placeholder', 'Any category');
                $heroBreedLabel = \App\Models\SiteSetting::get('filter_breed_label', 'BREED');
                $heroBreedPlaceholder = \App\Models\SiteSetting::get('filter_breed_placeholder', 'Any breed');
                $heroLocLabel = \App\Models\SiteSetting::get('filter_loc_label', 'LOCATION');
                $heroLocPlaceholder = \App\Models\SiteSetting::get('filter_loc_placeholder', 'Any location');
                $heroPriceLabel = \App\Models\SiteSetting::get('filter_price_label', 'PRICE');
                $heroPricePlaceholder = \App\Models\SiteSetting::get('filter_price_placeholder', 'Any price');
                $heroBtnText = \App\Models\SiteSetting::get('filter_btn_text', 'Find a Pet');
                $activePriceRanges = $priceRanges ?? \App\Models\SiteSetting::getPriceRanges();
                $activeLocations = $dynamicCities ?? \App\Models\SiteSetting::getLocationsList();
            @endphp
            <!-- FLOATING DYNAMIC SEARCH BAR (Synchronized with Admin & Category Filters) -->
            <form action="{{ route('category') }}" method="GET" class="home-search-wrap">

                <div class="home-search-bar">

                    <!-- Filter 1: PET CATEGORY BUTTON -->
                    <div class="home-filter custom-dropdown-wrap" data-filter="category" data-default="{{ $heroCatPlaceholder }}" tabindex="0">
                        <input type="hidden" name="category" value="">
                        <div class="home-filter-left">
                            <!-- Green Paw Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                <circle cx="7" cy="7.5" r="2.2"/>
                                <circle cx="12" cy="5.5" r="2.2"/>
                                <circle cx="17" cy="7.5" r="2.2"/>
                                <circle cx="4.5" cy="12" r="2"/>
                                <path d="M12 10.5c-3.2 0-5.5 2.4-5.5 5.2 0 1.8 1.4 3.3 3.2 3.3 1 0 1.6-.4 2.3-.4s1.3.4 2.3.4c1.8 0 3.2-1.5 3.2-3.3 0-2.8-2.3-5.2-5.5-5.2z"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">{{ $heroCatLabel }}</span>
                                <span class="home-filter-value">{{ $heroCatPlaceholder }}</span>
                            </div>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>

                        <!-- Custom Dynamic Category Dropdown Menu -->
                        <div class="custom-dropdown-menu">
                            <div class="custom-dropdown-item is-selected" data-value="">
                                <span>{{ $heroCatPlaceholder }}</span>
                                <i class="fa-solid fa-check opt-check"></i>
                            </div>
                            @if(isset($categories) && $categories->isNotEmpty())
                                @foreach($categories as $cat)
                                    <div class="custom-dropdown-item" data-value="{{ $cat->slug }}">
                                        <span>{{ $cat->name }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Filter 2: BREED BUTTON -->
                    <div class="home-filter custom-dropdown-wrap" data-filter="breed" data-default="{{ $heroBreedPlaceholder }}" tabindex="0">
                        <input type="hidden" name="breed" value="">
                        <div class="home-filter-left">
                            <!-- Green Breed Icon (DNA) -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#14794A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 3v2c0 3 8 5 8 8v8"/>
                                <path d="M16 3v2c0 3-8 5-8 8v8"/>
                                <path d="M8 6h8"/>
                                <path d="M10 12h4"/>
                                <path d="M8 18h8"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">{{ $heroBreedLabel }}</span>
                                <span class="home-filter-value">{{ $heroBreedPlaceholder }}</span>
                            </div>
                        </div>
                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>

                        <!-- Custom Dynamic Breed Dropdown Menu -->
                        <div class="custom-dropdown-menu" id="homeBreedDropdown">
                            <div class="custom-dropdown-item is-selected" data-value="" data-category="">
                                <span>{{ $heroBreedPlaceholder }}</span>
                                <i class="fa-solid fa-check opt-check"></i>
                            </div>
                            @if(isset($breeds) && $breeds->isNotEmpty())
                                @foreach($breeds as $b)
                                    <div class="custom-dropdown-item" data-value="{{ $b->slug }}" data-category="{{ $b->category ? $b->category->slug : '' }}">
                                        <span>{{ $b->name }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Filter 3: LOCATION BUTTON -->
                    <div class="home-filter custom-dropdown-wrap" data-filter="location" data-default="{{ $heroLocPlaceholder }}" tabindex="0">
                        <input type="hidden" name="location" value="">
                        <div class="home-filter-left">
                            <!-- Green Location Pin Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">{{ $heroLocLabel }}</span>
                                <span class="home-filter-value">{{ $heroLocPlaceholder }}</span>
                            </div>
                        </div>
                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>

                        <!-- Custom Dynamic Locations Dropdown Menu -->
                        <div class="custom-dropdown-menu">
                            <div class="custom-dropdown-item is-selected" data-value="">
                                <span>{{ $heroLocPlaceholder }}</span>
                                <i class="fa-solid fa-check opt-check"></i>
                            </div>
                            @if(isset($activeLocations) && count($activeLocations) > 0)
                                @foreach($activeLocations as $city)
                                    <div class="custom-dropdown-item" data-value="{{ strtolower(trim($city)) }}">
                                        <span>{{ $city }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Filter 4: PRICE BUTTON -->
                    <div class="home-filter custom-dropdown-wrap" data-filter="price" data-default="{{ $heroPricePlaceholder }}" tabindex="0">
                        <input type="hidden" name="price" value="">
                        <div class="home-filter-left">
                            <!-- Green Price Tag Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">{{ $heroPriceLabel }}</span>
                                <span class="home-filter-value">{{ $heroPricePlaceholder }}</span>
                            </div>
                        </div>
                        <svg class="home-filter-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>

                        <!-- Custom Dynamic Price Dropdown Menu -->
                        <div class="custom-dropdown-menu">
                            <div class="custom-dropdown-item is-selected" data-value="">
                                <span>{{ $heroPricePlaceholder }}</span>
                                <i class="fa-solid fa-check opt-check"></i>
                            </div>
                            @if(isset($activePriceRanges) && count($activePriceRanges) > 0)
                                @foreach($activePriceRanges as $range)
                                    <div class="custom-dropdown-item" data-value="{{ $range['val'] }}">
                                        <span>{{ $range['label'] }}</span>
                                        <i class="fa-solid fa-check opt-check"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- CTA Button: Dynamic Find a Pet -->
                    <button type="submit" class="home-search-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>{{ $heroBtnText }}</span>
                    </button>

                </div>
            </form>

        </section>

        <!-- Next Section Spacer (So the overlapping search bar looks natural) -->
        <div class="home-hero-spacer"></div>

        {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
        <!-- CATEGORIES -->
        <div class="home-categories-section">
            <h2 class="home-sec-title home-sec-title--md">{{ \App\Models\SiteSetting::get('home_cat_title', 'Browse by Pet Category') }}</h2>
            <p class="home-sec-desc home-sec-desc--spaced">{{ \App\Models\SiteSetting::get('home_cat_subtitle', "Start your search by choosing the type of companion you're looking for.") }}</p>
            <style>
                .home-categories-wrapper {
                    width: 100%;
                    overflow-x: auto;
                    padding: 10px 0;
                    /* Hide scrollbar for Chrome, Safari and Opera */
                    -ms-overflow-style: none;  /* IE and Edge */
                    scrollbar-width: none;  /* Firefox */
                }
                .home-categories-wrapper::-webkit-scrollbar {
                    display: none;
                }
                .home-categories-track {
                    display: inline-flex;
                    gap: 30px;
                    width: max-content;
                }
            </style>
            <div class="home-categories-wrapper">
                <div class="home-categories-track">
                    {{-- USER PROMPT: "when i click on these option it scrool up to curent page ... i want that when i click on any of these opton it directly goes to pet card no scrol up no scrool down just goes to that specific Pet card with out any scrolling" --}}
                    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
                    <div class="home-categories" style="display: flex; gap: 30px; flex-wrap: nowrap;">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $cat)
                                <a href="{{ route('category', ['param1' => $cat->slug]) }}" class="home-cat-item" style="cursor: pointer; text-decoration: none; color: inherit;">
                                    <div class="home-cat-img">
                                        <img src="{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}" alt="{{ $cat->name }}" onerror="this.src='{{ asset('images/cat_dog.jpg') }}'">
                                    </div>
                                    <div class="home-cat-name">{{ $cat->name }}</div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- FEATURED PETS -->
        <div id="featured-pets" class="home-featured home-pets-section">
            <div class="home-container">
                <div class="home-header">
                    <div>
                        {{-- USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly" --}}
                        <a href="{{ route('featured.pets') }}" style="text-decoration: none; color: inherit;">
                            <h2 class="home-sec-title home-sec-title--md" style="cursor: pointer;">{{ \App\Models\SiteSetting::get('featured_sec_title', 'Featured Pets') }}</h2>
                        </a>
                        <p class="home-sec-desc home-sec-desc--flush">{{ \App\Models\SiteSetting::get('featured_sec_subtitle', 'Highlighted pet listings from sellers on the marketplace.') }}</p>
                    </div>
                    <button class="home-btn-outline home-btn-desktop" onclick="window.location='{{ route('featured.pets') }}'">View All Pets</button>
                </div>
                <div class="home-pets-grid">
                    @if(isset($featuredListings) && $featuredListings->isNotEmpty())
                        @foreach($featuredListings as $pet)
                            <div class="home-pet-card" id="listing-{{ $pet->id }}" onclick="window.location='{{ route('pet.details', ['slug' => $pet->slug ?: $pet->id]) }}'" style="scroll-margin-top: 100px; cursor: pointer;">
                                <div class="home-pet-media">
                                    <img src="{{ $pet->primary_image_url }}" alt="{{ $pet->title }}" class="home-pet-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                    <span class="home-pet-badge">FEATURED</span>
                                    @php
                                        $isFav = in_array($pet->id, $favoritedListingIds ?? []);
                                    @endphp
                                    <button type="button" 
                                            class="home-pet-fav {{ $isFav ? 'active favorited' : '' }}" 
                                            data-url="{{ route('favorites.toggle', ['listingId' => $pet->id]) }}" 
                                            data-id="{{ $pet->id }}" 
                                            style="border:none; cursor:pointer;" 
                                            title="{{ $isFav ? 'Remove from favorites' : 'Add to favorites' }}" 
                                            aria-label="Add to favorites">
                                        <i class="{{ $isFav ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isFav ? 'color: #ff4b68;' : '' }}"></i>
                                    </button>
                                </div>
                                <div class="home-pet-info">
                                    <h3 class="home-pet-title">{{ $pet->title }}</h3>
                                    <p class="home-pet-breed">{{ $pet->breed_name ?: ($pet->breed ? $pet->breed->name : 'Pet') }}</p>
                                    <div class="home-pet-price">{{ $pet->formatted_price }}</div>
                                    <div class="home-pet-meta">
                                        <span><i class="fa-regular fa-clock"></i> {{ $pet->age_text }}</span>
                                        <span><i class="fa-solid fa-{{ $pet->gender == 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($pet->gender) }}</span>
                                    </div>
                                    {{-- USER PROMPT: "set exactly like this" --}}
                                    <div class="home-pet-location">
                                        <span class="home-pet-city"><i class="fa-solid fa-location-dot"></i> {{ $pet->city }}</span>
                                        <span class="home-pet-time"><i class="fa-regular fa-clock"></i> {{ $pet->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- USER PROMPT: "yr mera ya flow ho ga ab user ay ga vo signup kry ga agr vo pet  sell jo krta hao vo show hon is ky ilawa koi dummy data show pets na hon jo vo listing bany vohi sirf show hon" --}}
                        <div style="grid-column: 1 / -1; text-align: center; padding: 48px 24px; background: #FFFFFF; border-radius: 20px; border: 1.5px dashed #CBD5E1; margin: 10px 0;">
                            <i class="fa-solid fa-paw" style="font-size: 2.4rem; color: #147A4D; margin-bottom: 12px; display: inline-block;"></i>
                            <h3 style="font-size: 19px; font-weight: 700; color: #0F172A; margin-bottom: 6px;">No Pet Listings Posted Yet</h3>
                            <p style="font-size: 14px; color: #64748B; margin-bottom: 20px; max-width: 440px; margin-left: auto; margin-right: auto; line-height: 1.5;">
                                Sign up or log in to post your pet for sale. As soon as you create a listing, it will appear live right here!
                            </p>
                            <a href="{{ route('seller.create-listing') }}" class="home-btn-outline" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 11px 24px;">
                                <i class="fa-solid fa-plus"></i> Sell a Pet Now
                            </a>
                        </div>
                    @endif
                </div>
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--featured">
                    <a href="{{ route('featured.pets') }}" class="home-btn-viewall" id="featured-view-all-mobile">View All Pets</a>
                </div>
            </div>
        </div>

        <!-- LATEST PET LISTINGS -->
        <div class="home-latest home-pets-section">
            <div class="home-container">
                <div class="home-header home-header--latest">
                    <div class="home-header-text-left">
                        <a href="{{ route('category') }}" style="text-decoration: none; color: inherit;">
                            <h2 class="home-sec-title home-sec-title--md" style="cursor: pointer;">Latest Pet Listings</h2>
                        </a>
                        <p class="home-sec-desc home-sec-desc--latest">Fresh listings recently posted by pet owners and businesses.</p>
                    </div>
                    {{-- USER PROMPT: "is btn ka size oper waly btn ky size ky equal kro" --}}
                    <button class="home-btn-outline home-btn-desktop" onclick="window.location='{{ route('category') }}'">View All Pets</button>
                </div>
                <div class="home-pets-grid">
                    @if(isset($recentListings) && $recentListings->isNotEmpty())
                        @foreach($recentListings as $pet)
                            <div class="home-pet-card" id="listing-recent-{{ $pet->id }}" onclick="window.location='{{ route('pet.details', ['slug' => $pet->slug ?: $pet->id]) }}'" style="scroll-margin-top: 100px; cursor: pointer;">
                                <div class="home-pet-media">
                                    <img src="{{ $pet->primary_image_url }}" alt="{{ $pet->title }}" class="home-pet-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                    @if($pet->is_featured)
                                        <span class="home-pet-badge">FEATURED</span>
                                    @endif
                                    @php
                                        $isFav = in_array($pet->id, $favoritedListingIds ?? []);
                                    @endphp
                                    <button type="button" 
                                            class="home-pet-fav {{ $isFav ? 'active favorited' : '' }}" 
                                            data-url="{{ route('favorites.toggle', ['listingId' => $pet->id]) }}" 
                                            data-id="{{ $pet->id }}" 
                                            style="border:none; cursor:pointer;" 
                                            title="{{ $isFav ? 'Remove from favorites' : 'Add to favorites' }}" 
                                            aria-label="Add to favorites">
                                        <i class="{{ $isFav ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isFav ? 'color: #ff4b68;' : '' }}"></i>
                                    </button>
                                </div>
                                <div class="home-pet-info">
                                    <h3 class="home-pet-title">{{ $pet->title }}</h3>
                                    <p class="home-pet-breed">{{ $pet->breed_name ?: ($pet->breed ? $pet->breed->name : 'Pet') }}</p>
                                    <div class="home-pet-price">{{ $pet->formatted_price }}</div>
                                    <div class="home-pet-meta">
                                        <span><i class="fa-regular fa-clock"></i> {{ $pet->age_text }}</span>
                                        <span><i class="fa-solid fa-{{ $pet->gender == 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($pet->gender) }}</span>
                                    </div>
                                    {{-- USER PROMPT: "set exactly like this" --}}
                                    <div class="home-pet-location">
                                        <span class="home-pet-city"><i class="fa-solid fa-location-dot"></i> {{ $pet->city }}</span>
                                        <span class="home-pet-time"><i class="fa-regular fa-clock"></i> {{ $pet->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- USER PROMPT: "yr mera ya flow ho ga ab user ay ga vo signup kry ga agr vo pet  sell jo krta hao vo show hon is ky ilawa koi dummy data show pets na hon jo vo listing bany vohi sirf show hon" --}}
                        <div style="grid-column: 1 / -1; text-align: center; padding: 48px 24px; background: #FFFFFF; border-radius: 20px; border: 1.5px dashed #CBD5E1; margin: 10px 0;">
                            <i class="fa-solid fa-shield-cat" style="font-size: 2.4rem; color: #147A4D; margin-bottom: 12px; display: inline-block;"></i>
                            <h3 style="font-size: 19px; font-weight: 700; color: #0F172A; margin-bottom: 6px;">No Recent Pets Found</h3>
                            <p style="font-size: 14px; color: #64748B; margin-bottom: 20px; max-width: 440px; margin-left: auto; margin-right: auto; line-height: 1.5;">
                                When sellers create pet listings, their verified ads will be listed right here in real-time.
                            </p>
                            <a href="{{ route('seller.create-listing') }}" class="home-btn-outline" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 11px 24px;">
                                <i class="fa-solid fa-plus"></i> Post a Pet Listing
                            </a>
                        </div>
                    @endif
                </div>
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--featured">
                    <a href="{{ route('category') }}" class="home-btn-viewall" id="latest-view-all-mobile">View All Pets</a>
                </div>
            </div>
        </div>

        {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
        <!-- CTA BANNER -->
        @php
            $homeCtaTitle = \App\Models\SiteSetting::get('home_cta_title', 'One More Friend');
            $homeCtaSubtitle = \App\Models\SiteSetting::get('home_cta_subtitle', 'Thousands More Fun!');
            $homeCtaDesc = \App\Models\SiteSetting::get('home_cta_desc', 'Having a pet means you have more joy, a new friend, a happy person who will always be with you to have fun. We have 200+ different pets that can meet your needs!');
            $homeCtaImg = \App\Models\SiteSetting::get('home_cta_image', 'images/more-friend.png');
            $homeCtaBtn1Text = \App\Models\SiteSetting::get('home_cta_btn1_text', 'Browse Dogs');
            $homeCtaBtn1Link = \App\Models\SiteSetting::get('home_cta_btn1_link', '/category/dogs');
            $homeCtaBtn2Text = \App\Models\SiteSetting::get('home_cta_btn2_text', 'Browse Cats');
            $homeCtaBtn2Link = \App\Models\SiteSetting::get('home_cta_btn2_link', '/category/cats');
        @endphp
        <div class="home-cta">

            <!-- Decorative shapes (Background) -->
            <div class="home-cta-dark"></div>
            <div class="home-cta-cream"></div>

            <!-- Left Side: Image Container -->
            <div class="home-cta-img-wrap">
                <img src="{{ asset($homeCtaImg) }}" alt="{{ $homeCtaTitle }}" class="home-cta-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                <div class="home-cta-img-fallback">
                    <img src="{{ asset('images/cta-green-mb-vw.png') }}" alt="CTA Banner Image" class="home-cta-fallback-img">
                </div>
            </div>

            <!-- Right Side: Text & Buttons Container -->
            <div class="home-cta-text">

                <!-- Main Heading -->
                <h1 class="home-cta-title">{{ $homeCtaTitle }}</h1>

                <!-- Sub Heading -->
                <h2 class="home-cta-subtitle">{{ $homeCtaSubtitle }}</h2>

                <!-- Description Paragraph -->
                <p class="home-cta-desc">
                    {{ $homeCtaDesc }}
                </p>

                <!-- Buttons Wrapper -->
                <div class="home-cta-buttons">
                    @if(!empty($homeCtaBtn1Text))
                    <a href="{{ url($homeCtaBtn1Link) }}" class="home-cta-btn home-cta-btn--solid">{{ $homeCtaBtn1Text }}</a>
                    @endif
                    @if(!empty($homeCtaBtn2Text))
                    <a href="{{ url($homeCtaBtn2Link) }}" class="home-cta-btn home-cta-btn--outline">{{ $homeCtaBtn2Text }}</a>
                    @endif
                </div>

            </div>

        </div>

        <!-- POPULAR BREEDS SECTION -->
        <section class="home-popular">
            <div class="home-container">
                <div class="home-header home-header--popular">
                    <div>
                        <h2 class="home-popular-title">Popular Breeds</h2>
                        <p class="home-popular-desc">Explore listings by commonly searched breeds.</p>
                    </div>
                    <a href="{{ route('breeds') }}" class="home-popular-link home-btn-desktop">View All Breeds</a>
                </div>

                <div class="home-popular-grid">
                    {{-- USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain" --}}
                    @php
                        $colorThemes = ['cream', 'blue', 'rose', 'pink'];
                        $catFallbacks = [
                            'dogs' => 'images/cat_dog.jpg',
                            'cats' => 'images/cat_cat.jpg',
                            'birds' => 'images/cat_bird.jpg',
                            'fish' => 'images/cat_fish.jpg',
                            'fishes' => 'images/cat_fish.jpg',
                            'horses-farm' => 'images/cat_horse.jpg',
                            'rabbits' => 'images/card_rabbit.jpg',
                            'reptiles' => 'images/cat_reptile.jpg',
                            'exotic' => 'images/card_parrot.jpg',
                        ];
                    @endphp

                    @if(isset($popularBreeds) && $popularBreeds->isNotEmpty())
                        @foreach($popularBreeds->take(4) as $idx => $pBreed)
                            @php
                                $theme = $colorThemes[$idx % count($colorThemes)];
                                $catSlug = $pBreed->category ? $pBreed->category->slug : 'all';
                                
                                // Image resolution
                                $pImg = null;
                                if (!empty($pBreed->image) && file_exists(public_path($pBreed->image))) {
                                    $pImg = asset($pBreed->image);
                                } elseif ($pBreed->listings && $pBreed->listings->first() && $pBreed->listings->first()->images->first()) {
                                    $pImg = asset($pBreed->listings->first()->images->first()->image_path);
                                } elseif (file_exists(public_path('images/' . str_replace('-', '_', $pBreed->slug) . '.jpg'))) {
                                    $pImg = asset('images/' . str_replace('-', '_', $pBreed->slug) . '.jpg');
                                } else {
                                    $pImg = asset($catFallbacks[$catSlug] ?? 'images/golden_retriever.jpg');
                                }

                                $cnt = $pBreed->active_listings_count ?? 0;
                            @endphp
                            <div class="home-breed-card" onclick="window.location='{{ route('category', ['param1' => $catSlug, 'param2' => $pBreed->slug]) }}'" style="cursor: pointer;">
                                <img src="{{ $pImg }}" alt="{{ $pBreed->name }}" class="home-breed-img" onerror="this.src='{{ asset('images/golden_retriever.jpg') }}'">
                                <div class="home-breed-info home-breed-info--{{ $theme }}">
                                    <h3 class="home-breed-name">{{ $pBreed->name }}</h3>
                                    <span class="home-breed-count">{{ $cnt > 0 ? $cnt . ' available' : 'Available in listings' }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback static cards -->
                        <div class="home-breed-card" onclick="window.location='{{ route('category', ['param1' => 'golden-retriever']) }}'" style="cursor: pointer;">
                            <img src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever" class="home-breed-img">
                            <div class="home-breed-info home-breed-info--cream">
                                <h3 class="home-breed-name">Golden Retriever</h3>
                                <span class="home-breed-count">Available</span>
                            </div>
                        </div>

                        <div class="home-breed-card" onclick="window.location='{{ route('category', ['param1' => 'german-shepherd']) }}'" style="cursor: pointer;">
                            <img src="{{ asset('images/german_shepherd.jpg') }}" alt="German Shepherd" class="home-breed-img">
                            <div class="home-breed-info home-breed-info--blue">
                                <h3 class="home-breed-name">German Shepherd</h3>
                                <span class="home-breed-count">Available</span>
                            </div>
                        </div>

                        <div class="home-breed-card" onclick="window.location='{{ route('category', ['param1' => 'persian']) }}'" style="cursor: pointer;">
                            <img src="{{ asset('images/persian.jpg') }}" alt="Persian" class="home-breed-img">
                            <div class="home-breed-info home-breed-info--rose">
                                <h3 class="home-breed-name">Persian</h3>
                                <span class="home-breed-count">Available</span>
                            </div>
                        </div>

                        <div class="home-breed-card" onclick="window.location='{{ route('category', ['param1' => 'british-shorthair']) }}'" style="cursor: pointer;">
                            <img src="{{ asset('images/british_shorthair.jpg') }}" alt="British Shorthair" class="home-breed-img">
                            <div class="home-breed-info home-breed-info--pink">
                                <h3 class="home-breed-name">British Shorthair</h3>
                                <span class="home-breed-count">Available</span>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- USER PROMPT: "do some thing in mobile view of home page first change the 'view all pets to' 'view All breed' and when we click on this we navigate to breed page in mobile view juts do these changes and not effect any thing" --}}
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--popular">
                    <a href="{{ route('breeds') }}" class="home-btn-viewall" id="popular-breeds-view-all-mobile">View All Breeds</a>
                </div>
            </div>
        </section>

        {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
        <!-- LOCATIONS -->
        @php
            $locSecTitle = \App\Models\SiteSetting::get('loc_sec_title', 'Find Pets by Location');
            $locSecSubtitle = \App\Models\SiteSetting::get('loc_sec_subtitle', 'Browse pets available in major cities and find listings closer to your location.');
            $rawCities = \App\Models\SiteSetting::get('loc_sec_cities', 'Lahore, Faisalabad, Multan, Sialkot, Karachi, Peshawar, Islamabad');
            $citiesList = array_values(array_filter(array_map('trim', explode(',', $rawCities))));
            $locSecCardSubtext = \App\Models\SiteSetting::get('loc_sec_card_subtext', 'Browse listings');
            $locSecAllText = \App\Models\SiteSetting::get('loc_sec_all_text', 'All Locations');
        @endphp
        <div class="home-locations">
            <div class="home-locations-container">
                <div class="home-locations-head">
                    <h2 class="home-sec-title home-sec-title--light">{{ $locSecTitle }}</h2>
                    <p class="home-sec-desc home-sec-desc--light">{{ $locSecSubtitle }}</p>
                </div>
                {{-- USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main" --}}
                <div class="home-loc-grid">
                    @foreach($citiesList as $city)
                        @php
                            $citySlug = \Illuminate\Support\Str::slug($city);
                        @endphp
                        <div class="home-loc-card" onclick="window.location='{{ route('category', ['param1' => $citySlug]) }}'" style="cursor: pointer;">
                            <div>
                                <h3>{{ $city }}</h3>
                                <p>{{ $locSecCardSubtext }}</p>
                            </div>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    @endforeach
                    @if(!empty($locSecAllText))
                    <div class="home-loc-card" onclick="window.location='{{ route('category') }}'" style="cursor: pointer;">
                        <div>
                            <h3>{{ $locSecAllText }}</h3>
                            <p>{{ $locSecCardSubtext }}</p>
                        </div>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- JOURNEY COMPONENT -->
        <x-journey-section />

        <!-- SAFETY & RESPONSIBLE PET OWNERSHIP SECTION COMPONENT -->
        <x-safety-section />

        <!-- SELL PET BANNER COMPONENT -->
        <x-sell-banner />

    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const soldPets = JSON.parse(localStorage.getItem('sold_pets') || '{}');
        const deletedPets = JSON.parse(localStorage.getItem('deleted_pets') || '{}');
        document.querySelectorAll('.home-pet-card').forEach(card => {
            const titleEl = card.querySelector('.home-pet-title');
            if (titleEl) {
                const key = titleEl.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
                if (soldPets[key] || deletedPets[key]) {
                    card.style.display = 'none';
                }
            }
        });

        function updateHeartUI(btn, isFav) {
            const icon = btn.querySelector('i');
            if (isFav) {
                btn.classList.add('active', 'favorited');
                btn.setAttribute('title', 'Remove from favorites');
                if (icon) {
                    icon.className = 'fa-solid fa-heart';
                    icon.style.color = '#ff4b68';
                }
            } else {
                btn.classList.remove('active', 'favorited');
                btn.setAttribute('title', 'Add to favorites');
                if (icon) {
                    icon.className = 'fa-regular fa-heart';
                    icon.style.color = '';
                }
            }
        }

        function setListingFavoriteState(listingId, isFav) {
            if (!listingId) return;
            document.querySelectorAll('.home-pet-fav[data-id="' + listingId + '"]').forEach(b => {
                updateHeartUI(b, isFav);
            });
        }

        // Real-time synchronization of all heart icons with database
        window.syncHomeFavorites = function() {
            fetch('{{ route('favorites.ids') }}', {
                headers: { 'Accept': 'application/json' },
                cache: 'no-store'
            })
            .then(r => r.json())
            .then(data => {
                if (data && Array.isArray(data.favorite_ids)) {
                    const favSet = new Set(data.favorite_ids.map(String));
                    document.querySelectorAll('.home-pet-fav').forEach(btn => {
                        const id = btn.getAttribute('data-id');
                        const isFav = id && favSet.has(String(id));
                        updateHeartUI(btn, isFav);
                    });
                }
            })
            .catch(err => console.warn('Fav sync error:', err));
        };

        // Always sync on page load
        window.syncHomeFavorites();

        // Always sync whenever returning to page (Browser Back/Forward navigation)
        window.addEventListener('pageshow', function() {
            window.syncHomeFavorites();
        });

        // Sync when returning from another tab or window
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                window.syncHomeFavorites();
            }
        });

        // AJAX Heart Favorite Toggle on Home Page
        document.querySelectorAll('.home-pet-fav').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const icon = this.querySelector('i');
                const isSolid = icon && (icon.classList.contains('fa-solid') || icon.classList.contains('fas'));
                const url = this.getAttribute('data-url');
                const listingId = this.getAttribute('data-id');
                const willBeFav = !isSolid;

                // Instantly update all cards on the page for this pet (Featured & Recent)
                setListingFavoriteState(listingId, willBeFav);

                // Bounce animation
                this.style.transition = 'transform 0.15s ease-in-out';
                this.style.transform = 'scale(1.25)';
                setTimeout(() => { this.style.transform = 'scale(1)'; }, 150);

                if (url) {
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
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
                        // Re-sync with server state on failure
                        window.syncHomeFavorites();
                    });
                }
            });
        });

        // USER PROMPT: "yr refresh per ya direct hero per ly jata  hai"
        // Retain natural scroll position on refresh and honor specific anchors
        if (window.location.hash && window.location.hash.startsWith('#listing-')) {
            // Only scroll to card when returning directly from an auth redirect with anchor
            const targetCard = document.querySelector(window.location.hash) || document.querySelector('#listing-recent-' + window.location.hash.replace('#listing-', ''));
            if (targetCard) {
                setTimeout(() => {
                    targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    targetCard.style.transition = 'box-shadow 0.4s ease';
                    targetCard.style.boxShadow = '0 0 0 3px #147A4D';
                    setTimeout(() => {
                        targetCard.style.boxShadow = '';
                    }, 1500);
                }, 300);
            }
        }

        // Custom Dropdowns in Hero Search Bar
        const dropdownWraps = document.querySelectorAll('.custom-dropdown-wrap');
        dropdownWraps.forEach(wrap => {
            const input = wrap.querySelector('input[type="hidden"]');
            const displayVal = wrap.querySelector('.home-filter-value');
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
                    const val = item.getAttribute('data-value') || '';
                    const text = item.querySelector('span').innerText.trim();

                    if (input) input.value = val;
                    if (displayVal) displayVal.innerText = text;

                    items.forEach(it => it.classList.remove('is-selected'));
                    item.classList.add('is-selected');

                    wrap.classList.remove('is-open');

                    // If Category was changed, filter the Breed dropdown options
                    if (wrap.dataset.filter === 'category') {
                        const breedWrap = document.querySelector('.custom-dropdown-wrap[data-filter="breed"]');
                        if (breedWrap) {
                            const breedItems = breedWrap.querySelectorAll('.custom-dropdown-item');
                            const breedInput = breedWrap.querySelector('input[type="hidden"]');
                            const breedDisplay = breedWrap.querySelector('.home-filter-value');

                            breedItems.forEach(bItem => {
                                const bCat = bItem.getAttribute('data-category');
                                if (!val || !bCat || bCat === val) {
                                    bItem.style.display = 'flex';
                                } else {
                                    bItem.style.display = 'none';
                                }
                            });

                            if (breedInput) breedInput.value = '';
                            const defaultBreedPlaceholder = breedWrap.getAttribute('data-default') || 'Any breed';
                            if (breedDisplay) breedDisplay.innerText = defaultBreedPlaceholder;
                            breedItems.forEach(bi => {
                                if (bi.getAttribute('data-value') === '') {
                                    bi.classList.add('is-selected');
                                } else {
                                    bi.classList.remove('is-selected');
                                }
                            });
                        }
                    }
                });
            });
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.custom-dropdown-wrap')) {
                dropdownWraps.forEach(w => w.classList.remove('is-open'));
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                dropdownWraps.forEach(w => w.classList.remove('is-open'));
            }
        });
        const homeSearchForm = document.querySelector('.home-search-wrap');
        if (homeSearchForm) {
            homeSearchForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const catInput = homeSearchForm.querySelector('input[name="category"]');
                const locInput = homeSearchForm.querySelector('input[name="location"]');
                const breedInput = homeSearchForm.querySelector('input[name="breed"]');
                const priceInput = homeSearchForm.querySelector('input[name="price"]');

                const catVal = catInput ? (catInput.value || '').trim() : '';
                const locVal = locInput ? (locInput.value || '').trim() : '';
                const breedVal = breedInput ? (breedInput.value || '').trim() : '';
                const priceVal = priceInput ? (priceInput.value || '').trim() : '';

                let pathParts = [];
                if (catVal && catVal !== 'all') pathParts.push(encodeURIComponent(catVal));
                if (breedVal && breedVal !== 'all') pathParts.push(encodeURIComponent(breedVal));
                if (locVal && locVal !== 'all') pathParts.push(encodeURIComponent(locVal));

                let basePath = '/category' + (pathParts.length > 0 ? '/' + pathParts.join('/') : '');

                const params = new URLSearchParams();
                if (priceVal && priceVal !== 'all') params.set('price', priceVal);

                const qStr = params.toString();
                window.location.href = basePath + (qStr ? '?' + qStr : '');
            });
        }
    });
    </script>

