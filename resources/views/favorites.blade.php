<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites - Pet Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        .main-content { 
            width: 100%; 
            flex-grow: 1; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            padding: 24px 0; 
        }

        .welcome-banner {
            background-color: var(--primary-green);
            color: white;
            border-radius: 16px;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
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
            margin: 0;
        }

        .btn-notification {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 8px;
            transition: opacity 0.2s;
        }

        .btn-notification:hover {
            opacity: 0.8;
        }

        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .fav-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }

        .fav-card-img-wrapper {
            position: relative;
            height: 200px;
            width: 100%;
        }

        .fav-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fav-heart-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            color: #ff4757;
            font-size: 18px;
            border: none;
            cursor: pointer;
            z-index: 2;
        }

        .fav-card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .fav-card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .fav-card-subtitle {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 12px;
        }

        .fav-card-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 16px;
        }

        .fav-card-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .fav-card-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fav-card-location {
            font-size: 14px;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fav-card-location i, .fav-card-meta i {
            color: var(--text-gray);
        }
    </style>
</head>
<body>

    <x-header />

    <!-- Main Content -->
    <div class="shell-1440" style="flex-grow:1;">
        <div class="container">
            <main class="main-content">
                
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h1>Favorites</h1>
                        <p>Keep track of the pets you have saved and revisit their listings anytime.</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn-notification">
                            <i class="fa-regular fa-bell" style="font-size: 32px; color: #fff;"></i>
                        </button>
                    </div>
                </div>

                <!-- Favorites Grid -->
                <div class="favorites-grid">
                    <!-- Card 1 -->
                    <div class="fav-card">
                        <div class="fav-card-img-wrapper">
                            <img src="{{ asset('images/card_gsd.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=500&q=80'" alt="German Shepherd" class="fav-card-img">
                            <button class="fav-heart-btn">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                        <div class="fav-card-content">
                            <div class="fav-card-title">German Shepherd</div>
                            <div class="fav-card-subtitle">German Shepherd</div>
                            <div class="fav-card-price">Rs. 85,000</div>
                            <div class="fav-card-meta">
                                <span><i class="fa-regular fa-clock"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="fav-card-location">
                                <i class="fa-solid fa-location-dot"></i> Lahore
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="fav-card">
                        <div class="fav-card-img-wrapper">
                            <img src="{{ asset('images/card_gsd.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=500&q=80'" alt="German Shepherd" class="fav-card-img">
                            <button class="fav-heart-btn">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                        <div class="fav-card-content">
                            <div class="fav-card-title">German Shepherd</div>
                            <div class="fav-card-subtitle">German Shepherd</div>
                            <div class="fav-card-price">Rs. 85,000</div>
                            <div class="fav-card-meta">
                                <span><i class="fa-regular fa-clock"></i> 3 Months</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="fav-card-location">
                                <i class="fa-solid fa-location-dot"></i> Lahore
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="fav-card">
                        <div class="fav-card-img-wrapper">
                            <img src="{{ asset('images/card_persian.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=500&q=80'" alt="British Shorthair" class="fav-card-img">
                            <button class="fav-heart-btn">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                        <div class="fav-card-content">
                            <div class="fav-card-title">British Shorthair</div>
                            <div class="fav-card-subtitle">British Shorthair</div>
                            <div class="fav-card-price">Rs. 42,000</div>
                            <div class="fav-card-meta">
                                <span><i class="fa-regular fa-clock"></i> 7 Months</span>
                                <span><i class="fa-solid fa-venus"></i> Female</span>
                            </div>
                            <div class="fav-card-location">
                                <i class="fa-solid fa-location-dot"></i> Islamabad
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="fav-card">
                        <div class="fav-card-img-wrapper">
                            <img src="{{ asset('images/card_bird.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1452570053594-1b985d6ea890?auto=format&fit=crop&w=500&q=80'" alt="Shih Tzu Puppy" class="fav-card-img">
                            <button class="fav-heart-btn">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                        <div class="fav-card-content">
                            <div class="fav-card-title">Shih Tzu Puppy</div>
                            <div class="fav-card-subtitle">Shih Tzu</div>
                            <div class="fav-card-price">Rs. 65,000</div>
                            <div class="fav-card-meta">
                                <span><i class="fa-regular fa-clock"></i> 1 Year</span>
                                <span><i class="fa-solid fa-mars"></i> Male</span>
                            </div>
                            <div class="fav-card-location">
                                <i class="fa-solid fa-location-dot"></i> Karachi
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
