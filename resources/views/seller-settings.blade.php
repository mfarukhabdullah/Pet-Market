<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - Pet Marketplace</title>
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

        /* Cover and Profile Photos */
        .media-section {
            margin-bottom: 20px;
            position: relative;
        }

        .cover-photo-area {
            height: 96px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            background-color: #e5e7eb;
        }

        .cover-photo-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-upload-cover {
            position: absolute;
            right: 16px;
            bottom: 16px;
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .profile-photo-area {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 16px;
        }

        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            background-color: white;
        }

        .btn-change-photo {
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
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
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-green);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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
            }
            .welcome-text h1 {
                font-size: 22px;
            }
            .welcome-text p {
                font-size: 14px;
            }
            .btn-notification {
                display: none;
            }
            
            .settings-card {
                flex-direction: column;
                background: transparent;
                border: none;
            }
            
            .settings-menu {
                width: 100%;
                flex-direction: row;
                border-right: none;
                padding: 0 4px 4px 4px; /* Add slight padding for scroll visual */
                margin-bottom: 24px;
                overflow-x: auto;
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
            
            .cover-photo-area {
                width: 333px;
                max-width: 100%;
                height: 96px;
                border-radius: 20px;
                overflow: hidden;
                position: relative;
            }
            .cover-photo-area img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .btn-upload-cover {
                position: absolute;
                right: 12px;
                bottom: 12px;
                background: #ffffff;
                color: #111827;
                border: 1px solid rgba(0, 0, 0, 0.08);
                padding: 8px 16px;
                border-radius: 12px;
                font-size: 13px;
                font-weight: 600;
                box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            }
            
            .profile-photo-area {
                margin-top: 16px;
                padding-left: 0;
                display: flex;
                align-items: center;
                gap: 16px;
                z-index: 1;
                position: static;
            }
            .avatar-preview {
                width: 76px;
                height: 76px;
                border-radius: 50%;
                border: none;
                object-fit: cover;
                flex-shrink: 0;
            }
            .btn-change-photo {
                margin: 0;
                background: #ffffff;
                color: #111827;
                border: 1px solid #d0d5dd;
                border-radius: 12px;
                padding: 10px 20px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
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
                padding: 14px 0;
            }
        }
    </style>

</head>
<body>

    <x-header />

    <!-- Main Content -->
    <div class="shell-1440" style="flex-grow:1;"><div class="container"><main class="main-content">
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
                    <h2>Profile Information</h2>
                    <p>Update the public information shown on your seller profile.</p>
                </div>
                <div class="divider"></div>

                <div class="media-section">
                    <div class="cover-photo-area">
                        <img src="{{ asset('images/seller-profile-hero.jpg') }}" alt="Cover Photo" onerror="this.src='https://images.unsplash.com/photo-1544928147-79a2dbc1f389?auto=format&fit=crop&w=800&q=80'">
                        <button class="btn-upload-cover">Upload Cover</button>
                    </div>
                    <div class="profile-photo-area">
                        <img src="{{ asset('images/seller-avatar.jpg') }}" alt="Profile Photo" class="avatar-preview" onerror="this.src='https://ui-avatars.com/api/?name=Ahmed+Khan&background=random'">
                        <button class="btn-change-photo">Change Photo</button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="max-width: 350px; width: 100%;">
                        <label>Full Name</label>
                        <input type="text" class="form-control" value="Ahmed Khan">
                    </div>
                </div>

                <div class="form-group">
                    <label>About</label>
                    <textarea class="form-control">Pet owner based in Lahore. Buyers can review my active listings and contact me through the marketplace.</textarea>
                </div>

                <div class="form-actions">
                    <button class="btn-cancel">Cancel</button>
                    <button class="btn-save">Save Changes</button>
                </div>
            </div>

        </div>
    </main></div></div>

    <x-footer />
</body>
</html>
