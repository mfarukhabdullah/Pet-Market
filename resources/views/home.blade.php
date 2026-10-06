    <main class="site-wrapper">
        
        <!-- HERO SECTION WRAPPER -->
        <section style="position: relative; background-color: #F7EFE2; padding-bottom: 70px;">

            <!-- Background Decorative Shapes Container (Clipped so shapes don't overflow) -->
            <div style="position: absolute; top: 0; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 1440px; overflow: hidden; pointer-events: none; z-index: 1;">
            
            <!-- Bottom-left soft beige hill shape (Replaced with SVG) -->
            <img src="{{ asset('images/herobottom.svg') }}" style="position: absolute; bottom: 0; left: -8%; width: 751px; max-width: 100%;" alt="">

            <!-- Center small floating diamond accents -->
            <div style="position: absolute; top: 55px; left: 51%; width: 12px; height: 12px; background-color: #F6D592; border-radius: 3px; transform: rotate(20deg);"></div>
            <div style="position: absolute; top: 112px; left: 49.8%; width: 18px; height: 18px; background-color: #F6D592; border-radius: 4px; transform: rotate(15deg);"></div>
            <div style="position: absolute; top: 115px; left: 49.4%; width: 16px; height: 16px; background-color: #14794A; border-radius: 4px; transform: rotate(45deg);"></div>

            <!-- Right-side Green organic shape -->
            <div style="position: absolute; bottom: -79px; right: 21%; width: 320px; height: 390px; background-color: #147A4D; border-radius: 65px; transform: rotate(12deg);"></div>

            <!-- Right-side Warm Yellow tilted rectangle shape -->
            <div style="position: absolute; bottom: -110px; right: 7%; width: 470px; height: 420px; background-color: #F7DBA7; border-radius: 65px; transform: rotate(22deg);"></div>
            </div>

            <!-- HERO MAIN CONTENT -->
            <div class="hero-inner" style="position: relative; z-index: 2; width: 100%; max-width: 1200px; margin: 0 auto; padding: 65px 0 10px 0; display: flex; align-items: center; justify-content: space-between; gap: 30px;">
            
            <!-- Left Column: Heading & Subtitle -->
            <div class="hero-text" style="flex: 1; max-width: 500px;">
                <h1 style="font-size: 48px; font-weight: 800; color: #161616; line-height: 1.15; letter-spacing: -0.8px; margin-bottom: 22px;">
                Find the right pet for<br />your family.
                </h1>
                <p style="font-size: 16px; font-weight: 400; color: #202020; line-height: 24px; max-width: 450px; text-align: justify;">
                Search pets by category, breed, location and price, then review the listing and seller before making contact.
                </p>
            </div>

            <!-- Right Column: Dog & Owner Image -->
            <!-- Right Column: Dog & Owner Image -->
            <div style="flex: 1; display: flex; justify-content: flex-end;">
                <div style="position: relative; display: inline-block;">
                    <!-- Comic Excitement Lines SVG near the dog head -->
                    <svg style="position: absolute; top: 7%; right: 40%; z-index: 15; transform: scale(1.2);" width="38" height="38" viewBox="0 0 40 40" fill="none">
                    <path d="M5 14L18 8" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M12 25L22 17" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M27 32L29 19" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>

                    <!-- Cutout Pet Image (Replace src with your transparent PNG if needed) -->
                    <img 
                    src="{{ asset('images/home-hero-image.png') }}" 
                    alt="Happy person holding a Corgi dog" 
                    style="width: 100%; max-width: 560px; height: auto; object-fit: contain; z-index: 5; position: relative; margin-bottom: -80px;" 
                    />
                </div>
            </div>

            </div>

            <!-- FLOATING SEARCH BAR (Overlapping bottom edge) -->
            <div class="search-bar-wrapper" style="position: absolute; left: 0; right: 0; bottom: 0; transform: translateY(50%); z-index: 10; width: 100%; max-width: 1200px; margin: 0 auto;">
            
            <div class="search-bar" style="background-color: #FFFFFF; border-radius: 14px; padding: 16px 18px; box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08); display: flex; align-items: center; gap: 14px; border: 1px solid #F0F0F0;">
                
                <!-- Filter 1: PET CATEGORY -->
                <div style="flex: 1; display: flex; align-items: center; justify-content: space-between; border: 1px solid #DCDCDC; border-radius: 10px; padding: 10px 14px; cursor: pointer; background: #FFF;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Green Paw Icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                    <circle cx="7" cy="7.5" r="2.2"/>
                    <circle cx="12" cy="5.5" r="2.2"/>
                    <circle cx="17" cy="7.5" r="2.2"/>
                    <circle cx="4.5" cy="12" r="2"/>
                    <path d="M12 10.5c-3.2 0-5.5 2.4-5.5 5.2 0 1.8 1.4 3.3 3.2 3.3 1 0 1.6-.4 2.3-.4s1.3.4 2.3.4c1.8 0 3.2-1.5 3.2-3.3 0-2.8-2.3-5.2-5.5-5.2z"/>
                    </svg>
                    <div>
                    <span style="display: block; font-size: 10px; font-weight: 600; color: #6B7280; letter-spacing: 0.4px; text-transform: uppercase;">PET CATEGORY</span>
                    <span style="display: block; font-size: 13.5px; font-weight: 600; color: #1F2937; margin-top: 2px;">Any category</span>
                    </div>
                </div>
                <!-- Dropdown Arrow -->
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>

                <!-- Filter 2: BREED -->
                <div style="flex: 1; display: flex; align-items: center; justify-content: space-between; border: 1px solid #DCDCDC; border-radius: 10px; padding: 10px 14px; cursor: pointer; background: #FFF;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Green Breed/DNA Ribbon Icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#14794A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 3h12l-6 9 6 9H6l6-9-6-9z"/>
                    </svg>
                    <div>
                    <span style="display: block; font-size: 10px; font-weight: 600; color: #6B7280; letter-spacing: 0.4px; text-transform: uppercase;">BREED</span>
                    <span style="display: block; font-size: 13.5px; font-weight: 600; color: #1F2937; margin-top: 2px;">Any breed</span>
                    </div>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>

                <!-- Filter 3: LOCATION -->
                <div style="flex: 1; display: flex; align-items: center; justify-content: space-between; border: 1px solid #DCDCDC; border-radius: 10px; padding: 10px 14px; cursor: pointer; background: #FFF;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Green Location Pin Icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <div>
                    <span style="display: block; font-size: 10px; font-weight: 600; color: #6B7280; letter-spacing: 0.4px; text-transform: uppercase;">LOCATION</span>
                    <span style="display: block; font-size: 13.5px; font-weight: 600; color: #1F2937; margin-top: 2px;">Any location</span>
                    </div>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>

                <!-- Filter 4: PRICE -->
                <div style="flex: 1; display: flex; align-items: center; justify-content: space-between; border: 1px solid #DCDCDC; border-radius: 10px; padding: 10px 14px; cursor: pointer; background: #FFF;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Green Price Tag Icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#14794A">
                    <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                    </svg>
                    <div>
                    <span style="display: block; font-size: 10px; font-weight: 600; color: #6B7280; letter-spacing: 0.4px; text-transform: uppercase;">PRICE</span>
                    <span style="display: block; font-size: 13.5px; font-weight: 600; color: #1F2937; margin-top: 2px;">Any price</span>
                    </div>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>

                <!-- CTA Button: Find a Pet -->
                <button class="search-btn" style="background-color: #14794A; color: #FFFFFF; border: none; border-radius: 10px; padding: 16px 26px; font-size: 15px; font-weight: 600; display: flex; align-items: center; gap: 9px; cursor: pointer; white-space: nowrap;">
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
        <div class="hero-spacer" style="height: 60px; background-color: transparent;"></div>

        <!-- CATEGORIES -->
        <div class="my-section" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0;">
            <h2 class="my-sec-title" style="font-size: 28px; margin-bottom: 8px;">Browse by Pet Category</h2>
            <p class="my-sec-desc" style="margin-bottom: 45px;">Start your search by choosing the type of companion you're looking for.</p>
            <div class="my-categories" style="display: flex; justify-content: space-between;">
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_dog.jpg') }}" alt="Dogs" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Dogs</div>
                </div>
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_cat.jpg') }}" alt="Cats" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Cats</div>
                </div>
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_bird.jpg') }}" alt="Birds" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Birds</div>
                </div>
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_fish.jpg') }}" alt="Fish" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Fish</div>
                </div>
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_reptile.jpg') }}" alt="Reptiles" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Reptiles</div>
                </div>
                <div class="my-cat-item" style="width: 150px;">
                    <div class="my-cat-img" style="width: 150px; height: 150px; border: none; box-shadow: none; background: transparent;"><img src="{{ asset('images/cat_horse.jpg') }}" alt="Horses & Farm" style="border-radius: 50%;"></div>
                    <div class="my-cat-name" style="font-size: 15px;">Horses & Farm</div>
                </div>
            </div>
        </div>

        <!-- FEATURED PETS -->
        <div class="featured-pets-section" style="margin-top: 21px; background-color: #F9F2E7; padding: 30px 0;">
            <div style="width: 100%; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column;">
                <div class="featured-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
                    <div class="featured-title-container">
                        <h2 class="my-sec-title" style="font-size: 28px; margin-bottom: 8px;">Featured Pets</h2>
                        <p class="my-sec-desc" style="margin:0;">Highlighted pet listings from sellers on the marketplace.</p>
                    </div>
                    <button class="my-btn desktop-btn" style="background: transparent; color: #147A4D; border: 1px solid #147A4D; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer;">View All Pets</button>
                </div>
                <div class="my-pets-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
                    <!-- Card 1 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <span class="my-badge" style="background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; top: 12px; left: 12px;">FEATURED</span>
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">Golden Retriever Puppy</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">Golden Retriever</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 85,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_persian.jpg') }}" alt="Persian Cat" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <span class="my-badge" style="background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; top: 12px; left: 12px;">FEATURED</span>
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">Persian Cat</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">Persian</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 42,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Islamabad</div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="African Grey Parrot" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <span class="my-badge" style="background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; top: 12px; left: 12px;">FEATURED</span>
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">African Grey Parrot</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">African Grey</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 65,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Karachi</div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_rabbit.jpg') }}" alt="Mini Lop Rabbit" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <span class="my-badge" style="background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; top: 12px; left: 12px;">FEATURED</span>
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">Mini Lop Rabbit</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">Mini Lop</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 12,500</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </div>
                </div>
                <div class="mobile-btn-container" style="display: none; margin-top: 24px; text-align: center;">
                    <button class="my-btn" style="background: transparent; color: #147A4D; border: 1px solid #147A4D; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; width: 100%;">View All Pets</button>
                </div>
            </div>
        </div>

        <!-- LATEST PET LISTINGS -->
        <div class="latest-pets-section my-section" style="background: #FFFFFF; width: 100%; padding: 30px 0;">
            <div style="width: 100%; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column;">
                <div class="latest-header" style="text-align: center; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: flex-end;">
                    <div class="latest-title-container" style="text-align: left;">
                        <h2 class="my-sec-title" style="font-size: 28px; margin-bottom: 8px;">Latest Pet Listings</h2>
                        <p class="my-sec-desc" style="margin:0 auto; max-width: 600px;">Fresh listings recently posted by pet owners and businesses.</p>
                    </div>
                    <button class="my-btn desktop-btn" style="background: transparent; color: #147A4D; border: 1px solid #147A4D; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer;">View All</button>
                </div>
                <div class="my-pets-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
                    <!-- Card 1 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">German Shepherd</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">German Shepherd</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 85,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_british.jpg') }}" alt="British Shorthair" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">British Shorthair</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">British Shorthair</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 42,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Islamabad</div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_shihtzu.jpg') }}" alt="Shih Tzu Puppy" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">Shih Tzu Puppy</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">Shih Tzu</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 65,000</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Karachi</div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="my-pet-card" onclick="window.location='{{ url('/pet-details') }}'" style="border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 12px;">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="Lovebird Pair" class="my-pet-img" style="height: 236px; border-radius: 12px 12px 0 0;">
                            <div class="my-pet-fav" style="top: 12px; right: 12px; width: 28px; height: 28px; font-size: 12px;"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info" style="padding: 16px;">
                            <h3 class="my-pet-title" style="font-size: 16px; margin-bottom: 4px;">Lovebird Pair</h3>
                            <p class="my-pet-breed" style="font-size: 12px; margin-bottom: 12px; color: #94a3b8;">Lovebird</p>
                            <div class="my-pet-price" style="font-size: 16px; color: #147A4D; margin-bottom: 12px;">Rs. 12,500</div>
                            <div class="my-pet-meta" style="border: none; padding-top: 0; margin-bottom: 12px; justify-content: flex-start; gap: 16px; font-size: 12px;">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </div>
                </div>
                <div class="mobile-btn-container" style="display: none; margin-top: 24px; text-align: center;">
                    <button class="my-btn" style="background: transparent; color: #147A4D; border: 1px solid #147A4D; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; width: 100%;">View All</button>
                </div>
            </div>
        </div>
        <!-- CTA BANNER -->
        <div class="cta-banner-wrapper" style="position: relative; width: 100%; max-width: 1200px; min-height: 378px; background-color: #147A4D; border-radius: 20px; overflow: hidden; display: flex; align-items: center; justify-content: space-between; box-sizing: border-box; margin: 20px auto 0;">

            <!-- Left Side Decorative Dark Shape (Background) -->
            <div class="cta-dark-shape" style="position: absolute; bottom: -180px; left: -120px; width: 650px; height: 500px; background-color: #147A4D; border-radius: 99px; transform: rotate(25deg); z-index: 1;"></div>

            <!-- Right Side Decorative Cream Shape (Background) -->
            <div class="cta-cream-shape" style="position: absolute; top: -160px; right: -140px; width: 780px; height: 650px; background-color: #FCEED5; border-radius: 99px; transform: rotate(25deg); z-index: 1;"></div>

            <!-- Left Side: Image Container -->
            <div class="cta-img-wrapper" style="position: relative; z-index: 2; width: 48%; height: 100%; display: flex; align-items: flex-end; justify-content: center; padding-top: 30px;">
                <img src="{{ asset('images/more-friend.png') }}" alt="Woman kissing dog" style="max-width: 100%; height: auto; max-height: 360px; display: block; object-fit: contain;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                
                <div style="display: none; width: 380px; height: 320px; background: rgba(255,255,255,0.15); backdrop-filter: blur(4px); border: 2px dashed rgba(255,255,255,0.5); border-radius: 16px 16px 0 0; color: #ffffff; align-items: center; justify-content: center; text-align: center; padding: 20px; box-sizing: border-box; font-size: 14px;">
                    [ Yahan Apni Girl & Dog Wali Transparent PNG Image Lagayein ]
                </div>
            </div>

            <!-- Right Side: Text & Buttons Container -->
            <div class="cta-text-wrapper" style="position: relative; z-index: 2; width: 52%; padding: 40px 65px 40px 100px; text-align: left; box-sizing: border-box; display: flex; flex-direction: column; align-items: flex-start;">
                
                <!-- Main Heading -->
                <h1 style="margin: 0; font-size: 34px; font-weight: 800; color: #000000; line-height: 1.2;">
                    One More Friend
                </h1>
                
                <!-- Sub Heading -->
                <h2 style="margin: 6px 0 18px 0; font-size: 34px; font-weight: 700; color: #000000; line-height: 44px;">
                    Thousands More Fun!
                </h2>
                
                <!-- Description Paragraph -->
                <p style="margin: 0 0 28px 0; font-size: 16px; font-weight: 400; color: #202020; line-height: 24px; max-width: 400px; text-align: justify;">
                    Having a pet means you have more joy, a new friend, a happy person who will always be with you to have fun. We have 200+ different pets that can meet your needs!
                </p>

                <!-- Buttons Wrapper -->
                <div class="cta-buttons" style="display: flex; gap: 16px; justify-content: flex-start; flex-wrap: wrap;">
                    
                    <!-- Browse Dogs Button (Solid Fill) -->
                    <a href="#" style="text-decoration: none; width: 173px; height: 52px; display: flex; align-items: center; justify-content: center; border-radius: 12px; color: #ffffff; font-weight: 600; font-size: 14px; background-color: #147A4D; box-sizing: border-box;">
                        Browse Dogs
                    </a>
                    
                    <!-- Browse Cats Button (Outline) -->
                    <a href="#" style="text-decoration: none; width: 173px; height: 52px; display: flex; align-items: center; justify-content: center; border: 2px solid #147A4D; border-radius: 12px; color: #147A4D; font-weight: 600; font-size: 14px; background-color: transparent; box-sizing: border-box;">
                        Browse Cats
                    </a>

                </div>

            </div>

        </div>

        <!-- POPULAR BREEDS SECTION -->
        <section class="popular-breeds-section" style="background-color: #F7F3EC; padding: 40px 0; margin: 40px 0; width: 100%; box-sizing: border-box; display: flex; justify-content: center;">
            <div style="width: 100%; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column;">
                <div class="popular-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 30px;">
                    <div class="popular-title-container">
                        <h2 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 700; color: #000000; line-height: 1.2;">
                            Popular Breeds
                        </h2>
                        <p style="margin: 0; font-size: 13px; font-weight: 400; color: #333333;">
                            Explore listings by commonly searched breeds.
                        </p>
                    </div>
                    <a href="#" class="desktop-btn" style="text-decoration: none; padding: 10px 20px; border: 1px solid #0E6B40; border-radius: 6px; color: #0E6B40; font-size: 13px; font-weight: 600; background-color: transparent; display: inline-block;">
                        View All Breeds
                    </a>
                </div>

                <div class="popular-breeds-grid" style="display: flex; gap: 20px; justify-content: space-between; flex-wrap: wrap;">
                    <!-- Card 1: Golden Retriever -->
                    <div class="popular-breed-card" style="width: 280px; height: 272px; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; box-sizing: border-box;">
                        <img src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever" class="popular-breed-img" style="width: 180px; height: 180px; border-radius: 50%; border: 3px solid #ffffff; object-fit: cover; position: absolute; top: 0; z-index: 2; box-sizing: border-box; background-color: #ccc;">
                        <div class="popular-breed-info" style="width: 100%; height: 180px; background-color: #FCE5C9; border-radius: 12px; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding-bottom: 22px; box-sizing: border-box; z-index: 1;">
                            <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 700; color: #000000;">Golden Retriever</h3>
                            <span style="font-size: 12px; font-weight: 400; color: #333333;">320 available</span>
                        </div>
                    </div>

                    <!-- Card 2: German Shepherd -->
                    <div class="popular-breed-card" style="width: 280px; height: 272px; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; box-sizing: border-box;">
                        <img src="{{ asset('images/german_shepherd.jpg') }}" alt="German Shepherd" class="popular-breed-img" style="width: 180px; height: 180px; border-radius: 50%; border: 3px solid #ffffff; object-fit: cover; position: absolute; top: 0; z-index: 2; box-sizing: border-box; background-color: #ccc;">
                        <div class="popular-breed-info" style="width: 100%; height: 180px; background-color: #E0ECFB; border-radius: 12px; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding-bottom: 22px; box-sizing: border-box; z-index: 1;">
                            <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 700; color: #000000;">German Shepherd</h3>
                            <span style="font-size: 12px; font-weight: 400; color: #333333;">320 available</span>
                        </div>
                    </div>

                    <!-- Card 3: Persian -->
                    <div class="popular-breed-card" style="width: 280px; height: 272px; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; box-sizing: border-box;">
                        <img src="{{ asset('images/persian.jpg') }}" alt="Persian" class="popular-breed-img" style="width: 180px; height: 180px; border-radius: 50%; border: 3px solid #ffffff; object-fit: cover; position: absolute; top: 0; z-index: 2; box-sizing: border-box; background-color: #ccc;">
                        <div class="popular-breed-info" style="width: 100%; height: 180px; background-color: #FDC5BC; border-radius: 12px; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding-bottom: 22px; box-sizing: border-box; z-index: 1;">
                            <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 700; color: #000000;">Persian</h3>
                            <span style="font-size: 12px; font-weight: 400; color: #333333;">320 available</span>
                        </div>
                    </div>

                    <!-- Card 4: British Shorthair -->
                    <div class="popular-breed-card" style="width: 280px; height: 272px; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; box-sizing: border-box;">
                        <img src="{{ asset('images/british_shorthair.jpg') }}" alt="British Shorthair" style="width: 180px; height: 180px; border-radius: 50%; border: 3px solid #ffffff; object-fit: cover; position: absolute; top: 0; z-index: 2; box-sizing: border-box; background-color: #ccc;">
                        <div style="width: 100%; height: 180px; background-color: #F9DCE5; border-radius: 12px; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding-bottom: 22px; box-sizing: border-box; z-index: 1;">
                            <h3 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 700; color: #000000;">British Shorthair</h3>
                            <span style="font-size: 12px; font-weight: 400; color: #333333;">320 available</span>
                        </div>
                    </div>
                </div>
                <div class="mobile-btn-container" style="display: none; margin-top: 24px; text-align: center;">
                    <a href="#" class="my-btn" style="text-decoration: none; background: #147A4D; color: #ffffff; border: 1px solid #147A4D; padding: 10px 20px; border-radius: 6px; font-weight: 600; display: inline-block; width: calc(100% - 40px);">View All Breeds</a>
                </div>
            </div>
        </section>

        <!-- LOCATIONS -->
        <div class="my-section" style="background: #147A4D; width: 100%; padding: 50px 0;">
            <div style="width: 100%; max-width: 1200px; margin: 0 auto; color: white;">
                <div style="margin-bottom: 40px;">
                    <h2 class="my-sec-title" style="color: white; margin-bottom: 12px; font-size: 28px;">Find Pets by Location</h2>
                    <p class="my-sec-desc" style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 0;">Browse pets available in major cities and find listings closer to your location.</p>
                </div>
                <div class="my-loc-grid">
                    <div class="my-loc-card"><div><h3>Lahore</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>Faisalabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>Multan</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>Sialkot</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    
                    <div class="my-loc-card"><div><h3>Karachi</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>Peshawar</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>Islamabad</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="my-loc-card"><div><h3>All Locations</h3><p>Browse listings</p></div><i class="fa-solid fa-arrow-right"></i></div>
                </div>
            </div>
        </div>

        <!-- JOURNEY -->
        <div class="my-section" style="width: 100%; max-width: 1200px; margin: 0 auto; padding-top: 120px; padding-bottom: 0px;">
            <h2 class="my-sec-title" style="text-align: center;">A Simple Marketplace Journey</h2>
            <p class="my-sec-desc" style="text-align: center;">How to buy or sell pets easily and safely.</p>
            <div class="my-journey">
                <div class="my-step s1" style="position: relative; padding: 30px;">
                    <img src="{{ asset('images/search.svg') }}" style="position: absolute; right: 20px; top: 30px; width: 100px; height: 100px; opacity: 1; z-index: 0; filter: brightness(0) invert(1); pointer-events: none;">
                    <div style="position: relative; z-index: 1;">
                        <div class="my-step-icon"><img src="{{ asset('images/search.svg') }}" style="width: 20px; height: 20px;"></div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700;">Search and Filter</h3>
                        <p style="font-family: 'DM Sans', sans-serif; font-size: 18px; font-weight: 400; line-height: 30px; color: #000000; max-width: 85%; margin: 0;">Search by pet category, breed, location and price to find relevant listings.</p>
                    </div>
                </div>
                <div class="my-step s2" style="position: relative; padding: 30px;">
                    <img src="{{ asset('images/review-icon.svg') }}" style="position: absolute; right: 20px; top: 30px; width: 100px; height: 100px; opacity: 1; z-index: 0; filter: brightness(0) invert(1); pointer-events: none;">
                    <div style="position: relative; z-index: 1;">
                        <div class="my-step-icon"><img src="{{ asset('images/review-icon.svg') }}" style="width: 20px; height: 20px;"></div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700;">Review the Listing</h3>
                        <p style="font-family: 'DM Sans', sans-serif; font-size: 18px; font-weight: 400; line-height: 30px; color: #000000; max-width: 85%; margin: 0;">Check photos, pet details, health information and seller profile before making contact.</p>
                    </div>
                </div>
                <div class="my-step s3" style="position: relative; padding: 30px;">
                    <!-- Floating Animals on top of card -->
                    <img src="{{ asset('images/cat-journey.png') }}" style="position: absolute; top: -161px; left: 45px; width: 130px; z-index: 5; pointer-events: none;">
                    <img src="{{ asset('images/dog-journey.png') }}" style="position: absolute; top: -201px; left: 150px; width: 180px; z-index: 4; pointer-events: none;">
                    
                    <img src="{{ asset('images/contact-seller.svg') }}" style="position: absolute; right: 20px; top: 30px; width: 100px; height: 100px; opacity: 1; z-index: 0; filter: brightness(0) invert(1); pointer-events: none;">
                    <div style="position: relative; z-index: 1;">
                        <div class="my-step-icon"><img src="{{ asset('images/contact-seller.svg') }}" style="width: 20px; height: 20px;"></div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700;">Contact the Seller</h3>
                        <p style="font-family: 'DM Sans', sans-serif; font-size: 18px; font-weight: 400; line-height: 30px; color: #000000; max-width: 85%; margin: 0;">Send an inquiry or message without exposing private contact details by default.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SAFETY & RESPONSIBLE PET OWNERSHIP SECTION COMPONENT -->
        <x-safety-section />

        <!-- SELL PET BANNER COMPONENT -->
        <x-sell-banner />

    </main>
