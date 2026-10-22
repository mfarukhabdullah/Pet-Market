<!-- HEADER COMPONENT -->
@php
    $currentUrl = request()->fullUrl();
    if (request()->is('login') || request()->is('sign') || request()->is('register')) {
        $loginUrl = route('login') . (request()->has('redirect') ? '?redirect=' . urlencode(request()->get('redirect')) : '');
        $signUrl = route('sign') . (request()->has('redirect') ? '?redirect=' . urlencode(request()->get('redirect')) : '');
    } else {
        $loginUrl = route('login') . '?redirect=' . urlencode($currentUrl);
        $signUrl = route('sign') . '?redirect=' . urlencode($currentUrl);
    }
@endphp
<!-- Top Green Notice Bar (#0C5E3A - Full Screen Width Background) -->
<div class="header-top-bar">
    <div class="shell-1440">
        <div class="container">
            <div class="header-top-content">
                <div class="top-notice-left">
                    <img src="{{ asset('images/header-icon.svg') }}" alt="Header Icon" class="top-notice-header-icon">
                    {{-- USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao" --}}
                    <span>{{ \App\Models\SiteSetting::get('site_top_notice', 'Buy responsibly. Verify the animal and seller before completing a transaction.') }}</span>
                </div>
                <div class="top-notice-right">
                    {{-- USER PROMPT: "phir ya q a rha hai" --}}
                    <a href="{{ route('about') }}" class="safety-guide-link">Safety Guide</a>
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
                    <a href="{{ route('featured.pets') }}" class="header-nav-item">Featured Pets</a>
                    <a href="{{ route('category') }}" class="header-nav-item">Categories</a>
                    <a href="{{ route('breeds') }}" class="header-nav-item">Breeds</a>
                    <a href="{{ route('about') }}" class="header-nav-item">About Us</a>
                </nav>

                <!-- Action Buttons & Mobile Controls -->
                <div class="header-action-btns">
                    @if(auth()->check())
                        <style>
                            .user-profile-dropdown .dd-icon {
                                width: 20px;
                                height: 20px;
                                min-width: 20px;
                                min-height: 20px;
                                display: inline-block;
                                flex-shrink: 0;
                                background-color: var(--text-dark, #17211C);
                                -webkit-mask-size: contain;
                                mask-size: contain;
                                -webkit-mask-repeat: no-repeat;
                                mask-repeat: no-repeat;
                                -webkit-mask-position: center;
                                mask-position: center;
                                vertical-align: middle;
                                transition: background-color 0.2s ease;
                            }
                            .user-profile-dropdown .dropdown-item:hover .dd-icon,
                            .user-profile-dropdown .dropdown-item.active .dd-icon {
                                background-color: var(--primary-green, #147A4D);
                            }
                            .user-profile-dropdown .icon-dash-dd {
                                -webkit-mask-image: url('{{ asset('images/dash-icon.svg') }}');
                                mask-image: url('{{ asset('images/dash-icon.svg') }}');
                            }
                            .user-profile-dropdown .icon-list-dd {
                                -webkit-mask-image: url('{{ asset('images/list-icon.svg') }}');
                                mask-image: url('{{ asset('images/list-icon.svg') }}');
                            }
                            .user-profile-dropdown .icon-msg-dd {
                                -webkit-mask-image: url('{{ asset('images/messages-icon.svg') }}');
                                mask-image: url('{{ asset('images/messages-icon.svg') }}');
                            }
                            .user-profile-dropdown .icon-fav-dd {
                                -webkit-mask-image: url('{{ asset('images/heart-icon.svg') }}');
                                mask-image: url('{{ asset('images/heart-icon.svg') }}');
                            }
                            .user-profile-dropdown .icon-notif-dd {
                                -webkit-mask-image: url('{{ asset('images/ps-bell.svg') }}');
                                mask-image: url('{{ asset('images/ps-bell.svg') }}');
                            }
                            .user-profile-dropdown .icon-ps-dd {
                                -webkit-mask-image: url('{{ asset('images/profile-setting-user-icon.svg') }}');
                                mask-image: url('{{ asset('images/profile-setting-user-icon.svg') }}');
                            }
                            {{-- USER PROMPT: "yr errow move ni kr rha hai" --}}
                            .user-profile-dropdown .profile-toggle-btn i {
                                display: inline-block;
                                transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s ease;
                            }
                            .user-profile-dropdown:hover .profile-toggle-btn i,
                            .user-profile-dropdown.open .profile-toggle-btn i,
                            .user-profile-dropdown .profile-toggle-btn.active i,
                            .user-profile-dropdown:has(.profile-dropdown-menu.show) .profile-toggle-btn i {
                                transform: rotate(180deg);
                                color: var(--primary-green, #147A4D);
                            }
                        </style>
                        <div class="user-profile-dropdown">
                            <button class="profile-toggle-btn" id="profileDropdownBtn">
                                <img src="{{ auth()->user()->avatar_url }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=147A4D&color=fff'" alt="{{ auth()->user()->name ?? 'Profile' }}" class="header-avatar">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="profile-dropdown-menu" id="profileDropdownMenu">
                                <a href="{{ route('seller.profile') }}" class="dropdown-user-info">
                                    <img src="{{ auth()->user()->avatar_url }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=147A4D&color=fff'" alt="{{ auth()->user()->name ?? 'User' }}" class="dropdown-user-avatar">
                                    <div class="dropdown-user-details">
                                        <div class="dropdown-user-name">{{ auth()->user()->name ?? 'My Profile' }}</div>
                                        <div class="dropdown-user-role">View Public Profile <i class="fa-solid fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i></div>
                                    </div>
                                </a>
                                
                                <div class="dropdown-divider"></div>

                                {{-- USER PROMPT: "yr ya drop down bohot bara hai or nichay sy cut ho rha hai is ko sai kro" --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item" style="color: #147A4D; font-weight: 700;">
                                        <i class="fa-solid fa-shield-cat" style="width:18px; font-size:15px; text-align:center;"></i> Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="dropdown-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><span class="dd-icon icon-dash-dd"></span> Dashboard</a>
                                <a href="{{ route('seller.listings') }}" class="dropdown-item {{ request()->routeIs('seller.listings') ? 'active' : '' }}"><span class="dd-icon icon-list-dd"></span> My Listings</a>
                                <a href="{{ route('seller.messages') }}" class="dropdown-item {{ request()->routeIs('seller.messages') ? 'active' : '' }}"><span class="dd-icon icon-msg-dd"></span> Messages</a>
                                <a href="{{ route('favorites') }}" class="dropdown-item {{ request()->routeIs('favorites') ? 'active' : '' }}"><span class="dd-icon icon-fav-dd"></span> Favorites</a>
                                <a href="{{ route('notifications') }}" class="dropdown-item {{ request()->routeIs('notifications') ? 'active' : '' }}"><span class="dd-icon icon-notif-dd"></span> Notifications</a>
                                <a href="{{ route('seller.settings') }}" class="dropdown-item {{ request()->routeIs('seller.settings*') ? 'active' : '' }}"><span class="dd-icon icon-ps-dd"></span> Profile Settings</a>
                                
                                <a href="{{ route('logout') }}" class="dropdown-item">
                                    <i class="fa-solid fa-arrow-right-from-bracket" style="width:18px; font-size:15px; text-align:center;"></i> Log Out
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="btn-login-register" style="display: flex; align-items: center; justify-content: center; gap: 4px; cursor: default;">
                            <a href="{{ $loginUrl }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='#147A4D'" onmouseout="this.style.color='inherit'">Login</a>
                            <span>/</span>
                            <a href="{{ $signUrl }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='#147A4D'" onmouseout="this.style.color='inherit'">Register</a>
                        </div>
                    @endif
                    @if(auth()->check())
                        <a href="{{ route('seller.create-listing') }}" class="btn-sell-pet">Sell a Pet</a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('seller.create-listing')) }}" class="btn-sell-pet">Sell a Pet</a>
                    @endif
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
            <li><a href="{{ route('featured.pets') }}">Featured Pets</a></li>
            <li><a href="{{ route('category') }}">Categories</a></li>
            <li><a href="{{ route('breeds') }}">Breeds</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
        </ul>
    </div>
    <div style="margin-top:32px;">
        @if(auth()->check())
            <a href="{{ route('seller.create-listing') }}" class="btn-sell-pet" style="width:100%; margin-bottom:12px; justify-content:center;">Sell a Pet</a>
            {{-- USER PROMPT: "in mobile view just change this 'My Account' to my dashboard just change this text" --}}
            <a href="{{ route('dashboard') }}" class="btn-login-register" style="width:100%; justify-content:center; background-color:#eaf7f0; color:#147A4D; border:none;"><i class="fa-solid fa-user" style="margin-right:8px;"></i> My Dashboard</a>
            <a href="{{ route('logout') }}" class="btn-login-register text-danger" style="width:100%; justify-content:center; margin-top:12px; border:none;"><i class="fa-solid fa-arrow-right-from-bracket" style="margin-right:8px;"></i> Log Out</a>
        @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('seller.create-listing')) }}" class="btn-sell-pet" style="width:100%; margin-bottom:12px; justify-content:center;">Sell a Pet</a>
            <div class="btn-login-register" style="width:100%; display: flex; align-items: center; justify-content: center; gap: 4px; cursor: default;">
                <a href="{{ $loginUrl }}" style="color: inherit; text-decoration: none;">Login</a>
                <span>/</span>
                <a href="{{ $signUrl }}" style="color: inherit; text-decoration: none;">Register</a>
            </div>
        @endif
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
        <a href="{{ route('seller.create-listing') }}" class="nav-fab">
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
    @if(auth()->check())
    <div class="account-nav-header">
        <div class="account-nav-user">
            <div class="account-nav-avatar">
                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=147A4D&color=fff'">
            </div>
            <div class="account-nav-info">
                <h3 class="account-nav-name">{{ auth()->user()->name }}</h3>
                <a href="{{ route('seller.profile') }}" class="account-nav-link">View Public Profile <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
    <div class="account-nav-body">
        <h4 class="account-nav-section-title">Personal</h4>
        <ul class="account-nav-list">
            {{-- USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao" --}}
            @if(auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" style="color: #147A4D; font-weight: 700;">
                    <div class="list-left"><i class="fa-solid fa-shield-cat"></i> <span>Admin Panel</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            @endif
            {{-- USER PROMPT: "in mobile view just change this 'My Account' to my dashboard just change this text" --}}
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="list-left"><i class="fa-solid fa-border-all"></i> <span>My Dashboard</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('favorites') }}">
                    <div class="list-left"><i class="fa-regular fa-heart"></i> <span>Favourites</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('notifications') }}">
                    <div class="list-left"><i class="fa-regular fa-bell"></i> <span>Notifications</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('seller.settings') }}">
                    <div class="list-left"><i class="fa-regular fa-user"></i> <span>Profile Settings</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li class="logout-item">
                <a href="{{ route('logout') }}" class="logout-link">
                    <div class="list-left"><i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Logout</span></div>
                </a>
            </li>
        </ul>
    </div>
    @else
    <div class="account-nav-header">
        <div class="account-nav-user">
            <div class="account-nav-info">
                <h3 class="account-nav-name">Guest User</h3>
                <p style="font-size: 13px; color: #64748B; margin: 4px 0 0 0;">Please login to access your account</p>
            </div>
        </div>
    </div>
    <div class="account-nav-body">
        <ul class="account-nav-list">
            <li>
                <a href="{{ $loginUrl }}">
                    <div class="list-left"><i class="fa-solid fa-right-to-bracket"></i> <span>Login</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ $signUrl }}">
                    <div class="list-left"><i class="fa-solid fa-user-plus"></i> <span>Register</span></div>
                    <i class="fa-solid fa-chevron-right list-arrow"></i>
                </a>
            </li>
        </ul>
    </div>
    @endif
</div>


