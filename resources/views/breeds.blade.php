<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse All Pet Breeds - Pet Marketplace</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Find pets by breed and explore available listings.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            padding-bottom: 80px;
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
            margin: 32px 15px 24px 15px;
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
            margin-top: 30px;
        }

        .breed-tag {
            padding: 10px 29px;
            background-color: #D6EADF;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 14px;
            color: #17211C;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .breed-tag:hover {
            background-color: #c9e0d3;
        }

        .breed-category-section {
            margin-bottom: 80px;
            scroll-margin-top: 100px;
        }

        .breed-section-header {
            display: flex;
            align-items: center;
            margin-bottom: 110px; /* Extra margin for the overlapping images */
        }

        .breed-section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #17211C;
            margin: 0;
            white-space: nowrap;
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
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #17211C;
            margin: 0 0 4px 0;
        }

        .breed-count {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            color: #667069;
        }

        @media (max-width: 768px) {
            .breed-search-card {
                height: auto;
                padding: 24px;
                margin-top: -32px;
            }
            .breed-search-form {
                flex-direction: column;
            }
            .breed-search-btn {
                width: 100%;
                justify-content: center;
            }
            .breed-tags-container {
                gap: 12px;
            }
            .breed-tag {
                padding: 8px 16px;
                font-size: 13px;
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
                        <form action="#" method="GET" class="breed-search-form">
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
        <section class="shell-1440">
            <div class="container">
                
                <!-- Breed Tags -->
                <div class="breed-tags-container">
                    <a href="#dogs-section" class="breed-tag">Dogs</a>
                    <a href="#cats-section" class="breed-tag">Cats</a>
                    <a href="#birds-section" class="breed-tag">Birds</a>
                    <a href="#fish-section" class="breed-tag">Fish</a>
                    <a href="#reptiles-section" class="breed-tag">Reptiles</a>
                    <a href="#horses-section" class="breed-tag">Horses &amp; Farm</a>
                </div>

                <!-- Dog Breeds Section -->
                <div class="breed-category-section" id="dogs-section">
                    <div class="breed-section-header">
                        <h2 class="breed-section-title">Dog Breeds</h2>
                        <div class="breed-section-line"></div>
                    </div>

                    <div class="breeds-grid">
                        <!-- Dog Breed 1 -->
                        <a href="#" class="breed-card">
                            <div class="breed-img-wrapper">
                                <img src="{{ asset('images/golden_retriever.jpg') }}" alt="Golden Retriever">
                            </div>
                            <h3 class="breed-name">Golden Retriever</h3>
                            <span class="breed-count">320 available</span>
                        </a>

                        <!-- Dog Breed 2 -->
                        <a href="#" class="breed-card">
                            <div class="breed-img-wrapper">
                                <img src="{{ asset('images/german_shepherd.jpg') }}" alt="German Shepherd">
                            </div>
                            <h3 class="breed-name">German Shepherd</h3>
                            <span class="breed-count">320 available</span>
                        </a>
                    </div>
                </div>

                <!-- Cat Breeds Section -->
                <div class="breed-category-section" id="cats-section">
                    <div class="breed-section-header">
                        <h2 class="breed-section-title">Cat Breeds</h2>
                        <div class="breed-section-line"></div>
                    </div>

                    <div class="breeds-grid">
                        <!-- Cat Breed 1 -->
                        <a href="#" class="breed-card">
                            <div class="breed-img-wrapper">
                                <img src="{{ asset('images/persian.jpg') }}" alt="Persian">
                            </div>
                            <h3 class="breed-name">Persian</h3>
                            <span class="breed-count">320 available</span>
                        </a>

                        <!-- Cat Breed 2 -->
                        <a href="#" class="breed-card">
                            <div class="breed-img-wrapper">
                                <img src="{{ asset('images/british_shorthair.jpg') }}" alt="British Shorthair">
                            </div>
                            <h3 class="breed-name">British Shorthair</h3>
                            <span class="breed-count">320 available</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <x-footer />

</body>
</html>
