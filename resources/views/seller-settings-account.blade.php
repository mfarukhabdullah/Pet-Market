<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Pet Marketplace</title>
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
            --red-btn: #dc3545;
            --red-btn-hover: #c82333;
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
            min-height: 0;
            display: flex;
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: relative;
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
            font-size: 15px;
            color: var(--text-gray);
        }

        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin-bottom: 20px;
        }

        /* Account Cards */
        .acc-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px 24px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .acc-info h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .acc-info p {
            font-size: 15px;
            color: var(--text-gray);
        }

        .btn-outline-dark {
            background-color: white;
            color: #000;
            border: 1px solid #000;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            width: 160px;
        }

        .btn-outline-dark:hover {
            background-color: #f3f4f6;
        }

        .btn-red {
            background-color: #d1494e;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            width: 160px;
        }

        .btn-red:hover {
            background-color: #b5383d;
        }

        .btn-modal-red {
            background-color: #d1494e;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-modal-red:hover {
            background-color: #b5383d;
        }

        /* Modal */
        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-container {
            background-color: #d1d1d1;
            border-radius: 20px;
            padding: 32px;
            width: 90%;
            max-width: 560px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-title {
            font-size: 26px;
            font-weight: 700;
            color: #000;
            margin-bottom: 16px;
        }

        .modal-text {
            font-size: 18px;
            color: #1a1a1a;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
        }

        .btn-cancel {
            background-color: white;
            color: #000;
            border: 1px solid #777;
            padding: 12px 32px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background-color: #f3f4f6;
        }

        .btn-deactivate {
            background-color: #127546;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-deactivate:hover {
            background-color: #0e5b36;
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

            .divider { margin-bottom: 16px; }

            .acc-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 16px;
                gap: 16px;
            }

            .acc-info h3 {
                font-size: 14px;
                font-weight: 700;
                color: #111827;
            }

            .acc-info p {
                font-size: 12px;
                color: #6b7280;
                margin-top: 4px;
                line-height: 1.4;
            }

            .acc-card button {
                width: 100%;
                font-size: 13px;
                padding: 12px 0;
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
                    <h2>Account Settings</h2>
                    <p>Manage your account status.</p>
                </div>
                <div class="divider"></div>

                <div class="acc-card">
                    <div class="acc-info">
                        <h3>Deactivate Account</h3>
                        <p>Temporarily disable your account.</p>
                    </div>
                    <button class="btn-outline-dark" id="btn-trigger-deactivate">Deactivate</button>
                </div>

                <div class="acc-card">
                    <div class="acc-info">
                        <h3>Delete Account</h3>
                        <p>Permanently delete your account after confirmation.</p>
                    </div>
                    <button class="btn-red" id="btn-trigger-delete">Delete Account</button>
                </div>

            </div>

            <!-- Deactivate Modal -->
            <div class="modal-overlay" id="deactivate-modal">
                <div class="modal-container">
                    <h2 class="modal-title">Deactivate your account?</h2>
                    <p class="modal-text">Your seller profile and active marketplace activity will be temporarily unavailable. You can reactivate your account by signing in again.</p>
                    <div class="modal-actions">
                        <button class="btn-cancel" id="btn-cancel-deactivate">Cancel</button>
                        <button class="btn-deactivate">Deactivate Account</button>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal-overlay" id="delete-modal">
                <div class="modal-container">
                    <h2 class="modal-title">Delete your account permanently?</h2>
                    <p class="modal-text">This action may permanently remove your account. Review what happens to your listings, messages and profile data before continuing.</p>
                    <div class="modal-actions">
                        <button class="btn-cancel" id="btn-cancel-delete">Cancel</button>
                        <button class="btn-modal-red">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>

    </main></div></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnTriggerDeactivate = document.getElementById('btn-trigger-deactivate');
            const modalDeactivate = document.getElementById('deactivate-modal');
            const btnCancelDeactivate = document.getElementById('btn-cancel-deactivate');

            const btnTriggerDelete = document.getElementById('btn-trigger-delete');
            const modalDelete = document.getElementById('delete-modal');
            const btnCancelDelete = document.getElementById('btn-cancel-delete');

            // Deactivate Modal Logic
            btnTriggerDeactivate.addEventListener('click', function() {
                modalDeactivate.classList.add('active');
            });

            btnCancelDeactivate.addEventListener('click', function() {
                modalDeactivate.classList.remove('active');
            });

            modalDeactivate.addEventListener('click', function(e) {
                if(e.target === modalDeactivate) {
                    modalDeactivate.classList.remove('active');
                }
            });

            // Delete Modal Logic
            btnTriggerDelete.addEventListener('click', function() {
                modalDelete.classList.add('active');
            });

            btnCancelDelete.addEventListener('click', function() {
                modalDelete.classList.remove('active');
            });

            modalDelete.addEventListener('click', function(e) {
                if(e.target === modalDelete) {
                    modalDelete.classList.remove('active');
                }
            });
        });
    </script>
    <x-footer />
</body>
</html>
