<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Settings - Pet Marketplace</title>
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
            --light-yellow: #fff8e1;
            --text-orange: #b7791f;
            --light-orange: #fef08a;
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
            min-width: 0;
            padding: 24px 32px;
        }

        .content-header {
            margin-bottom: 16px;
        }

        .content-header h2 {
            font-size: 24px;
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

        /* Security Cards */
        .sec-card {
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .sec-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .sec-card-title h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .sec-card-title p {
            font-size: 14px;
            color: var(--text-gray);
        }

        .btn-green {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-green:hover {
            background-color: #0f764a;
        }

        .btn-outline {
            background-color: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-outline:hover {
            background-color: #f3f4f6;
        }

        /* Rows */
        .sec-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
        }

        .sec-row.border-top {
            border-top: 1px solid var(--border-color);
        }

        .sec-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            background-color: var(--light-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
        }

        .icon-circle svg {
            width: 24px;
            height: 24px;
        }

        .sec-text h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .sec-text p {
            font-size: 13px;
            color: var(--text-gray);
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-active {
            background-color: var(--light-green);
            color: var(--primary-green);
        }

        .badge-verified {
            background-color: var(--light-green);
            color: var(--primary-green);
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #d97706;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Table */
        .login-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .login-table th {
            text-align: left;
            font-size: 13px;
            color: var(--text-gray);
            font-weight: 600;
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .login-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 15px;
            color: var(--text-gray);
        }

        .login-table tr:last-child td {
            border-bottom: none;
        }

        .device-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .device-icon {
            color: var(--primary-green);
            display: flex;
            align-items: center;
        }

        .device-icon svg {
            width: 24px;
            height: 24px;
        }

        .text-current {
            color: var(--primary-green);
            font-weight: 600;
        }

        /* Alert Box */
        .alert-box {
            background-color: #fffbeb;
            color: #b45309;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .alert-box svg {
            width: 20px;
            height: 20px;
            color: #d97706;
            flex-shrink: 0;
        }

        /* Form Styles for Password */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #000;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon input {
            width: 100%;
            padding: 12px 16px;
            padding-right: 48px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
        }

        .input-with-icon input:focus {
            border-color: var(--primary-green);
        }

        .input-with-icon svg {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: var(--primary-green);
            cursor: pointer;
        }

        .form-actions-right {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
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
            .menu-item.active {
                background-color: #eaf7f0;
                border-color: #eaf7f0;
                color: var(--primary-green);
            }
            .hide-on-mobile { display: none; }
            
            .settings-content {
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 16px;
                padding: 24px 16px;
            }

            .sec-card {
                padding: 16px;
            }
            
            .sec-card-header {
                align-items: center;
                gap: 12px;
            }
            
            .sec-card-title {
                flex: 1;
            }
            
            .sec-card-title h3 {
                font-size: 16px;
            }
            
            .sec-card-title p {
                font-size: 12px;
                line-height: 1.4;
            }
            
            .btn-green {
                font-size: 13px;
                padding: 8px 12px;
                white-space: nowrap;
            }
            
            .icon-circle {
                border-radius: 12px;
                width: 44px;
                height: 44px;
                flex-shrink: 0;
            }
            
            .sec-row {
                padding: 16px 0;
            }

            .sec-info {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .sec-info .sec-text h4 {
                font-size: 14px;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 2px;
            }
            
            .sec-info .sec-text p {
                font-size: 13px;
                color: #6b7280;
            }

            .badge {
                font-size: 12px;
                padding: 6px 12px;
                font-weight: 700;
                text-align: center;
            }
            
            .action-group {
                flex-direction: column;
                gap: 8px;
                align-items: stretch;
            }

            .btn-outline {
                font-size: 12px;
                font-weight: 700;
                padding: 6px 0;
                text-align: center;
                border-radius: 8px;
                color: #1f2937;
            }

            .login-table th, .login-table td {
                padding: 12px 6px;
                font-size: 7px;
                color: #111827;
            }
            .login-table th { 
                font-size: 7px; 
                color: #6b7280;
                font-weight: 600;
                padding: 10px 6px;
            }
            .device-name-text {
                font-size: 11px !important;
            }
            .device-sub-text {
                font-size: 7px !important;
            }
            .text-current {
                font-size: 10px !important;
            }
            .btn-not-me {
                font-size: 10px !important;
            }
            .device-icon svg { width: 20px; height: 20px; stroke-width: 2; }
            .device-info { gap: 3px; align-items: flex-start; }
            
            /* Password Form Mobile Overrides */
            #password-form-view .input-with-icon input {
                border-radius: 12px;
                padding: 14px 16px;
                padding-right: 48px;
            }
            #password-form-view .form-actions-right {
                display: flex;
                flex-direction: row;
                gap: 12px;
                width: 100%;
                margin-top: 24px;
            }
            #password-form-view .form-actions-right button {
                flex: 1;
                padding: 14px 0;
                font-size: 15px;
                font-weight: 700;
                border-radius: 12px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #password-form-view .form-actions-right .btn-outline {
                color: #000 !important;
                border: 1px solid #000 !important;
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
                    <h2>Security</h2>
                    <p>Manage password and basic account security.</p>
                </div>
                <div class="divider"></div>

                <!-- Password Card -->
                <div class="sec-card">
                    <div class="sec-card-header">
                        <div class="sec-card-title">
                            <h3>Password</h3>
                            <p>Keep your account secure with a strong password.</p>
                        </div>
                        <button class="btn-green" id="btn-change-password-toggle">Change Password</button>
                    </div>

                    <!-- Default View -->
                    <div id="password-default-view">
                        <div class="sec-row border-top">
                            <div class="sec-info">
                                <div class="icon-circle">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </div>
                                <div class="sec-text">
                                    <h4>Account Password</h4>
                                    <p>Last changed 3 months ago</p>
                                </div>
                            </div>
                            <div class="badge badge-active">Active</div>
                        </div>
                    </div>

                    <!-- Form View -->
                    <div id="password-form-view" style="display: none; padding-top: 16px;">
                        <div class="form-group">
                            <label>Current Password</label>
                            <div class="input-with-icon">
                                <input type="password">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="input-with-icon">
                                <input type="password">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <div class="input-with-icon">
                                <input type="password">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                        </div>
                        <div class="form-actions-right">
                            <button type="button" class="btn-outline" id="btn-cancel-password" style="color: #1f2937; border-color: #1f2937;">Cancel</button>
                            <button type="button" class="btn-green">Update Password</button>
                        </div>
                    </div>
                </div>

                <!-- Email & Phone Verification Card -->
                <div class="sec-card">
                    <div class="sec-card-header">
                        <div class="sec-card-title">
                            <h3>Email & Phone Verification</h3>
                            <p>Confirm the contact details linked with your account.</p>
                        </div>
                    </div>
                    <div class="sec-row border-top">
                        <div class="sec-info">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <div class="sec-text">
                                <h4>Email Address</h4>
                                <p>ahmed@example.com</p>
                            </div>
                        </div>
                        <div class="badge badge-verified">Verified</div>
                    </div>
                    <div class="sec-row border-top">
                        <div class="sec-info">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <div class="sec-text">
                                <h4>Phone Number</h4>
                                <p>+92 300 1234567</p>
                            </div>
                        </div>
                        <div class="action-group">
                            <div class="badge badge-warning">Not Verified</div>
                            <button class="btn-outline">Verify</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Login Activity Card -->
                <div class="sec-card" style="margin-top: 32px;">
                    <div class="sec-card-header" style="margin-bottom: 20px;">
                        <div class="sec-card-title">
                            <h3 style="font-size: 22px; font-weight: 600; color: var(--text-dark); margin-bottom: 4px;">Recent Login Activity</h3>
                            <p style="font-size: 15px; color: var(--text-gray);">Review recent sign-ins and flag activity you do not recognize.</p>
                        </div>
                    </div>

                    <div style="border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; margin-bottom: 24px; background: white;">
                        <table class="login-table">
                            <thead style="background-color: #f9fafb;">
                                <tr>
                                    <th>DEVICE</th>
                                    <th>LOCATION</th>
                                    <th>TIME</th>
                                    <th style="text-align: right;">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="device-info">
                                            <div class="device-icon">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                            </div>
                                            <div class="sec-text">
                                                <h4 class="device-name-text" style="font-size: 16px; font-weight: 600; color: var(--text-dark); white-space: normal;">Chrome on Windows</h4>
                                                <p class="device-sub-text" style="font-size: 14px; color: var(--text-gray); margin-top: 2px;">Current device</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Lahore</td>
                                    <td>Today,<br>10:32 AM</td>
                                    <td class="text-current" style="text-align: right; font-size: 15px; color: var(--primary-green); font-weight: 600;">Current</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="device-info">
                                            <div class="device-icon">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                                            </div>
                                            <div class="sec-text">
                                                <h4 class="device-name-text" style="font-size: 16px; font-weight: 600; color: var(--text-dark); white-space: normal;">Chrome on Android</h4>
                                                <p class="device-sub-text" style="font-size: 14px; color: var(--text-gray); margin-top: 2px;">Mobile</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Lahore</td>
                                    <td>Yesterday,<br>10:32 AM</td>
                                    <td style="text-align: right;">
                                        <button class="btn-not-me" style="padding: 0; background: transparent; border: none; font-weight: 700; color: #1f2937; white-space: nowrap; font-size: 14px; cursor: pointer;">Not Me</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="alert-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        If you do not recognize a login, change your password and follow the account recovery/security flow.
                    </div>
                </div>

            </div>

        </div>
    </main></div></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnChangePassword = document.getElementById('btn-change-password-toggle');
            const btnCancelPassword = document.getElementById('btn-cancel-password');
            const passwordDefaultView = document.getElementById('password-default-view');
            const passwordFormView = document.getElementById('password-form-view');

            btnChangePassword.addEventListener('click', function() {
                passwordDefaultView.style.display = 'none';
                btnChangePassword.style.display = 'none';
                passwordFormView.style.display = 'block';
            });

            btnCancelPassword.addEventListener('click', function() {
                passwordFormView.style.display = 'none';
                passwordDefaultView.style.display = 'block';
                btnChangePassword.style.display = 'block';
            });
        });
    </script>
    <x-footer />
</body>
</html>
