<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites - Pet Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* =========================================================
           [AI UPDATE - START]
           User Prompt: "when we navigate to Favrouite Page its bell icon in welcome banner slightly moves to right set it as same other welcome banners of Other pages"
           Description: Harmonized welcome-banner padding (24px 24px), added .welcome-actions flex wrapper,
           and added flex alignment on .btn-notification so the bell icon aligns precisely with other pages.
           ========================================================= */
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
            margin: 0;
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
        /* =========================================================
           [AI UPDATE - END]
           ========================================================= */

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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .fav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -4px rgba(0, 0, 0, 0.1);
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

        @media (max-width: 768px) {
            .welcome-banner {
                padding: 24px 20px;
            }

            .favorites-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .fav-card-img-wrapper {
                height: 140px;
            }

            .fav-heart-btn {
                width: 28px;
                height: 28px;
                top: 8px;
                right: 8px;
                font-size: 14px;
            }

            .fav-card-content {
                padding: 12px;
            }

            .fav-card-title {
                font-size: 13px;
                margin-bottom: 2px;
            }

            .fav-card-subtitle {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .fav-card-price {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .fav-card-meta {
                gap: 8px;
                font-size: 10px;
                margin-bottom: 8px;
                padding-bottom: 8px;
            }

            .fav-card-meta span {
                gap: 4px;
            }

            .fav-card-location {
                font-size: 10px;
                gap: 4px;
            }
        }

        /* Empty State */
        .empty-favorites {
            background: white;
            border-radius: 16px;
            border: 1px dashed var(--border-color);
            padding: 56px 24px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 8px;
        }

        .empty-fav-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(18, 140, 90, 0.08);
            color: var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .empty-favorites h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .empty-favorites p {
            font-size: 14px;
            color: var(--text-gray);
            max-width: 440px;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .empty-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-browse-pets {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-green);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-browse-pets:hover {
            background: #0e7048;
            transform: translateY(-1px);
            color: white;
        }

        .btn-reset-favs {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--text-gray);
            border: 1px solid var(--border-color);
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset-favs:hover {
            background: #f9fafb;
            color: var(--text-dark);
            border-color: #cbd5e1;
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
                        <x-notification-bell />
                    </div>
                </div>

                <!-- Favorites Grid -->
                @if($favorites->isNotEmpty())
                    <div class="favorites-grid">
                        @foreach($favorites as $fav)
                            <a href="{{ route('pet.details', ['id' => $fav->id]) }}" class="fav-card" data-fav-id="{{ $fav->id }}">
                                <div class="fav-card-img-wrapper">
                                    <img src="{{ $fav->primary_image_url }}" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'" alt="{{ $fav->title }}" class="fav-card-img">
                                    <button type="button" 
                                            class="fav-heart-btn active favorited" 
                                            data-url="{{ route('favorites.toggle', ['listingId' => $fav->id]) }}" 
                                            data-id="{{ $fav->id }}"
                                            onclick="removeFavoriteCard(this, event);" 
                                            title="Remove from Favorites"
                                            aria-label="Remove from Favorites">
                                        <i class="fa-solid fa-heart" style="color: #ff4b68;"></i>
                                    </button>
                                </div>
                                <div class="fav-card-content">
                                    <div class="fav-card-title">{{ $fav->title }}</div>
                                    <div class="fav-card-subtitle">{{ $fav->breed_name ?: ($fav->breed ? $fav->breed->name : 'Pet') }}</div>
                                    <div class="fav-card-price">{{ $fav->formatted_price }}</div>
                                    <div class="fav-card-meta">
                                        <span><i class="fa-regular fa-clock"></i> {{ $fav->age_text }}</span>
                                        <span><i class="fa-solid fa-{{ $fav->gender === 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($fav->gender) }}</span>
                                    </div>
                                    <div class="fav-card-location">
                                        <i class="fa-solid fa-location-dot"></i> {{ $fav->city }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div id="emptyFavoritesState" class="empty-favorites">
                        <div class="empty-fav-icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <h2>No favorites yet</h2>
                        <p>You haven't saved any pets to your favorites. Browse listings and find your companion!</p>
                        <div class="empty-actions">
                            <a href="{{ route('category') }}" class="btn-browse-pets">
                                <i class="fa-solid fa-compass"></i> Explore Pets
                            </a>
                        </div>
                    </div>
                @endif

            </main>
        </div>
    </div>

    <x-footer />

    <script>
        function removeFavoriteCard(btn, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const card = btn.closest('.fav-card');
            const url = btn.getAttribute('data-url');
            if (!card) return;

            // Visual feedback
            const icon = btn.querySelector('i');
            if (icon) {
                icon.className = 'fa-regular fa-heart';
                icon.style.color = '#9ca3af';
            }
            btn.classList.remove('active', 'favorited');

            // Smooth card collapse animation
            card.style.pointerEvents = 'none';
            card.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.88)';

            // Call server to delete favorite from database
            if (url) {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(r => r.json())
                .catch(err => console.warn('Remove favorite failed', err));
            }

            setTimeout(() => {
                card.remove();
                checkEmptyFavorites();
            }, 260);
        }

        function checkEmptyFavorites() {
            const grid = document.querySelector('.favorites-grid');
            const emptyState = document.getElementById('emptyFavoritesState');
            if (!grid) return;

            const remainingCards = grid.querySelectorAll('.fav-card');
            if (remainingCards.length === 0) {
                grid.style.display = 'none';
                if (emptyState) {
                    emptyState.style.display = 'flex';
                }
            } else {
                grid.style.display = 'grid';
                if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }
        }

        window.removeFavoriteCard = removeFavoriteCard;
        window.toggleFavorite = removeFavoriteCard;
        window.checkEmptyFavorites = checkEmptyFavorites;

        document.addEventListener('DOMContentLoaded', () => {
            // Clear any stale mock removals from localStorage so real database items always show
            localStorage.removeItem('removed_favorites');
            checkEmptyFavorites();
        });
    </script>
</body>
</html>
