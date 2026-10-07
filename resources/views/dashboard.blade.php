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
            min-height: 100vh;
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
            overflow: hidden;
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

        .btn-sell {
            background-color: white;
            color: var(--primary-green);
            padding: 10px 20px;
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
            width: 20px;
            height: 20px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        /* Bottom Grid */
        .bottom-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            flex-grow: 1;
            min-height: 0;
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
            overflow-y: auto;
            flex-grow: 1;
            min-height: 0;
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
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .message-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
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
    </style>
</head>
<body>

    <x-dashboard-sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Welcome back, Ahmed</h1>
                <p>Manage your pet listings, buyer inquiries and account from one place.</p>
            </div>
            <div class="welcome-actions">
                <button class="btn-sell">Sell a Pet</button>
                <button class="btn-notification">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">04</div>
                <div class="stat-label">
                    <div class="stat-icon icon-list"></div>
                    Active Listings
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number">04</div>
                <div class="stat-label">
                    <div class="stat-icon icon-messages"></div>
                    New Messages
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number">04</div>
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
                    <div class="listing-item">
                        <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever" class="listing-img" onerror="this.src='https://images.unsplash.com/photo-1600804340584-c7db2eacf0bf?auto=format&fit=crop&w=150&q=80'">
                        <div class="listing-info">
                            <div class="listing-name">Golden Retriever Puppy</div>
                            <div class="listing-details"><strong>Rs. 85,000</strong> · Lahore</div>
                        </div>
                        <span class="status-badge status-live">Live</span>
                    </div>

                    <div class="listing-item">
                        <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" class="listing-img" onerror="this.src='https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=150&q=80'">
                        <div class="listing-info">
                            <div class="listing-name">German Shepherd</div>
                            <div class="listing-details"><strong>Rs. 70,000</strong> · Lahore</div>
                        </div>
                        <span class="status-badge status-pending">Pending Review</span>
                    </div>

                    <div class="listing-item">
                        <img src="{{ asset('images/card_shihtzu.jpg') }}" alt="Shih Tzu Puppy" class="listing-img" onerror="this.src='https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&w=150&q=80'">
                        <div class="listing-info">
                            <div class="listing-name">Shih Tzu Puppy</div>
                            <div class="listing-details"><strong>Rs. 48,000</strong> · Lahore</div>
                        </div>
                        <span class="status-badge status-draft">Draft</span>
                    </div>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Recent Messages</div>
                    <a href="{{ route('seller.messages') }}" class="card-link">Open Inbox</a>
                </div>
                
                <div class="card-body">
                    <div class="message-item">
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="msg-avatar">
                        <div class="msg-content">
                            <div class="msg-header">
                                <span class="msg-name">Ali Raza</span>
                                <span class="msg-time">10m</span>
                            </div>
                            <div class="msg-text">Is the Golden Retriever still available?</div>
                        </div>
                    </div>

                    <div class="message-item">
                        <img src="https://ui-avatars.com/api/?name=Sarah&background=random" alt="Sarah" class="msg-avatar">
                        <div class="msg-content">
                            <div class="msg-header">
                                <span class="msg-name">Sarah</span>
                                <span class="msg-time">1h</span>
                            </div>
                            <div class="msg-text">Can you share vaccination details?</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
