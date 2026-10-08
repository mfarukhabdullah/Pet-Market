<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Preferences - Pet Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Additional Fonts for Header/Footer -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS for Header/Footer -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        :root {
            --primary-green: #128c5a;
            --bg-color: #f7f9f8;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --border-color: #e5e7eb;
            --light-green: #e8f5e9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main Content */
        .main-content { width: 100%; flex-grow: 1; min-height: 100vh; display: flex; flex-direction: column; padding: 24px 0; }

        /* Welcome Banner */
        .welcome-banner {
            background-color: var(--primary-green);
            color: white;
            border-radius: 16px;
            padding: 24px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-shrink: 0;
        }

        .welcome-text h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            color: white;
        }

        .welcome-text p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-notification {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s;
        }

        .btn-notification:hover {
            opacity: 0.8;
        }

        .btn-notification svg {
            width: 32px;
            height: 32px;
        }

        /* Settings Card */
        .settings-card {
            flex-grow: 1;
            display: flex;
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        /* Settings Menu */
        .settings-menu {
            width: 260px;
            border-right: 1px solid var(--border-color);
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-shrink: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 16px;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .menu-item.active {
            background-color: var(--light-green);
            color: var(--primary-green);
        }

        .menu-item:hover {
            background-color: #f3f4f6;
            color: var(--primary-green);
        }

        .menu-icon {
            width: 18px;
            height: 18px;
            background-color: currentColor;
            mask-size: contain;
            mask-repeat: no-repeat;
            mask-position: center;
            -webkit-mask-size: contain;
            -webkit-mask-repeat: no-repeat;
            -webkit-mask-position: center;
        }

        /* Settings Content */
        .settings-content {
            flex-grow: 1;
            padding: 20px 32px;
        }

        .content-header {
            margin-bottom: 12px;
        }

        .content-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .content-header p {
            font-size: 15px;
            color: var(--text-gray);
        }

        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin-bottom: 12px;
        }

        /* Notification Rows */
        .notif-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .notif-row:last-child {
            border-bottom: none;
        }

        .notif-info h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .notif-info p {
            font-size: 15px;
            color: var(--text-gray);
        }

        /* Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        input:checked + .slider {
            background-color: var(--primary-green);
        }

        input:checked + .slider:before {
            transform: translateX(22px);
        }
        @media (max-width: 768px) {
            .welcome-banner {
                padding: 24px 20px;
                border-radius: 12px;
                flex-direction: column;
                align-items: flex-start;
            }
            .welcome-text h1 { font-size: 22px; }
            .welcome-text p { font-size: 14px; }
            .btn-notification { display: none; }
            
            .settings-card {
                flex-direction: column;
                background: transparent;
                border: none;
                overflow: visible;
                padding: 0;
            }
            
            .settings-menu {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 0;
                border-right: none;
                border-bottom: none;
                margin-bottom: 24px;
                padding-bottom: 8px;
                gap: 12px;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .settings-menu::-webkit-scrollbar {
                display: none;
            }
            
            .menu-item {
                flex-direction: column;
                margin: 0;
                padding: 0;
                width: 108px;
                height: 68px;
                flex-shrink: 0;
                background-color: white;
                border-radius: 12px;
                gap: 8px;
                justify-content: center;
                align-items: center;
                border: 1px solid var(--border-color);
            }
            .menu-item.active {
                background-color: #eaf7f0;
                border-color: #eaf7f0;
                color: var(--primary-green);
            }
            
            .settings-content {
                padding: 16px;
                background: white;
                border-radius: 16px;
                border: 1px solid var(--border-color);
            }

            .hide-on-mobile {
                display: none !important;
            }

            .content-header h2 {
                font-size: 18px;
            }
            
            .content-header p {
                font-size: 13px;
                margin-bottom: 16px;
            }

            .notif-row {
                padding: 16px 0;
            }

            .notif-info h3 {
                font-size: 14px;
                font-weight: 700;
                color: #111827;
            }

            .notif-info p {
                font-size: 12px;
                color: #6b7280;
                margin-top: 4px;
                line-height: 1.4;
                padding-right: 12px;
            }

            .switch {
                transform: scale(0.8);
                transform-origin: right center;
            }
        }
    </style>
</head>
<body>

    <x-header />

    <!-- Main Content -->
    <div class="shell-1440" style="margin: 0 auto; width: 100%; flex-grow: 1; display: flex; flex-direction: column;"><div class="container" style="flex-grow: 1; display: flex; flex-direction: column;"><main class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Profile Settings</h1>
                <p>Manage your seller profile, contact details, security and account preferences.</p>
            </div>
            <button class="btn-notification">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </button>
        </div>

        <!-- Settings Card -->
        <div class="settings-card">
            
            <!-- Left Menu -->
            <div class="settings-menu">
                <a href="{{ route('seller.settings') }}" class="menu-item {{ Route::is('seller.settings') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/profile-setting-user-icon.svg') }}'); -webkit-mask-image: url('{{ asset('images/profile-setting-user-icon.svg') }}');"></div>
                    Profile
                </a>
                <a href="{{ route('seller.settings.contact') }}" class="menu-item {{ Route::is('seller.settings.contact') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-con-icon.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-con-icon.svg') }}');"></div>
                    Contact<span class="hide-on-mobile"> & Location</span>
                </a>
                <a href="{{ route('seller.settings.security') }}" class="menu-item {{ Route::is('seller.settings.security') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-sec.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-sec.svg') }}');"></div>
                    Security
                </a>
                <a href="{{ route('seller.settings.notifications') }}" class="menu-item {{ Route::is('seller.settings.notifications') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-bell.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-bell.svg') }}');"></div>
                    Notifications
                </a>
                <a href="{{ route('seller.settings.account') }}" class="menu-item {{ Route::is('seller.settings.account') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-set.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-set.svg') }}');"></div>
                    Account
                </a>
            </div>

            <!-- Right Content -->
            <div class="settings-content">
                <div class="content-header">
                    <h2>Notification Preferences</h2>
                    <p>Choose how you receive marketplace updates.</p>
                </div>
                <div class="divider"></div>

                <div class="notif-row">
                    <div class="notif-info">
                        <h3>New Buyer Inquiry</h3>
                        <p>Notify me when a buyer messages about a listing.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="notif-row">
                    <div class="notif-info">
                        <h3>Listing Status Updates</h3>
                        <p>Notify me when a listing is approved, rejected or removed.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="notif-row">
                    <div class="notif-info">
                        <h3>Email Notifications</h3>
                        <p>Receive supported updates by email.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="notif-row">
                    <div class="notif-info">
                        <h3>SMS Notifications</h3>
                        <p>Optional if SMS notifications are enabled.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>
        </div>
    </main></div></div>

    <x-footer />
</body>
</html>
