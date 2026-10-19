<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Listings - Pet Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        .welcome-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-sell {
            background-color: white;
            color: var(--primary-green);
            width: 184px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-sell:hover {
            background-color: #f3f4f6;
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

        /* Status Tabs */
        .status-tabs {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-shrink: 0;
        }

        .tab-btn {
            background-color: white;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            flex: 1;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn:hover {
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .tab-btn.active {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
        }

        /* Listings Container */
        .listings-container {
            flex-grow: 1;
            padding-right: 0px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .listings-container::-webkit-scrollbar {
            width: 6px;
        }
        .listings-container::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 4px;
        }
        .listings-container::-webkit-scrollbar-thumb {
            background: #c1c1c1; 
            border-radius: 4px;
        }
        .listings-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8; 
        }

        /* Listing Card */
        .listing-card {
            position: relative;
            background: white;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            gap: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            align-items: center;
        }

        /* 3-Dots Options Menu & Dropdown */
        .listing-menu-wrapper {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 10;
        }

        .btn-dots {
            background: none;
            border: none;
            color: #6b7280;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s, color 0.2s;
        }

        .btn-dots:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .listing-dropdown {
            position: absolute;
            top: 36px;
            right: 0;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            min-width: 160px;
            display: none;
            flex-direction: column;
            padding: 6px 0;
            z-index: 20;
        }

        .listing-dropdown.show {
            display: flex;
        }

        .dropdown-menu-item {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #dc2626;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            transition: background-color 0.15s;
        }

        .dropdown-menu-item:hover {
            background-color: #fef2f2;
        }

        /* USER PROMPT: "just give edit option in listing front page not in this delete section" */

        /* Delete Modal Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .modal-backdrop.show {
            opacity: 1;
            display: flex !important;
        }

        .modal-card {
            background: white;
            border-radius: 20px;
            padding: 32px 28px;
            width: 100%;
            max-width: 440px;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.95);
            transition: transform 0.25s ease;
        }

        .modal-backdrop.show .modal-card {
            transform: scale(1);
        }

        .modal-close-icon {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 18px;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: color 0.2s, background-color 0.2s;
        }

        .modal-close-icon:hover {
            color: #111827;
            background: #f3f4f6;
        }

        .modal-icon-wrapper.danger {
            width: 56px;
            height: 56px;
            background-color: #fef2f2;
            color: #dc2626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            font-size: 24px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .modal-message {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .btn-modal {
            flex: 1;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-modal-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-modal-cancel:hover {
            background: #e5e7eb;
        }

        .btn-modal-danger {
            background: #dc2626;
            color: white;
        }

        .btn-modal-danger:hover {
            background: #b91c1c;
        }

        .listing-img-wrapper {
            width: 212px;
            height: 180px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .listing-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .listing-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }

        .status-live { background-color: #e8f5e9; color: #147A4D; }
        .status-pending { background-color: #fff8e1; color: #f57f17; }
        .status-draft { background-color: #f3f4f6; color: #4b5563; }
        .status-rejected { background-color: #ffebee; color: #d32f2f; }
        .status-sold { background-color: #e8eaf6; color: #3f51b5; }

        .listing-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .listing-breed {
            font-size: 14px;
            color: var(--text-gray);
        }

        .listing-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-green);
        }

        .listing-meta {
            font-size: 13px;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .listing-reason {
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 500;
        }

        .listing-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 200px;
            flex-shrink: 0;
            margin-top: 24px;
        }

        .btn-action {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            display: inline-block;
            box-sizing: border-box;
            text-decoration: none;
        }

        .btn-solid {
            background-color: var(--primary-green);
            color: white;
            border: 1px solid var(--primary-green);
        }

        .btn-solid:hover {
            background-color: #0f764a;
        }

        .btn-outline {
            background-color: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-outline:hover {
            border-color: var(--text-gray);
        }

        .btn-outline.text-red {
            color: #d32f2f;
        }
    
        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
            .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding: 24px 20px;
                margin-bottom: 20px;
            }
            .welcome-text {
                width: 100%;
                margin-bottom: 20px;
            }
            .welcome-actions {
                width: 100%;
                justify-content: center;
            }
            .btn-sell {
                width: auto;
                padding: 0 40px;
                height: 48px;
            }
            .btn-notification {
                display: none;
            }

            .status-tabs {
                display: flex;
                gap: 8px;
                margin-bottom: 16px;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 4px;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .status-tabs::-webkit-scrollbar {
                display: none;
            }
            .tab-btn {
                flex: none;
                width: 35vw;
                padding: 0;
                height: 40px;
                font-size: 13px;
                flex-shrink: 0;
            }

            .listing-card {
                padding: 16px;
                display: grid;
                grid-template-columns: 100px 1fr;
                gap: 16px;
                align-items: flex-start;
            }
            .listing-img-wrapper {
                width: 100px;
                height: 120px;
                grid-column: 1;
                grid-row: 1;
            }
            .listing-info {
                grid-column: 2;
                grid-row: 1;
                gap: 6px;
            }
            .status-badge {
                font-size: 10px;
                padding: 3px 8px;
                margin-bottom: 2px;
            }
            .listing-title {
                font-size: 14px;
                margin-bottom: 0;
            }
            .listing-breed {
                font-size: 12px;
                margin-bottom: 0;
            }
            .listing-price {
                font-size: 14px;
                margin-top: 2px;
            }
            .listing-meta {
                font-size: 11px;
                margin-top: 2px;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 4px;
            }
            .listing-meta span {
                font-size: 10px;
            }
            .listing-reason {
                font-size: 11px;
                margin-top: 2px;
            }

            .listing-actions {
                grid-column: 1 / -1;
                grid-row: 2;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
                gap: 8px;
            }
            .btn-action {
                flex-grow: 1;
                flex-basis: calc(50% - 4px);
                padding: 10px;
                font-size: 13px;
                height: auto;
            }
            .listing-actions .btn-action:first-child:last-child {
                flex-basis: 100%;
            }
            .listing-actions .btn-action:first-child:nth-last-child(3) {
                flex-basis: 100%;
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
                <h1>My Listings</h1>
                <p>Manage your pet listings, review their status, edit details or mark them sold/rehomed.</p>
            </div>
            <div class="welcome-actions">
                <x-notification-bell />
            </div>
        </div>

        @php
            $currentTab = request('tab', 'all');
        @endphp
        <!-- Status Tabs -->
        <div class="status-tabs">
            <a href="{{ route('seller.listings', ['tab' => 'all']) }}" data-tab="all" class="tab-btn {{ $currentTab === 'all' ? 'active' : '' }}" style="text-decoration:none;">All ({{ $counts['all'] ?? 0 }})</a>
            <a href="{{ route('seller.listings', ['tab' => 'live']) }}" data-tab="live" class="tab-btn {{ $currentTab === 'live' ? 'active' : '' }}" style="text-decoration:none;">Live ({{ $counts['live'] ?? 0 }})</a>
            <a href="{{ route('seller.listings', ['tab' => 'pending']) }}" data-tab="pending" class="tab-btn {{ $currentTab === 'pending' ? 'active' : '' }}" style="text-decoration:none;">Pending ({{ $counts['pending'] ?? 0 }})</a>
            <a href="{{ route('seller.listings', ['tab' => 'draft']) }}" data-tab="draft" class="tab-btn {{ $currentTab === 'draft' ? 'active' : '' }}" style="text-decoration:none;">Draft ({{ $counts['draft'] ?? 0 }})</a>
            <a href="{{ route('seller.listings', ['tab' => 'sold']) }}" data-tab="sold" class="tab-btn {{ $currentTab === 'sold' ? 'active' : '' }}" style="text-decoration:none;">Sold ({{ $counts['sold'] ?? 0 }})</a>
        </div>

        <!-- Listings Container -->
        <div class="listings-container">
            @forelse($filteredListings as $listing)
                <div class="listing-card" data-status="{{ $listing->status }}" data-id="{{ $listing->id }}">
                    <div class="listing-menu-wrapper">
                        <button type="button" class="btn-dots" aria-label="Listing Options">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <div class="listing-dropdown">
                            {{-- USER PROMPT: "just give edit option in listing front page not in this delete section" --}}
                            <form action="{{ route('listings.delete', ['id' => $listing->id]) }}" method="POST" onsubmit="return confirm('Delete this listing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-menu-item btn-delete-option" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <span>Delete Listing</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('pet.details', ['slug' => $listing->slug ?: $listing->id]) }}" class="listing-img-wrapper">
                        <img src="{{ $listing->primary_image_url }}" alt="{{ $listing->title }}" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                    </a>
                    <div class="listing-info">
                        <div class="status-badge status-{{ $listing->status }}">
                            {{ $listing->status === 'live' ? 'Live' : ($listing->status === 'pending' ? 'Pending Review' : ($listing->status === 'draft' ? 'Draft' : ($listing->status === 'sold' ? 'Sold / Rehomed' : ucfirst($listing->status)))) }}
                        </div>
                        <div class="listing-title"><a href="{{ route('pet.details', ['slug' => $listing->slug ?: $listing->id]) }}" style="color:inherit; text-decoration:none;">{{ $listing->title }}</a></div>
                        <div class="listing-breed">{{ $listing->breed_name ?: ($listing->breed ? $listing->breed->name : 'Pet') }}@if($listing->color) • <span style="font-weight: 600; color: #17211C;">{{ $listing->color }}</span>@endif</div>
                        <div class="listing-price">{{ $listing->formatted_price }}</div>
                        <div class="listing-meta">
                            <span>• {{ $listing->city }}</span>
                            <span>• {{ $listing->created_at->diffForHumans() }}</span>
                            <span>• {{ $listing->views_count }} views</span>
                        </div>
                        @if($listing->status === 'rejected' && $listing->moderation_feedback)
                            <div class="listing-reason" style="color: #dc2626; font-size: 12px; margin-top: 4px;">
                                <i class="fa-solid fa-circle-exclamation"></i> Feedback: {{ $listing->moderation_feedback }}
                            </div>
                        @endif
                    </div>
                    {{-- USER PROMPT: "in my listing page if user want to edit his pet listing we wil navigate him to create listing page do edit his listing" --}}
                    {{-- USER PROMPT: "just give edit option in listing front page not in this delete section" --}}
                    <div class="listing-actions">
                        @if($listing->status === 'live')
                            <a href="{{ route('pet.details', ['slug' => $listing->slug ?: $listing->id]) }}" class="btn-action btn-solid">View Listing</a>
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-outline">Edit Listing</a>
                            <form action="{{ route('listings.mark-sold', ['id' => $listing->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-action btn-outline mark-sold-btn">Mark Sold</button>
                            </form>
                        @elseif($listing->status === 'pending')
                            <a href="{{ route('pet.details', ['slug' => $listing->slug ?: $listing->id]) }}" class="btn-action btn-solid">Preview</a>
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-outline">Edit Listing</a>
                        @elseif($listing->status === 'draft')
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-solid">Continue Draft</a>
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-outline">Edit Listing</a>
                        @elseif($listing->status === 'sold')
                            <a href="{{ route('pet.details', ['slug' => $listing->slug ?: $listing->id]) }}" class="btn-action btn-solid">View Listing</a>
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-outline">Edit Listing</a>
                        @elseif($listing->status === 'rejected')
                            <a href="{{ route('seller.create-listing', ['edit' => $listing->id]) }}" class="btn-action btn-solid">Edit & Fix</a>
                        @endif
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; border: 1px solid var(--border-color); color: #64748b;">
                    <i class="fa-solid fa-box-open" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                    <p style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No {{ $currentTab !== 'all' ? $currentTab : '' }} listings found</p>
                    <a href="{{ route('seller.create-listing') }}" class="btn-action btn-solid" style="display: inline-block; width: auto; padding: 10px 24px; text-decoration: none;">Create New Listing</a>
                </div>
            @endforelse
        </div>
    </main></div></div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-backdrop">
        <div class="modal-card">
            <button type="button" class="modal-close-icon" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon-wrapper danger">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="modal-title">Delete Listing</h3>
            <p class="modal-message">Are you sure you want to delete <strong id="deletePetName">this listing</strong>? This action cannot be undone and it will be permanently removed from your account and marketplace.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button type="button" class="btn-modal btn-modal-danger" id="confirmDeleteBtn">Delete Listing</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Clear obsolete localStorage mockup keys so real database listings are never hidden
        try {
            localStorage.removeItem('deleted_pets');
            localStorage.removeItem('sold_pets');
        } catch(e) {}

        const tabs = document.querySelectorAll('.tab-btn');
        const cards = document.querySelectorAll('.listing-card');

        function getActiveFilter() {
            const activeTab = document.querySelector('.tab-btn.active');
            if (!activeTab) return 'all';
            if (activeTab.dataset.tab) return activeTab.dataset.tab.toLowerCase();
            const text = activeTab.textContent.toLowerCase();
            if (text.includes('all')) return 'all';
            if (text.includes('live')) return 'live';
            if (text.includes('pending')) return 'pending';
            if (text.includes('draft')) return 'draft';
            if (text.includes('sold')) return 'sold';
            return 'all';
        }

        function filterListings() {
            const filter = getActiveFilter();

            document.querySelectorAll('.listing-card').forEach(card => {
                const status = (card.dataset.status || '').toLowerCase();
                
                if (filter === 'all' || filter === '' || status === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function scrollToActiveTab() {
            const activeTab = document.querySelector('.tab-btn.active');
            const container = document.querySelector('.status-tabs');
            if (activeTab && container) {
                const activeLeft = activeTab.offsetLeft;
                const activeWidth = activeTab.offsetWidth;
                const containerWidth = container.offsetWidth;
                container.scrollTo({
                    left: activeLeft - (containerWidth / 2) + (activeWidth / 2),
                    behavior: 'smooth'
                });
            }
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                // If clicked, update active class and filter
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                filterListings();
                scrollToActiveTab();
            });
        });

        // Run initial filter and scroll to active tab on page load
        filterListings();
        setTimeout(scrollToActiveTab, 100);

        // Card Click Navigation for Mobile/Desktop
        document.querySelectorAll('.listing-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.closest('a, button, .btn-dots, .listing-dropdown, form')) return;
                const solidBtn = card.querySelector('.btn-action.btn-solid');
                if (solidBtn && solidBtn.href) {
                    window.location.href = solidBtn.href;
                }
            });
        });

        // 3-Dots dropdown toggle & outside click handler
        document.addEventListener('click', (e) => {
            const dotsBtn = e.target.closest('.btn-dots');
            if (dotsBtn) {
                e.stopPropagation();
                const wrapper = dotsBtn.closest('.listing-menu-wrapper');
                const dropdown = wrapper ? wrapper.querySelector('.listing-dropdown') : null;
                
                document.querySelectorAll('.listing-dropdown.show').forEach(d => {
                    if (d !== dropdown) d.classList.remove('show');
                });

                if (dropdown) dropdown.classList.toggle('show');
                return;
            }

            if (!e.target.closest('.listing-dropdown')) {
                document.querySelectorAll('.listing-dropdown.show').forEach(d => d.classList.remove('show'));
            }
        });

        // Delete Option Click -> Open Confirmation Modal
        let targetCardToDelete = null;

        document.addEventListener('click', (e) => {
            const deleteOption = e.target.closest('.btn-delete-option');
            if (deleteOption) {
                e.stopPropagation();
                e.preventDefault();
                const dropdown = deleteOption.closest('.listing-dropdown');
                if (dropdown) dropdown.classList.remove('show');

                targetCardToDelete = deleteOption.closest('.listing-card');
                if (targetCardToDelete) {
                    const titleEl = targetCardToDelete.querySelector('.listing-title');
                    const petName = titleEl ? titleEl.textContent.trim() : 'this listing';
                    document.getElementById('deletePetName').textContent = `"${petName}"`;
                    
                    const modal = document.getElementById('deleteModal');
                    if (modal) modal.classList.add('show');
                }
            }
        });

        window.closeDeleteModal = function() {
            const modal = document.getElementById('deleteModal');
            if (modal) modal.classList.remove('show');
            targetCardToDelete = null;
        };

        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => {
                if (targetCardToDelete) {
                    const form = targetCardToDelete.querySelector('form');
                    if (form) {
                        form.submit();
                    } else {
                        targetCardToDelete.remove();
                        closeDeleteModal();
                        filterListings();
                    }
                }
            });
        }
    });
    </script>
    <x-footer />
</body>
</html>
