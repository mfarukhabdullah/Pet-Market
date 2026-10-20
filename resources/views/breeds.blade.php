<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse All Pet Breeds - Pet Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    {{-- USER PROMPT: "yr idher robot tag do roebot text ni" --}}
    <meta name="robots" content="{{ \App\Models\SiteSetting::get('seo_robots', 'index, follow') }}">
    <meta name="description" content="Find pets by breed and explore available listings.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .breeds-page-wrapper {
            background-color: #FAFAF8;
            padding-bottom: 50px;
        }

        .breed-search-card {
            background: #FFFFFF;
            border-radius: 10px;
            border: 1px solid #E2E7E3;
            box-shadow: 0px 4px 20px rgba(20, 35, 28, 0.10);
            height: 90px;
            width: auto;
            display: flex;
            align-items: center;
            padding: 0 24px;
            margin: 32px 15px 48px 15px;
            position: relative;
            z-index: 10;
        }

        .breed-search-form {
            display: flex;
            gap: 12px;
            width: 100%;
        }

        .breed-search-input-group {
            flex-grow: 1;
            display: flex;
            align-items: center;
            background-color: #FFFFFF;
            border: 1px solid #E2E7E3;
            border-radius: 8px;
            padding: 0 16px;
            height: 44px;
        }
        
        .breed-search-input-group:focus-within {
            border-color: #147A4D;
        }

        .breed-search-input-group i {
            color: #147A4D;
            margin-right: 12px;
        }

        .breed-search-input-group input {
            border: none;
            outline: none;
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #17211C;
        }

        .breed-search-btn {
            background-color: #147A4D !important;
            color: #FFFFFF !important;
            border: none;
            border-radius: 8px;
            padding: 0 24px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 44px;
            transition: all 0.2s ease;
        }

        .breed-search-btn:hover {
            background-color: #106640 !important;
        }

        .breed-tags-container {
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 50px;
            flex-wrap: wrap;
            margin-top: 110px;
        }

        .breed-tag {
            padding: 10px 29px;
            background-color: #D6EADF;
            border-radius: 10px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 20px;
            line-height: 24px;
            color: #000000;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .breed-tag:hover {
            background-color: #c9e0d3;
        }

        .breed-category-section {
            margin-bottom: 60px;
            scroll-margin-top: 100px;
        }

        .breed-category-section:last-of-type {
            margin-bottom: 0px;
        }

        .breed-section-header {
            display: flex;
            align-items: center;
            margin-bottom: 110px; /* Extra margin for the overlapping images */
        }

        .breed-section-title {
            font-family: 'manrope', sans-serif;
            font-size: 34px;
            font-weight: 700;
            color: #17211C;
            margin: 0;
            white-space: nowrap;
        }

        /* USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this" */
        .breed-section-view-all {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #147A4D;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background-color: #EBF7EE;
            border-radius: 20px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .breed-section-view-all:hover {
            background-color: #D6EADF;
            color: #0E5C38;
        }

        .breed-section-line {
            flex-grow: 1;
            height: 1px;
            background-color: #E2E7E3;
            margin-left: 24px;
        }

        .breeds-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
            column-gap: 24px;
            row-gap: 120px;
        }

        .breed-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            height: 180px;
            box-sizing: border-box;
            padding: 24px;
            padding-top: 114px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            box-shadow: 0px 0px 14px rgba(0, 0, 0, 0.12);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .breed-card:hover {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.16);
            transform: translateY(-4px);
        }

        .breed-img-wrapper {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            position: absolute;
            top: -90px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background-color: #f0f0f0;
            border: 3.6px solid #FFFFFF;
            box-sizing: content-box;
        }

        .breed-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .breed-name {
            font-family: 'Manrope', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #17211C;
            margin: 0 0 4px 0;
        }

        .breed-count {
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            font-size: 16px;
            color: #667069;
        }

        @media (max-width: 768px) {
            .breed-search-card {
                height: auto;
                padding: 18px;
                margin: 40px 5px 25px 5px;
            }
            .breed-search-form {
                flex-direction: column;
            }
            .breed-search-btn {
                width: 100%;
                justify-content: center;
            }
            .breed-tags-container {
                gap: 16px;
                margin-top: 160px;
                flex-wrap: nowrap;
                overflow-x: auto;
                justify-content: flex-start;
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
                padding-bottom: 4px;
            }
            .breed-tags-container::-webkit-scrollbar {
                display: none; /* Chrome, Safari and Opera */
            }
            .breed-tag {
                padding: 12px 24px;
                white-space: nowrap;
                flex-shrink: 0;
            }
            .breed-section-header {
                justify-content: center;
                margin-bottom: 70px;
            }
            .breed-section-title {
                font-size: 24px;
            }
            .breed-section-line {
                display: none;
            }
            .breeds-grid {
                grid-template-columns: 1fr 1fr;
                column-gap: 12px;
                row-gap: 70px;
            }
            .breed-card {
                height: 120px;
                padding: 12px;
                padding-top: 56px;
            }
            .breed-img-wrapper {
                width: 110px;
                height: 110px;
                top: -66px;
                border-width: 3px;
            }
            .breed-name {
                font-size: 16px;
                line-height: 18.21px;
            }
            .breed-count {
                font-size: 14px;
                line-height: 14.57px;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <x-header />

    <!-- PAGE CONTENT -->
    <main class="site-wrapper breeds-page-wrapper">
        
        <!-- HERO SECTION (USING COMPONENT) -->
        <x-hero title="Browse All Pet Breeds" description="Find pets by breed and explore available listings.">
            <!-- Floating Search Card Container -->
            <div class="shell-1440">
                <div class="container">
                    <div class="breed-search-card">
                        <form action="{{ route('category') }}" method="GET" class="breed-search-form">
                            <!-- Search Input Field -->
                            <div class="breed-search-input-group">
                                <i class="fas fa-search"></i>
                                <input type="text" name="q" placeholder="Search breed">
                            </div>

                            <!-- Search Button -->
                            <button type="submit" class="breed-search-btn">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </x-hero>

        <!-- MAIN BREEDS SECTION -->
        {{-- USER PROMPT: "yr idhr vo sirf main jo admin main main add kron" --}}
        @php
            if (!isset($categories)) {
                $categories = \App\Models\Category::with(['breeds' => function ($q) {
                    $q->withCount(['listings' => function ($l) {
                        $l->where('status', 'live');
                    }]);
                }])->get();
            }
            if (!isset($liveListings)) {
                $liveListings = \App\Models\Listing::live()->with(['images', 'category', 'breed'])->get();
            }

            $fallbackImages = [
                'dogs' => 'images/cat_dog.jpg',
                'cats' => 'images/cat_cat.jpg',
                'birds' => 'images/cat_bird.jpg',
                'rabbits' => 'images/card_rabbit.jpg',
                'fish' => 'images/cat_fish.jpg',
                'fishes' => 'images/cat_fish.jpg',
                'reptiles' => 'images/cat_reptile.jpg',
                'reptile' => 'images/cat_reptile.jpg',
                'horses-farm' => 'images/cat_horse.jpg',
                'horse' => 'images/cat_horse.jpg',
                'horses' => 'images/cat_horse.jpg',
                'exotic' => 'images/card_parrot.jpg',
                'exotic-pets' => 'images/card_parrot.jpg',
            ];

            $sectionTitles = [
                'dogs' => 'Dog Breeds',
                'cats' => 'Cat Breeds',
                'birds' => 'Bird Breeds',
                'fish' => 'Fish Breeds',
                'reptiles' => 'Reptile Breeds',
                'horses-farm' => 'Horses & Farm Breeds',
                'rabbits' => 'Rabbit Breeds',
                'exotic' => 'Exotic Pet Breeds',
            ];

            // Normalize helper for fuzzy matching listings with breeds
            $normalizeName = function($str) {
                $clean = strtolower(trim((string)$str));
                $clean = str_replace(['german', 'germen'], 'german', $clean);
                $clean = str_replace(['persion', 'persian cat'], 'persian', $clean);
                return preg_replace('/[^a-z0-9]/', '', $clean);
            };

            // Only categories that have breeds explicitly added by admin
            $categoriesWithBreeds = $categories->filter(fn($c) => $c->breeds->count() > 0);
        @endphp

        <section class="shell-1440">
            <div class="container">
                
                @if($categoriesWithBreeds->count() > 0)
                    <!-- Breed Tags -->
                    <div class="breed-tags-container">
                        @foreach($categoriesWithBreeds as $cat)
                            <a href="#{{ $cat->slug }}-section" class="breed-tag" data-category="{{ $cat->slug }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>

                    @foreach($categoriesWithBreeds as $cat)
                        @php
                            $catListings = $liveListings->where('category_id', $cat->id);
                            $sectionTitle = $sectionTitles[$cat->slug] ?? (\Illuminate\Support\Str::singular($cat->name) . ' Breeds');
                        @endphp

                        <!-- {{ $sectionTitle }} Section -->
                        <div class="breed-category-section" id="{{ $cat->slug }}-section">
                            <div class="breed-section-header">
                                <h2 class="breed-section-title">{{ $sectionTitle }}</h2>
                                <div class="breed-section-line"></div>
                            </div>

                            <div class="breeds-grid">
                                @foreach($cat->breeds as $breed)
                                    @php
                                        $breedName = $breed->name;
                                        $breedSlug = $breed->slug ?: \Illuminate\Support\Str::slug($breedName);
                                        $bNorm = $normalizeName($breedName);

                                        // Match live listings count
                                        $count = $breed->listings_count ?? 0;
                                        $matchingListing = $catListings->first(function ($l) use ($breed, $bNorm, $normalizeName) {
                                            return ($l->breed_id == $breed->id || $normalizeName($l->breed_name ?? '') === $bNorm) 
                                                && $l->images->count() > 0;
                                        });

                                        if ($count === 0) {
                                            $count = $catListings->filter(function ($l) use ($breed, $bNorm, $normalizeName) {
                                                return $l->breed_id == $breed->id || $normalizeName($l->breed_name ?? '') === $bNorm;
                                            })->count();
                                        }

                                        // Image resolution: Admin uploaded > Live listing photo > Local photo by slug > Category fallback
                                        $imgSrc = null;
                                        if (!empty($breed->image) && file_exists(public_path($breed->image))) {
                                            $imgSrc = asset($breed->image);
                                        } elseif ($matchingListing && $matchingListing->images->first()) {
                                            $imgSrc = asset($matchingListing->images->first()->image_path);
                                        } elseif (file_exists(public_path('images/' . str_replace('-', '_', $breedSlug) . '.jpg'))) {
                                            $imgSrc = asset('images/' . str_replace('-', '_', $breedSlug) . '.jpg');
                                        } else {
                                            $imgSrc = asset($fallbackImages[$cat->slug] ?? 'images/cat_dog.jpg');
                                        }
                                    @endphp
                                    <a href="{{ route('category', ['param1' => $cat->slug, 'param2' => $breedSlug]) }}" class="breed-card">
                                        <div class="breed-img-wrapper">
                                            <img src="{{ $imgSrc }}" alt="{{ $breedName }}" loading="lazy">
                                        </div>
                                        <h3 class="breed-name">{{ $breedName }}</h3>
                                        <span class="breed-count">{{ $count > 0 ? $count . ' ' . \Illuminate\Support\Str::plural('listing', $count) . ' available' : 'Available in listings' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 80px 20px; background: #fff; border-radius: 12px; margin: 40px 0; border: 1px dashed #E2E7E3;">
                        <i class="fa-solid fa-dna" style="font-size: 48px; color: #147A4D; margin-bottom: 16px;"></i>
                        <h3 style="font-size: 22px; font-weight: 700; color: #17211C; margin-bottom: 8px;">No Breeds Added Yet</h3>
                        <p style="font-size: 15px; color: #64748B; margin-bottom: 24px;">Admin panel mein ja kar categories ke liye breeds add karein, wo foran yahan display ho jayengi.</p>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard', ['tab' => 'breeds']) }}" class="breed-search-btn" style="display: inline-flex; text-decoration: none;">
                                <i class="fa-solid fa-plus"></i> Add Breeds in Admin Panel
                            </a>
                        @endif
                    </div>
                @endif

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
    <script>
        // USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this"
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-scroll if hash exists or category query param exists (e.g. /breeds#fish-section or /breeds?category=fish)
            const hash = window.location.hash;
            const urlParams = new URLSearchParams(window.location.search);
            const catParam = urlParams.get('category');
            
            const targetId = hash ? hash.replace('#', '') : (catParam ? (catParam + '-section') : null);
            if (targetId) {
                const el = document.getElementById(targetId);
                if (el) {
                    setTimeout(() => {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 150);
                }
            }

            // Smooth scroll on clicking top breed tags
            document.querySelectorAll('.breed-tag').forEach(tag => {
                tag.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            history.pushState(null, null, href);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
