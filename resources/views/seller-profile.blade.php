<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ahmed Khan - Seller Profile | Pet Marketplace</title>
    <meta name="description" content="View Ahmed Khan's seller profile, active pet listings, and completed sales history on Pet Marketplace.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    
<style>
    /* Seller Profile specific styles */
    .sp-wrap { max-width: 1240px; margin: 40px auto; padding: 0 20px; font-family: 'DM Sans', sans-serif; }
    
    /* Profile Card */
    .sp-card { background: #fff; border-radius: 16px; border: 1px solid #E5E7EB; overflow: hidden; position: relative; margin-bottom: 24px; }
    .sp-cover { height: 164px; width: 100%; object-fit: cover; background: #e0d9d2; }
    
    .sp-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 0 40px 30px; position: relative; }
    .sp-avatar-wrap { position: relative; margin-top: -95px; margin-right: 24px; }
    .sp-avatar { width: 190px; height: 190px; border-radius: 50%; border: 7.13px solid #FAFAF8; object-fit: cover; background: #fff; }
    
    .sp-info-left { display: flex; align-items: flex-end; }
    .sp-details { margin-bottom: 10px; }
    .sp-name-row { display: flex; align-items: center; gap: 10px; margin-bottom: 4px; }
    .sp-name { font-family: 'Manrope', sans-serif; font-size: 30px; font-weight: 700; color: #000000; margin: 0; line-height: 44px; }
    .sp-badge { background: #147A4D; color: #fff; font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; }
    
    .sp-type-loc { font-size: 14px; color: #6B7280; display: flex; align-items: center; gap: 8px; }
    .sp-type-loc i { margin-right: 4px; }
    
    .sp-actions { display: flex; gap: 12px; margin-top: 20px; }
    .sp-btn { height: 56px; border-radius: 8px; font-size: 16px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; text-decoration: none; border: 1px solid transparent; transition: 0.2s; box-sizing: border-box; }
    .sp-btn-primary { width: 197px; background: #147A4D; color: #fff; box-shadow: 0px 2px 7px rgba(0, 0, 0, 0.1); }
    .sp-btn-primary:hover { background: #0E6B40; }
    .sp-btn-outline { width: 179px; background: #fff; border: 0.74px solid rgba(40, 40, 40, 0.3); color: #161616; }
    .sp-btn-outline i { color: #DC2626; }
    .sp-btn-outline:hover { background: #F9FAFB; }
    
    /* About */
    .sp-about { padding: 0 40px 40px; }
    .sp-about-title { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #161616; margin: 0 0 12px; }
    .sp-about-text { font-family: 'DM Sans', sans-serif; font-size: 16px; color: #000000; line-height: 24px; margin: 0 0 24px; max-width: 841px; }
    
    /* Stats Grid */
    .sp-stats { display: flex; gap: 16px; max-width: 841px; }
    .sp-stat { flex: 1; height: 89px; padding: 0 24px; border-radius: 14px; border-top: 0.67px solid #E2E7E3; display: flex; flex-direction: column; justify-content: center; box-sizing: border-box; }
    .sp-stat-green { background: #EAF7F0; }
    .sp-stat-beige { background: #F7EFE2; }
    .sp-stat-val { font-family: 'DM Sans', sans-serif; font-size: 20px; font-weight: 700; line-height: 31px; color: #0C5E3A; margin-bottom: 0; }
    .sp-stat-label { font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500; color: #000000; }
    
    /* Listings Section */
    .sp-list-sec { text-align: center; margin-bottom: 24px; }
    .sp-list-title { font-family: 'Manrope', sans-serif; font-size: 34px; font-weight: 700; color: #000000; margin: 0 0 8px; line-height: 44px; }
    .sp-list-desc { font-family: 'DM Sans', sans-serif; font-size: 16px; font-weight: 400; color: #000000; margin: 0 0 24px; line-height: 24px; text-align: center; }
    
    .sp-tabs { display: flex; justify-content: center; gap: 12px; margin-bottom: 40px; }
    .sp-tab { height: 40px; padding: 0 24px; border-radius: 6px; font-size: 14px; font-weight: 600; display: flex; align-items: center; cursor: pointer; text-decoration: none; border: 1px solid #E5E7EB; color: #161616; background: #fff; transition: 0.2s; }
    .sp-tab.active { background: #147A4D; color: #fff; border-color: #147A4D; }
    
    /* Grid Reused from other pages */
    .my-pets-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 0px; text-align: left; }
    .my-pet-card { background: #fff; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden; text-decoration: none; color: inherit; display: flex; flex-direction: column; transition: 0.3s; position: relative; }
    .my-pet-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .my-pet-img { width: 100%; height: 236px; object-fit: cover; }
    .my-pet-fav { position: absolute; top: 12px; right: 12px; width: 28px; height: 28px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #6B7280; font-size: 12px; transition: 0.2s; }
    .my-pet-fav:hover { color: #DC2626; }
    .my-pet-info { padding: 16px; flex: 1; display: flex; flex-direction: column; }
    .my-pet-title { font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; color: #161616; margin: 0 0 4px; }
    .my-pet-breed { font-size: 12px; color: #94a3b8; margin: 0 0 12px; }
    .my-pet-price { font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 800; color: #147A4D; margin-bottom: 12px; }
    .my-pet-meta { display: flex; justify-content: space-between; font-size: 12px; color: #64748b; margin-bottom: 12px; }
    .my-pet-loc { font-size: 12px; color: #64748b; border-top: 1px solid #F3F4F6; padding-top: 12px; }
    
    @media (max-width: 1100px) {
        .my-pets-grid { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 900px) {
        .sp-wrap { margin: 20px auto; }
        .sp-header { flex-direction: column; align-items: flex-start; padding: 0 20px 20px; text-align: left; }
        .sp-info-left { flex-direction: column; align-items: flex-start; }
        .sp-avatar-wrap { margin-right: 0; margin-bottom: 16px; margin-top: -40px; }
        .sp-avatar { width: 120px; height: 120px; border-width: 4px; }
        .sp-name { font-size: 26px; line-height: 36px; }
        .sp-name-row { justify-content: flex-start; }
        .sp-type-loc { justify-content: flex-start; }
        .sp-actions { justify-content: flex-start; width: 100%; margin-top: 16px; }
        .sp-about { padding: 0 20px 30px; text-align: left; }
        .sp-about-text { text-align: justify; }
        .sp-stats { flex-direction: column; gap: 16px; }
        .sp-stat { width: 100%; height: 89px; min-height: 89px; flex: none; box-sizing: border-box; }
    }
    
    @media (max-width: 768px) {
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
    
    @media (max-width: 600px) {
        .sp-actions { flex-direction: column; }
        .sp-btn { height: 50px; width: 100%; justify-content: center; }
        .sp-tabs { gap: 8px; }
        .sp-tab { flex: 1; justify-content: center; padding: 0 10px; font-size: 13px; text-align: center; }
    }
</style>
</head>
<body>

    <!-- HEADER COMPONENT -->
    <x-header />

<div class="sp-wrap">
    <!-- Seller Profile Card -->
    <div class="sp-card">
        <img src="{{ asset('images/seller-profile-hero.jpg') }}" alt="Cover" class="sp-cover" onerror="this.src='https://placehold.co/1200x200/e0d9d2/e0d9d2';">
        
        <div class="sp-header">
            <div class="sp-info-left">
                <div class="sp-avatar-wrap">
                    <img src="{{ asset('images/seller-avatar.jpg') }}" alt="Ahmed Khan" class="sp-avatar" onerror="this.src='https://placehold.co/120x120/ccc/fff?text=AK';">
                </div>
                <div class="sp-details">
                    <div class="sp-name-row">
                        <h1 class="sp-name">Ahmed Khan</h1>
                        <span class="sp-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
                    </div>
                    <div class="sp-type-loc">
                        <span>Individual Seller</span>
                        <span>&nbsp;<i class="fa-solid fa-location-dot"></i> Lahore</span>
                    </div>
                </div>
            </div>
            
            <div class="sp-actions">
                <a href="#" class="sp-btn sp-btn-primary"><i class="fa-regular fa-message"></i> Contact Seller</a>
                <a href="#" class="sp-btn sp-btn-outline"><i class="fa-regular fa-flag"></i> Report Seller</a>
            </div>
        </div>
        
        <div class="sp-about">
            <h2 class="sp-about-title">About Seller</h2>
            <p class="sp-about-text">Pet owner based in Lahore. Buyers can review this seller's profile, active listings and completed or sold listing history, then contact the seller through the marketplace.</p>
            
            <div class="sp-stats">
                <div class="sp-stat sp-stat-green">
                    <div class="sp-stat-val">Verified</div>
                    <div class="sp-stat-label">Seller Status</div>
                </div>
                <div class="sp-stat sp-stat-beige">
                    <div class="sp-stat-val">4</div>
                    <div class="sp-stat-label">Active Listings</div>
                </div>
                <div class="sp-stat sp-stat-beige">
                    <div class="sp-stat-val">3</div>
                    <div class="sp-stat-label">Sold / Completed</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Listings Section -->
    <div class="sp-list-sec">
        <h2 class="sp-list-title">Seller Listings</h2>
        <p class="sp-list-desc">Browse active listings or completed/sold listing history.</p>
        
        <div class="sp-tabs">
            <a href="#" class="sp-tab active">Active Listings</a>
            <a href="#" class="sp-tab">Sold / Completed</a>
        </div>
        
        <div class="my-pets-grid">
            <!-- Card 1 -->
            <a href="{{ url('/pet-details') }}" class="my-pet-card">
                <div style="position: relative;">
                    <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" class="my-pet-img" onerror="this.src='https://placehold.co/400x300';">
                    <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="my-pet-info">
                    <h3 class="my-pet-title">German Shepherd</h3>
                    <p class="my-pet-breed">German Shepherd</p>
                    <div class="my-pet-price">Rs. 85,000</div>
                    <div class="my-pet-meta">
                        <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 3 Months</span>
                        <span><i class="fa-solid fa-venus-mars" style="margin-right: 4px;"></i> Male</span>
                    </div>
                    <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                </div>
            </a>
            
            <!-- Card 2 -->
            <a href="{{ url('/pet-details') }}" class="my-pet-card">
                <div style="position: relative;">
                    <img src="{{ asset('images/card_british.jpg') }}" alt="British Shorthair" class="my-pet-img" onerror="this.src='https://placehold.co/400x300';">
                    <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="my-pet-info">
                    <h3 class="my-pet-title">British Shorthair</h3>
                    <p class="my-pet-breed">British Shorthair</p>
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
                    <img src="{{ asset('images/card_shihtzu.jpg') }}" alt="Shih Tzu Puppy" class="my-pet-img" onerror="this.src='https://placehold.co/400x300';">
                    <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="my-pet-info">
                    <h3 class="my-pet-title">Shih Tzu Puppy</h3>
                    <p class="my-pet-breed">Shih Tzu</p>
                    <div class="my-pet-price">Rs. 65,000</div>
                    <div class="my-pet-meta">
                        <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 1 Year</span>
                        <span><i class="fa-solid fa-venus-mars" style="margin-right: 4px;"></i> Male</span>
                    </div>
                    <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Karachi</div>
                </div>
            </a>
            
            <!-- Card 4 -->
            <a href="{{ url('/pet-details') }}" class="my-pet-card">
                <div style="position: relative;">
                    <img src="{{ asset('images/card_parrot.jpg') }}" alt="Lovebird Pair" class="my-pet-img" onerror="this.src='https://placehold.co/400x300';">
                    <div class="my-pet-fav"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="my-pet-info">
                    <h3 class="my-pet-title">Lovebird Pair</h3>
                    <p class="my-pet-breed">Lovebird</p>
                    <div class="my-pet-price">Rs. 12,500</div>
                    <div class="my-pet-meta">
                        <span><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 5 Months</span>
                        <span><i class="fa-solid fa-venus" style="margin-right: 4px;"></i> Female</span>
                    </div>
                    <div class="my-pet-loc"><i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> Lahore</div>
                </div>
            </a>
        </div>
    </div>
</div>

    <!-- FOOTER COMPONENT -->
    <x-footer />

<script>
    // Tab switching logic (visual only for now)
    const tabs = document.querySelectorAll('.sp-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
</script>

</body>
</html>
