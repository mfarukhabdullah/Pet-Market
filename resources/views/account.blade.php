<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Account - Pet Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        .account-page-wrapper {
            background-color: #ffffff;
            min-height: calc(100vh - 120px);
            margin: 0 auto;
            max-width: 600px; /* limits width on desktop so it looks like mobile view */
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .account-nav-header {
            background-color: #147A4D;
            padding: 40px 24px 30px 24px;
        }

        .account-nav-user {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .account-nav-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #ffffff;
        }

        .account-nav-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .account-avatar-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0e0e0;
        }

        .account-nav-info {
            display: flex;
            flex-direction: column;
        }

        .account-nav-name {
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0 0 4px 0;
        }

        .account-nav-link {
            color: #ffffff;
            font-size: 0.85rem;
            text-decoration: underline;
            display: flex;
            align-items: center;
            gap: 4px;
            opacity: 0.9;
        }

        .account-nav-body {
            padding: 24px;
        }

        .account-nav-section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 16px;
            margin-top: 0;
        }

        .account-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .account-nav-list li {
            border-bottom: 1px solid #eeeeee;
        }

        .account-nav-list li.logout-item {
            border-bottom: none;
            margin-top: 16px;
        }

        .account-nav-list li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            color: #111111;
            text-decoration: none;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
        }

        .account-nav-list li a .list-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .account-nav-list li a .list-left i {
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
            color: #555555;
        }

        .account-nav-list li a .list-arrow {
            font-size: 0.85rem;
            color: #999999;
        }
    </style>
</head>
<body>
    <style>
        .account-page-wrapper {
            max-width: 480px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        @media (max-width: 768px) {
            .account-page-wrapper {
                margin: 0;
                border-radius: 0;
                box-shadow: none;
                max-width: 100%;
            }
        }
    </style>
    <!-- HEADER COMPONENT -->
    <x-header />

    <!-- PAGE BODY -->
    <div class="site-wrapper" style="background-color: #f8f9fa; padding: 20px 0;">
        <div class="account-page-wrapper">
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
    </div>

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>
