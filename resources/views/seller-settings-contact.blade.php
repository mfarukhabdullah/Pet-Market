<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Location - Pet Marketplace</title>
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
            background-color: #e8f5e9;
            color: var(--primary-green);
        }

        .menu-item:hover {
            background-color: #f3f4f6;
            color: var(--primary-green);
        }
        
        .menu-item.active:hover {
            background-color: #e8f5e9;
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
            padding: 24px 32px;
        }

        .content-header {
            margin-bottom: 16px;
        }

        .content-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .content-header p {
            font-size: 14px;
            color: var(--text-gray);
        }

        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin-bottom: 20px;
        }

        /* Form Fields */
        .form-row {
            display: flex;
            gap: 24px;
            margin-bottom: 16px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-group p {
            font-size: 13px;
            color: var(--text-gray);
            margin-top: -4px;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--primary-green);
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Custom Dropdown */
        .custom-select-wrapper {
            position: relative;
            width: 100%;
            user-select: none;
        }

        .custom-select-trigger {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: #000;
            background: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .custom-select-wrapper.open .custom-select-trigger {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(18, 140, 90, 0.1);
        }

        .custom-select-trigger i {
            color: var(--text-gray);
            font-size: 12px;
            transition: transform 0.2s;
        }

        .custom-select-wrapper.open .custom-select-trigger i {
            transform: rotate(180deg);
        }

        .custom-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-top: 4px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s;
            overflow: hidden;
        }

        .custom-select-wrapper.open .custom-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .custom-option {
            padding: 12px 16px;
            font-size: 14px;
            color: #000;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 1px solid #f3f4f6;
        }

        .custom-option:last-child {
            border-bottom: none;
        }

        .custom-option:hover, .custom-option.selected {
            background-color: var(--primary-green);
            color: white;
        }

        /* Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 24px;
        }

        .btn-cancel {
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #f3f4f6;
        }

        .btn-save {
            background: var(--primary-green);
            color: white;
            border: 1px solid var(--primary-green);
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-save:hover {
            background: #0f764a;
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
            }
            
            .settings-menu {
                width: 100%;
                display: flex;
                flex-direction: row;
                border-right: none;
                padding: 0 4px 4px 4px;
                margin-bottom: 24px;
                overflow-x: auto;
                gap: 12px;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .settings-menu::-webkit-scrollbar { display: none; }
            
            .menu-item {
                display: flex;
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
            .hide-on-mobile { display: none; }
            .menu-item.active {
                background-color: #eaf7f0;
                border-color: #eaf7f0;
                color: var(--primary-green);
            }
            
            .settings-content {
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 16px;
                padding: 24px 16px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 16px;
            }
            
            .form-actions {
                flex-direction: row;
                gap: 12px;
                margin-top: 24px;
            }
            .btn-cancel, .btn-save {
                flex: 1;
                text-align: center;
                padding: 10px 0;
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
                    <h2>Contact & Location</h2>
                    <p>Manage your account contact information and general location.</p>
                </div>
                <div class="divider"></div>

                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Email</label>
                        <input type="email" class="form-control" value="example@gmail.com">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="0300000000">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>City</label>
                        <div class="custom-select-wrapper" id="citySelectWrapper">
                            <div class="custom-select-trigger" onclick="document.getElementById('citySelectWrapper').classList.toggle('open')">
                                <span id="selectedCity">Lahore</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="custom-options">
                                <div class="custom-option selected" onclick="selectCity('Lahore', this)">Lahore</div>
                                <div class="custom-option" onclick="selectCity('Karachi', this)">Karachi</div>
                                <div class="custom-option" onclick="selectCity('Islamabad', this)">Islamabad</div>
                            </div>
                            <input type="hidden" name="city" id="cityInput" value="Lahore">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Area</label>
                        <input type="text" class="form-control" value="Dha">
                    </div>
                </div>

                <div class="form-group">
                    <label>Contact Preference</label>
                    <p style="color: #000;">Choose how buyers should contact you. Marketplace Messages keeps your personal contact details private.</p>
                    <div class="custom-select-wrapper" id="contactPrefWrapper">
                        <div class="custom-select-trigger" onclick="document.getElementById('contactPrefWrapper').classList.toggle('open')">
                            <span id="selectedContactPref">Marketplace Messages</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option selected" onclick="selectPref('Marketplace Messages', this)">Marketplace Messages</div>
                            <div class="custom-option" onclick="selectPref('Direct Phone Call', this)">Direct Phone Call</div>
                            <div class="custom-option" onclick="selectPref('Email Only', this)">Email Only</div>
                        </div>
                        <input type="hidden" name="contact_preference" id="contactPrefInput" value="Marketplace Messages">
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn-cancel">Cancel</button>
                    <button class="btn-save">Save Changes</button>
                </div>
            </div>

        </div>
    </main></div></div>

    <x-footer />

    <script>
        function selectPref(value, element) {
            document.getElementById('selectedContactPref').innerText = value;
            document.getElementById('contactPrefInput').value = value;
            
            document.querySelectorAll('#contactPrefWrapper .custom-option').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
            
            document.getElementById('contactPrefWrapper').classList.remove('open');
        }

        function selectCity(value, element) {
            document.getElementById('selectedCity').innerText = value;
            document.getElementById('cityInput').value = value;
            
            document.querySelectorAll('#citySelectWrapper .custom-option').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
            
            document.getElementById('citySelectWrapper').classList.remove('open');
        }

        document.addEventListener('click', function(e) {
            const prefWrapper = document.getElementById('contactPrefWrapper');
            if (prefWrapper && !prefWrapper.contains(e.target)) {
                prefWrapper.classList.remove('open');
            }

            const cityWrapper = document.getElementById('citySelectWrapper');
            if (cityWrapper && !cityWrapper.contains(e.target)) {
                cityWrapper.classList.remove('open');
            }
        });
    </script>
</body>
</html>
