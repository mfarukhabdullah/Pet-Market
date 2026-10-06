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
            width: 20px;
            height: 20px;
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
            width: 183px;
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
            overflow-y: auto;
            min-height: 0;
            padding-right: 8px;
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
            background: white;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            gap: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            align-items: center;
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
    </style>
</head>
<body>

    <x-dashboard-sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>My Listings</h1>
                <p>Manage your pet listings, review their status, edit details or mark them sold/rehomed.</p>
            </div>
            <div class="welcome-actions">
                <button class="btn-sell">Create Listing</button>
                <button class="btn-notification">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Status Tabs -->
        <div class="status-tabs">
            <button class="tab-btn active">All</button>
            <button class="tab-btn">Live</button>
            <button class="tab-btn">Pending Review</button>
            <button class="tab-btn">Draft</button>
            <button class="tab-btn">Sold / Rehomed</button>
        </div>

        <!-- Listings Container -->
        <div class="listings-container">
            <!-- Listing Item 1 -->
            <div class="listing-card">
                <div class="listing-img-wrapper">
                    <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever Puppy" onerror="this.src='https://images.unsplash.com/photo-1600804340584-c7db2eacf0bf?auto=format&fit=crop&w=200&q=80'">
                </div>
                <div class="listing-info">
                    <div class="status-badge status-live">Live</div>
                    <div class="listing-title">Golden Retriever Puppy</div>
                    <div class="listing-breed">Golden Retriever</div>
                    <div class="listing-price">Rs. 85,000</div>
                    <div class="listing-meta">
                        <span>• Lahore</span>
                        <span>• Posted 2 days ago</span>
                    </div>
                </div>
                <div class="listing-actions">
                    <button class="btn-action btn-solid">View Listing</button>
                    <button class="btn-action btn-outline">Edit</button>
                    <button class="btn-action btn-outline">Mark Sold</button>
                </div>
            </div>

            <!-- Listing Item 2 -->
            <div class="listing-card">
                <div class="listing-img-wrapper">
                    <img src="{{ asset('images/card_gsd.jpg') }}" alt="German Shepherd" onerror="this.src='https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=200&q=80'">
                </div>
                <div class="listing-info">
                    <div class="status-badge status-pending">Pending Review</div>
                    <div class="listing-title">German Shepherd</div>
                    <div class="listing-breed">German Shepherd</div>
                    <div class="listing-price">Rs. 70,000</div>
                    <div class="listing-meta">
                        <span>• Lahore</span>
                        <span>• Submitted today</span>
                    </div>
                </div>
                <div class="listing-actions">
                    <button class="btn-action btn-solid">Preview</button>
                    <button class="btn-action btn-outline">Edit</button>
                </div>
            </div>

            <!-- Listing Item 3 -->
            <div class="listing-card">
                <div class="listing-img-wrapper">
                    <img src="{{ asset('images/card_shihtzu.jpg') }}" alt="Shih Tzu Puppy" onerror="this.src='https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&w=200&q=80'">
                </div>
                <div class="listing-info">
                    <div class="status-badge status-draft">Draft</div>
                    <div class="listing-title">Shih Tzu Puppy</div>
                    <div class="listing-breed">Shih Tzu</div>
                    <div class="listing-price">Rs. 48,000</div>
                    <div class="listing-meta">
                        <span>• Lahore</span>
                        <span>• Updated yesterday</span>
                    </div>
                </div>
                <div class="listing-actions">
                    <button class="btn-action btn-solid">Continue Editing</button>
                    <button class="btn-action btn-outline text-red">Delete Draft</button>
                </div>
            </div>

            <!-- Listing Item 4 -->
            <div class="listing-card">
                <div class="listing-img-wrapper">
                    <img src="{{ asset('images/card_persian.jpg') }}" alt="Persian Cat" onerror="this.src='https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=200&q=80'">
                </div>
                <div class="listing-info">
                    <div class="status-badge status-rejected">Rejected</div>
                    <div class="listing-title">Persian Cat</div>
                    <div class="listing-breed">Persian</div>
                    <div class="listing-price">Rs. 42,000</div>
                    <div class="listing-meta">
                        <span>• Lahore</span>
                        <span>• Reviewed 1 day ago</span>
                    </div>
                    <div class="listing-reason"><strong>Reason:</strong> Missing health details</div>
                </div>
                <div class="listing-actions">
                    <button class="btn-action btn-solid">Edit & Resubmit</button>
                </div>
            </div>

            <!-- Listing Item 5 -->
            <div class="listing-card">
                <div class="listing-img-wrapper">
                    <img src="{{ asset('images/card_pug.jpg') }}" alt="Pug Puppy" onerror="this.src='https://images.unsplash.com/photo-1517423440428-a5a00ad493e8?auto=format&fit=crop&w=200&q=80'">
                </div>
                <div class="listing-info">
                    <div class="status-badge status-sold">Sold / Rehomed</div>
                    <div class="listing-title">Pug Puppy</div>
                    <div class="listing-breed">Pug</div>
                    <div class="listing-price">Rs. 35,000</div>
                    <div class="listing-meta">
                        <span>• Lahore</span>
                        <span>• Completed 5 days ago</span>
                    </div>
                </div>
                <div class="listing-actions">
                    <button class="btn-action btn-solid">View Listing</button>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
