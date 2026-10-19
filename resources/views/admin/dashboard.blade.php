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
            {{-- USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai" --}}
            <li class="admin-nav-item {{ $tab === 'hero' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}">
                    <span class="nav-left"><i class="fa-solid fa-wand-magic-sparkles"></i> Homepage Hero</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
            <li class="admin-nav-item {{ $tab === 'hero_filters' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}">
                    <span class="nav-left"><i class="fa-solid fa-sliders"></i> Hero Search Filters</span>
                    <span class="nav-pill">Sync</span>
                </a>
            </li>
            {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
            <li class="admin-nav-item {{ $tab === 'home_categories' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}">
                    <span class="nav-left"><i class="fa-solid fa-shapes"></i> Homepage Categories</span>
                    <span class="nav-pill">Home</span>
                </a>
            </li>
            {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
            <li class="admin-nav-item {{ $tab === 'home_cta' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'home_cta']) }}">
                    <span class="nav-left"><i class="fa-solid fa-bullhorn"></i> Promo CTA Banner</span>
                    <span class="nav-pill">Home</span>
                </a>
            </li>
            <li class="admin-nav-item {{ $tab === 'home_locations' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'home_locations']) }}">
                    <span class="nav-left"><i class="fa-solid fa-location-crosshairs"></i> Location Cards</span>
                    <span class="nav-pill">Home</span>
                </a>
            </li>
            {{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
            <li class="admin-nav-item {{ $tab === 'category_hero' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'category_hero']) }}">
                    <span class="nav-left"><i class="fa-solid fa-shapes"></i> Category Hero</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            {{-- USER PROMPT: "ya admin pannel home page main ya section dynamic kro" --}}
            <li class="admin-nav-item {{ $tab === 'safety' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}">
                    <span class="nav-left"><i class="fa-solid fa-shield-halved"></i> Safety &amp; Trust</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            {{-- USER PROMPT: "footer to dynamic kro" --}}
            <li class="admin-nav-item {{ $tab === 'footer' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}">
                    <span class="nav-left"><i class="fa-solid fa-shoe-prints"></i> Dynamic Footer</span>
                    <span class="nav-pill">Live</span>
                </a>
            </li>
            {{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
            <li class="admin-nav-item {{ $tab === 'about' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'about']) }}">
                    <span class="nav-left"><i class="fa-solid fa-circle-info"></i> About Us Page</span>
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
            {{-- USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly" --}}
            <li class="admin-nav-item {{ $tab === 'featured_pets' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', ['tab' => 'featured_pets']) }}">
                    <span class="nav-left"><i class="fa-solid fa-star" style="color: #F59E0B;"></i> Featured Pets</span>
                    <span class="nav-pill" style="background: rgba(245, 158, 11, 0.15); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.3);">{{ $stats['featured_listings'] ?? 0 }}</span>
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
            {{-- USER PROMPT: "yr ya direct open ho rha hai login ni mang rha hai" --}}
            <a href="{{ route('admin.logout') }}" class="btn-sidebar-viewsite" style="color: #F87171; background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.25);">
                <i class="fa-solid fa-power-off"></i> Exit Admin Session (Logout)
            </a>
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
                    {{-- USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai" --}}
                    @elseif($tab === 'hero')
                        <h1>Homepage Hero Settings</h1>
                        <p>Customize hero headline, description, and visual image</p>
                    {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
                    @elseif($tab === 'hero_filters')
                        <h1>Hero &amp; Category Search Filters Engine</h1>
                        <p>Customize search filter labels, dynamic locations list, price ranges, and synchronize them live across Homepage and Category pages</p>
                    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
                    @elseif($tab === 'home_categories')
                        <h1>Homepage Pet Categories Section</h1>
                        <p>Customize section title, subtitle description, category display order, and circular pet icons</p>
                    {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
                    @elseif($tab === 'home_cta')
                        <h1>Homepage Promotional CTA Banner</h1>
                        <p>Customize promotional headline, subtitle, description, visual image, and direct action buttons</p>
                    @elseif($tab === 'home_locations')
                        <h1>Homepage Find Pets by Location</h1>
                        <p>Customize section title, subtitle, target cities list, card subtext, and all locations button</p>
                    {{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
                    @elseif($tab === 'category_hero')
                        <h1>Category Page Hero Banner Settings</h1>
                        <p>Customize category &amp; featured pet listings headline, description, and pets collage visual</p>
                    {{-- USER PROMPT: "ya admin pannel home page main ya section dynamic kro" --}}
                    @elseif($tab === 'safety')
                        <h1>Safety &amp; Responsible Pet Ownership Section</h1>
                        <p>Customize trust headline, highlighted subtitle, safety guidelines, and promotional illustration</p>
                    {{-- USER PROMPT: "footer to dynamic kro" --}}
                    @elseif($tab === 'footer')
                        <h1>Dynamic Marketplace Footer Settings</h1>
                        <p>Customize footer brand identity, logo, columns, contact channels, and social media links</p>
                    {{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
                    @elseif($tab === 'about')
                        <h1>About Us Page Dynamic Sections</h1>
                        <p>Customize Our Purpose, Marketplace Needs, and Safer Interactions with live visual preview</p>
                    @elseif($tab === 'seo')
                        <h1>Dynamic SEO &amp; Meta Tag Engine</h1>
                        <p>Configure search engine titles, open-graph cards, sitemaps, and indexing rules</p>
                    @elseif($tab === 'categories')
                        <h1>Dynamic Categories &amp; Breeds Management</h1>
                        <p>Control pet categories, breed taxonomies, active states, and custom slugs</p>
                    @elseif($tab === 'listings')
                        <h1>Platform Pet Inventory &amp; Moderation</h1>
                        <p>Review, verify, mark featured, and moderate listings across all cities</p>
                    {{-- USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly" --}}
                    @elseif($tab === 'featured_pets')
                        <h1>Featured Pets Management &amp; Highlight Showcase</h1>
                        <p>Select, feature, or un-feature any live pet listings to showcase them instantly on the marketplace homepage</p>
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
                {{-- USER PROMPT: "yr ya direct open ho rha hai login ni mang rha hai" --}}
                <a href="{{ route('admin.logout') }}" class="btn-admin-logout" title="Logout from Admin" style="display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: #FEE2E2; color: #DC2626; border: 1px solid #FCA5A5; border-radius: 20px; font-weight: 700; font-size: 12px; text-decoration: none; cursor: pointer; transition: all 0.2s;">
                    <i class="fa-solid fa-power-off"></i> Logout
                </a>
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

            {{-- USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly" --}}
            <!-- TAB: FEATURED PETS MANAGEMENT -->
            @elseif($tab === 'featured_pets')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'featured_pets']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-star" style="color: #F59E0B;"></i> Featured Pets Manager
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shapes"></i> Homepage Categories
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Homepage Hero
                    </a>
                    <a href="{{ route('featured.pets') }}" target="_blank" class="btn-admin btn-admin-secondary" style="margin-left: auto;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Public Featured Showcase
                    </a>
                </div>

                <!-- Stats Overview -->
                <div class="admin-stats-grid" style="margin-bottom: 24px;">
                    <div class="stat-card">
                        <div>
                            <div class="val" style="color: #F59E0B;">{{ $featuredPets->count() }}</div>
                            <div class="lbl">Currently Featured Pets</div>
                        </div>
                        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #F59E0B;"><i class="fa-solid fa-star"></i></div>
                    </div>
                    <div class="stat-card">
                        <div>
                            <div class="val">{{ $stats['live_listings'] }}</div>
                            <div class="lbl">Total Live Pets in Inventory</div>
                        </div>
                        <div class="stat-icon icon-green"><i class="fa-solid fa-paw"></i></div>
                    </div>
                    <div class="stat-card">
                        <div>
                            <div class="val" style="font-size: 18px; color: #10B981; margin-top: 4px;">Live on Homepage</div>
                            <div class="lbl">Instant Realtime Sync</div>
                        </div>
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-bolt"></i></div>
                    </div>
                </div>

                <!-- Section 1: Homepage Section Heading Settings -->
                <div class="admin-panel" style="margin-bottom: 24px;">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-pen-to-square" style="color: var(--admin-primary);"></i> Homepage "Featured Pets" Section Titles</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.featured_pets.section_update') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="featured_sec_title">Section Main Title</label>
                                    <input type="text" name="featured_sec_title" id="featured_sec_title" class="form-control" value="{{ $featuredSecSettings['featured_sec_title'] }}" placeholder="Featured Pets" required>
                                    <div class="form-help">Displayed as the main heading on the homepage (default: <code>Featured Pets</code>).</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="featured_sec_subtitle">Section Subtitle Description</label>
                                    <input type="text" name="featured_sec_subtitle" id="featured_sec_subtitle" class="form-control" value="{{ $featuredSecSettings['featured_sec_subtitle'] }}" placeholder="Highlighted pet listings from sellers on the marketplace.">
                                    <div class="form-help">Short text description under the headline.</div>
                                </div>
                            </div>
                            <div style="text-align: right; margin-top: 10px;">
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Section Heading
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Section 2: Currently Featured Pets -->
                <div class="admin-panel" style="margin-bottom: 28px;">
                    <div class="panel-head" style="border-bottom: 1px solid var(--admin-border); padding-bottom: 16px;">
                        <div>
                            <h2><i class="fa-solid fa-star" style="color: #F59E0B;"></i> Currently Featured Pets ({{ $featuredPets->count() }})</h2>
                            <p style="margin: 4px 0 0; font-size: 13px; color: var(--admin-text-muted);">These pets are currently pinned and showcased at the top of the homepage and in the Featured Pets filter.</p>
                        </div>
                    </div>

                    @if($featuredPets->isEmpty())
                        <div style="text-align: center; padding: 48px 24px; background: #FAF8F5; border-radius: 12px; margin: 20px; border: 1.5px dashed #CBD5E1;">
                            <i class="fa-solid fa-star" style="font-size: 36px; color: #CBD5E1; margin-bottom: 14px; display: inline-block;"></i>
                            <h3 style="font-size: 18px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">No Pets Featured Yet</h3>
                            {{-- USER PROMPT: "yr pets errow sy open ho or oper text ho english main urdu main ni" --}}
                            <p style="font-size: 14px; color: #64748B; max-width: 520px; margin: 0 auto 18px; line-height: 1.5;">
                                No pet listings are currently marked as featured. Choose and feature any pet listing from the live marketplace inventory below to showcase it prominently on the homepage.
                            </p>
                            <button type="button" onclick="openAvailablePetsSection()" class="btn-admin btn-admin-primary" style="background: #147A4D; color: white; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; padding: 12px 24px; border-radius: 10px; cursor: pointer; border: none; font-weight: 700; box-shadow: 0 4px 12px rgba(20, 122, 77, 0.25); transition: all 0.2s;">
                                <i class="fa-solid fa-arrow-down" id="heroArrowIcon" style="font-size: 14px; transition: transform 0.3s ease;"></i> Open Live Pets to Feature
                            </button>
                        </div>
                    @else
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Pet Details</th>
                                        <th>Seller</th>
                                        <th>Price</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Featured Order</th>
                                        <th style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($featuredPets as $fPet)
                                        <tr>
                                            <td>
                                                <div style="display:flex; align-items:center; gap:12px;">
                                                    <img src="{{ $fPet->primary_image_url }}" alt="{{ $fPet->title }}" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:1px solid #E2E8F0;">
                                                    <div>
                                                        <a href="{{ route('pet.details', ['slug' => $fPet->slug ?: $fPet->id]) }}" target="_blank" style="font-weight:700;color:var(--admin-text-main);text-decoration:none;">{{ $fPet->title }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:11px;color:#94A3B8;margin-left:3px;"></i></a>
                                                        <div style="font-size:12px;color:var(--admin-text-muted);">
                                                            {{ $fPet->category ? $fPet->category->name : 'Pet' }} • {{ $fPet->breed_name ?: ($fPet->breed ? $fPet->breed->name : 'N/A') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $fPet->user ? $fPet->user->name : 'N/A' }}</strong>
                                                <div style="font-size:12px;color:var(--admin-text-muted);">{{ $fPet->user ? ($fPet->user->phone ?: $fPet->user->email) : '' }}</div>
                                            </td>
                                            <td><strong style="color: #147A4D;">{{ $fPet->formatted_price }}</strong></td>
                                            <td>{{ $fPet->city }}</td>
                                            <td>
                                                @if($fPet->status === 'live')
                                                    <span class="badge badge-live">Live</span>
                                                @else
                                                    <span class="badge badge-sold">{{ ucfirst($fPet->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge" style="background: rgba(245, 158, 11, 0.15); color: #B45309; border: 1px solid rgba(245, 158, 11, 0.3);">
                                                    <i class="fa-solid fa-star"></i> Featured
                                                </span>
                                            </td>
                                            <td style="text-align: right;">
                                                <div style="display:inline-flex; gap:8px; align-items: center;">
                                                    <a href="{{ route('pet.details', ['slug' => $fPet->slug ?: $fPet->id]) }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm" title="Open Pet Details in New Tab" style="display:inline-flex;align-items:center;gap:4px;">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open
                                                    </a>
                                                    <form action="{{ route('admin.listings.featured', ['id' => $fPet->id]) }}" method="POST" onsubmit="return confirm('Remove this pet from the Featured section on the homepage?');">
                                                        @csrf
                                                        <input type="hidden" name="redirect_tab" value="featured_pets">
                                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm" style="display: inline-flex; align-items: center; gap: 6px;">
                                                            <i class="fa-solid fa-trash-can"></i> Remove from Featured
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- USER PROMPT: "yr ya jb feature main a gy hai to nichay waly main abhi q ha oper walay sy hi un feature ho" --}}
                <!-- Section 3: Add Pets to Featured (Choose from Live Listings) -->
                <div class="admin-panel" id="available-pets-section" style="scroll-margin-top: 100px;">
                    <div class="panel-head" style="flex-wrap: wrap; gap: 14px; cursor: pointer;" onclick="toggleAvailablePetsSection()">
                        <div>
                            <h2>
                                <i class="fa-solid fa-paw" style="color: var(--admin-primary);"></i> Choose Live Pets to Feature ({{ $availableLivePets->total() }})
                                <i class="fa-solid fa-chevron-down" id="petsChevron" style="font-size: 14px; margin-left: 8px; color: var(--admin-text-muted); transition: transform 0.3s ease;"></i>
                            </h2>
                            <p style="margin: 4px 0 0; font-size: 13px; color: var(--admin-text-muted);">Live pets available to feature. Click <strong>"Feature This Pet"</strong> to add it to the Featured showcase above.</p>
                        </div>

                        <!-- Search & Filter Form -->
                        <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;" onclick="event.stopPropagation();">
                            <input type="hidden" name="tab" value="featured_pets">
                            
                            <select name="featured_cat" class="form-control" style="width: 170px; padding: 8px 12px; font-size: 13px;">
                                <option value="all">All Categories</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ request('featured_cat') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>

                            <input type="text" name="featured_q" value="{{ request('featured_q') }}" placeholder="Search title, breed, city, seller..." class="form-control" style="width: 240px; padding: 8px 12px; font-size: 13px;">
                            
                            <button type="submit" class="btn-admin btn-admin-primary btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i> Filter
                            </button>

                            @if(request('featured_q') || (request('featured_cat') && request('featured_cat') !== 'all'))
                                <a href="{{ route('admin.dashboard', ['tab' => 'featured_pets']) }}" class="btn-admin btn-admin-secondary btn-sm" title="Clear Filters">
                                    <i class="fa-solid fa-xmark"></i> Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    <div id="availablePetsBody">
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Pet Listing</th>
                                        <th>Category &amp; Breed</th>
                                        <th>Seller</th>
                                        <th>Price</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($availableLivePets as $item)
                                        <tr>
                                            <td>
                                                <div style="display:flex; align-items:center; gap:12px;">
                                                    <img src="{{ $item->primary_image_url }}" alt="{{ $item->title }}" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:1px solid #E2E8F0;">
                                                    <div>
                                                        <a href="{{ route('pet.details', ['slug' => $item->slug ?: $item->id]) }}" target="_blank" style="font-weight:700;color:var(--admin-text-main);text-decoration:none;">{{ $item->title }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:11px;color:#94A3B8;margin-left:3px;"></i></a>
                                                        <div style="font-size:12px;color:var(--admin-text-muted);">Listed: {{ $item->created_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $item->category ? $item->category->name : 'N/A' }}</strong>
                                                <div style="font-size:12px;color:var(--admin-text-muted);">{{ $item->breed_name ?: ($item->breed ? $item->breed->name : 'N/A') }}</div>
                                            </td>
                                            <td>
                                                <strong>{{ $item->user ? $item->user->name : 'N/A' }}</strong>
                                                <div style="font-size:12px;color:var(--admin-text-muted);">{{ $item->user ? ($item->user->phone ?: $item->user->email) : '' }}</div>
                                            </td>
                                            <td><strong style="color: #147A4D;">{{ $item->formatted_price }}</strong></td>
                                            <td>{{ $item->city }}</td>
                                            <td>
                                                <span class="badge badge-sold"><i class="fa-regular fa-star"></i> Not Featured</span>
                                            </td>
                                            <td style="text-align: right;">
                                                <div style="display:inline-flex; gap:8px; align-items:center;">
                                                    <a href="{{ route('pet.details', ['slug' => $item->slug ?: $item->id]) }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm" title="Open Pet Details in New Tab" style="display:inline-flex;align-items:center;gap:4px;">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open
                                                    </a>
                                                    <form action="{{ route('admin.listings.featured', ['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="redirect_tab" value="featured_pets">
                                                        <button type="submit" class="btn-admin btn-sm" style="background: #10B981; color: #FFFFFF; border: none; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                                                            <i class="fa-solid fa-star" style="color: #FEF08A;"></i> Feature This Pet
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align:center;padding:36px;color:var(--admin-text-muted);">
                                                No live pet listings matching your search filter.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($availableLivePets->hasPages())
                            <div style="padding:16px 24px; border-top: 1px solid var(--admin-border);">
                                {{ $availableLivePets->links() }}
                            </div>
                        @endif
                    </div>
                </div>

            <!-- TAB: HOMEPAGE HERO (HEADLINE, TEXT & IMAGE ONLY) -->
            {{-- USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai" --}}
            @elseif($tab === 'hero')
                {{-- USER PROMPT: "ya admin pannel home page main ya section dynamic kro" --}}
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-sliders"></i> 2. Hero Search Filters
                    </a>
                    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shapes"></i> 3. Browse by Category
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 4. Safety &amp; Responsible Section
                    </a>
                    {{-- USER PROMPT: "footer to dynamic kro" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 5. Dynamic Footer
                    </a>
                </div>

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

                        <!-- Mini Search Bar Simulation (Synchronized with Hero Search Filters) -->
                        {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
                        <div style="margin-top: 20px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 12px 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; box-shadow: 0 4px 14px rgba(0,0,0,0.04);">
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-paw"></i> {{ $heroFilterSettings['filter_cat_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroFilterSettings['filter_cat_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-dna"></i> {{ $heroFilterSettings['filter_breed_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroFilterSettings['filter_breed_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-location-dot"></i> {{ $heroFilterSettings['filter_loc_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroFilterSettings['filter_loc_placeholder'] }}</div>
                            </div>
                            <div style="flex: 1; min-width: 120px; padding: 6px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <div style="font-size: 10px; font-weight: 700; color: var(--admin-primary);"><i class="fa-solid fa-tag"></i> {{ $heroFilterSettings['filter_price_label'] }}</div>
                                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $heroFilterSettings['filter_price_placeholder'] }}</div>
                            </div>
                            <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-primary btn-sm" style="padding: 10px 18px; border-radius: 8px; text-decoration: none;">
                                <i class="fa-solid fa-sliders"></i> Edit Filters
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Hero Headline, Text & Image Settings Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Hero Text &amp; Visual Image Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Hero Main Headline Title -->
                            <div class="form-group">
                                <label class="form-label" for="hero_title">Hero Main Headline Title</label>
                                <input type="text" name="hero_title" id="hero_title" class="form-control" value="{{ strip_tags($heroSettings['hero_title']) }}" placeholder="Find the right pet for your family." required>
                                <div class="form-help">Main hero headline displayed prominently on homepage (Plain text only, no HTML tags).</div>
                            </div>

                            <!-- Hero Subtitle Description -->
                            <div class="form-group">
                                <label class="form-label" for="hero_desc">Hero Subtitle Description</label>
                                <textarea name="hero_desc" id="hero_desc" rows="3" class="form-control" required>{{ $heroSettings['hero_desc'] }}</textarea>
                                <div class="form-help">Subtitle narrative guiding visitors to browse pets, breeds, and trusted sellers.</div>
                            </div>

                            {{-- USER PROMPT: "yr image ka aik do" --}}
                            <!-- Single Hero Visual Image Upload -->
                            <div class="form-group">
                                <label class="form-label" for="hero_image">Hero Visual Image</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 72px; height: 72px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06);">
                                        <img id="heroImagePreview" src="{{ asset($heroSettings['hero_image']) }}" alt="Current Hero Image" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/home-hero-image.png') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*" onchange="previewHeroImage(this)">
                                        <div class="form-help">Upload a PNG, JPG, or WEBP image file to change the hero visual. Current: <code>{{ $heroSettings['hero_image'] }}</code></div>
                                    </div>
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border);">
                                <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Hero Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: HERO & CATEGORY SEARCH FILTERS ENGINE -->
            {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
            @elseif($tab === 'hero_filters')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-sliders"></i> 2. Hero Search Filters
                    </a>
                    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shapes"></i> 3. Browse by Category
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 4. Safety &amp; Trust
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 5. Dynamic Footer
                    </a>
                </div>

                <!-- Two-Way Live Synchronization Notice -->
                <div style="background: linear-gradient(135deg, #EBF5F0 0%, #E3EFE9 100%); border-left: 4px solid var(--admin-primary); border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(20, 121, 74, 0.12); color: var(--admin-primary); display: flex; align-items: center; justify-content: center; font-size: 20px;">
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </div>
                        <div>
                            <strong style="color: #14794A; font-size: 14px; display: block;">Real-Time Two-Way Filter Synchronization Active</strong>
                            <span style="font-size: 13px; color: #4B5563;">
                                Updating filter titles, placeholders, locations, or price ranges here automatically syncs across the 
                                <strong>Homepage Floating Search Bar</strong> and the <strong>Category Page Top Search &amp; Sidebar Filters</strong> simultaneously.
                            </span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> View Homepage
                        </a>
                        <a href="{{ route('category') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> View Category Page
                        </a>
                    </div>
                </div>

                <!-- Live Search Bar Simulation (Floating Hero Design Preview) -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Floating Search Bar Preview</h2>
                            <span class="nav-pill" style="background: var(--admin-primary); color: #fff;">Synchronized Live</span>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 14px 18px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                            <!-- Filter 1: Category -->
                            <div style="flex: 1; min-width: 140px; padding: 8px 14px; background: #F8FAFC; border-radius: 10px; border: 1px solid #E2E8F0; display:flex; gap:10px; align-items:center;">
                                <i class="fa-solid fa-paw" style="color: #14794A; font-size: 18px;"></i>
                                <div>
                                    <div style="font-size: 10px; font-weight: 700; color: #14794A; letter-spacing: 0.5px;">{{ $heroFilterSettings['filter_cat_label'] }}</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #1E293B;">{{ $heroFilterSettings['filter_cat_placeholder'] }}</div>
                                </div>
                            </div>

                            <!-- Filter 2: Breed -->
                            <div style="flex: 1; min-width: 140px; padding: 8px 14px; background: #F8FAFC; border-radius: 10px; border: 1px solid #E2E8F0; display:flex; gap:10px; align-items:center;">
                                <i class="fa-solid fa-dna" style="color: #14794A; font-size: 18px;"></i>
                                <div>
                                    <div style="font-size: 10px; font-weight: 700; color: #14794A; letter-spacing: 0.5px;">{{ $heroFilterSettings['filter_breed_label'] }}</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #1E293B;">{{ $heroFilterSettings['filter_breed_placeholder'] }}</div>
                                </div>
                            </div>

                            <!-- Filter 3: Location -->
                            <div style="flex: 1; min-width: 140px; padding: 8px 14px; background: #F8FAFC; border-radius: 10px; border: 1px solid #E2E8F0; display:flex; gap:10px; align-items:center;">
                                <i class="fa-solid fa-location-dot" style="color: #14794A; font-size: 18px;"></i>
                                <div>
                                    <div style="font-size: 10px; font-weight: 700; color: #14794A; letter-spacing: 0.5px;">{{ $heroFilterSettings['filter_loc_label'] }}</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #1E293B;">{{ $heroFilterSettings['filter_loc_placeholder'] }}</div>
                                </div>
                            </div>

                            <!-- Filter 4: Price -->
                            <div style="flex: 1; min-width: 140px; padding: 8px 14px; background: #F8FAFC; border-radius: 10px; border: 1px solid #E2E8F0; display:flex; gap:10px; align-items:center;">
                                <i class="fa-solid fa-tag" style="color: #14794A; font-size: 18px;"></i>
                                <div>
                                    <div style="font-size: 10px; font-weight: 700; color: #14794A; letter-spacing: 0.5px;">{{ $heroFilterSettings['filter_price_label'] }}</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #1E293B;">{{ $heroFilterSettings['filter_price_placeholder'] }}</div>
                                </div>
                            </div>

                            <!-- Search CTA Button -->
                            <button type="button" class="btn-admin btn-admin-primary" style="padding: 12px 22px; border-radius: 10px; pointer-events: none; font-weight: 700;">
                                <i class="fa-solid fa-magnifying-glass"></i> {{ $heroFilterSettings['filter_btn_text'] }}
                            </button>
                        </div>

                        <!-- Active Stats Badges Row -->
                        <div style="display: flex; gap: 12px; margin-top: 16px; flex-wrap: wrap;">
                            <span style="font-size: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; padding: 4px 10px; border-radius: 6px; color: #64748B;">
                                <i class="fa-solid fa-city" style="color: #14794A;"></i> <strong>{{ count($heroFilterSettings['locations_list']) }}</strong> Active Cities
                            </span>
                            <span style="font-size: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; padding: 4px 10px; border-radius: 6px; color: #64748B;">
                                <i class="fa-solid fa-tags" style="color: #14794A;"></i> <strong>{{ count($heroFilterSettings['price_ranges_list']) }}</strong> Price Brackets
                            </span>
                            <span style="font-size: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; padding: 4px 10px; border-radius: 6px; color: #64748B;">
                                <i class="fa-solid fa-layer-group" style="color: #14794A;"></i> <strong>{{ $stats['total_categories'] }}</strong> Categories &amp; <strong>{{ $stats['total_breeds'] }}</strong> Breeds
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Hero & Category Search Filters Configuration Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Configure Search Filters &amp; Synchronization Engine</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.hero_filters.update') }}" method="POST">
                            @csrf

                            <!-- Section A: Filter Labels & Placeholders -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-heading" style="color: var(--admin-primary);"></i> 1. Filter Labels &amp; Default Placeholders
                                </h3>
                                
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px;">
                                    <!-- Category Filter -->
                                    <div style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: var(--admin-primary); margin-bottom: 8px;"><i class="fa-solid fa-paw"></i> Filter 1: Pet Category</div>
                                        <div class="form-group" style="margin-bottom: 8px;">
                                            <label class="form-label" style="font-size: 11px;">Heading Label</label>
                                            <input type="text" name="filter_cat_label" class="form-control" value="{{ $heroFilterSettings['filter_cat_label'] }}" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" style="font-size: 11px;">Default / Empty Option Text</label>
                                            <input type="text" name="filter_cat_placeholder" class="form-control" value="{{ $heroFilterSettings['filter_cat_placeholder'] }}" required>
                                        </div>
                                    </div>

                                    <!-- Breed Filter -->
                                    <div style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: var(--admin-primary); margin-bottom: 8px;"><i class="fa-solid fa-dna"></i> Filter 2: Breed</div>
                                        <div class="form-group" style="margin-bottom: 8px;">
                                            <label class="form-label" style="font-size: 11px;">Heading Label</label>
                                            <input type="text" name="filter_breed_label" class="form-control" value="{{ $heroFilterSettings['filter_breed_label'] }}" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" style="font-size: 11px;">Default / Empty Option Text</label>
                                            <input type="text" name="filter_breed_placeholder" class="form-control" value="{{ $heroFilterSettings['filter_breed_placeholder'] }}" required>
                                        </div>
                                    </div>

                                    <!-- Location Filter -->
                                    <div style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: var(--admin-primary); margin-bottom: 8px;"><i class="fa-solid fa-location-dot"></i> Filter 3: Location</div>
                                        <div class="form-group" style="margin-bottom: 8px;">
                                            <label class="form-label" style="font-size: 11px;">Heading Label</label>
                                            <input type="text" name="filter_loc_label" class="form-control" value="{{ $heroFilterSettings['filter_loc_label'] }}" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" style="font-size: 11px;">Default / Empty Option Text</label>
                                            <input type="text" name="filter_loc_placeholder" class="form-control" value="{{ $heroFilterSettings['filter_loc_placeholder'] }}" required>
                                        </div>
                                    </div>

                                    <!-- Price Filter -->
                                    <div style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: var(--admin-primary); margin-bottom: 8px;"><i class="fa-solid fa-tag"></i> Filter 4: Price</div>
                                        <div class="form-group" style="margin-bottom: 8px;">
                                            <label class="form-label" style="font-size: 11px;">Heading Label</label>
                                            <input type="text" name="filter_price_label" class="form-control" value="{{ $heroFilterSettings['filter_price_label'] }}" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" style="font-size: 11px;">Default / Empty Option Text</label>
                                            <input type="text" name="filter_price_placeholder" class="form-control" value="{{ $heroFilterSettings['filter_price_placeholder'] }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Button Text -->
                                <div class="form-group" style="margin-top: 16px;">
                                    <label class="form-label" for="filter_btn_text">Search CTA Button Text</label>
                                    <input type="text" name="filter_btn_text" id="filter_btn_text" class="form-control" value="{{ $heroFilterSettings['filter_btn_text'] }}" required style="max-width: 320px;">
                                    <div class="form-help">Text on the green search button in Homepage Hero and Category Top Search card.</div>
                                </div>
                            </div>

                            <!-- Section B: Dynamic Locations / Cities Engine -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-city" style="color: var(--admin-primary);"></i> 2. Dynamic Locations &amp; Cities Engine (Synchronized with Category Page)
                                </h3>

                                <div class="form-group">
                                    <label class="form-label" for="hero_locations">Marketplace Locations List (Comma-Separated)</label>
                                    <textarea name="hero_locations" id="hero_locations" rows="3" class="form-control" required>{{ $heroFilterSettings['hero_locations'] }}</textarea>
                                    <div class="form-help">
                                        Enter city names separated by commas (e.g. <code>Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta</code>).
                                        These locations automatically populate the dropdown in <strong>Homepage Hero</strong> AND <strong>Category Page Top Search &amp; Sidebar</strong>.
                                    </div>
                                </div>

                                <!-- Active Resolved Cities Badges -->
                                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 12px 16px;">
                                    <div style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 8px;">
                                        Currently Active Locations ({{ count($heroFilterSettings['locations_list']) }} cities recognized):
                                    </div>
                                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                        @foreach($heroFilterSettings['locations_list'] as $city)
                                            <span style="font-size: 12px; background: #FFFFFF; border: 1px solid #CBD5E1; color: #334155; padding: 3px 9px; border-radius: 6px;">
                                                <i class="fa-solid fa-location-dot" style="color: #14794A; font-size: 10px;"></i> {{ $city }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Section C: Dynamic Price Ranges Configuration -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-tags" style="color: var(--admin-primary);"></i> 3. Dynamic Price Ranges (Synchronized with Category Quick Pills)
                                </h3>
                                <p style="font-size: 13px; color: #64748B; margin-bottom: 14px;">
                                    Configure price range brackets. Use <code>{curr}</code> in display labels to automatically render the active currency prefix (e.g. <code>Rs. </code> or <code>PKR </code>).
                                    These tiers will populate the Home Hero Price dropdown and provide quick-click filter pills on the Category page.
                                </p>

                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    @php
                                        $pTiers = $heroFilterSettings['price_ranges_list'];
                                    @endphp
                                    @foreach($pTiers as $idx => $tier)
                                        <div style="background: #FAF8F5; padding: 12px 16px; border-radius: 10px; border: 1px solid var(--admin-border); display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
                                            <div style="width: 70px; font-weight: 700; color: var(--admin-primary); font-size: 12px;">
                                                Tier {{ $idx + 1 }}
                                            </div>
                                            <div style="flex: 1; min-width: 120px;">
                                                <label class="form-label" style="font-size: 10px; margin-bottom: 2px;">Min Amount</label>
                                                <input type="number" name="price_ranges[{{ $idx }}][min]" class="form-control" value="{{ $tier['min'] }}" placeholder="0">
                                            </div>
                                            <div style="flex: 1; min-width: 120px;">
                                                <label class="form-label" style="font-size: 10px; margin-bottom: 2px;">Max Amount (leave blank for +)</label>
                                                <input type="number" name="price_ranges[{{ $idx }}][max]" class="form-control" value="{{ $tier['max'] }}" placeholder="e.g. 20000">
                                            </div>
                                            <div style="flex: 2; min-width: 200px;">
                                                <label class="form-label" style="font-size: 10px; margin-bottom: 2px;">Display Label (with {curr})</label>
                                                @php
                                                    $rawJson = $heroFilterSettings['hero_price_ranges'];
                                                    $decodedJson = is_string($rawJson) ? json_decode($rawJson, true) : null;
                                                    $rawLabel = (is_array($decodedJson) && isset($decodedJson[$idx]['label'])) ? $decodedJson[$idx]['label'] : $tier['label'];
                                                @endphp
                                                <input type="text" name="price_ranges[{{ $idx }}][label]" class="form-control" value="{{ $rawLabel }}" placeholder="e.g. Under {curr}20,000" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border); flex-wrap: wrap; gap: 12px;">
                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Homepage
                                    </a>
                                    <a href="{{ route('category') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Category Page
                                    </a>
                                </div>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-arrows-rotate"></i> Save &amp; Synchronize Filters
                                </button>
                            </div>

                        </form>
                    </div>
            <!-- TAB: HOMEPAGE BROWSE BY PET CATEGORY -->
            {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
            @elseif($tab === 'home_categories')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-sliders"></i> 2. Hero Search Filters
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-shapes"></i> 3. Browse by Category
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 4. Safety &amp; Trust
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 5. Dynamic Footer
                    </a>
                </div>

                <!-- Live Simulation Preview matching the user's exact homepage screenshot -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;flex-wrap:wrap;gap:12px;">
                            <div>
                                <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Homepage "Browse by Pet Category" Simulation</h2>
                                <p style="font-size: 12px; color: var(--admin-text-muted); margin: 2px 0 0;">This preview directly reflects the actual layout and active categories displayed on the public homepage</p>
                            </div>
                            <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Homepage
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 28px 24px; background: #FFFFFF; border-radius: 0 0 16px 16px;">
                        <!-- Front-End Simulation Container -->
                        <div style="max-width: 100%; margin: 0 auto;">
                            <h2 style="font-family: 'Outfit', -apple-system, sans-serif; font-size: 26px; font-weight: 700; color: #0F172A; margin: 0 0 6px; letter-spacing: -0.3px;">
                                {{ $homeCatSettings['home_cat_title'] }}
                            </h2>
                            <p style="font-size: 14px; color: #64748B; margin: 0 0 24px; line-height: 1.5;">
                                {{ $homeCatSettings['home_cat_subtitle'] }}
                            </p>

                            <!-- Circular Categories Horizontal Track -->
                            <div style="width: 100%; overflow-x: auto; padding: 12px 4px 18px; scrollbar-width: thin; -webkit-overflow-scrolling: touch;">
                                <div style="display: inline-flex; gap: 28px; width: max-content; align-items: flex-start;">
                                    @php
                                        $activeHomeCats = $categories->where('is_active', true)->sortBy('sort_order');
                                    @endphp
                                    @forelse($activeHomeCats as $cat)
                                        <div style="display: flex; flex-direction: column; align-items: center; width: 110px; text-align: center; position: relative;">
                                            <div style="width: 96px; height: 96px; border-radius: 50%; overflow: hidden; background: #F1F5F9; box-shadow: 0 6px 16px rgba(0,0,0,0.08); border: 3px solid #FFFFFF; transition: transform 0.2s ease, box-shadow 0.2s ease; display: flex; align-items: center; justify-content: center; position: relative;">
                                                <img src="{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}" alt="{{ $cat->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/cat_dog.jpg') }}'">
                                            </div>
                                            <div style="font-family: 'Outfit', sans-serif; font-size: 14px; font-weight: 700; color: #0F172A; margin-top: 10px; line-height: 1.2;">
                                                {{ $cat->name }}
                                            </div>
                                            <span style="font-size: 11px; color: var(--admin-primary); font-weight: 600; margin-top: 3px;">
                                                {{ $cat->active_listings_count }} ads
                                            </span>
                                        </div>
                                    @empty
                                        <div style="padding: 20px; color: #94A3B8; font-style: italic;">
                                            No active categories configured. Please activate at least one category below.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form: Section Headline & Subtitle Settings -->
                <div class="admin-panel" style="margin-bottom: 24px;">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-heading" style="color: var(--admin-primary);"></i> Section Headline &amp; Subtitle Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.home_categories.update') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="home_cat_title">Section Headline Title</label>
                                    <input type="text" name="home_cat_title" id="home_cat_title" class="form-control" value="{{ $homeCatSettings['home_cat_title'] }}" placeholder="Browse by Pet Category" required>
                                    <div class="form-help">Main heading displayed above the circular pet category icons on the homepage.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="home_cat_subtitle">Section Subtitle Description</label>
                                    <input type="text" name="home_cat_subtitle" id="home_cat_subtitle" class="form-control" value="{{ $homeCatSettings['home_cat_subtitle'] }}" placeholder="Start your search by choosing the type of companion you're looking for." required>
                                    <div class="form-help">Supporting instruction text guiding buyers to choose a pet companion.</div>
                                </div>
                            </div>
                            <div style="text-align: right; margin-top: 10px;">
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Section Text
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Pet Categories & Circular Images Inventory Panel -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <h2><i class="fa-solid fa-icons" style="color: var(--admin-primary);"></i> Pet Categories Inventory &amp; Circular Images ({{ $categories->count() }})</h2>
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button type="button" class="btn-admin btn-admin-primary btn-sm" onclick="openAddCategoryModalWithTab('home_categories')">
                                <i class="fa-solid fa-plus"></i> Add New Category
                            </button>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Circular Image</th>
                                    <th>Category Name</th>
                                    <th>Clean URL Slug</th>
                                    <th>Active Ads</th>
                                    <th>Homepage Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                    <tr>
                                        <td>
                                            <span style="font-weight: 800; font-size: 14px; color: var(--admin-text-main);">#{{ $cat->sort_order }}</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; background: #F1F5F9; border: 2px solid var(--admin-primary); box-shadow: 0 4px 10px rgba(0,0,0,0.06); flex-shrink: 0;">
                                                    <img src="{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}" alt="{{ $cat->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/cat_dog.jpg') }}'">
                                                </div>
                                                <form action="{{ route('admin.categories.image', ['id' => $cat->id]) }}" method="POST" enctype="multipart/form-data" style="margin: 0;">
                                                    @csrf
                                                    <input type="hidden" name="redirect_tab" value="home_categories">
                                                    <label class="btn-admin btn-admin-secondary btn-sm" style="cursor: pointer; padding: 5px 10px; font-size: 11px;" title="Upload new circular image for {{ $cat->name }}">
                                                        <i class="fa-solid fa-camera"></i> Change
                                                        <input type="file" name="image" accept="image/*" onchange="this.form.submit()" style="display: none;">
                                                    </label>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <i class="{{ $cat->icon ?: 'fa-solid fa-paw' }}" style="color: var(--admin-primary); font-size: 16px;"></i>
                                                <strong style="font-size: 15px; color: var(--admin-text-main);">{{ $cat->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('category', ['param1' => $cat->slug]) }}" target="_blank" style="text-decoration: none;">
                                                <code style="background: #F1F5F9; padding: 4px 8px; border-radius: 6px; color: #0F172A; font-size: 12px; font-weight: 600;">/category/{{ $cat->slug }}</code>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-live">{{ $cat->active_listings_count }} live ads</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories.toggle', ['id' => $cat->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="redirect_tab" value="home_categories">
                                                <button type="submit" class="badge {{ $cat->is_active ? 'badge-live' : 'badge-rejected' }}" style="border: none; cursor: pointer; padding: 6px 12px; font-size: 11px;" title="Click to toggle visibility on Homepage">
                                                    <i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $cat->is_active ? 'Visible on Home' : 'Hidden from Home' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 6px;">
                                                <button type="button" class="btn-admin btn-admin-secondary btn-sm" onclick="editCategoryWithImage({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ $cat->icon }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }}, '{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}', 'home_categories')">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                                @if($cat->listings_count == 0)
                                                    <form action="{{ route('admin.categories.delete', ['id' => $cat->id]) }}" method="POST" onsubmit="return confirm('Delete category {{ $cat->name }}?');" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="redirect_tab" value="home_categories">
                                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm" title="Delete category"><i class="fa-solid fa-trash"></i></button>
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

            <!-- TAB: HOMEPAGE PROMOTIONAL CTA BANNER -->
            {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
            @elseif($tab === 'home_cta')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-sliders"></i> 2. Hero Search Filters
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shapes"></i> 3. Browse by Category
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_cta']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-bullhorn"></i> 4. Promo CTA Banner
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_locations']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-location-crosshairs"></i> 5. Location Cards
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 6. Safety &amp; Trust
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 7. Dynamic Footer
                    </a>
                </div>

                <!-- Live Simulation Preview of Promo Banner -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;flex-wrap:wrap;gap:12px;">
                            <div>
                                <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Promotional CTA Banner Simulation</h2>
                                <p style="font-size: 12px; color: var(--admin-text-muted); margin: 2px 0 0;">Visual replica matching the public homepage promotional banner</p>
                            </div>
                            <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Homepage
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <!-- Front-End Banner Simulation Container -->
                        <div style="position: relative; width: 100%; min-height: 320px; background-color: #147A4D; border-radius: 20px; overflow: hidden; display: flex; align-items: center; justify-content: space-between; box-sizing: border-box; box-shadow: 0 12px 30px rgba(20, 122, 77, 0.2);">
                            <!-- Decorative Cream Shape -->
                            <div style="position: absolute; top: -140px; right: -100px; width: 680px; height: 580px; background-color: #FCEED5; border-radius: 99px; transform: rotate(25deg); z-index: 1;"></div>
                            
                            <!-- Left: Image Preview -->
                            <div style="position: relative; z-index: 2; width: 45%; height: 100%; display: flex; align-items: flex-end; justify-content: center; padding-top: 20px;">
                                <img src="{{ asset($homeCtaSettings['home_cta_image']) }}" alt="Banner Visual" style="max-width: 90%; max-height: 290px; object-fit: contain; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));" onerror="this.src='{{ asset('images/more-friend.png') }}'">
                            </div>

                            <!-- Right: Text & Buttons -->
                            <div style="position: relative; z-index: 2; width: 55%; padding: 30px 45px 30px 40px; text-align: left; box-sizing: border-box; display: flex; flex-direction: column; align-items: flex-start;">
                                <h1 style="margin: 0; font-family: 'Outfit', sans-serif; font-size: 32px; font-weight: 800; color: #000000; line-height: 1.15;">
                                    {{ $homeCtaSettings['home_cta_title'] }}
                                </h1>
                                <h2 style="margin: 6px 0 12px 0; font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 700; color: #161616; line-height: 1.2;">
                                    {{ $homeCtaSettings['home_cta_subtitle'] }}
                                </h2>
                                <p style="margin: 0 0 20px 0; font-size: 13px; font-weight: 400; line-height: 1.6; color: #242B33; max-width: 440px;">
                                    {{ $homeCtaSettings['home_cta_desc'] }}
                                </p>
                                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                                    <span style="display: inline-block; padding: 10px 22px; border-radius: 8px; font-weight: 600; font-size: 13px; background-color: #147A4D; color: #FFFFFF; border: 1px solid #147A4D;">
                                        {{ $homeCtaSettings['home_cta_btn1_text'] ?: 'Button 1' }}
                                    </span>
                                    <span style="display: inline-block; padding: 10px 22px; border-radius: 8px; font-weight: 600; font-size: 13px; background-color: #FCEED5; color: #147A4D; border: 1px solid #147A4D;">
                                        {{ $homeCtaSettings['home_cta_btn2_text'] ?: 'Button 2' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form: Promotional CTA Banner Configuration -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Promotional CTA Banner Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.home_cta.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section 1: Headlines & Copy -->
                            <div style="margin-bottom: 24px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-heading" style="color: var(--admin-primary);"></i> 1. Banner Headlines &amp; Description
                                </h3>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="home_cta_title">Primary Headline Title</label>
                                        <input type="text" name="home_cta_title" id="home_cta_title" class="form-control" value="{{ $homeCtaSettings['home_cta_title'] }}" placeholder="One More Friend" required>
                                        <div class="form-help">Large main title text (default: <code>One More Friend</code>).</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="home_cta_subtitle">Secondary Subtitle</label>
                                        <input type="text" name="home_cta_subtitle" id="home_cta_subtitle" class="form-control" value="{{ $homeCtaSettings['home_cta_subtitle'] }}" placeholder="Thousands More Fun!" required>
                                        <div class="form-help">Subtitle beneath the headline (default: <code>Thousands More Fun!</code>).</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="home_cta_desc">Banner Description Paragraph</label>
                                    <textarea name="home_cta_desc" id="home_cta_desc" rows="3" class="form-control" required>{{ $homeCtaSettings['home_cta_desc'] }}</textarea>
                                    <div class="form-help">Short text explaining the joy of adopting/buying pets on the platform.</div>
                                </div>
                            </div>

                            <!-- Section 2: Banner Visual / Image -->
                            <div style="margin-bottom: 24px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-image" style="color: var(--admin-primary);"></i> 2. Promotional Pet Visual Image
                                </h3>

                                <div style="display: flex; gap: 24px; align-items: center; background: #FAF8F5; padding: 18px; border-radius: 12px; border: 1px solid var(--admin-border); flex-wrap: wrap;">
                                    <div style="width: 100px; height: 100px; border-radius: 12px; background: #147A4D; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        <img src="{{ asset($homeCtaSettings['home_cta_image']) }}" alt="Current CTA Image" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.src='{{ asset('images/more-friend.png') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 260px;">
                                        <label class="form-label" for="home_cta_image">Upload New Visual Image (PNG / Transparent Recommended)</label>
                                        <input type="file" name="home_cta_image" id="home_cta_image" class="form-control" accept="image/*">
                                        <div class="form-help" style="margin-top: 6px;">
                                            Current image path: <code>{{ $homeCtaSettings['home_cta_image'] }}</code>. Transparent PNG gives the best result on the dark green background.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Action Buttons -->
                            <div style="margin-bottom: 24px;">
                                <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                    <i class="fa-solid fa-hand-pointer" style="color: var(--admin-primary);"></i> 3. Action Buttons &amp; Navigation Links
                                </h3>

                                <div class="form-row">
                                    <!-- Button 1 -->
                                    <div style="background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: #147A4D; margin-bottom: 10px; font-size: 13px;">
                                            <i class="fa-solid fa-square" style="color: #147A4D;"></i> Button 1 (Solid Dark Green)
                                        </div>
                                        <div class="form-group" style="margin-bottom: 12px;">
                                            <label class="form-label" for="home_cta_btn1_text">Button Label</label>
                                            <input type="text" name="home_cta_btn1_text" id="home_cta_btn1_text" class="form-control" value="{{ $homeCtaSettings['home_cta_btn1_text'] }}" placeholder="Browse Dogs" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" for="home_cta_btn1_link">Destination Link / URL</label>
                                            <input type="text" name="home_cta_btn1_link" id="home_cta_btn1_link" class="form-control" value="{{ $homeCtaSettings['home_cta_btn1_link'] }}" placeholder="/category/dogs" required>
                                            <div class="form-help">e.g. <code>/category/dogs</code> or <code>{{ route('category', ['param1' => 'dogs']) }}</code></div>
                                        </div>
                                    </div>

                                    <!-- Button 2 -->
                                    <div style="background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                        <div style="font-weight: 700; color: #B45309; margin-bottom: 10px; font-size: 13px;">
                                            <i class="fa-regular fa-square" style="color: #147A4D;"></i> Button 2 (Cream Outline)
                                        </div>
                                        <div class="form-group" style="margin-bottom: 12px;">
                                            <label class="form-label" for="home_cta_btn2_text">Button Label</label>
                                            <input type="text" name="home_cta_btn2_text" id="home_cta_btn2_text" class="form-control" value="{{ $homeCtaSettings['home_cta_btn2_text'] }}" placeholder="Browse Cats" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" for="home_cta_btn2_link">Destination Link / URL</label>
                                            <input type="text" name="home_cta_btn2_link" id="home_cta_btn2_link" class="form-control" value="{{ $homeCtaSettings['home_cta_btn2_link'] }}" placeholder="/category/cats" required>
                                            <div class="form-help">e.g. <code>/category/cats</code> or <code>{{ route('category', ['param1' => 'cats']) }}</code></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border); flex-wrap: wrap; gap: 12px;">
                                <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Public Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Promotional Banner Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: HOMEPAGE FIND PETS BY LOCATION -->
            {{-- USER PROMPT: "yr home page main in sections ko dynamic kro" --}}
            @elseif($tab === 'home_locations')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-sliders"></i> 2. Hero Search Filters
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_categories']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shapes"></i> 3. Browse by Category
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_cta']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-bullhorn"></i> 4. Promo CTA Banner
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'home_locations']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-location-crosshairs"></i> 5. Location Cards
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 6. Safety &amp; Trust
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 7. Dynamic Footer
                    </a>
                </div>

                <!-- Live Simulation Preview of Locations Grid -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;flex-wrap:wrap;gap:12px;">
                            <div>
                                <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live "Find Pets by Location" Simulation</h2>
                                <p style="font-size: 12px; color: var(--admin-text-muted); margin: 2px 0 0;">Visual replica matching the green location cards section on the homepage</p>
                            </div>
                            <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Homepage
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <!-- Deep Green Simulation Container -->
                        <div style="background-color: #0E6B40; border-radius: 20px; padding: 36px 30px; box-shadow: 0 12px 32px rgba(14, 107, 64, 0.25);">
                            <div style="margin-bottom: 28px;">
                                <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 700; color: #FFFFFF; margin: 0 0 8px;">
                                    {{ $homeLocSettings['loc_sec_title'] }}
                                </h2>
                                <p style="font-size: 14px; color: rgba(255, 255, 255, 0.85); margin: 0; max-width: 620px;">
                                    {{ $homeLocSettings['loc_sec_subtitle'] }}
                                </p>
                            </div>

                            @php
                                $previewCities = array_values(array_filter(array_map('trim', explode(',', $homeLocSettings['loc_sec_cities']))));
                            @endphp

                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 16px;">
                                @foreach($previewCities as $c)
                                    <div style="background: rgba(255, 255, 255, 0.08); border: 0.67px solid rgba(255, 255, 255, 0.1); border-top: 0.67px solid rgba(255, 255, 255, 0.72); border-radius: 14px; padding: 18px 20px; color: white; display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #FFFFFF; font-family: 'Manrope', sans-serif;">{{ $c }}</h3>
                                            <p style="font-size: 13px; font-weight: 500; margin: 4px 0 0; color: #EBEBEB;">{{ $homeLocSettings['loc_sec_card_subtext'] }}</p>
                                        </div>
                                        <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.85); font-size: 14px;"></i>
                                    </div>
                                @endforeach

                                @if(!empty($homeLocSettings['loc_sec_all_text']))
                                    <div style="background: rgba(255, 255, 255, 0.12); border: 0.67px solid rgba(255, 255, 255, 0.15); border-top: 0.67px solid rgba(255, 255, 255, 0.9); border-radius: 14px; padding: 18px 20px; color: white; display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <h3 style="font-size: 18px; font-weight: 700; margin: 0; color: #FFFFFF; font-family: 'Manrope', sans-serif;">{{ $homeLocSettings['loc_sec_all_text'] }}</h3>
                                            <p style="font-size: 13px; font-weight: 500; margin: 4px 0 0; color: #EBEBEB;">{{ $homeLocSettings['loc_sec_card_subtext'] }}</p>
                                        </div>
                                        <i class="fa-solid fa-arrow-right" style="color: #FFFFFF; font-size: 14px;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form: Location Cards Configuration -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Location Cards Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.home_locations.update') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="loc_sec_title">Section Headline Title</label>
                                    <input type="text" name="loc_sec_title" id="loc_sec_title" class="form-control" value="{{ $homeLocSettings['loc_sec_title'] }}" placeholder="Find Pets by Location" required>
                                    <div class="form-help">Main heading displayed above the cards (default: <code>Find Pets by Location</code>).</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="loc_sec_subtitle">Section Subtitle Description</label>
                                    <input type="text" name="loc_sec_subtitle" id="loc_sec_subtitle" class="form-control" value="{{ $homeLocSettings['loc_sec_subtitle'] }}" placeholder="Browse pets available in major cities..." required>
                                    <div class="form-help">Subtitle beneath the headline explaining the location section.</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="loc_sec_cities">Target Cities (Comma-Separated)</label>
                                <textarea name="loc_sec_cities" id="loc_sec_cities" rows="3" class="form-control" required>{{ $homeLocSettings['loc_sec_cities'] }}</textarea>
                                <div class="form-help">
                                    Enter city names separated by commas (e.g. <code>Lahore, Faisalabad, Multan, Sialkot, Karachi, Peshawar, Islamabad</code>).
                                    Each city listed will dynamically generate its own card on the homepage and redirect users to filtered listings in that city!
                                </div>
                            </div>

                            <!-- Currently Parsed Cities Badges -->
                            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;">
                                <div style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 8px;">
                                    Recognized Cities ({{ count($previewCities) }} cards will be generated):
                                </div>
                                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                    @foreach($previewCities as $c)
                                        <span style="font-size: 12px; background: #FFFFFF; border: 1px solid #CBD5E1; color: #0E6B40; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                            <i class="fa-solid fa-location-dot" style="font-size: 11px;"></i> {{ $c }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="loc_sec_card_subtext">Card Subtext / Action Line</label>
                                    <input type="text" name="loc_sec_card_subtext" id="loc_sec_card_subtext" class="form-control" value="{{ $homeLocSettings['loc_sec_card_subtext'] }}" placeholder="Browse listings" required>
                                    <div class="form-help">Short text inside each card under the city name (default: <code>Browse listings</code>).</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="loc_sec_all_text">Final Card Title (Links to all listings)</label>
                                    <input type="text" name="loc_sec_all_text" id="loc_sec_all_text" class="form-control" value="{{ $homeLocSettings['loc_sec_all_text'] }}" placeholder="All Locations">
                                    <div class="form-help">Label for the last card that opens the full catalog without city filters (default: <code>All Locations</code>). Leave blank to disable.</div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border); flex-wrap: wrap; gap: 12px;">
                                <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Public Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Location Cards Configuration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: CATEGORY PAGE HERO SETTINGS -->
            {{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
            @elseif($tab === 'category_hero')
                <!-- Quick Navigation Pills between Hero Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero
                    </a>
                    {{-- USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero_filters']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-sliders"></i> 2. Search Filters
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'category_hero']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-shapes"></i> 3. Category Page Hero
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 3. Safety &amp; Responsible
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 4. Dynamic Footer
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'about']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-circle-info"></i> 5. About Us Page
                    </a>
                </div>

                <!-- Live Simulation Preview of Category Hero Banner -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Category Page Hero Preview</h2>
                            <a href="{{ route('category') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Category Page
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <!-- Cream Hero Simulation Container matching #FAF7F2 -->
                        <div style="background: #FAF7F2; border: 1px solid #EADBCE; border-radius: 20px; padding: 40px 32px; display: flex; align-items: center; justify-content: space-between; gap: 32px; flex-wrap: wrap; box-shadow: 0 8px 24px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                            <!-- Left Text Simulation -->
                            <div style="flex: 1; min-width: 280px; max-width: 540px;">
                                <h1 style="font-family: 'Outfit', sans-serif; font-size: 34px; font-weight: 800; color: #111827; line-height: 1.2; margin: 0 0 14px;">
                                    {{ $categoryHeroSettings['category_hero_title'] }}
                                </h1>
                                <p style="font-size: 15px; color: #4B5563; line-height: 1.6; margin: 0;">
                                    {{ $categoryHeroSettings['category_hero_desc'] }}
                                </p>
                            </div>

                            <!-- Right Pets Collage Simulation -->
                            <div style="flex-shrink: 0; position: relative; display: flex; align-items: center; justify-content: center; min-width: 300px; height: 180px;">
                                <img src="{{ asset('images/Rectangle 5.svg') }}" style="position: absolute; right: 20px; bottom: 10px; width: 120px; pointer-events: none; opacity: 0.8;" alt="">
                                <img src="{{ asset('images/Rectangle 6.svg') }}" style="position: absolute; right: 50px; top: 10px; width: 100px; pointer-events: none; opacity: 0.8;" alt="">
                                <img src="{{ asset('images/Rectangle 7.svg') }}" style="position: absolute; left: 30px; bottom: 20px; width: 80px; pointer-events: none; opacity: 0.8;" alt="">
                                <img id="categoryHeroPetsSimulation" src="{{ asset($categoryHeroSettings['category_hero_image']) }}" alt="Pets Collage Preview" style="position: relative; z-index: 2; max-height: 170px; object-fit: contain;" onerror="this.src='{{ asset('images/category-hero-img.png') }}'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Hero Configuration Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Category Hero Banner Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.category_hero.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <!-- Main Title -->
                                <div class="form-group">
                                    <label class="form-label" for="category_hero_title">Primary Headline Title</label>
                                    <input type="text" name="category_hero_title" id="category_hero_title" class="form-control" value="{{ $categoryHeroSettings['category_hero_title'] }}" placeholder="Browse Pet Listings" required>
                                    <div class="form-help">Displayed on the main Category listings page (default: <code>Browse Pet Listings</code>).</div>
                                </div>

                                <!-- Featured Title -->
                                <div class="form-group">
                                    <label class="form-label" for="featured_hero_title">Featured View Headline Title</label>
                                    <input type="text" name="featured_hero_title" id="featured_hero_title" class="form-control" value="{{ $categoryHeroSettings['featured_hero_title'] }}" placeholder="Featured Pet Listings" required>
                                    <div class="form-help">Displayed when filtering by Featured Pets (default: <code>Featured Pet Listings</code>).</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Primary Description -->
                                <div class="form-group">
                                    <label class="form-label" for="category_hero_desc">Primary Subtitle Description</label>
                                    <textarea name="category_hero_desc" id="category_hero_desc" rows="3" class="form-control" required placeholder="Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.">{{ $categoryHeroSettings['category_hero_desc'] }}</textarea>
                                    <div class="form-help">Main narrative displayed underneath the headline.</div>
                                </div>

                                <!-- Featured Description -->
                                <div class="form-group">
                                    <label class="form-label" for="featured_hero_desc">Featured View Subtitle Description</label>
                                    <textarea name="featured_hero_desc" id="featured_hero_desc" rows="3" class="form-control" required placeholder="Discover premium and featured pet listings from top verified sellers.">{{ $categoryHeroSettings['featured_hero_desc'] }}</textarea>
                                    <div class="form-help">Subtitle displayed on the featured listings view.</div>
                                </div>
                            </div>

                            <!-- Single Image File Upload for Pets Collage -->
                            <div class="form-group">
                                <label class="form-label" for="category_hero_image">Pets Collage Visual Graphic</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 140px; height: 90px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #FAF7F2; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06); padding: 6px;">
                                        <img id="categoryHeroImagePreview" src="{{ asset($categoryHeroSettings['category_hero_image']) }}" alt="Current Pets Collage" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='{{ asset('images/category-hero-img.png') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="category_hero_image" id="category_hero_image" class="form-control" accept="image/*" onchange="previewCategoryHeroImage(this)">
                                        <div class="form-help">Upload PNG or WEBP with transparent background for the pets collage banner. Current: <code>{{ $categoryHeroSettings['category_hero_image'] }}</code></div>
                                    </div>
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border);">
                                <a href="{{ route('category') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Category Page
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Category Hero Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: SAFETY & RESPONSIBLE PET OWNERSHIP SECTION -->
            {{-- USER PROMPT: "ya admin pannel home page main ya section dynamic kro" --}}
            @elseif($tab === 'safety')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-shield-halved"></i> 2. Safety &amp; Responsible Section
                    </a>
                    {{-- USER PROMPT: "footer to dynamic kro" --}}
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shoe-prints"></i> 3. Dynamic Footer
                    </a>
                </div>

                <!-- Live Simulation Preview -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Safety &amp; Responsible Section Preview</h2>
                            <a href="{{ route('home') }}#safety" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Homepage
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <div style="display: flex; gap: 32px; align-items: center; flex-wrap: wrap;">
                            <!-- Preview Image -->
                            <div style="width: 140px; height: 140px; border-radius: 20px; overflow: hidden; background: #E2E8F0; display:flex; align-items:center; justify-content:center; flex-shrink: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.08);">
                                <img src="{{ asset($safetySettings['safety_image']) }}" alt="Safety Preview" style="width:100%; height:100%; object-fit: cover;" onerror="this.src='{{ asset('images/safety-responsible.png') }}'">
                            </div>

                            <!-- Preview Text & Title -->
                            <div style="flex: 1; min-width: 280px;">
                                <h2 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: #1E293B; line-height: 1.25; margin: 0 0 10px;">
                                    {{ $safetySettings['safety_title'] }} <br>
                                    <span style="color: #14794A;">{{ $safetySettings['safety_title_highlight'] }}</span>
                                </h2>
                                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0 0 16px;">
                                    <strong>{{ $safetySettings['safety_lead_bold'] }}</strong> {{ $safetySettings['safety_lead_text'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Preview Checklist Items -->
                        <div style="margin-top: 20px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 20px;">
                            <div style="font-size: 11px; font-weight: 700; color: var(--admin-primary); margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fa-solid fa-list-check"></i> Safety Checklist Rules Preview
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 10px;">
                                @php
                                    $previewPoints = array_values(array_filter(array_map('trim', explode("\n", $safetySettings['safety_points']))));
                                @endphp
                                @foreach($previewPoints as $p)
                                    <div style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: #334155;">
                                        <div style="width: 20px; height: 20px; border-radius: 50%; background: #DCFCE7; color: #15803D; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; flex-shrink: 0;">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <span>{{ $p }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety Section Settings Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Safety &amp; Responsible Pet Ownership Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.safety.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <!-- Title Line 1 -->
                                <div class="form-group">
                                    <label class="form-label" for="safety_title">Headline Title (Line 1)</label>
                                    <input type="text" name="safety_title" id="safety_title" class="form-control" value="{{ $safetySettings['safety_title'] }}" placeholder="Safety & Responsible" required>
                                    <div class="form-help">Main title header text (default: <code>Safety &amp; Responsible</code>).</div>
                                </div>

                                <!-- Title Highlight Line 2 -->
                                <div class="form-group">
                                    <label class="form-label" for="safety_title_highlight">Highlighted Title (Line 2 - Green)</label>
                                    <input type="text" name="safety_title_highlight" id="safety_title_highlight" class="form-control" value="{{ $safetySettings['safety_title_highlight'] }}" placeholder="Pet Ownership" required>
                                    <div class="form-help">Subtitle highlight displayed in green font (default: <code>Pet Ownership</code>).</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Bold Intro Lead -->
                                <div class="form-group">
                                    <label class="form-label" for="safety_lead_bold">Intro Lead Highlight (Bold)</label>
                                    <input type="text" name="safety_lead_bold" id="safety_lead_bold" class="form-control" value="{{ $safetySettings['safety_lead_bold'] }}" placeholder="We promote safe pet transactions" required>
                                    <div class="form-help">Opening sentence shown in bold weight.</div>
                                </div>

                                <!-- Lead Normal Text -->
                                <div class="form-group">
                                    <label class="form-label" for="safety_lead_text">Intro Lead Narrative Text</label>
                                    <input type="text" name="safety_lead_text" id="safety_lead_text" class="form-control" value="{{ $safetySettings['safety_lead_text'] }}" placeholder="and responsible ownership to help protect both pets and people." required>
                                    <div class="form-help">Continuation sentence following the bold highlight.</div>
                                </div>
                            </div>

                            <!-- Single Image Upload -->
                            <div class="form-group">
                                <label class="form-label" for="safety_image">Visual Promotional Image</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 72px; height: 72px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06);">
                                        <img id="safetyImagePreview" src="{{ asset($safetySettings['safety_image']) }}" alt="Current Safety Image" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/safety-responsible.png') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="safety_image" id="safety_image" class="form-control" accept="image/*" onchange="previewSafetyImage(this)">
                                        <div class="form-help">Upload a PNG, JPG, or WEBP image to change the safety illustration. Current: <code>{{ $safetySettings['safety_image'] }}</code></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Checklist Guidelines (One per line) -->
                            <div class="form-group">
                                <label class="form-label" for="safety_points">Safety Checklist Guidelines (One rule per line)</label>
                                <textarea name="safety_points" id="safety_points" rows="6" class="form-control" required placeholder="Verify the pet’s health and vaccination details before buying.&#10;Meet the seller and pet in a safe location.&#10;Never send advance payment without proper verification.&#10;Understand the pet’s food, care, medical, and exercise needs.&#10;Report suspicious or misleading listings.">{{ $safetySettings['safety_points'] }}</textarea>
                                <div class="form-help">Enter each safety bullet point on a separate line. Each line renders on the homepage with a green checkmark icon.</div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border);">
                                <a href="{{ route('home') }}#safety" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View on Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Safety Section Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: DYNAMIC MARKETPLACE FOOTER -->
            {{-- USER PROMPT: "footer to dynamic kro" --}}
            @elseif($tab === 'footer')
                <!-- Quick Navigation Pills between Homepage Sections -->
                <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <a href="{{ route('admin.dashboard', ['tab' => 'hero']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> 1. Homepage Hero Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'safety']) }}" class="btn-admin btn-admin-secondary">
                        <i class="fa-solid fa-shield-halved"></i> 2. Safety &amp; Responsible Section
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'footer']) }}" class="btn-admin btn-admin-primary">
                        <i class="fa-solid fa-shoe-prints"></i> 3. Dynamic Footer
                    </a>
                </div>

                <!-- Live Simulation Preview -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live Marketplace Footer Preview</h2>
                            <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live Website
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px;">
                        <!-- Styled dark container mirroring footer -->
                        <div style="background: #223129; border-radius: 20px; padding: 36px 32px 24px; color: #FFFFFF; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                            <img src="{{ asset('images/paw.png') }}" alt="Watermark Paw" style="position: absolute; right: 0; bottom: 0; width: 220px; opacity: 0.12; pointer-events: none;">

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 28px; position: relative; z-index: 2;">
                                <!-- Column 1 -->
                                <div>
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                                        <div style="width: 40px; height: 40px; background: #FFFFFF; border-radius: 10px; display: flex; align-items: center; justify-content: center; padding: 6px;">
                                            <img id="footerLogoSimulation" src="{{ asset($footerSettings['footer_brand_logo']) }}" alt="Footer Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='{{ asset('images/Italic-text.png') }}'">
                                        </div>
                                        <span style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 800; color: #FFFFFF;">{{ $footerSettings['footer_brand_title'] }}</span>
                                    </div>
                                    <p style="font-size: 13px; color: #CBD5E1; line-height: 1.6; margin: 0;">
                                        {{ $footerSettings['footer_brand_desc'] }}
                                    </p>
                                </div>

                                <!-- Column 2 -->
                                <div>
                                    <h4 style="font-size: 15px; font-weight: 700; color: #FFFFFF; margin: 0 0 14px;">{{ $footerSettings['footer_quick_links_title'] }}</h4>
                                    <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px; line-height: 2; color: #CBD5E1;">
                                        <li>Home</li>
                                        <li>About Us</li>
                                        <li>Contact Us</li>
                                        <li>Categories</li>
                                        <li>Breeds</li>
                                    </ul>
                                </div>

                                <!-- Column 3 -->
                                <div>
                                    <h4 style="font-size: 15px; font-weight: 700; color: #FFFFFF; margin: 0 0 14px;">{{ $footerSettings['footer_categories_title'] }}</h4>
                                    <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px; line-height: 2; color: #CBD5E1;">
                                        @php
                                            $previewCats = \App\Models\Category::where('is_active', true)->orderBy('sort_order', 'asc')->take(6)->get();
                                        @endphp
                                        @forelse($previewCats as $pc)
                                            <li>{{ $pc->name }}</li>
                                        @empty
                                            <li>Dogs</li>
                                            <li>Cats</li>
                                            <li>Birds</li>
                                            <li>Rabbits</li>
                                            <li>Fish</li>
                                            <li>Horses &amp; Farm</li>
                                        @endforelse
                                    </ul>
                                </div>

                                <!-- Column 4 -->
                                <div>
                                    <h4 style="font-size: 15px; font-weight: 700; color: #FFFFFF; margin: 0 0 14px;">{{ $footerSettings['footer_contact_title'] }}</h4>
                                    <div style="font-size: 13px; color: #CBD5E1; display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <i class="far fa-envelope" style="color: #6EE7B7;"></i>
                                            <span>{{ $footerSettings['footer_email'] }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <i class="fas fa-phone-alt" style="color: #6EE7B7;"></i>
                                            <span>{{ $footerSettings['footer_phone'] }}</span>
                                        </div>
                                    </div>
                                    <div style="font-size: 12px; font-weight: 700; color: #CBD5E1; margin-bottom: 8px;">{{ $footerSettings['footer_social_title'] }}</div>
                                    <div style="display: flex; gap: 8px;">
                                        <span style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.1); display: inline-flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 12px;"><i class="fab fa-facebook-f"></i></span>
                                        <span style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.1); display: inline-flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 12px;"><i class="fab fa-instagram"></i></span>
                                        <span style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.1); display: inline-flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 12px;"><i class="fab fa-youtube"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 24px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: #94A3B8; text-align: left;">
                                {{ $footerSettings['footer_copyright'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Configuration Form -->
                <div class="admin-panel">
                    <div class="panel-head">
                        <h2><i class="fa-solid fa-sliders" style="color: var(--admin-primary);"></i> Dynamic Footer Configuration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <!-- Brand Title -->
                                <div class="form-group">
                                    <label class="form-label" for="footer_brand_title">Brand / Platform Title</label>
                                    <input type="text" name="footer_brand_title" id="footer_brand_title" class="form-control" value="{{ $footerSettings['footer_brand_title'] }}" placeholder="Pet Marketplace" required>
                                    <div class="form-help">Main brand name displayed beside the logo in the footer.</div>
                                </div>

                                <!-- Copyright Notice -->
                                <div class="form-group">
                                    <label class="form-label" for="footer_copyright">Bottom Copyright Text</label>
                                    <input type="text" name="footer_copyright" id="footer_copyright" class="form-control" value="{{ $footerSettings['footer_copyright'] }}" placeholder="© 2026 Pet Marketplace. All rights reserved." required>
                                    <div class="form-help">Copyright notice shown at the very bottom bar.</div>
                                </div>
                            </div>

                            <!-- Brand Narrative Description -->
                            <div class="form-group">
                                <label class="form-label" for="footer_brand_desc">Brand / Company Description</label>
                                <textarea name="footer_brand_desc" id="footer_brand_desc" rows="3" class="form-control" required placeholder="A trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses in one safe and easy-to-use platform.">{{ $footerSettings['footer_brand_desc'] }}</textarea>
                                <div class="form-help">Short summary paragraph appearing below the footer logo.</div>
                            </div>

                            <!-- Footer Logo Upload -->
                            <div class="form-group">
                                <label class="form-label" for="footer_brand_logo">Footer Logo Graphic</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 72px; height: 72px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #223129; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06); padding: 8px;">
                                        <img id="footerLogoPreview" src="{{ asset($footerSettings['footer_brand_logo']) }}" alt="Current Footer Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='{{ asset('images/Italic-text.png') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="footer_brand_logo" id="footer_brand_logo" class="form-control" accept="image/*" onchange="previewFooterLogo(this)">
                                        <div class="form-help">Upload PNG, JPG, or SVG for footer logo. Current path: <code>{{ $footerSettings['footer_brand_logo'] }}</code></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Column Headings -->
                            <div class="form-row" style="grid-template-columns: repeat(3, 1fr);">
                                <div class="form-group">
                                    <label class="form-label" for="footer_quick_links_title">Column 2 Heading</label>
                                    <input type="text" name="footer_quick_links_title" id="footer_quick_links_title" class="form-control" value="{{ $footerSettings['footer_quick_links_title'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_categories_title">Column 3 Heading</label>
                                    <input type="text" name="footer_categories_title" id="footer_categories_title" class="form-control" value="{{ $footerSettings['footer_categories_title'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_contact_title">Column 4 Heading</label>
                                    <input type="text" name="footer_contact_title" id="footer_contact_title" class="form-control" value="{{ $footerSettings['footer_contact_title'] }}" required>
                                </div>
                            </div>

                            <!-- Contact Channels -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="footer_email">Support Email Address</label>
                                    <input type="email" name="footer_email" id="footer_email" class="form-control" value="{{ $footerSettings['footer_email'] }}" placeholder="Support@petmarket.com" required>
                                    <div class="form-help">Displayed with mail icon in footer.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_phone">Support Contact Number</label>
                                    <input type="text" name="footer_phone" id="footer_phone" class="form-control" value="{{ $footerSettings['footer_phone'] }}" placeholder="+92 3100865765" required>
                                    <div class="form-help">Displayed with phone icon in footer.</div>
                                </div>
                            </div>

                            <!-- Social Media Channels -->
                            <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr 1fr;">
                                <div class="form-group">
                                    <label class="form-label" for="footer_social_title">Social Section Title</label>
                                    <input type="text" name="footer_social_title" id="footer_social_title" class="form-control" value="{{ $footerSettings['footer_social_title'] }}" placeholder="Follow Us:" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_facebook_url"><i class="fab fa-facebook" style="color: #1877F2;"></i> Facebook URL</label>
                                    <input type="text" name="footer_facebook_url" id="footer_facebook_url" class="form-control" value="{{ $footerSettings['footer_facebook_url'] }}" placeholder="https://facebook.com/yourpage">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_instagram_url"><i class="fab fa-instagram" style="color: #E4405F;"></i> Instagram URL</label>
                                    <input type="text" name="footer_instagram_url" id="footer_instagram_url" class="form-control" value="{{ $footerSettings['footer_instagram_url'] }}" placeholder="https://instagram.com/yourprofile">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="footer_youtube_url"><i class="fab fa-youtube" style="color: #FF0000;"></i> YouTube URL</label>
                                    <input type="text" name="footer_youtube_url" id="footer_youtube_url" class="form-control" value="{{ $footerSettings['footer_youtube_url'] }}" placeholder="https://youtube.com/@yourchannel">
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border);">
                                <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live Homepage
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save Footer Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- TAB: ABOUT US DYNAMIC SECTIONS -->
            {{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
            @elseif($tab === 'about')
                <!-- Live Simulation Preview for About Us Sections -->
                <div class="admin-panel" style="margin-bottom: 24px; border-left: 4px solid var(--admin-primary); background: #FAF8F5;">
                    <div class="panel-head" style="background: transparent; border-bottom: 1px solid rgba(0,0,0,0.06);">
                        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                            <h2><i class="fa-solid fa-eye" style="color: var(--admin-primary);"></i> Live About Us Visual Simulation</h2>
                            <a href="{{ route('about') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Live About Page
                            </a>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 24px; display: flex; flex-direction: column; gap: 28px;">
                        <!-- Preview 1: Our Purpose -->
                        <div style="background: #FFFFFF; border-radius: 16px; padding: 24px; border: 1px solid #E2E8F0; display: flex; gap: 24px; align-items: center; flex-wrap: wrap;">
                            <div style="width: 220px; height: 160px; border-radius: 14px; overflow: hidden; background: #F1F5F9; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                                <img id="aboutPurposeSimulation" src="{{ asset($aboutSettings['about_purpose_image']) }}" alt="Purpose Preview" style="width:100%; height:100%; object-fit: cover;" onerror="this.src='{{ asset('images/about-purpose.jpg') }}'">
                            </div>
                            <div style="flex: 1; min-width: 260px;">
                                <div style="font-size: 11px; font-weight: 800; color: #14794A; letter-spacing: 0.8px; margin-bottom: 6px;">{{ $aboutSettings['about_purpose_badge'] }}</div>
                                <h3 style="font-size: 18px; font-weight: 800; color: #1E293B; margin: 0 0 10px; line-height: 1.3;">{{ $aboutSettings['about_purpose_title'] }}</h3>
                                <p style="font-size: 13px; color: #475569; margin: 0 0 8px; line-height: 1.5;">{{ Str::limit($aboutSettings['about_purpose_desc1'], 120) }}</p>
                                <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                                    @php
                                        $purposeList = array_values(array_filter(array_map('trim', explode("\n", $aboutSettings['about_purpose_points']))));
                                    @endphp
                                    @foreach(array_slice($purposeList, 0, 3) as $pt)
                                        <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 11px; background: #F0FDF4; color: #166534; padding: 4px 10px; border-radius: 20px; border: 1px solid #BBF7D0;">
                                            <i class="fa-solid fa-check" style="font-size: 10px;"></i> {{ Str::limit($pt, 45) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Preview 2: Marketplace Needs -->
                        <div style="background: #FFFDF9; border-radius: 16px; padding: 24px; border: 1px solid #FED7AA; display: flex; gap: 24px; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 260px;">
                                <h3 style="font-size: 18px; font-weight: 800; color: #1E293B; margin: 0 0 14px; line-height: 1.3;">{{ $aboutSettings['about_marketplace_title'] }}</h3>
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 10px;">
                                    <div style="background: #FFFFFF; padding: 10px; border-radius: 8px; border: 1px solid #E2E8F0;">
                                        <strong style="font-size: 12px; color: #0F172A; display: block;">{{ $aboutSettings['about_need_1_title'] }}</strong>
                                        <span style="font-size: 11px; color: #64748B;">{{ Str::limit($aboutSettings['about_need_1_desc'], 60) }}</span>
                                    </div>
                                    <div style="background: #FFFFFF; padding: 10px; border-radius: 8px; border: 1px solid #E2E8F0;">
                                        <strong style="font-size: 12px; color: #0F172A; display: block;">{{ $aboutSettings['about_need_2_title'] }}</strong>
                                        <span style="font-size: 11px; color: #64748B;">{{ Str::limit($aboutSettings['about_need_2_desc'], 60) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 220px; height: 160px; border-radius: 14px; overflow: hidden; background: #F1F5F9; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                                <img id="aboutMarketplaceSimulation" src="{{ asset($aboutSettings['about_marketplace_image']) }}" alt="Dogs Preview" style="width:100%; height:100%; object-fit: cover;" onerror="this.src='{{ asset('images/about-dogs.jpg') }}'">
                            </div>
                        </div>

                        <!-- Preview 3: Safer Interactions -->
                        <div style="background: #14794A; border-radius: 16px; padding: 24px; color: #FFFFFF; display: flex; gap: 24px; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 260px;">
                                <h3 style="font-size: 18px; font-weight: 800; color: #FFFFFF; margin: 0 0 10px;">{{ $aboutSettings['about_safer_title'] }}</h3>
                                <p style="font-size: 12px; color: #DCFCE7; margin: 0 0 12px; line-height: 1.5;">{{ Str::limit($aboutSettings['about_safer_desc'], 130) }}</p>
                                <div style="font-size: 11px; color: #FFFFFF; display: flex; flex-direction: column; gap: 6px;">
                                    @php
                                        $saferList = array_values(array_filter(array_map('trim', explode("\n", $aboutSettings['about_safer_points']))));
                                    @endphp
                                    @foreach(array_slice($saferList, 0, 2) as $spt)
                                        <span style="display: flex; align-items: center; gap: 6px;"><i class="fa-solid fa-check" style="color: #86EFAC;"></i> {{ $spt }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 8px; width: 240px; flex-shrink: 0;">
                                <div style="background: #FFFFFF; color: #0F172A; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; gap: 10px;">
                                    <i class="{{ $aboutSettings['about_safer_card_1_icon'] }}" style="color: #14794A;"></i>
                                    <div>
                                        <strong style="font-size: 12px; display: block;">{{ $aboutSettings['about_safer_card_1_title'] }}</strong>
                                        <span style="font-size: 10px; color: #64748B;">{{ Str::limit($aboutSettings['about_safer_card_1_desc'], 45) }}</span>
                                    </div>
                                </div>
                                <div style="background: #FFFFFF; color: #0F172A; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; gap: 10px;">
                                    <i class="{{ $aboutSettings['about_safer_card_2_icon'] }}" style="color: #14794A;"></i>
                                    <div>
                                        <strong style="font-size: 12px; display: block;">{{ $aboutSettings['about_safer_card_2_title'] }}</strong>
                                        <span style="font-size: 10px; color: #64748B;">{{ Str::limit($aboutSettings['about_safer_card_2_desc'], 45) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Us Configuration Form -->
                <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION 1 FORM CARD: OUR PURPOSE -->
                    <div class="admin-panel" style="margin-bottom: 24px;">
                        <div class="panel-head">
                            <h2><i class="fa-solid fa-bullseye" style="color: var(--admin-primary);"></i> Section 1: Our Purpose Configuration</h2>
                        </div>
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="about_purpose_badge">Badge Eyebrow Text</label>
                                    <input type="text" name="about_purpose_badge" id="about_purpose_badge" class="form-control" value="{{ $aboutSettings['about_purpose_badge'] }}" placeholder="OUR PURPOSE" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="about_purpose_title">Section Headline Title</label>
                                    <input type="text" name="about_purpose_title" id="about_purpose_title" class="form-control" value="{{ $aboutSettings['about_purpose_title'] }}" placeholder="A marketplace built around better information, not just listings." required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="about_purpose_desc1">Narrative Paragraph 1</label>
                                    <textarea name="about_purpose_desc1" id="about_purpose_desc1" rows="3" class="form-control" required>{{ $aboutSettings['about_purpose_desc1'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="about_purpose_desc2">Narrative Paragraph 2</label>
                                    <textarea name="about_purpose_desc2" id="about_purpose_desc2" rows="3" class="form-control" required>{{ $aboutSettings['about_purpose_desc2'] }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="about_purpose_points">Feature Checklist Points (One rule per line)</label>
                                <textarea name="about_purpose_points" id="about_purpose_points" rows="4" class="form-control" required>{{ $aboutSettings['about_purpose_points'] }}</textarea>
                                <div class="form-help">Each line creates a green checkmark feature bullet on the About Us page.</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="about_purpose_image">Section Visual Image (Frisbee Dog)</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 80px; height: 80px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06);">
                                        <img id="aboutPurposePreview" src="{{ asset($aboutSettings['about_purpose_image']) }}" alt="Current Purpose Image" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/about-purpose.jpg') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="about_purpose_image" id="about_purpose_image" class="form-control" accept="image/*" onchange="previewAboutPurposeImage(this)">
                                        <div class="form-help">Upload PNG, JPG, or WEBP image. Current: <code>{{ $aboutSettings['about_purpose_image'] }}</code></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2 FORM CARD: ONE MARKETPLACE FOR DIFFERENT NEEDS -->
                    <div class="admin-panel" style="margin-bottom: 24px;">
                        <div class="panel-head">
                            <h2><i class="fa-solid fa-users-viewfinder" style="color: var(--admin-primary);"></i> Section 2: One Marketplace for Different Needs</h2>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="form-label" for="about_marketplace_title">Section Headline Title</label>
                                <input type="text" name="about_marketplace_title" id="about_marketplace_title" class="form-control" value="{{ $aboutSettings['about_marketplace_title'] }}" placeholder="One marketplace for different pet-related needs." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="about_marketplace_image">Section Visual Image (Running Dogs)</label>
                                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap; background: #FAF8F5; padding: 16px; border-radius: 12px; border: 1px solid var(--admin-border);">
                                    <div style="width: 80px; height: 80px; border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.06);">
                                        <img id="aboutMarketplacePreview" src="{{ asset($aboutSettings['about_marketplace_image']) }}" alt="Current Dogs Image" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/about-dogs.jpg') }}'">
                                    </div>
                                    <div style="flex: 1; min-width: 240px;">
                                        <input type="file" name="about_marketplace_image" id="about_marketplace_image" class="form-control" accept="image/*" onchange="previewAboutMarketplaceImage(this)">
                                        <div class="form-help">Upload PNG, JPG, or WEBP image. Current: <code>{{ $aboutSettings['about_marketplace_image'] }}</code></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Need 1 -->
                                <div class="form-group">
                                    <label class="form-label" for="about_need_1_title">Item 1 Title</label>
                                    <input type="text" name="about_need_1_title" id="about_need_1_title" class="form-control" value="{{ $aboutSettings['about_need_1_title'] }}" required>
                                    <label class="form-label" for="about_need_1_desc" style="margin-top: 8px;">Item 1 Description</label>
                                    <textarea name="about_need_1_desc" id="about_need_1_desc" rows="2" class="form-control" required>{{ $aboutSettings['about_need_1_desc'] }}</textarea>
                                </div>

                                <!-- Need 2 -->
                                <div class="form-group">
                                    <label class="form-label" for="about_need_2_title">Item 2 Title</label>
                                    <input type="text" name="about_need_2_title" id="about_need_2_title" class="form-control" value="{{ $aboutSettings['about_need_2_title'] }}" required>
                                    <label class="form-label" for="about_need_2_desc" style="margin-top: 8px;">Item 2 Description</label>
                                    <textarea name="about_need_2_desc" id="about_need_2_desc" rows="2" class="form-control" required>{{ $aboutSettings['about_need_2_desc'] }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Need 3 -->
                                <div class="form-group">
                                    <label class="form-label" for="about_need_3_title">Item 3 Title</label>
                                    <input type="text" name="about_need_3_title" id="about_need_3_title" class="form-control" value="{{ $aboutSettings['about_need_3_title'] }}" required>
                                    <label class="form-label" for="about_need_3_desc" style="margin-top: 8px;">Item 3 Description</label>
                                    <textarea name="about_need_3_desc" id="about_need_3_desc" rows="2" class="form-control" required>{{ $aboutSettings['about_need_3_desc'] }}</textarea>
                                </div>

                                <!-- Need 4 -->
                                <div class="form-group">
                                    <label class="form-label" for="about_need_4_title">Item 4 Title</label>
                                    <input type="text" name="about_need_4_title" id="about_need_4_title" class="form-control" value="{{ $aboutSettings['about_need_4_title'] }}" required>
                                    <label class="form-label" for="about_need_4_desc" style="margin-top: 8px;">Item 4 Description</label>
                                    <textarea name="about_need_4_desc" id="about_need_4_desc" rows="2" class="form-control" required>{{ $aboutSettings['about_need_4_desc'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3 FORM CARD: SAFER INTERACTIONS -->
                    <div class="admin-panel" style="margin-bottom: 24px;">
                        <div class="panel-head">
                            <h2><i class="fa-solid fa-shield-halved" style="color: var(--admin-primary);"></i> Section 3: Safer Interactions Configuration</h2>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="form-label" for="about_safer_title">Green Card Headline Title</label>
                                <input type="text" name="about_safer_title" id="about_safer_title" class="form-control" value="{{ $aboutSettings['about_safer_title'] }}" placeholder="Safer interactions start with better information." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="about_safer_desc">Green Card Narrative Text</label>
                                <textarea name="about_safer_desc" id="about_safer_desc" rows="3" class="form-control" required>{{ $aboutSettings['about_safer_desc'] }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="about_safer_points">Safety Checklist Points (One rule per line)</label>
                                <textarea name="about_safer_points" id="about_safer_points" rows="4" class="form-control" required>{{ $aboutSettings['about_safer_points'] }}</textarea>
                                <div class="form-help">Renders inside the green box with white checkmark icons.</div>
                            </div>

                            <h3 style="font-size: 15px; font-weight: 700; color: #1E293B; margin: 24px 0 12px; padding-top: 16px; border-top: 1px solid var(--admin-border);">
                                <i class="fa-solid fa-id-card" style="color: var(--admin-primary);"></i> Right Feature Cards (3 Cards)
                            </h3>

                            <div class="form-row" style="grid-template-columns: repeat(3, 1fr);">
                                <!-- Card 1 -->
                                <div class="form-group" style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                    <label class="form-label" for="about_safer_card_1_title">Card 1 Title</label>
                                    <input type="text" name="about_safer_card_1_title" id="about_safer_card_1_title" class="form-control" value="{{ $aboutSettings['about_safer_card_1_title'] }}" required>
                                    <label class="form-label" for="about_safer_card_1_icon" style="margin-top: 8px;">FontAwesome Icon Class</label>
                                    <input type="text" name="about_safer_card_1_icon" id="about_safer_card_1_icon" class="form-control" value="{{ $aboutSettings['about_safer_card_1_icon'] }}" placeholder="fas fa-user-shield" required>
                                    <label class="form-label" for="about_safer_card_1_desc" style="margin-top: 8px;">Card 1 Description</label>
                                    <textarea name="about_safer_card_1_desc" id="about_safer_card_1_desc" rows="3" class="form-control" required>{{ $aboutSettings['about_safer_card_1_desc'] }}</textarea>
                                </div>

                                <!-- Card 2 -->
                                <div class="form-group" style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                    <label class="form-label" for="about_safer_card_2_title">Card 2 Title</label>
                                    <input type="text" name="about_safer_card_2_title" id="about_safer_card_2_title" class="form-control" value="{{ $aboutSettings['about_safer_card_2_title'] }}" required>
                                    <label class="form-label" for="about_safer_card_2_icon" style="margin-top: 8px;">FontAwesome Icon Class</label>
                                    <input type="text" name="about_safer_card_2_icon" id="about_safer_card_2_icon" class="form-control" value="{{ $aboutSettings['about_safer_card_2_icon'] }}" placeholder="fas fa-comments" required>
                                    <label class="form-label" for="about_safer_card_2_desc" style="margin-top: 8px;">Card 2 Description</label>
                                    <textarea name="about_safer_card_2_desc" id="about_safer_card_2_desc" rows="3" class="form-control" required>{{ $aboutSettings['about_safer_card_2_desc'] }}</textarea>
                                </div>

                                <!-- Card 3 -->
                                <div class="form-group" style="background: #FAF8F5; padding: 14px; border-radius: 10px; border: 1px solid var(--admin-border);">
                                    <label class="form-label" for="about_safer_card_3_title">Card 3 Title</label>
                                    <input type="text" name="about_safer_card_3_title" id="about_safer_card_3_title" class="form-control" value="{{ $aboutSettings['about_safer_card_3_title'] }}" required>
                                    <label class="form-label" for="about_safer_card_3_icon" style="margin-top: 8px;">FontAwesome Icon Class</label>
                                    <input type="text" name="about_safer_card_3_icon" id="about_safer_card_3_icon" class="form-control" value="{{ $aboutSettings['about_safer_card_3_icon'] }}" placeholder="fas fa-flag" required>
                                    <label class="form-label" for="about_safer_card_3_desc" style="margin-top: 8px;">Card 3 Description</label>
                                    <textarea name="about_safer_card_3_desc" id="about_safer_card_3_desc" rows="3" class="form-control" required>{{ $aboutSettings['about_safer_card_3_desc'] }}</textarea>
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--admin-border);">
                                <a href="{{ route('about') }}" target="_blank" class="btn-admin btn-admin-secondary">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live About Page
                                </a>
                                <button type="submit" class="btn-admin btn-admin-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Save About Us Sections
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

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
                                                <div style="width:36px;height:36px;border-radius:50%;overflow:hidden;background:#F1F5F9;border:1px solid var(--admin-border);flex-shrink:0;">
                                                    <img src="{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}" alt="" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='{{ asset('images/cat_dog.jpg') }}'">
                                                </div>
                                                <strong style="font-size:15px;">{{ $cat->name }}</strong>
                                            </div>
                                        </td>
                                        <td><code style="background:#F1F5F9;padding:4px 8px;border-radius:6px;color:#0F172A;">/category/{{ $cat->slug }}</code></td>
                                        <td><span class="badge" style="background:#E0F2FE;color:#0369A1;">{{ $cat->breeds_count }} breeds</span></td>
                                        <td><span class="badge badge-live">{{ $cat->active_listings_count }} active ads</span></td>
                                        <td>
                                            <form action="{{ route('admin.categories.toggle', ['id' => $cat->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="redirect_tab" value="categories">
                                                <button type="submit" class="badge {{ $cat->is_active ? 'badge-live' : 'badge-rejected' }}" style="border:none;cursor:pointer;">
                                                    <i class="fa-solid fa-circle" style="font-size:8px;"></i> {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <button type="button" class="btn-admin btn-admin-secondary btn-sm" onclick="editCategoryWithImage({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ $cat->icon }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }}, '{{ $cat->image ? asset($cat->image) : asset('images/cat_dog.jpg') }}', 'categories')">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                                @if($cat->listings_count == 0)
                                                    <form action="{{ route('admin.categories.delete', ['id' => $cat->id]) }}" method="POST" onsubmit="return confirm('Delete category {{ $cat->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="redirect_tab" value="categories">
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
    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
    <div id="addCategoryModal" class="admin-modal-backdrop">
        <div class="admin-modal">
            <div class="admin-modal-header">
                <h3>Add New Category</h3>
                <button type="button" onclick="closeModal('addCategoryModal')" style="background:none;border:none;font-size:18px;cursor:pointer;color:#64748B;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="redirect_tab" id="addCatRedirectTab" value="{{ $tab }}">
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
                        <label class="form-label">Category Circular Thumbnail Image</label>
                        <div style="display:flex;gap:14px;align-items:center;background:#F8FAFC;padding:12px;border-radius:10px;border:1px solid var(--admin-border);">
                            <div style="width:52px;height:52px;border-radius:50%;overflow:hidden;background:#FFFFFF;border:2px solid var(--admin-primary);box-shadow:0 2px 8px rgba(0,0,0,0.06);flex-shrink:0;">
                                <img id="addCatImgPreview" src="{{ asset('images/cat_dog.jpg') }}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            <div style="flex:1;">
                                <input type="file" name="image" accept="image/*" class="form-control" onchange="previewAddCatImage(this)">
                                <div class="form-help">Upload circular photo for homepage category track. Default fallback: cat_dog.jpg</div>
                            </div>
                        </div>
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
                            <span style="font-weight:600;font-size:14px;">Active &amp; Visible immediately on Homepage</span>
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
    {{-- USER PROMPT: "admin main home page setting main in ko bhi dynamic kro" --}}
    <div id="editCategoryModal" class="admin-modal-backdrop">
        <div class="admin-modal">
            <div class="admin-modal-header">
                <h3>Edit Category</h3>
                <button type="button" onclick="closeModal('editCategoryModal')" style="background:none;border:none;font-size:18px;cursor:pointer;color:#64748B;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="redirect_tab" id="editCatRedirectTab" value="{{ $tab }}">
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
                        <label class="form-label">Category Circular Thumbnail Image</label>
                        <div style="display:flex;gap:14px;align-items:center;background:#F8FAFC;padding:12px;border-radius:10px;border:1px solid var(--admin-border);">
                            <div style="width:52px;height:52px;border-radius:50%;overflow:hidden;background:#FFFFFF;border:2px solid var(--admin-primary);box-shadow:0 2px 8px rgba(0,0,0,0.06);flex-shrink:0;">
                                <img id="editCatImgPreview" src="{{ asset('images/cat_dog.jpg') }}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            <div style="flex:1;">
                                <input type="file" name="image" accept="image/*" class="form-control" onchange="previewEditCatImage(this)">
                                <div class="form-help">Upload new circular photo to replace thumbnail. Leave empty to keep current.</div>
                            </div>
                        </div>
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
                            <span style="font-weight:600;font-size:14px;">Active &amp; Visible on Homepage</span>
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

        // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
        function openAddCategoryModalWithTab(tab) {
            const redirectInput = document.getElementById('addCatRedirectTab');
            if (redirectInput) redirectInput.value = tab || 'home_categories';
            openModal('addCategoryModal');
        }

        function editCategoryWithImage(id, name, slug, icon, sortOrder, isActive, image, redirectTab) {
            editCategory(id, name, slug, icon, sortOrder, isActive, image, redirectTab);
        }

        function editCategory(id, name, slug, icon, sortOrder, isActive, image, redirectTab) {
            const form = document.getElementById('editCategoryForm');
            if (form) {
                form.action = '/admin/categories/' + id + '/update';
                document.getElementById('editCatName').value = name;
                document.getElementById('editCatSlug').value = slug;
                document.getElementById('editCatIcon').value = icon || '';
                document.getElementById('editCatOrder').value = sortOrder || 0;
                document.getElementById('editCatActive').checked = !!isActive;
                const imgPreview = document.getElementById('editCatImgPreview');
                if (imgPreview) {
                    imgPreview.src = image ? (image.startsWith('http') || image.startsWith('/') ? image : '/' + image) : '/images/cat_dog.jpg';
                }
                const redirectInput = document.getElementById('editCatRedirectTab');
                if (redirectInput) {
                    redirectInput.value = redirectTab || 'home_categories';
                }
                openModal('editCategoryModal');
            }
        }

        function previewAddCatImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('addCatImgPreview');
                    if (preview) preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewEditCatImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('editCatImgPreview');
                    if (preview) preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
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

        // USER PROMPT: "yr image ka aik do"
        function previewHeroImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('heroImagePreview');
                    if (preview) {
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // USER PROMPT: "ya admin pannel home page main ya section dynamic kro"
        function previewSafetyImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('safetyImagePreview');
                    if (preview) {
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // USER PROMPT: "footer to dynamic kro"
        function previewFooterLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('footerLogoPreview');
                    const sim = document.getElementById('footerLogoSimulation');
                    if (preview) preview.src = e.target.result;
                    if (sim) sim.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main"
        function previewAboutPurposeImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('aboutPurposePreview');
                    const sim = document.getElementById('aboutPurposeSimulation');
                    if (preview) preview.src = e.target.result;
                    if (sim) sim.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewAboutMarketplaceImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('aboutMarketplacePreview');
                    const sim = document.getElementById('aboutMarketplaceSimulation');
                    if (preview) preview.src = e.target.result;
                    if (sim) sim.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // USER PROMPT: "category page ka heroo section bhi dynamic kro"
        function previewCategoryHeroImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('categoryHeroImagePreview');
                    const sim = document.getElementById('categoryHeroPetsSimulation');
                    if (preview) preview.src = e.target.result;
                    if (sim) sim.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // USER PROMPT: "yr pets errow sy open ho or oper text ho english main urdu main ni"
        function toggleAvailablePetsSection() {
            const body = document.getElementById('availablePetsBody');
            const chevron = document.getElementById('petsChevron');
            if (body) {
                if (body.style.display === 'none') {
                    body.style.display = 'block';
                    if (chevron) {
                        chevron.style.transform = 'rotate(0deg)';
                        chevron.className = 'fa-solid fa-chevron-down';
                    }
                } else {
                    body.style.display = 'none';
                    if (chevron) {
                        chevron.style.transform = 'rotate(-90deg)';
                        chevron.className = 'fa-solid fa-chevron-right';
                    }
                }
            }
        }

        function openAvailablePetsSection() {
            const sec = document.getElementById('available-pets-section');
            const body = document.getElementById('availablePetsBody');
            const chevron = document.getElementById('petsChevron');
            if (body && body.style.display === 'none') {
                body.style.display = 'block';
                if (chevron) {
                    chevron.style.transform = 'rotate(0deg)';
                    chevron.className = 'fa-solid fa-chevron-down';
                }
            }
            if (sec) {
                const topbar = document.querySelector('.admin-topbar');
                const offset = topbar ? topbar.offsetHeight + 24 : 90;
                const elementPosition = sec.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                sec.style.transition = 'box-shadow 0.4s ease, border-color 0.4s ease';
                sec.style.borderColor = '#147A4D';
                sec.style.boxShadow = '0 0 0 4px rgba(20, 122, 77, 0.25)';
                setTimeout(() => {
                    sec.style.borderColor = '';
                    sec.style.boxShadow = '';
                }, 1800);

                const searchInput = sec.querySelector('input[name="featured_q"]');
                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 600);
                }
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
