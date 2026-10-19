<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Command Center | Pet Marketplace</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">

    <style>
        /* USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao" */
        :root {
            --admin-primary: #147A4D;
            --admin-primary-dark: #0D5C38;
            --admin-primary-light: #EAF7F0;
            --admin-bg: #F4F6F8;
            --admin-sidebar-bg: #0F172A;
            --admin-sidebar-hover: #1E293B;
            --admin-card-bg: #FFFFFF;
            --admin-text-main: #0F172A;
            --admin-text-muted: #64748B;
            --admin-border: #E2E8F0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--admin-bg);
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--admin-text-main);
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR NAVIGATION */
        .admin-sidebar {
            width: 270px;
            background: var(--admin-sidebar-bg);
            color: #F8FAFC;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.08);
        }

        .admin-sidebar-header {
            padding: 24px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .admin-logo-box {
            width: 42px;
            height: 42px;
            background: var(--admin-primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            box-shadow: 0 4px 12px rgba(20, 122, 77, 0.4);
        }

        .admin-logo-text h2 {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #FFFFFF;
        }

        .admin-logo-text span {
            font-size: 11px;
            color: #94A3B8;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .admin-nav-group-title {
            padding: 18px 24px 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748B;
        }

        .admin-nav {
            list-style: none;
            padding: 10px 14px;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .admin-nav-item a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-radius: 10px;
            color: #94A3B8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .admin-nav-item a .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-nav-item a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .admin-nav-item a:hover {
            background: var(--admin-sidebar-hover);
            color: #FFFFFF;
        }

        .admin-nav-item.active a {
            background: var(--admin-primary);
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(20, 122, 77, 0.35);
        }

        .nav-pill {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .nav-pill-alert {
            background: #EF4444;
            color: white;
        }

        .admin-sidebar-footer {
            margin-top: auto;
            padding: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-sidebar-viewsite {
            background: rgba(255, 255, 255, 0.08);
            color: #E2E8F0;
            text-align: center;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-sidebar-viewsite:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        /* MAIN CONTENT CONTAINER */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* TOP APP BAR */
        .admin-topbar {
            background: var(--admin-card-bg);
            border-bottom: 1px solid var(--admin-border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .admin-topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .mobile-toggle-btn {
            display: none;
            background: none;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 16px;
            cursor: pointer;
            color: var(--admin-text-main);
        }

        .admin-page-heading h1 {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--admin-text-main);
        }

        .admin-page-heading p {
            margin: 2px 0 0;
            font-size: 13px;
            color: var(--admin-text-muted);
        }

        .admin-topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-badge-role {
            background: var(--admin-primary-light);
            color: var(--admin-primary);
            font-weight: 700;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* BODY CONTENT AREA */
        .admin-body {
            padding: 32px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        /* ALERTS */
        .admin-alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeIn 0.3s ease;
        }

        .alert-success { background: #DEF7EC; color: #03543F; border: 1px solid #BCF0DA; }
        .alert-error { background: #FDE8E8; color: #9B1C1C; border: 1px solid #FBD5D5; }
        .alert-info { background: #E1EFFE; color: #1E429F; border: 1px solid #B4C6FC; }

        /* METRIC STATS GRID */
        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--admin-card-bg);
            padding: 22px 24px;
            border-radius: 16px;
            border: 1px solid var(--admin-border);
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.04);
        }

        .stat-card .val {
            font-size: 30px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: var(--admin-text-main);
            line-height: 1.1;
        }

        .stat-card .lbl {
            font-size: 13px;
            color: var(--admin-text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 6px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .icon-green { background: rgba(20, 122, 77, 0.1); color: var(--admin-primary); }
        .icon-amber { background: rgba(245, 158, 11, 0.1); color: #F59E0B; }
        .icon-red { background: rgba(239, 68, 68, 0.1); color: #EF4444; }
        .icon-blue { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }
        .icon-purple { background: rgba(139, 92, 246, 0.1); color: #8B5CF6; }

        /* CARDS & PANELS */
        .admin-panel {
            background: var(--admin-card-bg);
            border-radius: 16px;
            border: 1px solid var(--admin-border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            margin-bottom: 28px;
            overflow: hidden;
        }

        .panel-head {
            padding: 22px 28px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .panel-head h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: var(--admin-text-main);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-body {
            padding: 28px;
        }

        /* TABLES */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            padding: 14px 18px;
            background: #F8FAFC;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--admin-text-muted);
            border-bottom: 1px solid var(--admin-border);
            letter-spacing: 0.5px;
        }

        .admin-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #F1F5F9;
            font-size: 14px;
            vertical-align: middle;
        }

        .admin-table tr:hover td {
            background: #FBFDFB;
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-live { background: #DEF7EC; color: #03543F; }
        .badge-pending { background: #FEF3C7; color: #92400E; }
        .badge-rejected { background: #FDE8E8; color: #9B1C1C; }
        .badge-sold { background: #F3F4F6; color: #4B5563; }
        .badge-featured { background: #EDE9FE; color: #6D28D9; border: 1px solid #DDD6FE; }
        .badge-verified { background: #EAF7F0; color: #147A4D; }

        /* BUTTONS */
        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-admin-primary {
            background: var(--admin-primary);
            color: white;
            box-shadow: 0 2px 6px rgba(20, 122, 77, 0.25);
        }
        .btn-admin-primary:hover {
            background: var(--admin-primary-dark);
        }

        .btn-admin-secondary {
            background: #F1F5F9;
            color: #334155;
            border: 1px solid #CBD5E1;
        }
        .btn-admin-secondary:hover {
            background: #E2E8F0;
        }

        .btn-admin-danger {
            background: #EF4444;
            color: white;
        }
        .btn-admin-danger:hover {
            background: #DC2626;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 8px;
        }

        /* FORM CONTROLS */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--admin-border);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--admin-text-main);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #FFFFFF;
        }

        .form-control:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(20, 122, 77, 0.15);
        }

        .form-help {
            font-size: 12px;
            color: var(--admin-text-muted);
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* GOOGLE SEARCH PREVIEW CARD (SEO WIDGET) */
        .google-seo-preview {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.03);
            margin-bottom: 24px;
        }

        .seo-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #E2E8F0;
        }

        .seo-preview-header span {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748B;
        }

        .g-search-box {
            font-family: Arial, sans-serif;
            max-width: 600px;
        }

        .g-url-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #202124;
            margin-bottom: 4px;
        }

        .g-favicon {
            width: 18px;
            height: 18px;
            background: var(--admin-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
        }

        .g-title {
            color: #1a0dab;
            font-size: 19px;
            line-height: 1.3;
            font-weight: 400;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin-bottom: 4px;
        }

        .g-title:hover {
            text-decoration: underline;
        }

        .g-snippet {
            color: #4d5156;
            font-size: 14px;
            line-height: 1.58;
            margin: 0;
            word-wrap: break-word;
        }

        /* MODAL STYLES */
        .admin-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .admin-modal-backdrop.show {
            display: flex;
        }

        .admin-modal {
            background: white;
            border-radius: 18px;
            width: 90%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
            animation: modalPop 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .admin-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-modal-header h3 {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
        }

        .admin-modal-body {
            padding: 24px;
        }

        .admin-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--admin-border);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: #F8FAFC;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        /* RESPONSIVE DESIGN */
        @media(max-width: 1024px) {
            .admin-stats-grid { grid-template-columns: repeat(2, 1fr); }
            .form-row { grid-template-columns: 1fr; }
        }

        @media(max-width: 860px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .mobile-toggle-btn { display: inline-flex; }
            .admin-body { padding: 20px; }
            .admin-stats-grid { grid-template-columns: 1fr; }
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes modalPop { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>

    {{-- USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao" --}}
    <!-- SIDEBAR NAVIGATION -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar-header">
            <div class="admin-logo-box">
                <i class="fa-solid fa-shield-cat"></i>
            </div>
            <div class="admin-logo-text">
                <h2>PetMarket Admin</h2>
                <span>Command &amp; SEO Engine</span>
            </div>
        </div>

        <div class="admin-nav-group-title">Main Tabs</div>
        <ul class="admin-nav">
            <li class="admin-nav-item {{ $tab === 'overview' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'overview']) }}">
                    <span class="nav-left"><i class="fa-solid fa-chart-pie"></i> Overview &amp; Stats</span>
                    @if($stats['pending_listings'] > 0)
                        <span class="nav-pill nav-pill-alert">{{ $stats['pending_listings'] }}</span>
                    @endif
                </a>
            </li>
            {{-- USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi" --}}
            <li class="admin-nav-item {{ $tab === 'hero' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}">
                    <span class="nav-left"><i class="fa-solid fa-wand-magic-sparkles"></i> Homepage Hero &amp; Buttons</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'seo' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'seo']) }}">
                    <span class="nav-left"><i class="fa-solid fa-magnifying-glass-chart"></i> SEO &amp; Meta Engine</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'categories' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'categories']) }}">
                    <span class="nav-left"><i class="fa-solid fa-layer-group"></i> Categories &amp; Breeds</span>
                    <span class="nav-pill">{{ $stats['total_categories'] }}</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'listings' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'listings']) }}">
                    <span class="nav-left"><i class="fa-solid fa-paw"></i> Pet Listings</span>
                    <span class="nav-pill">{{ $stats['live_listings'] }}</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'users' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'users']) }}">
                    <span class="nav-left"><i class="fa-solid fa-users-gear"></i> Users &amp; Sellers</span>
                    <span class="nav-pill">{{ $stats['total_users'] }}</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'reports' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'reports']) }}">
                    <span class="nav-left"><i class="fa-solid fa-triangle-exclamation"></i> Anti-Scam Reports</span>
                    @if($stats['pending_reports'] > 0)
                        <span class="nav-pill nav-pill-alert">{{ $stats['pending_reports'] }}</span>
                    @endif
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'settings' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'settings']) }}">
                    <span class="nav-left"><i class="fa-solid fa-sliders"></i> Site Settings</span>
                </a>
            </li>
        </ul>

        <div class="admin-sidebar-footer">
            <a href="{{ route('home') }}" class="btn-sidebar-viewsite" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Public Website
            </a>
            <a href="{{ route('logout') }}" class="btn-sidebar-viewsite" style="color: #F87171;" onclick="event.preventDefault(); document.getElementById('adminLogoutForm').submit();">
                <i class="fa-solid fa-power-off"></i> Exit Admin Session
            </a>
            <form id="adminLogoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <main class="admin-main">
        <!-- TOPBAR -->
        <header class="admin-topbar">
            <div class="admin-topbar-left">
                <button type="button" class="mobile-toggle-btn" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="admin-page-heading">
                    @if($tab === 'overview')
                        <h1>Platform Command &amp; Moderation Center</h1>
                        <p>Real-time ecosystem metrics, inventory verification, and moderation queues</p>
                    {{-- USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi" --}}
                    @elseif($tab === 'hero')
                        <h1>Homepage Hero &amp; Interactive Filter Controls</h1>
                        <p>Customize hero headline, description, visual image, search buttons, placeholders, and supported cities</p>
                    @elseif($tab === 'seo')
                        <h1>Dynamic SEO &amp; Meta Tag Engine</h1>
                        <p>Configure search engine titles, open-graph cards, sitemaps, and indexing rules</p>
                    @elseif($tab === 'categories')
                        <h1>Dynamic Categories &amp; Breeds Management</h1>
                        <p>Control pet categories, breed taxonomies, active states, and custom slugs</p>
                    @elseif($tab === 'listings')
                        <h1>Platform Pet Inventory &amp; Moderation</h1>
                        <p>Review, verify, mark featured, and moderate listings across all cities</p>
                    @elseif($tab === 'users')
                        <h1>Registered Users &amp; Seller Verification</h1>
                        <p>Manage user accounts, assign trust ratings, verify breeders, and shield against fraud</p>
                    @elseif($tab === 'reports')
                        <h1>Community Safety &amp; Anti-Scam Shield</h1>
                        <p>Review user flags, investigate fraudulent behavior, and take disciplinary action</p>
                    @elseif($tab === 'settings')
                        <h1>General Marketplace &amp; Notice Settings</h1>
                        <p>Configure live announcement banners, contact channels, and system defaults</p>
                    @endif
                </div>
            </div>

            <div class="admin-topbar-right">
                <div class="admin-badge-role">
                    <i class="fa-solid fa-user-shield"></i> {{ auth()->user() ? auth()->user()->name : 'System Admin' }}
                </div>
            </div>
        </header>

        <!-- BODY CONTENT -->
        <div class="admin-body">
            @if(session('success'))
                <div class="admin-alert alert-success">
                    <span><i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:inherit;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="admin-alert alert-error">
                    <span><i class="fa-solid fa-circle-xmark" style="margin-right: 8px;"></i> {{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:inherit;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('info'))
                <div class="admin-alert alert-info">
                    <span><i class="fa-solid fa-circle-info" style="margin-right: 8px;"></i> {{ session('info') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:inherit;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            <!-- TAB 1: OVERVIEW & STATS -->
            @if($tab === 'overview')
                <div class="admin-stats-grid">
                    <div class="stat-card">
                        <div>
                            <div class="val">{{ number_format($stats['total_users']) }}</div>
                            <div class="lbl">Registered Users</div>
                        </div>
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-users"></i></div>
                    </div>
                    <div class="stat-card">
                        <div>
                            <div class="val">{{ number_format($stats['live_listings']) }}</div>
                            <div class="lbl">Live Verified Ads</div>
                        </div>
                        <div class="stat-icon icon-green"><i class="fa-solid fa-paw"></i></div>
                    </div>
                    <div class="stat-card">
                        <div>
                            <div class="val">{{ number_format($stats['pending_listings']) }}</div>
                            <div class="lbl">Pending Review</div>
                        </div>
                        <div class="stat-icon icon-amber"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    </div>
                    <div class="stat-card">
                        <div>
                            <div class="val">{{ number_format($stats['pending_reports']) }}</div>
                            <div class="lbl">Pending Reports</div>
                        </div>
                        <div class="stat-icon icon-red"><i class="fa-solid fa-shield-halved"></i></div>
                    </div>
                </div>

                <!-- Secondary metric row -->
                <div class="admin-stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 32px;">
                    <div class="stat-card" style="padding: 16px 20px;">
                        <div>
                            <div class="val" style="font-size: 22px;">{{ $stats['total_categories'] }}</div>
                            <div class="lbl" style="font-size: 11px;">Active Categories</div>
                        </div>
                        <div class="stat-icon icon-green" style="width: 42px; height: 42px; font-size: 18px;"><i class="fa-solid fa-tags"></i></div>
                    </div>
                    <div class="stat-card" style="padding: 16px 20px;">
                        <div>
                            <div class="val" style="font-size: 22px;">{{ $stats['total_breeds'] }}</div>
                            <div class="lbl" style="font-size: 11px;">Registered Breeds</div>
                        </div>
                        <div class="stat-icon icon-purple" style="width: 42px; height: 42px; font-size: 18px;"><i class="fa-solid fa-dna"></i></div>
                    </div>
                    <div class="stat-card" style="padding: 16px 20px;">
                        <div>
                            <div class="val" style="font-size: 22px;">{{ $stats['verified_sellers'] }}</div>
                            <div class="lbl" style="font-size: 11px;">Verified Sellers</div>
                        </div>
                        <div class="stat-icon icon-blue" style="width: 42px; height: 42px; font-size: 18px;"><i class="fa-solid fa-badge-check"></i></div>
                    </div>
                    <div class="stat-card" style="padding: 16px 20px;">
                        <div>
                            <div class="val" style="font-size: 22px;">{{ $stats['sold_listings'] }}</div>
                            <div class="lbl" style="font-size: 11px;">Completed Sales</div>
                        </div>
                        <div class="stat-icon icon-amber" style="width: 42px; height: 42px; font-size: 18px;"><i class="fa-solid fa-handshake"></i></div>
                    </div>
                </div>

                <!-- Pending Listings Queue -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-clipboard-check" style="color: var(--admin-primary);"></i> Pending Verification Queue ({{ $pendingListings->count() }})</h2>
                        <a href="{{ route('admin.dashboard', ['tab' => 'listings']) }}" class="btn-admin btn-admin-secondary btn-sm">View All Listings</a>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Listing Details</th>
                                    <th>Seller</th>
                                    <th>Price</th>
                                    <th>Location</th>
                                    <th>Submitted</th>
                                    <th>Moderation Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingListings as $item)
                                    <tr>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:12px;">
                                                <img src="{{ $item->primary_image_url }}" alt="" style="width:46px;height:46px;border-radius:8px;object-fit:cover;">
                                                <div>
                                                    <a href="{{ route('pet.details', ['slug' => $item->slug ?: $item->id]) }}" target="_blank" style="font-weight:700;color:var(--admin-text-main);text-decoration:none;">{{ $item->title }}</a>
                                                    <div style="font-size:12px;color:var(--admin-text-muted);">{{ $item->category ? $item->category->name : 'Pet' }} • {{ $item->breed_name ?: ($item->breed ? $item->breed->name : 'N/A') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $item->user->name }}</strong>
                                            <div style="font-size:12px;color:var(--admin-text-muted);">Trust: {{ $item->user->trust_score }}%</div>
                                        </td>
                                        <td><strong>{{ $item->formatted_price }}</strong></td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div style="display: flex; gap: 8px;">
                                                <form action="{{ route('admin.listings.approve', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-admin btn-admin-primary btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                                                </form>
                                                <form action="{{ route('admin.listings.reject', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="reason" value="Suspicious listing or unverified pet health paperwork">
                                                    <button type="submit" class="btn-admin btn-admin-secondary btn-sm"><i class="fa-solid fa-xmark"></i> Reject</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center;padding:36px;color:var(--admin-text-muted);">
                                            <i class="fa-solid fa-check-double" style="font-size:26px;color:var(--admin-primary);display:block;margin-bottom:8px;"></i>
                                            All clear! No listings currently waiting in verification queue.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Fraud Reports -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-shield-virus" style="color: #EF4444;"></i> Recent Anti-Scam Reports ({{ $recentReports->count() }})</h2>
                        <a href="{{ route('admin.dashboard', ['tab' => 'reports']) }}" class="btn-admin btn-admin-secondary btn-sm">View All Reports</a>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Reason</th>
                                    <th>Notes</th>
                                    <th>Reported User</th>
                                    <th>Reporter</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReports as $rep)
                                    <tr>
                                        <td><strong style="color:#EF4444;">{{ $rep->reason }}</strong></td>
                                        <td style="max-width:280px;color:var(--admin-text-muted);">{{ $rep->details ?: 'No additional details provided' }}</td>
                                        <td>
                                            @if($rep->seller)
                                                <strong>{{ $rep->seller->name }}</strong>
                                                <div style="font-size:12px;color:var(--admin-text-muted);">{{ $rep->seller->email }}</div>
                                            @else
                                                <span style="color:#94A3B8;">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $rep->reporter ? $rep->reporter->name : 'Anonymous Buyer' }}</td>
                                        <td>{{ $rep->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <form action="{{ route('admin.reports.resolve', ['id' => $rep->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-admin btn-admin-secondary btn-sm"><i class="fa-solid fa-check"></i> Resolve</button>
                                                </form>
                                                @if($rep->seller_id)
                                                    <form action="{{ route('admin.users.ban', ['id' => $rep->seller_id]) }}" method="POST" onsubmit="return confirm('Ban this seller and remove their ads?');">
                                                        @csrf
                                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm"><i class="fa-solid fa-ban"></i> Ban</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center;padding:36px;color:var(--admin-text-muted);">
                                            <i class="fa-solid fa-shield-cat" style="font-size:26px;color:var(--admin-primary);display:block;margin-bottom:8px;"></i>
                                            Zero open scam reports! Community is running safe and sound.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            <!-- TAB: HOMEPAGE HERO & FILTER BUTTONS -->
            {{-- USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi" --}}
            @elseif($tab === 'hero')
                <!-- Live Hero Simulation Preview -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Homepage Hero Preview</h2>
                            <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Homepage
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <div style="display: flex; gap: 32px; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 280px;">
                                <h1 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #1E293B; line-height: 1.2; margin: 0 0 12px;">
                                    {{ strip_tags($heroSettings['hero_title']) }}
                                </h1>
                                <p style="font-size: 14px; color: #64748B; line-height: 1.6; margin: 0 0 20px;">
                                    {{ $heroSettings['hero_desc'] }}
                                </p>
                            </div>
                            <div style="width: 140px; height: 140px; border-radius: 16px; overflow: hidden; background: #E2E8F0; display:flex; align-items:center; justify-content:center; flex-shrink: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.08);">
                                <img src="{{ asset($heroSettings['hero_image']) }}" alt="Hero Pet" style="width:100%; height:100%; object-fit: cover;" onerror="this.src='{{ asset('images/home-hero-image.png') }}'">
                            </div>
                        </div>

                        <!-- Mini Search Bar Simulation -->
                        <div style="margin-top: 20px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 12px 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; box-shadow: 0 4px 14px rgba(0,0,0,0.04);">
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-paw"></i> {{ $heroSettings['hero_filter_cat_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroSettings['hero_filter_cat_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-dna"></i> {{ $heroSettings['hero_filter_breed_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroSettings['hero_filter_breed_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-location-dot"></i> {{ $heroSettings['hero_filter_loc_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroSettings['hero_filter_loc_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-tag"></i> {{ $heroSettings['hero_filter_price_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroSettings['hero_filter_price_placeholder'] }}</div>
                            </div>
                            <button type="button" class="btn-admin btn-admin-primary btn-sm" style="padding: 10px 18px; border-radius: 8px; pointer-events: none;">
                                <i class="fa-solid fa-magnifying-glass"></i> {{ $heroSettings['hero_cta_text'] }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hero & Button Settings Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Hero Text, Images &amp; Interactive Buttons Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.hero.update') }}" method="POST">
                            @csrf

                            <!-- Section 1: Hero Main Copy -->
                            <div style="margin-bottom: 24px; padding-bottom: 18px; border-bottom: 1px solid var(--admin-border);">
                                <h3 style="font-size: 15px; font-weight: 700; color: var(--admin-text-main); margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--admin-primary-light); color: var(--admin-primary); display: inline-flex; align-items: center; justify-content: center; font-size: 12px;">1</span>
                                    Hero Headline, Description &amp; Visual
                                </h3>

                                {{-- USER PROMPT: "yr idher koi html code na ho" --}}
                                <div class="form-group">
                                    <label class="form-label" for="hero_title">Hero Main Headline Title</label>
                                    <input type="text" name="hero_title" id="hero_title" class="form-control" value="{{ strip_tags($heroSettings['hero_title']) }}" placeholder="Find the right pet for your family." required>
                                    <div class="form-help">Main hero headline displayed prominently on homepage (Plain text only, no HTML tags).</div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="hero_desc">Hero Subtitle Description</label>
                                    <textarea name="hero_desc" id="hero_desc" rows="3" class="form-control" required>{{ $heroSettings['hero_desc'] }}</textarea>
                                    <div class="form-help">Subtitle narrative guiding visitors to search pets by breed, city, and seller rating.</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="hero_image">Hero Visual Image Path / URL</label>
                                        <input type="text" name="hero_image" id="hero_image" class="form-control" value="{{ $heroSettings['hero_image'] }}" required>
                                        <div class="form-help">Path to the cutout pet image (default: <code>images/home-hero-image.png</code>).</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="hero_cta_text">Search Button CTA Text</label>
                                        <input type="text" name="hero_cta_text" id="hero_cta_text" class="form-control" value="{{ $heroSettings['hero_cta_text'] }}" required>
                                        <div class="form-help">Label shown on the green search trigger button (default: "Find a Pet").</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Interactive Filter Buttons & Placeholders -->
                            <div style="margin-bottom: 24px; padding-bottom: 18px; border-bottom: 1px solid var(--admin-border);">
                                <h3 style="font-size: 15px; font-weight: 700; color: var(--admin-text-main); margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--admin-primary-light); color: var(--admin-primary); display: inline-flex; align-items: center; justify-content: center; font-size: 12px;">2</span>
                                    Search Filter Buttons &amp; Labels
                                </h3>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_cat_label">Filter 1: Category Button Label</label>
                                        <input type="text" name="hero_filter_cat_label" id="hero_filter_cat_label" class="form-control" value="{{ $heroSettings['hero_filter_cat_label'] }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_cat_placeholder">Category Button Default Text</label>
                                        <input type="text" name="hero_filter_cat_placeholder" id="hero_filter_cat_placeholder" class="form-control" value="{{ $heroSettings['hero_filter_cat_placeholder'] }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_breed_label">Filter 2: Breed Button Label</label>
                                        <input type="text" name="hero_filter_breed_label" id="hero_filter_breed_label" class="form-control" value="{{ $heroSettings['hero_filter_breed_label'] }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_breed_placeholder">Breed Button Default Text</label>
                                        <input type="text" name="hero_filter_breed_placeholder" id="hero_filter_breed_placeholder" class="form-control" value="{{ $heroSettings['hero_filter_breed_placeholder'] }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_loc_label">Filter 3: Location Button Label</label>
                                        <input type="text" name="hero_filter_loc_label" id="hero_filter_loc_label" class="form-control" value="{{ $heroSettings['hero_filter_loc_label'] }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_loc_placeholder">Location Button Default Text</label>
                                        <input type="text" name="hero_filter_loc_placeholder" id="hero_filter_loc_placeholder" class="form-control" value="{{ $heroSettings['hero_filter_loc_placeholder'] }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="hero_locations">Supported Cities (Comma-separated)</label>
                                    <textarea name="hero_locations" id="hero_locations" rows="2" class="form-control" required>{{ $heroSettings['hero_locations'] }}</textarea>
                                    <div class="form-help">Cities shown in the hero location dropdown. Any cities active in user listings are also automatically appended.</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_price_label">Filter 4: Price Button Label</label>
                                        <input type="text" name="hero_filter_price_label" id="hero_filter_price_label" class="form-control" value="{{ $heroSettings['hero_filter_price_label'] }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="hero_filter_price_placeholder">Price Button Default Text</label>
                                        <input type="text" name="hero_filter_price_placeholder" id="hero_filter_price_placeholder" class="form-control" value="{{ $heroSettings['hero_filter_price_placeholder'] }}" required>
                                    </div>
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 16px;">
                                <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Hero &amp; Buttons Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB 2: SEO & META ENGINE -->
            @elseif($tab === 'seo')
                {{-- USER PROMPT: "in 3 no ko remove kr do" --}}
                <!-- SEO Configuration Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Core Metadata &amp; Search Engine Indexing</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.seo.update') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label class="form-label" for="seo_meta_title">Default SEO Meta Title</label>
                                <input type="text" name="seo_meta_title" id="seo_meta_title" class="form-control" value="{{ $seoSettings['seo_meta_title'] }}" required>
                                <div class="form-help">Recommended length: 50–60 characters. Appears as the headline link in search results.</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="seo_meta_description">Meta Description</label>
                                <textarea name="seo_meta_description" id="seo_meta_description" rows="3" class="form-control" required>{{ $seoSettings['seo_meta_description'] }}</textarea>
                                <div class="form-help">Recommended length: 140–160 characters. Summarizes page content for prospective searchers.</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="seo_meta_keywords">Meta Keywords (Comma-separated)</label>
                                    <input type="text" name="seo_meta_keywords" id="seo_meta_keywords" class="form-control" value="{{ $seoSettings['seo_meta_keywords'] }}">
                                    <div class="form-help">Keywords indexing target pet species, cities and breeds.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="seo_canonical_base">Canonical Base URL</label>
                                    <input type="url" name="seo_canonical_base" id="seo_canonical_base" class="form-control" value="{{ $seoSettings['seo_canonical_base'] }}">
                                    <div class="form-help">Primary root domain used for rel="canonical" tags.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="seo_robots">Robots Meta Tag (&lt;meta name="robots"&gt;)</label>
                                    <select name="seo_robots" id="seo_robots" class="form-control">
                                        <option value="index, follow" {{ $seoSettings['seo_robots'] === 'index, follow' ? 'selected' : '' }}>index, follow (Standard: allow indexing and link following)</option>
                                        <option value="noindex, follow" {{ $seoSettings['seo_robots'] === 'noindex, follow' ? 'selected' : '' }}>noindex, follow (Do not index page, but follow links)</option>
                                        <option value="index, nofollow" {{ $seoSettings['seo_robots'] === 'index, nofollow' ? 'selected' : '' }}>index, nofollow (Index page, but do not follow links)</option>
                                        <option value="noindex, nofollow" {{ $seoSettings['seo_robots'] === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow (Complete privacy / block all search bots)</option>
                                    </select>
                                    <div class="form-help">Controls the &lt;meta name="robots" content="..."&gt; HTML tag across all public pages.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="seo_og_image">OpenGraph Image URL</label>
                                    <input type="text" name="seo_og_image" id="seo_og_image" class="form-control" value="{{ $seoSettings['seo_og_image'] }}">
                                    <div class="form-help">Image thumbnail displayed when website link is shared on WhatsApp/Facebook.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="seo_og_title">Social Share (OG) Title</label>
                                    <input type="text" name="seo_og_title" id="seo_og_title" class="form-control" value="{{ $seoSettings['seo_og_title'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="seo_og_description">Social Share (OG) Description</label>
                                    <input type="text" name="seo_og_description" id="seo_og_description" class="form-control" value="{{ $seoSettings['seo_og_description'] }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="seo_header_scripts">Custom Header Verification Tags / Analytics Code</label>
                                <textarea name="seo_header_scripts" id="seo_header_scripts" rows="3" class="form-control" placeholder="&lt;meta name=&quot;google-site-verification&quot; content=&quot;...&quot;&gt;">{{ $seoSettings['seo_header_scripts'] }}</textarea>
                                <div class="form-help">Paste Google Search Console HTML meta tag or analytics snippets here.</div>
                            </div>

                            <div style="text-align: right; margin-top: 10px;">
                                <button type="submit" class="btn-admin btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Save SEO Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB 3: CATEGORIES & BREEDS -->
            @elseif($tab === 'categories')
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-layer-group" style="color: var(--admin-primary);"></i> Dynamic Pet Categories ({{ $categories->count() }})</h2>
                        <button type="button" class="btn-admin btn-admin-primary btn-sm" onclick="openModal('addCategoryModal')">
                            <i class="fa-solid fa-plus"></i> Add New Category
                        </button>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Category</th>
                                    <th>Slug (Clean URL)</th>
                                    <th>Breeds</th>
                                    <th>Total Ads</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                    <tr>
                                        <td><strong>#{{ $cat->sort_order }}</strong></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <i class="{{ $cat->icon ?: 'fa-solid fa-paw' }}" style="font-size:18px;color:var(--admin-primary);"></i>
                                                <strong style="font-size:15px;">{{ $cat->name }}</strong>
                                            </div>
                                        </td>
                                        <td><code style="background:#F1F5F9;padding:4px 8px;border-radius:6px;color:#0F172A;">/category/{{ $cat->slug }}</code></td>
                                        <td><span class="badge" style="background:#E0F2FE;color:#0369A1;">{{ $cat->breeds_count }} breeds</span></td>
                                        <td><span class="badge badge-live">{{ $cat->active_listings_count }} active ads</span></td>
                                        <td>
                                            <form action="{{ route('admin.categories.toggle', ['id' => $cat->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="badge {{ $cat->is_active ? 'badge-live' : 'badge-rejected' }}" style="border:none;cursor:pointer;">
                                                    <i class="fa-solid fa-circle" style="font-size:8px;"></i> {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <button type="button" class="btn-admin btn-admin-secondary btn-sm" onclick="editCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ $cat->icon }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }})">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                                @if($cat->listings_count == 0)
                                                    <form action="{{ route('admin.categories.delete', ['id' => $cat->id]) }}" method="POST" onsubmit="return confirm('Delete category {{ $cat->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Breeds List Panel -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-dna" style="color: #8B5CF6;"></i> Registered Breeds Inventory ({{ $breeds->count() }})</h2>
                        <button type="button" class="btn-admin btn-admin-primary btn-sm" onclick="openModal('addBreedModal')">
                            <i class="fa-solid fa-plus"></i> Add New Breed
                        </button>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Breed Name</th>
                                    <th>Parent Category</th>
                                    <th>URL Slug</th>
                                    <th>Available Ads</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($breeds as $breed)
                                    <tr>
                                        <td><strong>{{ $breed->name }}</strong></td>
                                        <td>
                                            @if($breed->category)
                                                <span class="badge" style="background:#F1F5F9;color:#334155;"><i class="{{ $breed->category->icon }}"></i> {{ $breed->category->name }}</span>
                                            @else
                                                <span style="color:#94A3B8;">General</span>
                                            @endif
                                        </td>
                                        <td><code style="background:#F1F5F9;padding:4px 8px;border-radius:6px;color:#0F172A;">/category/{{ $breed->slug }}</code></td>
                                        <td><span class="badge badge-live">{{ $breed->listings_count }} ads</span></td>
                                        <td>
                                            <form action="{{ route('admin.breeds.delete', ['id' => $breed->id]) }}" method="POST" onsubmit="return confirm('Delete breed {{ $breed->name }}?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-admin btn-admin-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            <!-- TAB 4: PET LISTINGS -->
            @elseif($tab === 'listings')
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-paw" style="color: var(--admin-primary);"></i> Platform Pet Inventory</h2>
                        <!-- Search & Status filter form -->
                        <form action="{{ route('admin.dashboard', ['tab' => 'listings']) }}" method="GET" style="display:flex;gap:10px;align-items:center;">
                            <input type="hidden" name="tab" value="listings">
                            <input type="text" name="listing_q" value="{{ request('listing_q') }}" placeholder="Search title, seller, city..." class="form-control" style="width:220px;padding:7px 12px;font-size:13px;">
                            <select name="listing_status" class="form-control" style="width:140px;padding:7px 12px;font-size:13px;" onchange="this.form.submit()">
                                <option value="all" {{ request('listing_status') === 'all' ? 'selected' : '' }}>All Statuses</option>
                                <option value="live" {{ request('listing_status') === 'live' ? 'selected' : '' }}>Live Ads</option>
                                <option value="pending" {{ request('listing_status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="rejected" {{ request('listing_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="sold" {{ request('listing_status') === 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                            <button type="submit" class="btn-admin btn-admin-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Pet / Title</th>
                                    <th>Seller</th>
                                    <th>Price</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listings as $item)
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:12px;">
                                                <img src="{{ $item->primary_image_url }}" alt="" style="width:44px;height:44px;border-radius:8px;object-fit:cover;">
                                                <div>
                                                    <a href="{{ route('pet.details', ['slug' => $item->slug ?: $item->id]) }}" target="_blank" style="font-weight:700;color:var(--admin-text-main);text-decoration:none;">{{ $item->title }}</a>
                                                    <div style="font-size:12px;color:var(--admin-text-muted);">{{ $item->category ? $item->category->name : 'N/A' }} • {{ $item->created_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $item->user->name }}</strong>
                                            <div style="font-size:12px;color:var(--admin-text-muted);">{{ $item->user->phone ?: $item->user->email }}</div>
                                        </td>
                                        <td><strong>{{ $item->formatted_price }}</strong></td>
                                        <td>{{ $item->city }}</td>
                                        <td>
                                            @if($item->status === 'live')
                                                <span class="badge badge-live">Live</span>
                                            @elseif($item->status === 'pending')
                                                <span class="badge badge-pending">Pending</span>
                                            @elseif($item->status === 'rejected')
                                                <span class="badge badge-rejected">Rejected</span>
                                            @else
                                                <span class="badge badge-sold">{{ ucfirst($item->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.listings.featured', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="badge {{ $item->is_featured ? 'badge-featured' : 'badge-sold' }}" style="border:none;cursor:pointer;">
                                                    <i class="fa-solid fa-star"></i> {{ $item->is_featured ? 'Featured' : 'Standard' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                @if($item->status === 'pending')
                                                    <form action="{{ route('admin.listings.approve', ['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-admin btn-admin-primary btn-sm"><i class="fa-solid fa-check"></i></button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('pet.details', ['slug' => $item->slug ?: $item->id]) }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <form action="{{ route('admin.listings.delete', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Permanently remove listing?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-admin btn-admin-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align:center;padding:36px;color:var(--admin-text-muted);">No listings matching filters.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:16px 24px;">
                        {{ $listings->links() }}
                    </div>
                </div>

            <!-- TAB 5: USERS & SELLERS -->
            @elseif($tab === 'users')
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-users-gear" style="color: var(--admin-primary);"></i> Registered Users &amp; Sellers ({{ $users->total() }})</h2>
                        <form action="{{ route('admin.dashboard', ['tab' => 'users']) }}" method="GET" style="display:flex;gap:10px;">
                            <input type="hidden" name="tab" value="users">
                            <input type="text" name="user_q" value="{{ request('user_q') }}" placeholder="Search name, email, phone, city..." class="form-control" style="width:240px;padding:7px 12px;font-size:13px;">
                            <button type="submit" class="btn-admin btn-admin-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Role &amp; City</th>
                                    <th>Trust Rating</th>
                                    <th>Verified Seller</th>
                                    <th>Status</th>
                                    <th>Ads Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div style="width:38px;height:38px;border-radius:50%;background:#E2E8F0;display:flex;align-items:center;justify-content:center;font-weight:700;color:#334155;">
                                                    {{ substr($u->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $u->name }}</strong>
                                                    <div style="font-size:12px;color:var(--admin-text-muted);">{{ $u->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge" style="background:#F1F5F9;color:#334155;">{{ ucfirst($u->role) }}</span>
                                            <div style="font-size:12px;color:var(--admin-text-muted);margin-top:2px;">{{ $u->city ?: 'Pakistan' }}</div>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.trust', ['id' => $u->id]) }}" method="POST" style="display:flex;align-items:center;gap:6px;">
                                                @csrf
                                                <input type="number" name="trust_score" value="{{ $u->trust_score }}" min="0" max="100" class="form-control" style="width:65px;padding:4px 8px;font-size:12px;font-weight:700;">
                                                <button type="submit" class="btn-admin btn-admin-secondary btn-sm" style="padding:4px 8px;"><i class="fa-solid fa-check"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.toggle-verify', ['id' => $u->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="badge {{ $u->is_verified ? 'badge-verified' : 'badge-sold' }}" style="border:none;cursor:pointer;">
                                                    <i class="fa-solid {{ $u->is_verified ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i> {{ $u->is_verified ? 'Verified' : 'Unverified' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            @if($u->is_banned)
                                                <span class="badge badge-rejected"><i class="fa-solid fa-ban"></i> Banned</span>
                                            @else
                                                <span class="badge badge-live"><i class="fa-solid fa-circle-check"></i> Active</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $u->listings_count }}</strong></td>
                                        <td>
                                            @if($u->role !== 'admin')
                                                <form action="{{ route('admin.users.ban', ['id' => $u->id]) }}" method="POST" onsubmit="return confirm('{{ $u->is_banned ? 'Unban this user?' : 'Ban this user?' }}');">
                                                    @csrf
                                                    <button type="submit" class="btn-admin {{ $u->is_banned ? 'btn-admin-secondary' : 'btn-admin-danger' }} btn-sm">
                                                        <i class="fa-solid {{ $u->is_banned ? 'fa-unlock' : 'fa-ban' }}"></i> {{ $u->is_banned ? 'Unban' : 'Ban' }}
                                                    </button>
                                                </form>
                                            @else
                                                <span style="font-size:12px;color:var(--admin-text-muted);font-weight:700;">Admin</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:16px 24px;">
                        {{ $users->links() }}
                    </div>
                </div>

            <!-- TAB 6: REPORTS & ANTI-SCAM SHIELD -->
            @elseif($tab === 'reports')
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-triangle-exclamation" style="color: #EF4444;"></i> Community Flag &amp; Scam Reports ({{ $allReports->total() }})</h2>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>Category / Reason</th>
                                    <th>User Details &amp; Notes</th>
                                    <th>Reported Seller</th>
                                    <th>Reporter</th>
                                    <th>Status</th>
                                    <th>Take Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allReports as $rep)
                                    <tr>
                                        <td><strong>#{{ $rep->id }}</strong></td>
                                        <td><strong style="color:#EF4444;">{{ $rep->reason }}</strong></td>
                                        <td style="max-width:280px;color:var(--admin-text-muted);">{{ $rep->details ?: 'No additional notes provided' }}</td>
                                        <td>
                                            @if($rep->seller)
                                                <a href="{{ route('seller.profile', ['id' => $rep->seller->id]) }}" target="_blank" style="font-weight:700;color:var(--admin-primary);text-decoration:none;">{{ $rep->seller->name }}</a>
                                                <div style="font-size:12px;color:var(--admin-text-muted);">{{ $rep->seller->email }}</div>
                                            @else
                                                <span style="color:#94A3B8;">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $rep->reporter ? $rep->reporter->name : 'Anonymous' }}</td>
                                        <td>
                                            @if($rep->status === 'pending')
                                                <span class="badge badge-pending">Pending Review</span>
                                            @elseif($rep->status === 'resolved')
                                                <span class="badge badge-live">Resolved</span>
                                            @else
                                                <span class="badge badge-sold">{{ ucfirst($rep->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                @if($rep->status === 'pending')
                                                    <form action="{{ route('admin.reports.resolve', ['id' => $rep->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-admin btn-admin-primary btn-sm"><i class="fa-solid fa-check"></i> Resolve</button>
                                                    </form>
                                                    <form action="{{ route('admin.reports.dismiss', ['id' => $rep->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-admin btn-admin-secondary btn-sm"><i class="fa-solid fa-xmark"></i> Dismiss</button>
                                                    </form>
                                                @endif
                                                @if($rep->seller_id)
                                                    <form action="{{ route('admin.users.ban', ['id' => $rep->seller_id]) }}" method="POST" onsubmit="return confirm('Ban this reported seller?');">
                                                        @csrf
                                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm"><i class="fa-solid fa-ban"></i> Ban User</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align:center;padding:36px;color:var(--admin-text-muted);">No reports found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:16px 24px;">
                        {{ $allReports->links() }}
                    </div>
                </div>

            <!-- TAB 7: GENERAL SETTINGS -->
            @elseif($tab === 'settings')
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Dynamic Platform &amp; Live Announcement Settings</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="site_name">Marketplace Brand Name</label>
                                    <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $generalSettings['site_name'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="site_tagline">Platform Tagline</label>
                                    <input type="text" name="site_tagline" id="site_tagline" class="form-control" value="{{ $generalSettings['site_tagline'] }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="site_top_notice">Header Announcement Notice (Live Top Green Bar)</label>
                                <input type="text" name="site_top_notice" id="site_top_notice" class="form-control" value="{{ $generalSettings['site_top_notice'] }}" required>
                                <div class="form-help">Updates the safety warning notice displayed in the top green banner on every public page.</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="site_support_email">Official Support Email</label>
                                    <input type="email" name="site_support_email" id="site_support_email" class="form-control" value="{{ $generalSettings['site_support_email'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="site_support_phone">Customer Helpline Phone</label>
                                    <input type="text" name="site_support_phone" id="site_support_phone" class="form-control" value="{{ $generalSettings['site_support_phone'] }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="site_whatsapp">Official WhatsApp Helpline</label>
                                    <input type="text" name="site_whatsapp" id="site_whatsapp" class="form-control" value="{{ $generalSettings['site_whatsapp'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="site_city_default">Default City</label>
                                    <input type="text" name="site_city_default" id="site_city_default" class="form-control" value="{{ $generalSettings['site_city_default'] }}">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 10px;">
                                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                                    <input type="checkbox" name="site_auto_approve_listings" value="1" {{ $generalSettings['site_auto_approve_listings'] === '1' ? 'checked' : '' }} style="width:18px;height:18px;accent-color:var(--admin-primary);">
                                    <span style="font-weight:700;font-size:14px;">Instant Publishing Mode (Automatically approve new pet ads without moderation review)</span>
                                </label>
                                <div class="form-help" style="margin-left: 28px;">Leave unchecked to keep the anti-scam review queue active.</div>
                            </div>

                            <div style="text-align: right; margin-top: 24px;">
                                <button type="submit" class="btn-admin btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Save Site Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <!-- MODAL: ADD CATEGORY -->
    <div id="addCategoryModal" class="admin-modal-backdrop">
        <div class="admin-modal">
            <div class="admin-modal-header">
                <h3>Add New Category</h3>
                <button type="button" onclick="closeModal('addCategoryModal')" style="background:none;border:none;font-size:18px;cursor:pointer;color:#64748B;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="admin-modal-body">
                    <div class="form-group">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Parrots &amp; Macaws" required oninput="document.getElementById('catSlugInput').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')">
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL Slug</label>
                        <input type="text" name="slug" id="catSlugInput" class="form-control" placeholder="e.g. parrots-macaws">
                        <div class="form-help">Clean path: /category/your-slug</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="fa-solid fa-paw" placeholder="fa-solid fa-crow">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="10">
                    </div>
                    <div class="form-group">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="is_active" value="1" checked style="accent-color:var(--admin-primary);width:16px;height:16px;">
                            <span style="font-weight:600;font-size:14px;">Active &amp; Visible immediately</span>
                        </label>
                    </div>
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="btn-admin btn-admin-secondary" onclick="closeModal('addCategoryModal')">Cancel</button>
                    <button type="submit" class="btn-admin btn-admin-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT CATEGORY -->
    <div id="editCategoryModal" class="admin-modal-backdrop">
        <div class="admin-modal">
            <div class="admin-modal-header">
                <h3>Edit Category</h3>
                <button type="button" onclick="closeModal('editCategoryModal')" style="background:none;border:none;font-size:18px;cursor:pointer;color:#64748B;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                <div class="admin-modal-body">
                    <div class="form-group">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" id="editCatName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL Slug</label>
                        <input type="text" name="slug" id="editCatSlug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Icon Class</label>
                        <input type="text" name="icon" id="editCatIcon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" id="editCatOrder" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="is_active" id="editCatActive" value="1" style="accent-color:var(--admin-primary);width:16px;height:16px;">
                            <span style="font-weight:600;font-size:14px;">Active &amp; Visible</span>
                        </label>
                    </div>
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="btn-admin btn-admin-secondary" onclick="closeModal('editCategoryModal')">Cancel</button>
                    <button type="submit" class="btn-admin btn-admin-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD BREED -->
    <div id="addBreedModal" class="admin-modal-backdrop">
        <div class="admin-modal">
            <div class="admin-modal-header">
                <h3>Add New Breed</h3>
                <button type="button" onclick="closeModal('addBreedModal')" style="background:none;border:none;font-size:18px;cursor:pointer;color:#64748B;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.breeds.store') }}" method="POST">
                @csrf
                <div class="admin-modal-body">
                    <div class="form-group">
                        <label class="form-label">Parent Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Breed Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Siberian Husky" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" rows="2" class="form-control" placeholder="Short description for SEO"></textarea>
                    </div>
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="btn-admin btn-admin-secondary" onclick="closeModal('addBreedModal')">Cancel</button>
                    <button type="submit" class="btn-admin btn-admin-primary">Create Breed</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT LOGIC -->
    <script>
        // USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            if (sidebar) sidebar.classList.toggle('open');
        }

        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('show');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.remove('show');
        }

        function editCategory(id, name, slug, icon, sortOrder, isActive) {
            const form = document.getElementById('editCategoryForm');
            if (form) {
                form.action = '/admin/categories/' + id + '/update';
                document.getElementById('editCatName').value = name;
                document.getElementById('editCatSlug').value = slug;
                document.getElementById('editCatIcon').value = icon || '';
                document.getElementById('editCatOrder').value = sortOrder || 0;
                document.getElementById('editCatActive').checked = !!isActive;
                openModal('editCategoryModal');
            }
        }

        function updateGooglePreview() {
            const titleInput = document.getElementById('seo_meta_title');
            const descInput = document.getElementById('seo_meta_description');
            const previewTitle = document.getElementById('previewGoogleTitle');
            const previewSnippet = document.getElementById('previewGoogleSnippet');

            if (titleInput && previewTitle) {
                previewTitle.textContent = titleInput.value || 'Pet Marketplace Pakistan';
            }
            if (descInput && previewSnippet) {
                previewSnippet.textContent = descInput.value || 'Discover verified dogs, cats, birds, and pets from trusted sellers across Pakistan.';
            }
        }

        // USER PROMPT: "yr idher robot tag do roebot text ni"
        function updateRobotsPreview(val) {
            const badge = document.getElementById('robotsMetaTagBadge');
            if (badge) {
                badge.textContent = '<meta name="robots" content="' + val + '">';
            }
        }

        function focusRobotsTag() {
            const el = document.getElementById('seo_robots');
            if (el) {
                el.focus();
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        // Close modal on backdrop click
        document.querySelectorAll('.admin-modal-backdrop').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
