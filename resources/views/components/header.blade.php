<!-- HEADER COMPONENT -->
<!-- Top Green Notice Bar (#0C5E3A - Full Screen Width Background) -->
<div class="header-top-bar">
    <div class="shell-1440">
        <div class="container">
            <div class="header-top-content">
                <div class="top-notice-left">
                    <img src="{{ asset('images/header-icon.svg') }}" alt="Header Icon" class="top-notice-header-icon">
                    <span>Buy responsibly. Verify the animal and seller before completing a transaction.</span>
                </div>
                <div class="top-notice-right">
                    <a href="#safety" class="safety-guide-link">Safety Guide</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation Header (#ffffff - Full Screen Width Background) -->
<header class="main-header">
    <div class="shell-1440">
        <div class="container">
            <div class="nav-container">
                <!-- Brand Logo -->
                <a href="/" class="header-brand-logo">
                    <div class="logo-box-green">
                        <img src="{{ asset('images/Italic-text-header.svg') }}" alt="Pet Marketplace Logo" class="logo-italic-img">
                    </div>
                    <span class="brand-name">Pet Marketplace</span>
                </a>

                <!-- Navigation Links -->
                <nav class="header-nav-menu">
                    <a href="#featured" class="header-nav-item">Featured Pets</a>
                    <a href="#categories" class="header-nav-item">Categories</a>
                    <a href="#breeds" class="header-nav-item">Breeds</a>
                    <a href="#locations" class="header-nav-item">Locations</a>
                    <a href="#safety" class="header-nav-item">Safety</a>
                </nav>

                <!-- Action Buttons & Mobile Controls -->
                <div class="header-action-btns">
                    <a href="#login" class="btn-login-register">Login / Register</a>
                    <a href="#sell" class="btn-sell-pet">Sell a Pet</a>
                    <button class="mobile-menu-btn" aria-label="Toggle Mobile Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- MOBILE NAVIGATION DRAWER COMPONENT -->
<div id="mobileNavDrawer" class="mobile-nav-drawer">
    <div>
        <div class="mobile-nav-header">
            <a href="/" class="header-brand-logo">
                <div class="logo-box-green">
                    <img src="{{ asset('images/Italic-text-header.svg') }}" alt="Pet Marketplace Logo" class="logo-italic-img">
                </div>
                <span class="brand-name">Pet Marketplace</span>
            </a>
            <button id="closeDrawerBtn" class="close-drawer-btn"><i class="fas fa-times"></i></button>
        </div>
        <ul class="mobile-nav-list">
            <li><a href="#featured">Featured Pets</a></li>
            <li><a href="#categories">Categories</a></li>
            <li><a href="#breeds">Breeds</a></li>
            <li><a href="#locations">Locations</a></li>
            <li><a href="#safety">Safety</a></li>
        </ul>
    </div>
    <div style="margin-top:32px;">
        <a href="#sell" class="btn-sell-pet" style="width:100%; margin-bottom:12px; justify-content:center;">Sell a Pet</a>
        <a href="#login" class="btn-login-register" style="width:100%; justify-content:center;">Login / Register</a>
    </div>
</div>

<!-- MOBILE BOTTOM NAVIGATION BAR -->
<div class="mobile-bottom-nav">
    <a href="/" class="nav-item active">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
    </a>
    <a href="#chat" class="nav-item">
        <i class="fa-regular fa-comment-dots"></i>
        <span>Chat</span>
    </a>
    <div class="nav-fab-wrapper">
        <a href="#sell" class="nav-fab">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    <a href="#myads" class="nav-item">
        <i class="fa-solid fa-bullhorn"></i>
        <span>My Ads</span>
    </a>
    <button id="mobileToggleBtn" class="nav-item" aria-label="More">
        <i class="fa-solid fa-bars"></i>
        <span>More</span>
    </button>
</div>
