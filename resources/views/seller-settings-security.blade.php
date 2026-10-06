<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Settings - Pet Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            height: 100vh;
            overflow: hidden;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            flex-grow: 1;
            max-width: 1200px;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Welcome Banner */
        .welcome-banner {
            background-color: var(--primary-green);
            color: white;
            border-radius: 16px;
            padding: 24px 32px;
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
            width: 20px;
            height: 20px;
        }

        /* Settings Card */
        .settings-card {
            flex-grow: 1;
            min-height: 0;
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
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-shrink: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
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
            overflow-y: auto;
            padding: 32px 40px;
        }

        .content-header {
            margin-bottom: 24px;
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
            margin-bottom: 32px;
        }

        /* Security Cards */
        .sec-card {
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .sec-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
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
            padding: 16px 0;
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
        }

        .login-table th {
            text-align: left;
            font-size: 12px;
            color: var(--text-gray);
            font-weight: 600;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .login-table td {
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .login-table tr:last-child td {
            border-bottom: none;
        }

        .device-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .device-icon {
            color: var(--primary-green);
            display: flex;
            align-items: center;
        }

        .device-icon svg {
            width: 20px;
            height: 20px;
        }

        .text-current {
            color: var(--primary-green);
            font-weight: 600;
        }

        /* Alert Box */
        .alert-box {
            background-color: #fef3c7;
            color: #b45309;
            padding: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            margin-top: 16px;
            font-weight: 500;
        }

        .alert-box svg {
            width: 20px;
            height: 20px;
            color: #d97706;
        }

    </style>
</head>
<body>

    <x-dashboard-sidebar />

    <!-- Main Content -->
    <main class="main-content">
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
                    Contact & Location
                </a>
                <a href="{{ route('seller.settings.security') }}" class="menu-item {{ Route::is('seller.settings.security') ? 'active' : '' }}">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-sec.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-sec.svg') }}');"></div>
                    Security
                </a>
                <a href="#" class="menu-item">
                    <div class="menu-icon" style="mask-image: url('{{ asset('images/ps-bell.svg') }}'); -webkit-mask-image: url('{{ asset('images/ps-bell.svg') }}');"></div>
                    Notifications
                </a>
                <a href="#" class="menu-item">
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
                        <button class="btn-green">Change Password</button>
                    </div>
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
                <div class="sec-card">
                    <div class="sec-card-header" style="margin-bottom: 16px;">
                        <div class="sec-card-title">
                            <h3>Recent Login Activity</h3>
                            <p>Review recent sign-ins and flag activity you do not recognize.</p>
                        </div>
                    </div>
                    <table class="login-table">
                        <thead>
                            <tr>
                                <th>DEVICE</th>
                                <th>LOCATION</th>
                                <th>TIME</th>
                                <th>STATUS</th>
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
                                            <h4 style="font-size: 14px;">Chrome on Windows</h4>
                                            <p style="font-size: 13px;">Current device</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Lahore</td>
                                <td>Today, 10:32 AM</td>
                                <td class="text-current">Current</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="device-info">
                                        <div class="device-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                                        </div>
                                        <div class="sec-text">
                                            <h4 style="font-size: 14px;">Chrome on Android</h4>
                                            <p style="font-size: 13px;">Mobile</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Lahore</td>
                                <td>Yesterday, 8:14 PM</td>
                                <td><button class="btn-outline" style="padding: 6px 12px;">Not Me</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="alert-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        If you do not recognize a login, change your password and follow the account recovery/security flow.
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>
