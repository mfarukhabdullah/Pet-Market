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
            <div class="home-search-wrap">

                <div class="home-search-bar">

                    <!-- Filter 1: PET CATEGORY -->
                    <div class="home-filter">
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
                    <div class="home-filter">
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
                    <div class="home-filter">
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
                    <div class="home-filter">
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
                    <button class="home-search-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Find a Pet
                    </button>

                </div>
            </div>

        </section>

        <!-- Next Section Spacer (So the overlapping search bar looks natural) -->
        <div class="home-hero-spacer"></div>

        <!-- CATEGORIES -->
        <div class="home-categories-section">
            <h2 class="home-sec-title home-sec-title--md">Browse by Pet Category</h2>
            <p class="home-sec-desc home-sec-desc--spaced">Start your search by choosing the type of companion you're looking for.</p>
            <div class="home-categories">
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_dog.jpg') }}" alt="Dogs"></div>
                    <div class="home-cat-name">Dogs</div>
                </div>
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_cat.jpg') }}" alt="Cats"></div>
                    <div class="home-cat-name">Cats</div>
                </div>
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_bird.jpg') }}" alt="Birds"></div>
                    <div class="home-cat-name">Birds</div>
                </div>
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_fish.jpg') }}" alt="Fish"></div>
                    <div class="home-cat-name">Fish</div>
                </div>
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_reptile.jpg') }}" alt="Reptiles"></div>
                    <div class="home-cat-name">Reptiles</div>
                </div>
                <div class="home-cat-item">
                    <div class="home-cat-img"><img src="{{ asset('images/cat_horse.jpg') }}" alt="Horses & Farm"></div>
                    <div class="home-cat-name">Horses & Farm</div>
                </div>
            </div>
        </div>

        <!-- FEATURED PETS -->
        <div class="home-featured">
            <div class="home-container">
                <div class="home-header">
                    <div>
                        <h2 class="home-sec-title home-sec-title--md">Featured Pets</h2>
                        <p class="home-sec-desc home-sec-desc--flush">Highlighted pet listings from sellers on the marketplace.</p>
                    </div>
                    <button class="home-btn-outline home-btn-desktop">View All Pets</button>
                </div>
                <div class="home-pets-grid">
                    <!-- Card 1 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever" class="home-pet-img">
                            <span class="home-pet-badge">FEATURED</span>
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">Golden Retriever Puppy</h3>
                            <p class="home-pet-breed">Golden Retriever</p>
                            <div class="home-pet-price">Rs. 85,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Lahore</div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_persian.jpg') }}" alt="Persian Cat" class="home-pet-img">
                            <span class="home-pet-badge">FEATURED</span>
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">Persian Cat</h3>
                            <p class="home-pet-breed">Persian</p>
                            <div class="home-pet-price">Rs. 42,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus"></i> Female</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Islamabad</div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="African Grey Parrot" class="home-pet-img">
                            <span class="home-pet-badge">FEATURED</span>
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">African Grey Parrot</h3>
                            <p class="home-pet-breed">African Grey</p>
                            <div class="home-pet-price">Rs. 65,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Karachi</div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_rabbit.jpg') }}" alt="Mini Lop Rabbit" class="home-pet-img">
                            <span class="home-pet-badge">FEATURED</span>
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">Mini Lop Rabbit</h3>
                            <p class="home-pet-breed">Mini Lop</p>
                            <div class="home-pet-price">Rs. 12,500</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus"></i> Female</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Lahore</div>
                        </div>
                    </div>
                </div>
                <div class="home-mobile-btn-wrap">
                    <button class="home-btn-outline home-btn-outline--block">View All Pets</button>
                </div>
            </div>
        </div>

        <!-- LATEST PET LISTINGS -->
        <div class="home-latest">
            <div class="home-container">
                <div class="home-header home-header--latest">
                    <div class="home-header-text-left">
                        <h2 class="home-sec-title home-sec-title--md">Latest Pet Listings</h2>
                        <p class="home-sec-desc home-sec-desc--latest">Fresh listings recently posted by pet owners and businesses.</p>
                    </div>
                    <button class="home-btn-outline home-btn-desktop">View All</button>
                </div>
                <div class="home-pets-grid">
                    <!-- Card 1 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" class="home-pet-img">
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">German Shepherd</h3>
                            <p class="home-pet-breed">German Shepherd</p>
                            <div class="home-pet-price">Rs. 85,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Lahore</div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_british.jpg') }}" alt="British Shorthair" class="home-pet-img">
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">British Shorthair</h3>
                            <p class="home-pet-breed">British Shorthair</p>
                            <div class="home-pet-price">Rs. 42,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus"></i> Female</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Islamabad</div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_shihtzu.jpg') }}" alt="Shih Tzu Puppy" class="home-pet-img">
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">Shih Tzu Puppy</h3>
                            <p class="home-pet-breed">Shih Tzu</p>
                            <div class="home-pet-price">Rs. 65,000</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Karachi</div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="home-pet-card" onclick="window.location='{{ url('/pet-details') }}'">
                        <div class="home-pet-media">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="Lovebird Pair" class="home-pet-img">
                            <div class="home-pet-fav"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="home-pet-info">
                            <h3 class="home-pet-title">Lovebird Pair</h3>
                            <p class="home-pet-breed">Lovebird</p>
                            <div class="home-pet-price">Rs. 12,500</div>
                            <div class="home-pet-meta">
                                <span><i class="fa-regular fa-clock"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus"></i> Female</span>
                            </div>
                            <div class="home-pet-location"><i class="fa-solid fa-location-dot"></i> Lahore</div>
                        </div>
                    </div>
                </div>
                <div class="home-mobile-btn-wrap">
                    <button class="home-btn-outline home-btn-outline--block">View All</button>
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
                    [ Yahan Apni Girl & Dog Wali Transparent PNG Image Lagayein ]
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
                    <a href="#" class="home-cta-btn home-cta-btn--solid">Browse Dogs</a>
                    <a href="#" class="home-cta-btn home-cta-btn--outline">Browse Cats</a>
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
                    <a href="#" class="home-popular-link home-btn-desktop">View All Breeds</a>
                </div>

                <div class="home-popular-grid">
                    <!-- Card 1: Golden Retriever -->
                    <div class="home-breed-card">
                        <img src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--cream">
                            <h3 class="home-breed-name">Golden Retriever</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 2: German Shepherd -->
                    <div class="home-breed-card">
                        <img src="{{ asset('images/german_shepherd.jpg') }}" alt="German Shepherd" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--blue">
                            <h3 class="home-breed-name">German Shepherd</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 3: Persian -->
                    <div class="home-breed-card">
                        <img src="{{ asset('images/persian.jpg') }}" alt="Persian" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--rose">
                            <h3 class="home-breed-name">Persian</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>

                    <!-- Card 4: British Shorthair -->
                    <div class="home-breed-card">
                        <img src="{{ asset('images/british_shorthair.jpg') }}" alt="British Shorthair" class="home-breed-img">
                        <div class="home-breed-info home-breed-info--pink">
                            <h3 class="home-breed-name">British Shorthair</h3>
                            <span class="home-breed-count">320 available</span>
                        </div>
                    </div>
                </div>
                <div class="home-mobile-btn-wrap">
                    <a href="#" class="home-btn-solid">View All Breeds</a>
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
                    <div class="home-loc-card"><div><h3>Lahore</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>Faisalabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>Multan</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>Sialkot</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>

                    <div class="home-loc-card"><div><h3>Karachi</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>Peshawar</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>Islamabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="home-loc-card"><div><h3>All Locations</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                </div>
            </div>
        </div>

        <!-- JOURNEY -->
        <div class="home-journey-section">
            <h2 class="home-sec-title home-sec-title--center">A Simple Marketplace Journey</h2>
            <p class="home-sec-desc home-sec-desc--center">How to buy or sell pets easily and safely.</p>
            <div class="home-journey">
                <div class="home-step home-step--1">
                    <img src="{{ asset('images/search.svg') }}" class="home-step-bg-icon" alt="">
                    <div class="home-step-body">
                        <div class="home-step-icon"><img src="{{ asset('images/search.svg') }}" alt=""></div>
                        <h3 class="home-step-title">Search and Filter</h3>
                        <p class="home-step-text">Search by pet category, breed, location and price to find relevant listings.</p>
                    </div>
                </div>
                <div class="home-step home-step--2">
                    <img src="{{ asset('images/review-icon.svg') }}" class="home-step-bg-icon" alt="">
                    <div class="home-step-body">
                        <div class="home-step-icon"><img src="{{ asset('images/review-icon.svg') }}" alt=""></div>
                        <h3 class="home-step-title">Review the Listing</h3>
                        <p class="home-step-text">Check photos, pet details, health information and seller profile before making contact.</p>
                    </div>
                </div>
                <div class="home-step home-step--3">
                    <!-- Floating Animals on top of card -->
                    <img src="{{ asset('images/cat-journey.png') }}" class="home-step-cat" alt="">
                    <img src="{{ asset('images/dog-journey.png') }}" class="home-step-dog" alt="">

                    <img src="{{ asset('images/contact-seller.svg') }}" class="home-step-bg-icon" alt="">
                    <div class="home-step-body">
                        <div class="home-step-icon"><img src="{{ asset('images/contact-seller.svg') }}" alt=""></div>
                        <h3 class="home-step-title">Contact the Seller</h3>
                        <p class="home-step-text">Send an inquiry or message without exposing private contact details by default.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SAFETY & RESPONSIBLE PET OWNERSHIP SECTION COMPONENT -->
        <x-safety-section />

        <!-- SELL PET BANNER COMPONENT -->
        <x-sell-banner />

    </main>
