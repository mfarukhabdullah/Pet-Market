<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Golden Retriever Puppy for Sale in Lahore | Pet Marketplace</title>
    <meta name="description" content="Golden Retriever puppy, 2 months, male, vaccinated and dewormed. View pet details, health information and contact the verified seller in Lahore.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        /* ===== Shared section + card styles (same as home page) ===== */
        .my-sec-title { font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
        .my-sec-desc { color: #202020; font-size: 16px; font-weight: 400; line-height: 24px; margin-bottom: 40px; }
        .my-pets-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .my-pet-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: none; transition: 0.3s; cursor: pointer; position: relative; text-decoration: none; color: inherit; display: block; }
        .my-pet-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.18); }
        .my-pet-img { width: 100%; height: 236px; object-fit: cover; display: block; border-radius: 12px 12px 0 0; }
        .my-badge { position: absolute; top: 12px; left: 12px; background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .my-pet-fav { position: absolute; top: 12px; right: 12px; background: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 12px; }
        .my-pet-info { padding: 16px; }
        .my-pet-title { font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 4px; }
        .my-pet-breed { font-size: 12px; color: #94a3b8; margin: 0 0 12px; }
        .my-pet-price { font-size: 16px; font-weight: 800; color: #147A4D; margin-bottom: 12px; }
        .my-pet-meta { display: flex; justify-content: flex-start; gap: 16px; font-size: 12px; color: #64748b; margin-bottom: 12px; }
        .my-pet-loc { font-size: 12px; color: #64748b; }

        /* ===== Pet Details page ===== */
        .pd-page { background: #FBF8F3; padding: 24px 0 60px; }
        .pd-wrap { width: 100%; max-width: 1200px; margin: 0 auto; }
        .pd-card { background: #FFFFFF; border-radius: 16px; box-shadow: 0 6px 24px rgba(17, 24, 39, 0.06); border: 1px solid #F1ECE3; box-sizing: border-box; }

        /* Row 1: Gallery + Summary */
        .pd-top { display: grid; grid-template-columns: 1fr 580px; gap: 20px; align-items: stretch; }
        .pd-gallery { padding: 16px; display: flex; flex-direction: column; }
        .pd-main-img { width: 100%; height: 380px; flex: 1 0 380px; object-fit: cover; object-position: center 30%; border-radius: 12px; display: block; transition: opacity 0.25s ease; }
        .pd-thumbs { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-top: 12px; }
        .pd-thumb { width: 100%; height: 78px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent; opacity: 0.8; transition: 0.2s; box-sizing: border-box; }
        .pd-thumb:hover { opacity: 1; }
        .pd-thumb.active { border-color: #147A4D; opacity: 1; }

        .pd-summary { padding: 24px; display: flex; flex-direction: column; justify-content: space-between; }
        .pd-sum-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; }
        .pd-title { font-family: 'Manrope', sans-serif; font-size: 34px; font-weight: 700; color: #17211C; line-height: 42px; margin: 0; }
        .pd-icon-btns { display: flex; gap: 4px; }
        .pd-icon-btn { width: 36px; height: 36px; border-radius: 10px; border: 1px solid #E5E7EB; background: #fff; color: #374151; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; transition: 0.2s; }
        .pd-icon-btn:hover { border-color: #147A4D; color: #147A4D; }
        .pd-icon-btn.liked { color: #E11D48; border-color: #FBCFE8; background: #FFF1F2; }
        .pd-price { font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #147A4D; margin: 8px 0 8px; }
        .pd-sub-meta { display: flex; gap: 18px; font-size: 13px; color: #6B7280; margin-bottom: 16px; }
        .pd-sub-meta i { margin-right: 5px; }
        .pd-attr-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
        .pd-attr { background: #FAFAF8; border-radius: 13px; border: 1px solid #E2E7E3; padding: 14px 16px; box-sizing: border-box; }
        .pd-attr span { display: block; font-size: 10px; font-weight: 700; color: #147A4D; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 4px; }
        .pd-attr strong { display: block; font-family: 'DM Sans', sans-serif; font-size: 16px; font-weight: 700; color: #17211C; line-height: 21.7px; }
        .pd-btn-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
        .pd-btn { height: 56px; border-radius: 8px; font-size: 15px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; text-decoration: none; box-sizing: border-box; transition: 0.2s; font-family: inherit; box-shadow: 0 2px 7px rgba(0, 0, 0, 0.1); }
        .pd-btn-primary { background: #147A4D; color: #fff; border: 1px solid #147A4D; }
        .pd-btn-primary:hover { background: #0E6B40; }
        .pd-btn-outline { background: #fff; color: #161616; border: 1px solid #282828; }
        .pd-btn-outline:hover { border-color: #147A4D; color: #147A4D; }
        .pd-verify-note { background: #EAF7F0; border-radius: 10px; padding: 14px 16px; display: flex; gap: 10px; align-items: flex-start; font-size: 13px; color: #1F2937; line-height: 20px; }
        .pd-verify-note i { color: #147A4D; margin-top: 3px; }

        /* Row 2: Details + Sidebar */
        .pd-mid { display: grid; grid-template-columns: 1fr 370px; gap: 20px; margin-top: 40px; align-items: start; }
        .pd-details { padding: 30px; }
        .pd-h3 { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #161616; margin: 0 0 18px; }
        .pd-table { display: grid; grid-template-columns: 1fr 1fr; column-gap: 40px; }
        .pd-row { display: flex; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid #EFEFEF; font-size: 14px; }
        .pd-row span { color: #4B5563; }
        .pd-row strong { color: #161616; font-weight: 700; }
        .pd-divider { height: 1px; background: #EFEFEF; margin: 30px 0; border: none; }
        .pd-health-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .pd-health { background: #F6F3EB; border-radius: 12px; padding: 18px 20px; display: flex; gap: 14px; align-items: flex-start; }
        .pd-health-icon { color: #147A4D; font-size: 18px; margin-top: 1px; }
        .pd-health strong { display: block; font-size: 14px; font-weight: 700; color: #161616; margin-bottom: 6px; }
        .pd-health span { font-size: 13px; color: #161616; line-height: 1.4; }
        .pd-desc { font-size: 15px; color: #202020; line-height: 26px; margin: 0; text-align: justify; }

        .pd-side { display: flex; flex-direction: column; gap: 20px; }
        .pd-seller { padding: 24px; }
        .pd-seller-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .pd-avatar { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; }
        .pd-seller-name { font-size: 17px; font-weight: 700; color: #161616; display: flex; align-items: center; gap: 6px; }
        .pd-seller-name i { color: #147A4D; font-size: 14px; }
        .pd-seller-type { font-size: 12px; color: #6B7280; }
        .pd-seller-meta { display: flex; flex-direction: column; gap: 8px; font-size: 13px; color: #4B5563; margin-bottom: 18px; }
        .pd-seller-meta i { width: 16px; color: #6B7280; margin-right: 6px; }
        .pd-seller .pd-btn { width: 100%; margin-bottom: 10px; height: 46px; }
        .pd-report { display: flex; align-items: center; justify-content: center; gap: 6px; color: #DC2626; font-size: 13px; font-weight: 600; text-decoration: none; margin-top: 6px; }
        .pd-report:hover { text-decoration: underline; }
        .pd-safety { background: #F7EFE2; border-radius: 16px; padding: 24px; }
        .pd-safety h3 { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #161616; margin: 0 0 12px; }
        .pd-safety p { font-size: 14px; color: #161616; line-height: 22px; margin: 0 0 20px; }
        .pd-safety ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px; }
        .pd-safety li { display: flex; gap: 10px; font-size: 14px; color: #161616; line-height: 22px; align-items: flex-start; }
        .pd-safety li i { color: #000000; font-size: 13px; line-height: 13px; margin-top: 4px; }

        /* Listings sections */
        .pd-listings { margin-top: 60px; }
        .pd-listings .my-sec-title { font-size: 28px; margin-bottom: 8px; }
        .pd-listings .my-sec-desc { margin-bottom: 30px; }

        @media (max-width: 1240px) {
            .pd-wrap { padding: 0 20px; box-sizing: border-box; }
        }
        @media (max-width: 1100px) {
            .pd-top, .pd-mid { grid-template-columns: 1fr; }
            .my-pets-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .pd-wrap { padding: 0 16px; }
            .pd-summary { padding: 16px; justify-content: flex-start; gap: 4px; }
            .pd-title { font-size: 24px; line-height: 30px; }
            .pd-price { font-size: 24px; margin: 12px 0; }
            .pd-attr { padding: 14px 10px; }
            .pd-attr strong { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .pd-btn-row { grid-template-columns: 1fr; gap: 12px; }
            .pd-thumbs { grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 12px; }
            .pd-thumbs img:nth-child(n+5) { display: none; }
            .pd-main-img { height: 347px; flex: none; }
            .pd-thumb { height: auto; aspect-ratio: 1 / 1; }
            .pd-top { gap: 16px; }
            .pd-table, .pd-health-grid { grid-template-columns: 1fr; }
            .pd-divider { display: none; }
            .pd-desc-box { border: 1px solid #E5E7EB; border-radius: 12px; padding: 16px; margin-top: 24px; margin-bottom: 24px; }
            .pd-desc-box .pd-h3 { margin-top: 0; }
            .pd-side { display: flex; flex-direction: column; gap: 20px; }
            .pd-safety { order: -1; margin-top: 0; }
            .pd-seller { margin-top: 0; }
            .pd-card { padding: 16px; }

            /* Horizontal Scroll for Cards */
            .my-pets-grid { 
                display: flex; 
                flex-wrap: nowrap; 
                overflow-x: auto; 
                gap: 16px; 
                padding-bottom: 16px; 
                scroll-snap-type: x mandatory; 
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .my-pets-grid::-webkit-scrollbar { display: none; }
            .my-pets-grid .my-pet-card {
                flex: 0 0 calc(50% - 8px); 
                scroll-snap-align: start;
                border-radius: 12px;
            }
            .my-pets-grid .my-pet-img { height: 160px; }
            .my-pets-grid .my-pet-info { padding: 12px; }
            .my-pets-grid .my-pet-title { font-size: 14px; margin-bottom: 2px; }
            .my-pets-grid .my-pet-breed { font-size: 11px; margin-bottom: 6px; }
            .my-pets-grid .my-pet-price { font-size: 15px; margin-bottom: 8px; }
            .my-pets-grid .my-pet-meta { font-size: 11px; margin-bottom: 8px; justify-content: flex-start; gap: 12px; }
            .my-pets-grid .my-pet-loc { font-size: 11px; padding-top: 8px; }
        }
    </style>
</head>
<body>

    <!-- HEADER COMPONENT -->
    <x-header />

    <main class="site-wrapper pd-page">
        <div class="pd-wrap">

            <!-- ROW 1: GALLERY + SUMMARY -->
            <section class="pd-top">
                <!-- Gallery -->
                <div class="pd-card pd-gallery">
                    <img id="pdMainImg" class="pd-main-img" src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever Puppy">
                    <div class="pd-thumbs">
                        <img class="pd-thumb active" src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever photo 1">
                        <img class="pd-thumb" src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever photo 2">
                        <img class="pd-thumb" src="{{ asset('images/cat_dog.jpg') }}" alt="Golden Retriever photo 3">
                        <img class="pd-thumb" src="{{ asset('images/card_gsd.jpg') }}" alt="Golden Retriever photo 4">
                        <img class="pd-thumb" src="{{ asset('images/card_shihtzu.jpg') }}" alt="Golden Retriever photo 5">
                    </div>
                </div>

                <!-- Summary -->
                <div class="pd-card pd-summary">
                    <div class="pd-sum-head">
                        <h1 class="pd-title">Golden Retriever<br>Puppy</h1>
                        <div class="pd-icon-btns">
                            <button id="pdLikeBtn" class="pd-icon-btn" aria-label="Save to favourites"><i class="fa-solid fa-heart"></i></button>
                            <button id="pdShareBtn" class="pd-icon-btn" aria-label="Share listing"><i class="fa-solid fa-share-nodes"></i></button>
                        </div>
                    </div>
                    <div class="pd-price">Rs. 85,000</div>
                    <div class="pd-sub-meta">
                        <span><i class="fa-solid fa-location-dot"></i>Lahore</span>
                        <span><i class="fa-regular fa-clock"></i>Posted 2 days ago</span>
                    </div>
                    <div class="pd-attr-grid">
                        <div class="pd-attr"><span>Breed</span><strong>Golden Retriever</strong></div>
                        <div class="pd-attr"><span>Age</span><strong>2 Months</strong></div>
                        <div class="pd-attr"><span>Gender</span><strong>Male</strong></div>
                        <div class="pd-attr"><span>Color</span><strong>Golden</strong></div>
                    </div>
                    <div class="pd-btn-row">
                        <a href="#" id="pdSendMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        <a href="#" id="pdContactBtn" class="pd-btn pd-btn-outline"><i class="fa-regular fa-user"></i> Contact Seller</a>
                    </div>
                    <div class="pd-verify-note">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Verify the animal, seller and health documentation before completing a transaction.</span>
                    </div>
                </div>
            </section>

            <!-- ROW 2: DETAILS + SIDEBAR -->
            <section class="pd-mid">
                <div class="pd-card pd-details">
                    <!-- Pet Details -->
                    <h2 class="pd-h3">Pet Details</h2>
                    <div class="pd-table">
                        <div class="pd-row"><span>Category</span><strong>Dog</strong></div>
                        <div class="pd-row"><span>Breed</span><strong>Golden Retriever</strong></div>
                        <div class="pd-row"><span>Age</span><strong>2 Months</strong></div>
                        <div class="pd-row"><span>Gender</span><strong>Male</strong></div>
                        <div class="pd-row"><span>Color</span><strong>Golden</strong></div>
                        <div class="pd-row"><span>Pedigree / Papers</span><strong>Yes</strong></div>
                    </div>

                    <hr class="pd-divider">

                    <!-- Health Information -->
                    <h2 class="pd-h3">Health Information</h2>
                    <div class="pd-health-grid">
                        <div class="pd-health">
                            <div class="pd-health-icon"><i class="fa-solid fa-syringe"></i></div>
                            <div><strong>Vaccination</strong><span>Vaccinated</span></div>
                        </div>
                        <div class="pd-health">
                            <div class="pd-health-icon"><i class="fa-solid fa-shield-heart"></i></div>
                            <div><strong>Deworming</strong><span>Completed</span></div>
                        </div>
                        <div class="pd-health">
                            <div class="pd-health-icon"><i class="fa-solid fa-notes-medical"></i></div>
                            <div><strong>Health Notes</strong><span>Health information provided by seller.</span></div>
                        </div>
                        <div class="pd-health">
                            <div class="pd-health-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div><strong>Papers</strong><span>Available</span></div>
                        </div>
                    </div>

                    <hr class="pd-divider">

                    <!-- Description -->
                    <div class="pd-desc-box">
                        <h2 class="pd-h3">Description</h2>
                        <p class="pd-desc">Friendly Golden Retriever puppy looking for a responsible home. The seller has provided the pet's age, health details and pedigree information above. Contact the seller through the marketplace for further information and arrange a visit before completing any transaction.</p>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="pd-side">
                    <div class="pd-card pd-seller">
                        <div class="pd-seller-head">
                            <img class="pd-avatar" src="{{ asset('images/seller-avatar.jpg') }}" alt="Ahmed Khan">
                            <div>
                                <div class="pd-seller-name">Ahmed Khan <i class="fa-solid fa-circle-check"></i></div>
                                <div class="pd-seller-type">Individual Seller</div>
                            </div>
                        </div>
                        <div class="pd-seller-meta">
                            <span><i class="fa-solid fa-location-dot"></i>Lahore</span>
                            <span><i class="fa-solid fa-shield-halved"></i>Verified Seller</span>
                        </div>
                        <a href="#" id="pdSellerMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        <a href="#" id="pdSellerProfileBtn" class="pd-btn pd-btn-outline"><i class="fa-regular fa-user"></i> View Seller Profile</a>
                        <a href="#" id="pdReportBtn" class="pd-report"><i class="fa-regular fa-flag"></i> Report Seller</a>
                    </div>

                    <div class="pd-safety">
                        <h3>Safety Notice</h3>
                        <p>Take reasonable steps to verify the pet and seller before making a decision.</p>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>Verify the animal and seller.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Check ownership and available health documentation.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Review applicable local legal requirements.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Report suspicious or misleading listings.</li>
                        </ul>
                    </div>
                </aside>
            </section>

            <!-- SELLER'S OTHER LISTINGS -->
            <section class="pd-listings">
                <h2 class="my-sec-title">Seller's Other Listings</h2>
                <p class="my-sec-desc">More active listings from this seller.</p>
                <div class="my-pets-grid">
                    <!-- Card 1 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Golden Retriever Puppy</h3>
                            <p class="my-pet-breed">Golden Retriever</p>
                            <div class="my-pet-price">Rs. 85,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </a>
                    <!-- Card 2 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_persian.jpg') }}" alt="Persian Cat" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Persian Cat</h3>
                            <p class="my-pet-breed">Persian</p>
                            <div class="my-pet-price">Rs. 42,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Islamabad</div>
                        </div>
                    </a>
                    <!-- Card 3 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="African Grey Parrot" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">African Grey Parrot</h3>
                            <p class="my-pet-breed">African Grey</p>
                            <div class="my-pet-price">Rs. 65,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Karachi</div>
                        </div>
                    </a>
                    <!-- Card 4 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_rabbit.jpg') }}" alt="Mini Lop Rabbit" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Mini Lop Rabbit</h3>
                            <p class="my-pet-breed">Mini Lop</p>
                            <div class="my-pet-price">Rs. 12,500</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </a>
                </div>
            </section>

            <!-- SIMILAR PETS -->
            <section class="pd-listings" style="text-align: center;">
                <h2 class="my-sec-title">Similar Pets</h2>
                <p class="my-sec-desc">Related listings that may also match your search.</p>
                <div class="my-pets-grid" style="text-align: left;">
                    <!-- Card 1 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Golden Retriever Puppy</h3>
                            <p class="my-pet-breed">Golden Retriever</p>
                            <div class="my-pet-price">Rs. 95,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 2 Months</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </a>
                    <!-- Card 2 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_persian.jpg') }}" alt="Persian Cat" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Persian Cat</h3>
                            <p class="my-pet-breed">Persian</p>
                            <div class="my-pet-price">Rs. 42,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Islamabad</div>
                        </div>
                    </a>
                    <!-- Card 3 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_parrot.jpg') }}" alt="African Grey Parrot" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">African Grey Parrot</h3>
                            <p class="my-pet-breed">African Grey</p>
                            <div class="my-pet-price">Rs. 65,000</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars" style="margin-right: 4px;"></i> Male</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Karachi</div>
                        </div>
                    </a>
                    <!-- Card 4 -->
                    <a href="{{ url('/pet-details') }}" class="my-pet-card">
                        <div style="position: relative;">
                            <img src="{{ asset('images/card_rabbit.jpg') }}" alt="Mini Lop Rabbit" class="my-pet-img">
                            <span class="my-badge">FEATURED</span>
                            <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                        </div>
                        <div class="my-pet-info">
                            <h3 class="my-pet-title">Mini Lop Rabbit</h3>
                            <p class="my-pet-breed">Mini Lop</p>
                            <div class="my-pet-price">Rs. 12,500</div>
                            <div class="my-pet-meta">
                                <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 5 Months</span>
                                <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                            </div>
                            <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                        </div>
                    </a>
                </div>
            </section>

        </div>
    </main>

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
    
    <div id="toast" style="visibility: hidden; min-width: 200px; background-color: #282828; color: #fff; text-align: center; border-radius: 8px; padding: 12px 16px; position: fixed; z-index: 1000; left: 50%; bottom: 30px; font-size: 14px; font-weight: 500; font-family: 'DM Sans', sans-serif; transform: translateX(-50%); box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: visibility 0s, opacity 0.3s linear; opacity: 0;">
        Copied to clipboard
    </div>

    <script>
        // Gallery: thumbnail click swaps main image
        (function () {
            const main = document.getElementById('pdMainImg');
            document.querySelectorAll('.pd-thumb').forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    document.querySelectorAll('.pd-thumb').forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');
                    main.style.opacity = '0';
                    setTimeout(function () { main.src = thumb.src; main.style.opacity = '1'; }, 200);
                });
            });

            // Favourite toggle
            const like = document.getElementById('pdLikeBtn');
            like.addEventListener('click', function () {
                like.classList.toggle('liked');
                const icon = like.querySelector('i');
                icon.classList.toggle('fa-regular');
                icon.classList.toggle('fa-solid');
            });

            // Share: copy link
            document.getElementById('pdShareBtn').addEventListener('click', function () {
                var copyToClipboard = function() {
                    navigator.clipboard.writeText(location.href).catch(function(){});
                };
                
                // Show toast
                var toast = document.getElementById("toast");
                toast.style.visibility = "visible";
                toast.style.opacity = "1";
                
                // Try to copy to clipboard
                if (navigator.clipboard) { copyToClipboard(); }
                
                setTimeout(function(){ 
                    toast.style.opacity = "0"; 
                    setTimeout(function(){ toast.style.visibility = "hidden"; }, 300);
                }, 3000);
            });
        })();
    </script>
</body>
</html>
