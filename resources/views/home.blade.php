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

            <!-- HERO MAIN CONTENT -->
            <div class="home-hero-inner">

                <!-- Left Column: Heading & Subtitle -->
                <div class="home-hero-text">
                    <h1 class="home-hero-title">
                        Find the right pet for <br />your family.
                    </h1>
                    <p class="home-hero-desc">
                        Search pets by category, breed, location and price, then review the listing and seller before making contact.
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

                        <!-- Cutout Pet Image -->
                        <img
                            src="{{ asset('images/home-hero-image.png') }}"
                            alt="Happy person holding a Corgi dog"
                            class="home-hero-img"
                        />
                    </div>
                </div>

            </div>

            <!-- FLOATING SEARCH BAR (Overlapping bottom edge) -->
            <form action="{{ route('category') }}" method="GET" class="home-search-wrap">

                <div class="home-search-bar">

                    <!-- Filter 1: PET CATEGORY -->
                    <div class="home-filter" style="position: relative;">
                        <select name="category" class="hidden-filter-select" onchange="this.parentElement.querySelector('.home-filter-value').innerText = this.options[this.selectedIndex].text;">
                            <option value="" disabled selected>Any category</option>
                            @if(isset($categories) && $categories->isNotEmpty())
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                @endforeach
                            @else
                                <option value="dogs">Dogs</option>
                                <option value="cats">Cats</option>
                                <option value="birds">Birds</option>
                                <option value="rabbits">Rabbits</option>
                                <option value="fish">Fish</option>
                                <option value="reptiles">Reptiles</option>
                                <option value="horses-farm">Horses & Farm</option>
                                <option value="exotic">Exotic Pets</option>
                            @endif
                        </select>
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
                                <span class="home-filter-label">PET CATEGORY</span>
                                <span class="home-filter-value">Any category</span>
                            </div>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>

                    <!-- Filter 2: BREED -->
                    <div class="home-filter" style="position: relative;">
                        <select name="breed" class="hidden-filter-select" onchange="this.parentElement.querySelector('.home-filter-value').innerText = this.options[this.selectedIndex].text;">
                            <option value="" disabled selected>Any breed</option>
                            <option value="golden-retriever">Golden Retriever</option>
                            <option value="german-shepherd">German Shepherd</option>
                            <option value="persian">Persian Cat</option>
                            <option value="british-shorthair">British Shorthair</option>
                        </select>
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
                                <span class="home-filter-label">BREED</span>
                                <span class="home-filter-value">Any breed</span>
                            </div>
                        </div>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>

                    <!-- Filter 3: LOCATION -->
                    <div class="home-filter" style="position: relative;">
                        <select name="location" class="hidden-filter-select" onchange="this.parentElement.querySelector('.home-filter-value').innerText = this.options[this.selectedIndex].text;">
                            <option value="" disabled selected>Any location</option>
                            <option value="islamabad">Islamabad</option>
                            <option value="karachi">Karachi</option>
                            <option value="lahore">Lahore</option>
                            <option value="rawalpindi">Rawalpindi</option>
                            <option value="faisalabad">Faisalabad</option>
                            <option value="multan">Multan</option>
                            <option value="sialkot">Sialkot</option>
                            <option value="peshawar">Peshawar</option>
                        </select>
                        <div class="home-filter-left">
                            <!-- Green Location Pin Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">LOCATION</span>
                                <span class="home-filter-value">Any location</span>
                            </div>
                        </div>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>

                    <!-- Filter 4: PRICE -->
                    <div class="home-filter" style="position: relative;">
                        <select name="price" class="hidden-filter-select" onchange="this.parentElement.querySelector('.home-filter-value').innerText = this.options[this.selectedIndex].text;">
                            <option value="" disabled selected>Any price</option>
                            <option value="0-20000">Under Rs. 20k</option>
                            <option value="20000-50000">Rs. 20k - 50k</option>
                            <option value="50000-100000">Rs. 50k - 100k</option>
                            <option value="100000+">Rs. 100k+</option>
                        </select>
                        <div class="home-filter-left">
                            <!-- Green Price Tag Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                                <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                            </svg>
                            <div>
                                <span class="home-filter-label">PRICE</span>
                                <span class="home-filter-value">Any price</span>
                            </div>
                        </div>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>

                    <!-- CTA Button: Find a Pet -->
                    <button type="submit" class="home-search-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Find a Pet
                    </button>

                </div>
            </form>

        </section>

        <!-- Next Section Spacer (So the overlapping search bar looks natural) -->
        <div class="home-hero-spacer"></div>

        <!-- CATEGORIES -->
        <div class="home-categories-section">
            <h2 class="home-sec-title home-sec-title--md">Browse by Pet Category</h2>
            <p class="home-sec-desc home-sec-desc--spaced">Start your search by choosing the type of companion you're looking for.</p>
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
                    <div class="home-categories" style="display: flex; gap: 30px; flex-wrap: nowrap;">
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'dogs']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_dog.jpg') }}" alt="Dogs"></div>
                            <div class="home-cat-name">Dogs</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'cats']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_cat.jpg') }}" alt="Cats"></div>
                            <div class="home-cat-name">Cats</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'birds']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_bird.jpg') }}" alt="Birds"></div>
                            <div class="home-cat-name">Birds</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'fish']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_fish.jpg') }}" alt="Fish"></div>
                            <div class="home-cat-name">Fish</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'reptiles']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_reptile.jpg') }}" alt="Reptiles"></div>
                            <div class="home-cat-name">Reptiles</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'rabbits']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/card_rabbit.jpg') }}" alt="Rabbits"></div>
                            <div class="home-cat-name">Rabbits</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'horses-farm']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/cat_horse.jpg') }}" alt="Horses & Farm"></div>
                            <div class="home-cat-name">Horses & Farm</div>
                        </div>
                        <div class="home-cat-item" onclick="window.location='{{ route('category', ['category' => 'exotic']) }}#petCardsGrid'" style="cursor: pointer;">
                            <div class="home-cat-img"><img src="{{ asset('images/card_parrot.jpg') }}" alt="Exotic Pets"></div>
                            <div class="home-cat-name">Exotic Pets</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FEATURED PETS -->
        <div id="featured-pets" class="home-featured home-pets-section">
            <div class="home-container">
                <div class="home-header">
                    <div>
                        <a href="{{ route('category', ['featured' => 'true']) }}" style="text-decoration: none; color: inherit;">
                            <h2 class="home-sec-title home-sec-title--md" style="cursor: pointer;">Featured Pets</h2>
                        </a>
                        <p class="home-sec-desc home-sec-desc--flush">Highlighted pet listings from sellers on the marketplace.</p>
                    </div>
                    <button class="home-btn-outline home-btn-desktop" onclick="window.location='{{ route('category', ['featured' => 'true']) }}'">View All Pets</button>
                </div>
                <div class="home-pets-grid">
                    @if(isset($featuredListings) && $featuredListings->isNotEmpty())
                        @foreach($featuredListings as $pet)
                            <div class="home-pet-card" id="listing-{{ $pet->id }}" onclick="window.location='{{ route('pet.details', ['id' => $pet->id]) }}'" style="scroll-margin-top: 100px; cursor: pointer;">
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
                                    <div class="home-pet-location"><span><i class="fa-solid fa-location-dot"></i> {{ $pet->city }}</span><span><i class="fa-regular fa-clock"></i> {{ $pet->created_at->diffForHumans() }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card -->
                        <div class="home-pet-card" onclick="window.location='{{ route('category') }}'">
                            <div class="home-pet-media">
                                <img src="{{ asset('images/pets/golden-retriever.jpg') }}" alt="Golden Retriever" class="home-pet-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                <span class="home-pet-badge">FEATURED</span>
                            </div>
                            <div class="home-pet-info">
                                <h3 class="home-pet-title">Golden Retriever Puppy</h3>
                                <p class="home-pet-breed">Golden Retriever</p>
                                <div class="home-pet-price">Rs. 75,000</div>
                                <div class="home-pet-meta"><span><i class="fa-regular fa-clock"></i> 3 Months</span><span><i class="fa-solid fa-mars"></i> Male</span></div>
                                <div class="home-pet-location"><span><i class="fa-solid fa-location-dot"></i> Lahore</span></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--featured">
                    <a href="{{ route('category', ['featured' => 'true']) }}" class="home-btn-viewall" id="featured-view-all-mobile">View All Pets</a>
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
                    <button class="home-btn-outline home-btn-desktop" onclick="window.location='{{ route('category') }}'">View All</button>
                </div>
                <div class="home-pets-grid">
                    @if(isset($recentListings) && $recentListings->isNotEmpty())
                        @foreach($recentListings as $pet)
                            <div class="home-pet-card" id="listing-recent-{{ $pet->id }}" onclick="window.location='{{ route('pet.details', ['id' => $pet->id]) }}'" style="scroll-margin-top: 100px; cursor: pointer;">
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
                                    <div class="home-pet-location"><span><i class="fa-solid fa-location-dot"></i> {{ $pet->city }}</span><span><i class="fa-regular fa-clock"></i> {{ $pet->created_at->diffForHumans() }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card -->
                        <div class="home-pet-card" onclick="window.location='{{ route('category') }}'">
                            <div class="home-pet-media">
                                <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" class="home-pet-img">
                            </div>
                            <div class="home-pet-info">
                                <h3 class="home-pet-title">German Shepherd</h3>
                                <p class="home-pet-breed">German Shepherd</p>
                                <div class="home-pet-price">Rs. 55,000</div>
                                <div class="home-pet-meta"><span><i class="fa-regular fa-clock"></i> 3 Months</span><span><i class="fa-solid fa-mars"></i> Male</span></div>
                                <div class="home-pet-location"><span><i class="fa-solid fa-location-dot"></i> Lahore</span></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--featured">
                    <a href="{{ route('category') }}" class="home-btn-viewall" id="latest-view-all-mobile">View All Pets</a>
                </div>
            </div>
        </div>

        <!-- CTA BANNER -->
        <div class="home-cta">

            <!-- Decorative shapes (Background) -->
            <div class="home-cta-dark"></div>
            <div class="home-cta-cream"></div>

            <!-- Left Side: Image Container -->
            <div class="home-cta-img-wrap">
                <img src="{{ asset('images/more-friend.png') }}" alt="Woman kissing dog" class="home-cta-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                <div class="home-cta-img-fallback">
                    <img src="{{ asset('images/cta-green-mb-vw.png') }}" alt="CTA Banner Image" class="home-cta-fallback-img">
                </div>
            </div>

            <!-- Right Side: Text & Buttons Container -->
            <div class="home-cta-text">

                <!-- Main Heading -->
                <h1 class="home-cta-title">One More Friend</h1>

                <!-- Sub Heading -->
                <h2 class="home-cta-subtitle">Thousands More Fun!</h2>

                <!-- Description Paragraph -->
                <p class="home-cta-desc">
                    Having a pet means you have more joy, a new friend, a happy person who will always be with you to have fun. We have 200+ different pets that can meet your needs!
                </p>

                <!-- Buttons Wrapper -->
                <div class="home-cta-buttons">
                    <a href="{{ route('category', ['category' => 'dogs']) }}#petCardsGrid" class="home-cta-btn home-cta-btn--solid">Browse Dogs</a>
                    <a href="{{ route('category', ['category' => 'cats']) }}#petCardsGrid" class="home-cta-btn home-cta-btn--outline">Browse Cats</a>
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
                    <!-- Card 1: Golden Retriever -->
                    <div class="home-breed-card" onclick="window.location='{{ route('category', ['breed' => 'golden-retriever']) }}'" style="cursor: pointer;">
                        <img src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--cream">
                            <h3 class="home-breed-name">Golden Retriever</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 2: German Shepherd -->
                    <div class="home-breed-card" onclick="window.location='{{ route('category', ['breed' => 'german-shepherd']) }}'" style="cursor: pointer;">
                        <img src="{{ asset('images/german_shepherd.jpg') }}" alt="German Shepherd" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--blue">
                            <h3 class="home-breed-name">German Shepherd</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 3: Persian -->
                    <div class="home-breed-card" onclick="window.location='{{ route('category', ['breed' => 'persian']) }}'" style="cursor: pointer;">
                        <img src="{{ asset('images/persian.jpg') }}" alt="Persian" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--rose">
                            <h3 class="home-breed-name">Persian</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 4: British Shorthair -->
                    <div class="home-breed-card" onclick="window.location='{{ route('category', ['breed' => 'british-shorthair']) }}'" style="cursor: pointer;">
                        <img src="{{ asset('images/british_shorthair.jpg') }}" alt="British Shorthair" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--pink">
                            <h3 class="home-breed-name">British Shorthair</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>
                </div>
                <div class="home-mobile-btn-wrap home-mobile-btn-wrap--popular">
                    <a href="#" class="home-btn-viewall">View All Pets</a>
                </div>
            </div>
        </section>

        <!-- LOCATIONS -->
        <div class="home-locations">
            <div class="home-locations-container">
                <div class="home-locations-head">
                    <h2 class="home-sec-title home-sec-title--light">Find Pets by Location</h2>
                    <p class="home-sec-desc home-sec-desc--light">Browse pets available in major cities and find listings closer to your location.</p>
                </div>
                <div class="home-loc-grid">
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'lahore']) }}'" style="cursor: pointer;"><div><h3>Lahore</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'faisalabad']) }}'" style="cursor: pointer;"><div><h3>Faisalabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'multan']) }}'" style="cursor: pointer;"><div><h3>Multan</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'sialkot']) }}'" style="cursor: pointer;"><div><h3>Sialkot</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>

                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'karachi']) }}'" style="cursor: pointer;"><div><h3>Karachi</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'peshawar']) }}'" style="cursor: pointer;"><div><h3>Peshawar</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category', ['location' => 'islamabad']) }}'" style="cursor: pointer;"><div><h3>Islamabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card" onclick="window.location='{{ route('category') }}'" style="cursor: pointer;"><div><h3>All Locations</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
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

        // Detect page reload/refresh
        const isReload = (window.performance && window.performance.getEntriesByType && window.performance.getEntriesByType('navigation')[0] && window.performance.getEntriesByType('navigation')[0].type === 'reload') || (window.performance && window.performance.navigation && window.performance.navigation.type === 1);

        if (isReload) {
            // Keep user on the Hero section (top of page) on refresh
            if (window.location.hash) {
                history.replaceState(null, document.title, window.location.pathname + window.location.search);
            }
            window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
        } else if (window.location.hash && window.location.hash.startsWith('#listing-')) {
            // Only scroll to card when returning directly from an auth redirect with anchor
            const targetCard = document.querySelector(window.location.hash) || document.querySelector('#listing-recent-' + window.location.hash.replace('#listing-', ''));
            if (targetCard) {
                setTimeout(() => {
                    targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    targetCard.style.transition = 'box-shadow 0.4s ease';
                    targetCard.style.boxShadow = '0 0 0 3px #147A4D';
                    setTimeout(() => {
                        targetCard.style.boxShadow = '';
                        // Remove hash from URL so subsequent refreshes stay on Hero section
                        if (window.location.hash && window.location.hash.startsWith('#listing-')) {
                            history.replaceState(null, document.title, window.location.pathname + window.location.search);
                        }
                    }, 1500);
                }, 300);
            }
        }
    });
    </script>

