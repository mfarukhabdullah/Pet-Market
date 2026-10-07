<style>
    /* Sidebar */
    .sidebar {
        width: 280px;
        background-color: #128c5a;
        color: white;
        display: flex;
        flex-direction: column;
        padding: 24px;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 100;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 23px;
        font-weight: 700;
        padding-bottom: 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 24px;
    }

    .brand img {
        width: 32px;
        height: 32px;
    }

    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex-grow: 1;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.2s;
        font-weight: 500;
    }

    .nav-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .nav-item.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .nav-item img {
        width: 20px;
        height: 20px;
        opacity: 0.8;
    }
    
    .nav-item:hover img,
    .nav-item.active img {
        opacity: 1;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: auto;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        overflow: hidden;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 14px;
    }

    .user-role {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }
</style>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/dashboard-paw.svg') }}" alt="Pet Marketplace">
        Pet Marketplace
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <img src="{{ asset('images/dash-icon.svg') }}" alt="Dashboard">
            Dashboard
        </a>
        <a href="{{ route('seller.listings') }}" class="nav-item {{ Route::is('seller.listings') ? 'active' : '' }}">
            <img src="{{ asset('images/list-icon.svg') }}" alt="My Listings">
            My Listings
        </a>
        <a href="{{ route('seller.messages') }}" class="nav-item {{ Route::is('seller.messages') ? 'active' : '' }}">
            <img src="{{ asset('images/messages-icon.svg') }}" alt="Messages">
            Messages
        </a>
        <a href="{{ route('seller.settings') }}" class="nav-item {{ Route::is('seller.settings') ? 'active' : '' }}">
            <img src="{{ asset('images/usericon.svg') }}" alt="Profile">
            Profile Settings
        </a>
    </nav>

    <div class="user-profile">
        <div class="avatar">
            <img src="{{ asset('images/seller-avatar.jpg') }}" alt="Ahmed" onerror="this.src='https://ui-avatars.com/api/?name=Ahmed&background=random'">
        </div>
        <div class="user-info">
            <span class="user-name">Ahmed</span>
            <span class="user-role">Seller Account</span>
        </div>
    </div>
</div>
