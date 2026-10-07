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
                    <a href="{{ route('category') }}" class="header-nav-item">Categories</a>
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
            <li><a href="{{ route('category') }}">Categories</a></li>
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
    <a href="{{ route('seller.messages') }}" class="nav-item">
        <i class="fa-regular fa-comment-dots"></i>
        <span>Chat</span>
    </a>
    <div class="nav-fab-wrapper">
        <a href="#sell" class="nav-fab">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    <a href="{{ route('seller.listings') }}" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 3px;">
            <path d="M7 8H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2" />
            <path d="M7 8l9-3v14l-9-3z" />
            <path d="M9.5 16.8l-2.5 4a2 2 0 0 0 3.5 1l2-4" />
            <path d="M19 8l1.5-1.5" />
            <path d="M20 12h2" />
            <path d="M19 16l1.5 1.5" />
        </svg>
        <span>My Ads</span>
    </a>
    <a href="{{ route('account') }}" class="nav-item" aria-label="Account">
        <i class="fa-regular fa-user"></i>
        <span>Account</span>
    </a>
</div>

<!-- ACCOUNT SLIDE-OUT MENU -->
<div id="accountNavDrawer" class="account-nav-drawer">
    <div class="account-nav-header">
        <div class="account-nav-user">
            <div class="account-nav-avatar">
                <img src="{{ asset('images/avatar-placeholder.jpg') }}" alt="Ahmed Khan" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="account-avatar-fallback"><img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="User" style="width:100%;height:100%;border-radius:50%;object-fit:cover;"></div>
            </div>
            <div class="account-nav-info">
                <h3 class="account-nav-name">Ahmed Khan</h3>
                <a href="#profile" class="account-nav-link">View Public Profile <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
    <div class="account-nav-body">
        <h4 class="account-nav-section-title">Personal</h4>
        <ul class="account-nav-list">
            <li>
                <a href="#my-account">
                    <div class="list-left"><i class="fa-solid fa-border-all"></i> <span>My Account</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="#favourites">
                    <div class="list-left"><i class="fa-regular fa-heart"></i> <span>Favourites</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="#notifications">
                    <div class="list-left"><i class="fa-regular fa-bell"></i> <span>Notifications</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="#settings">
                    <div class="list-left"><i class="fa-regular fa-user"></i> <span>Profile Settings</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li class="logout-item">
                <a href="#logout" class="logout-link">
                    <div class="list-left"><i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Logout</span></div>
                </a>
            </li>
        </ul>
    </div>
</div>
