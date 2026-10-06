<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Marketplace</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        /* ADDING CUSTOM STYLES TO REPLICATE THE IMAGE */
        /* Mobile Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-inner {
                flex-direction: column !important;
                padding-top: 30px !important;
                padding-bottom: 70px !important; /* Perfect overlap with search bar */
                align-items: center !important;
            }
            .hero-text {
                max-width: 100% !important;
                margin-bottom: 10px !important; /* Tighter space between text and image */
                padding: 0 20px !important;
            }
            .hero-text h1 {
                font-size: 34px !important;
                line-height: 1.15 !important;
                text-align: left !important;
                margin-bottom: 14px !important;
            }
            .hero-text p {
                text-align: left !important;
                font-size: 15px !important;
                line-height: 1.5 !important;
                margin-bottom: 10px !important;
            }
            .hero-text + div {
                justify-content: center !important;
                width: 100%;
                position: relative;
            }
            .hero-text + div img {
                margin-bottom: 0px !important;
                max-width: 100% !important;
                transform: scale(1.3); /* Scale up the image as per reference */
                transform-origin: bottom center;
            }
            .hero-inner svg {
                right: 12% !important;
                top: 5% !important;
                z-index: 20;
            }
            .search-bar-wrapper {
                position: absolute !important;
                bottom: 0 !important;
                transform: translateY(50%) !important;
                padding: 0 15px !important; /* Slightly wider search bar */
                z-index: 20 !important;
            }
            .search-bar {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px !important;
                padding: 15px !important;
                border-radius: 12px !important;
            }
            .search-bar > div {
                padding: 10px 14px !important;
                border-radius: 8px !important;
            }
            .search-btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 14px !important;
            }
            .hero-spacer {
                height: 250px !important; /* Match the new search bar height */
            }

            /* Decorative shapes positioning for mobile */
            /* Restore diamonds on left side */
            section[style*="background-color: #F7EFE2"] > div:first-child > div:nth-child(2) {
                display: block !important;
                left: 10% !important;
                top: 55% !important;
                transform: rotate(20deg) !important;
            }
            section[style*="background-color: #F7EFE2"] > div:first-child > div:nth-child(3) {
                display: block !important;
                left: 16% !important;
                top: 60% !important;
                transform: rotate(15deg) !important;
            }
            section[style*="background-color: #F7EFE2"] > div:first-child > div:nth-child(4) {
                display: block !important;
                left: 8% !important;
                top: 65% !important;
                transform: rotate(45deg) !important;
            }

            /* herobottom.svg */
            section[style*="background-color: #F7EFE2"] > div:first-child > img {
                width: 250% !important;
                max-width: none !important;
                left: -70% !important;
                bottom: -30px !important; 
            }
            /* Right-side Green organic shape */
            section[style*="background-color: #F7EFE2"] > div:first-child > div:nth-child(5) {
                right: auto !important;
                left: -15% !important;
                bottom: 60px !important;
                width: 240px !important;
                height: 320px !important;
                transform: rotate(-10deg) !important;
            }
            /* Right-side Yellow shape */
            section[style*="background-color: #F7EFE2"] > div:first-child > div:nth-child(6) {
                right: -25% !important;
                bottom: auto !important;
                top: 45% !important;
                width: 280px !important;
                height: 280px !important;
                transform: rotate(15deg) !important;
            }

            /* Fix category cards on mobile */
            .my-categories {
                gap: 15px !important;
                justify-content: center !important;
            }
            .my-cat-item {
                width: 110px !important;
            }
            .my-cat-img {
                width: 90px !important;
                height: 90px !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .my-cat-name {
                font-size: 14px !important;
            }
            .my-pets-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 15px !important;
            }
            .my-pet-img {
                height: 160px !important;
            }
            .my-cta-banner {
                margin: 40px 10px !important;
                padding: 30px 20px !important;
            }
            .my-loc-grid {
                grid-template-columns: 1fr 1fr !important;
            }
            .my-journey {
                grid-template-columns: 1fr !important;
            }
        }
        
        .my-section { padding: 60px 0; width: 100%; margin: 0 auto; }
        .my-sec-title { font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
        .my-sec-desc { color: #202020; font-size: 16px; font-weight: 400; line-height: 24px; margin-bottom: 40px; text-align: justify; }
        
        .my-categories { display: flex; gap: 30px; flex-wrap: wrap; justify-content: flex-start; }
        .my-cat-item { text-align: center; cursor: pointer; transition: 0.3s; }
        .my-cat-item:hover { transform: translateY(-5px); }
        .my-cat-img { width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid #f8fafc; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 15px; background: #fff; display: flex; align-items: center; justify-content: center; }
        .my-cat-img img { width: 100%; height: 100%; object-fit: cover; }
        .my-cat-name { font-weight: 700; color: #1e293b; font-size: 1.1rem; }
        
        .my-pets-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; }
        .my-pet-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; transition: 0.3s; cursor: pointer; position: relative; }
        .my-pet-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .my-pet-img { width: 100%; height: 200px; object-fit: cover; }
        .my-badge { position: absolute; top: 15px; left: 15px; background: #f59e0b; color: white; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .my-pet-fav { position: absolute; top: 15px; right: 15px; background: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #94a3b8; }
        .my-pet-info { padding: 20px; }
        .my-pet-title { font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
        .my-pet-breed { font-size: 0.9rem; color: #64748b; margin-bottom: 10px; }
        .my-pet-price { font-size: 1.3rem; font-weight: 800; color: #10b981; margin-bottom: 15px; }
        .my-pet-meta { display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b; border-top: 1px solid #f1f5f9; padding-top: 15px; }
        
        .my-cta-banner { background: #fff4ed; border-radius: 24px; padding: 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; margin: 60px 20px; max-width: 1200px; margin-left: auto; margin-right: auto; position: relative; overflow: hidden; }
        .my-cta-banner::before { content: ''; position: absolute; left: 0; bottom: 0; width: 400px; height: 100%; background: #10b981; clip-path: polygon(0 0, 100% 100%, 0 100%); z-index: 1; }
        .my-cta-img { position: relative; z-index: 2; width: 300px; border-radius: 16px; margin-right: 40px; }
        .my-cta-content { flex: 1; position: relative; z-index: 2; min-width: 300px; text-align: right; }
        .my-cta-content h2 { font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 15px; }
        .my-cta-content p { color: #64748b; font-size: 1.1rem; margin-bottom: 25px; }
        .my-cta-btns { display: flex; gap: 15px; justify-content: flex-end; }
        
        .my-loc-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .my-loc-card { background: rgba(255, 255, 255, 0.08); border: 0.67px solid rgba(255, 255, 255, 0.1); border-top: 0.67px solid rgba(255, 255, 255, 0.72); border-radius: 16px; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: 0.3s; min-height: 122px; box-sizing: border-box; }
        .my-loc-card:hover { background: rgba(255, 255, 255, 0.15); border-top-color: #ffffff; }
        .my-loc-card h3 { font-size: 24px; font-weight: 700; line-height: 24.8px; letter-spacing: 0.5px; margin: 0; font-family: 'Manrope', sans-serif; color: #FFFFFF; }
        .my-loc-card p { font-size: 16px; font-weight: 500; line-height: 18.6px; margin: 6px 0 0; color: #EBEBEB; font-family: 'DM Sans', sans-serif; }
        
        .my-journey { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 40px; }
        .my-step { padding: 30px; border-radius: 16px; position: relative; }
        .my-step.s1 { background: #FCE5C9; }
        .my-step.s2 { background: #D6EADF; }
        .my-step.s3 { background: #FDC5BC; }
        .my-step-icon { width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; background: #147A4D; }
        .my-step-icon img { filter: brightness(0) invert(1); }
        .my-step h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
        .my-step p { color: #64748b; font-size: 0.9rem; }
    </style>
</head>
<body>

    <!-- HEADER COMPONENT -->
    <x-header />

    <!-- PAGE BODY SHELL -->
    @include('home')

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>
