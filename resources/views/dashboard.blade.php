<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pet Marketplace</title>
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
            --sidebar-green: #16935b;
            --sidebar-hover: #1eab6d;
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

        .welcome-actions {
            display: flex;
            align-items: center;
            gap: 16px;
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
            flex-shrink: 0;
        }

        .stat-card {
            background-color: #e8f3ee;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            margin-bottom: 4px;
        }

        .stat-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #000;
        }

        .stat-icon {
            width: 18px;
            height: 18px;
            background-color: #147A4D;
            display: inline-block;
        }

        .icon-list {
            -webkit-mask: url("{{ asset('images/list-icon.svg') }}") no-repeat center / contain;
            mask: url("{{ asset('images/list-icon.svg') }}") no-repeat center / contain;
        }

        .icon-messages {
            -webkit-mask: url("{{ asset('images/messages-icon.svg') }}") no-repeat center / contain;
            mask: url("{{ asset('images/messages-icon.svg') }}") no-repeat center / contain;
        }

        .icon-sold {
            -webkit-mask: url("{{ asset('images/sold-icon.svg') }}") no-repeat center / contain;
            mask: url("{{ asset('images/sold-icon.svg') }}") no-repeat center / contain;
        }

        .icon-favourites {
            -webkit-mask: url("{{ asset('images/heart-icon.svg') }}") no-repeat center / contain;
            mask: url("{{ asset('images/heart-icon.svg') }}") no-repeat center / contain;
        }

        /* Bottom Grid */
        .bottom-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            flex-grow: 1;
        }

        /* Card common */
        .card {
            background: white;
            border-radius: 16px;
            padding: 20px 20px 10px 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-shrink: 0;
        }

        .card-body {
            flex-grow: 1;
            padding-right: 8px;
        }

        .card-body::-webkit-scrollbar {
            width: 6px;
        }
        .card-body::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 4px;
        }
        .card-body::-webkit-scrollbar-thumb {
            background: #c1c1c1; 
            border-radius: 4px;
        }
        .card-body::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8; 
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
        }

        .card-link {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        /* Listings */
        .listing-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
            color: inherit;
        }
        .listing-item:hover {
            opacity: 0.8;
        }

        .listing-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .listing-img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
        }

        .listing-info {
            flex-grow: 1;
        }

        .listing-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .listing-details {
            font-size: 14px;
            color: var(--text-gray);
        }

        .listing-details strong {
            color: var(--text-dark);
            font-weight: 600;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-live {
            background-color: #e8f3ee;
            color: var(--primary-green);
        }

        .status-pending {
            background-color: #fff7ed;
            color: #c2410c;
        }

        .status-draft {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        /* Messages */
        .message-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 8px;
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .message-item:hover {
            background-color: #EAF7F0;
        }

        .message-item:last-child {
            border-bottom: none;
        }

        .msg-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .msg-content {
            flex-grow: 1;
        }

        .msg-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 4px;
        }

        .msg-name {
            font-weight: 600;
            font-size: 14px;
        }

        .msg-time {
            font-size: 12px;
            color: var(--text-gray);
        }

        .msg-text {
            font-size: 14px;
            color: var(--text-gray);
            line-height: 1.4;
        }
        /* Recent Favorites */
        .favorite-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
            text-decoration: none;
            color: inherit;
        }
        .favorite-item:hover {
            opacity: 0.9;
        }
        .favorite-item:last-child {
            /* border-bottom: none; */
        }
        .fav-badge {
            display: none;
        }
        .fav-img {
            width: 120px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        .fav-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .fav-title {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin-bottom: 4px;
        }
        .fav-subtitle {
            color: var(--text-gray);
            font-size: 14px;
        }
        .fav-meta {
            display: flex;
            gap: 16px;
            margin-top: 8px;
        }
        .fav-meta span {
            color: var(--text-gray);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .fav-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
        }
        .fav-price {
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-green);
        }
        .fav-price-mobile {
            display: none;
        }
        .fav-heart {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            cursor: pointer;
            transition: all 0.2s;
        }
        .fav-heart:hover {
            background-color: #ffeef0;
            color: #ff4b68;
        }

        .btn-sell-mobile {
            display: none;
        }

        @media (max-width: 768px) {
            .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding: 24px 20px;
            }
            .welcome-actions {
                display: none;
            }
            .btn-sell-mobile {
                display: flex;
                background-color: white;
                color: var(--primary-green);
                height: 48px;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                font-size: 16px;
                margin-top: 20px;
                width: 200px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .stat-card {
                flex-direction: row;
                justify-content: space-between;
                padding: 16px 24px;
            }
            .stat-number {
                font-size: 24px;
                margin-bottom: 0;
                order: 2;
            }
            .stat-label {
                order: 1;
            }
            .bottom-grid {
                grid-template-columns: 1fr;
            }
            .favorites-grid-mobile {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            .favorite-item {
                flex-direction: column;
                align-items: stretch;
                position: relative;
                padding: 0;
                overflow: hidden;
                border: 0.43px solid #E2E7E3;
                border-radius: 12px;
            }
            .fav-img {
                width: 100%;
                height: 140px;
                border-radius: 12px 12px 0 0;
                object-fit: cover;
            }
            .fav-badge {
                display: inline-block;
                position: absolute;
                top: 8px;
                left: 8px;
                background-color: white;
                color: #333;
                font-size: 8px;
                font-weight: 700;
                padding: 4px 8px;
                border-radius: 12px;
                z-index: 10;
                letter-spacing: 0.5px;
            }
            .fav-info {
                padding: 8px;
                padding-bottom: 12px;
            }
            .fav-title {
                font-size: 11px;
                font-weight: 600;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .fav-subtitle {
                font-size: 10px;
                margin-bottom: 2px;
            }
            .fav-price-mobile {
                display: block;
                font-size: 13px;
                font-weight: 700;
                color: var(--primary-green);
                margin-bottom: 6px;
            }
            .fav-meta {
                flex-wrap: wrap;
                gap: 4px;
                margin-top: 4px;
                display: flex;
            }
            .fav-meta span {
                font-size: 9px;
                color: #666;
                display: flex;
                align-items: center;
                gap: 2px;
            }
            .fav-meta span i {
                font-size: 10px;
            }
            .fav-meta span:nth-child(1) {
                order: 3;
                width: 100%;
                margin-top: 4px;
                border-top: 1px solid #eee;
                padding-top: 6px;
            }
            .fav-meta span:nth-child(2) {
                order: 1;
                margin-right: 6px;
            }
            .fav-meta span:nth-child(3) {
                order: 2;
            }
            .fav-actions {
                display: contents;
            }
            .fav-price {
                display: none !important;
            }
            .fav-heart {
                position: absolute;
                top: 8px;
                right: 8px;
                width: 32px;
                height: 32px;
                background-color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.15);
                display: flex !important;
                z-index: 10;
                cursor: pointer !important;
                pointer-events: auto !important;
            }
            .fav-heart i {
                color: #666;
                font-size: 14px;
                pointer-events: none;
            }
            .btn-sell-mobile {
                width: 100%;
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
                <h1>Welcome back, Ahmed</h1>
                <p>Manage your pet listings, buyer inquiries and account from one place.</p>
            </div>
            <a href="{{ route('seller.create-listing') }}" class="btn-sell-mobile">Sell a Pet</a>
            <div class="welcome-actions">
                <x-notification-bell />
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ sprintf('%02d', $stats['live_count'] ?? 0) }}</div>
                <div class="stat-label">
                    <div class="stat-icon icon-list"></div>
                    Active Listings
                </div>
            </div>
            <a href="{{ route('seller.messages') }}" class="stat-card" style="text-decoration:none; color:inherit;">
                <div class="stat-number">{{ sprintf('%02d', $stats['inquiries_count'] ?? 0) }}</div>
                <div class="stat-label">
                    <div class="stat-icon icon-messages"></div>
                    Inquiries
                </div>
            </a>
            <a href="{{ route('favorites') }}" class="stat-card" style="text-decoration:none; color:inherit;">
                <div class="stat-number">{{ sprintf('%02d', $stats['favorites_count'] ?? 0) }}</div>
                <div class="stat-label">
                    <div class="stat-icon icon-favourites"></div>
                    Favourites
                </div>
            </a>
            <div class="stat-card">
                <div class="stat-number">{{ sprintf('%02d', $stats['sold_count'] ?? 0) }}</div>
                <div class="stat-label">
                    <div class="stat-icon icon-sold"></div>
                    Sold / Rehomed
                </div>
            </div>
        </div>

        <!-- Bottom Grid -->
        <div class="bottom-grid">
            <!-- My Listings -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">My Listings</div>
                    <a href="{{ route('seller.listings') }}" class="card-link">View All</a>
                </div>
                
                <div class="card-body">
                    @forelse($recentListings as $listing)
                        <a href="{{ route('pet.details', ['id' => $listing->id]) }}" class="listing-item">
                            <img src="{{ $listing->primary_image_url }}" alt="{{ $listing->title }}" class="listing-img" onerror="this.src='{{ asset('images/card_golden.jpg') }}'">
                            <div class="listing-info">
                                <div class="listing-name">{{ $listing->title }}</div>
                                <div class="listing-details"><strong>{{ $listing->formatted_price }}</strong> · {{ $listing->city }}</div>
                            </div>
                            <span class="status-badge status-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span>
                        </a>
                    @empty
                        <div style="padding: 24px; text-align: center; color: #64748b;">No listings created yet.</div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Recent Messages</div>
                    <a href="{{ route('seller.messages') }}" class="card-link">Open Inbox</a>
                </div>
                
                <div class="card-body">
                    @forelse($recentConversations as $conv)
                        @php
                            $other = $conv->otherParticipant($user->id);
                        @endphp
                        <a href="{{ route('seller.messages', ['conversation_id' => $conv->id]) }}" class="message-item">
                            <img src="{{ $other->avatar_url }}" alt="{{ $other->name }}" class="msg-avatar" onerror="this.src='https://ui-avatars.com/api/?name=' . urlencode($other->name) . '&background=random'">
                            <div class="msg-content">
                                <div class="msg-header">
                                    <span class="msg-name">{{ $other->name }}</span>
                                    <span class="msg-time">{{ $conv->last_message_at ? $conv->last_message_at->diffForHumans(null, true) : '' }}</span>
                                </div>
                                <div class="msg-text">{{ $conv->latestMessage ? Str::limit($conv->latestMessage->message, 40) : 'No messages' }}</div>
                            </div>
                        </a>
                    @empty
                        <div style="padding: 24px; text-align: center; color: #64748b;">No messages received yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Favorites -->
        <div class="card" style="margin-top: 24px; margin-bottom: 24px;">
            <div class="card-header">
                <div class="card-title">Recent Favorites</div>
                <a href="{{ route('favorites') }}" class="card-link">View All</a>
            </div>
            
            <div class="card-body favorites-grid-mobile">
                @forelse($recentFavorites as $fav)
                    <a href="{{ route('pet.details', ['id' => $fav->id]) }}" class="favorite-item">
                        @if($fav->is_featured)
                            <span class="fav-badge">FEATURED</span>
                        @endif
                        <img src="{{ $fav->primary_image_url }}" alt="{{ $fav->title }}" class="fav-img" onerror="this.src='{{ asset('images/card_golden.jpg') }}'">
                        <div class="fav-info">
                            <div class="fav-title">{{ $fav->title }}</div>
                            <div class="fav-subtitle">{{ $fav->breed_name ?: ($fav->breed ? $fav->breed->name : 'Pet') }}</div>
                            <div class="fav-price-mobile">{{ $fav->formatted_price }}</div>
                            <div class="fav-meta">
                                <span><i class="fa-solid fa-location-dot"></i> {{ $fav->city }}</span>
                                <span><i class="fa-solid fa-clock"></i> {{ $fav->age_text }}</span>
                                <span><i class="fa-solid fa-{{ $fav->gender === 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($fav->gender) }}</span>
                            </div>
                        </div>
                        <div class="fav-actions">
                            <div class="fav-heart" style="color: #e11d48;">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <div class="fav-price">{{ $fav->formatted_price }}</div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; padding: 24px; text-align: center; color: #64748b;">No favorite pets saved yet.</div>
                @endforelse
            </div>
        </div>
    </main></div></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const soldPets = JSON.parse(localStorage.getItem('sold_pets') || '{}');
        const deletedPets = JSON.parse(localStorage.getItem('deleted_pets') || '{}');
        document.querySelectorAll('.listing-item').forEach(item => {
            const titleEl = item.querySelector('.listing-name');
            if (titleEl) {
                const key = titleEl.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
                if (deletedPets[key]) {
                    item.style.display = 'none';
                } else if (soldPets[key]) {
                    const badge = item.querySelector('.status-badge');
                    if (badge) {
                        badge.className = 'status-badge status-sold';
                        badge.textContent = 'Sold';
                    }
                }
            }
        });
    });
    </script>

    <x-footer />
</body>
</html>
