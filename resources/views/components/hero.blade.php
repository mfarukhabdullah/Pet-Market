{{-- USER PROMPT: "category page ka heroo section bhi dynamic kro" --}}
@props(['title' => null, 'description' => null, 'image' => null])

@php
    $defaultTitle = \App\Models\SiteSetting::get('category_hero_title', 'Browse Pet Listings');
    $defaultDesc = \App\Models\SiteSetting::get('category_hero_desc', 'Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.');
    $defaultImage = \App\Models\SiteSetting::get('category_hero_image', 'images/category-hero-img.png');

    $finalTitle = $title ?? $defaultTitle;
    $finalDesc = $description ?? $defaultDesc;
    $finalImage = $image ?? $defaultImage;
@endphp

<style>
    @media (max-width: 768px) {
        .category-hero-section .container {
            padding: 0 !important;
        }
    }
</style>

<section class="category-hero-section">
    <div class="shell-1440">
        <div class="container">
            <div class="category-hero-grid">
                
                <!-- Left Hero Text Content -->
                <div class="category-hero-text">
                    <h1 class="category-hero-title">{{ $finalTitle }}</h1>
                    <p class="category-hero-desc">
                        {{ $finalDesc }}
                    </p>
                </div>

                <!-- Right Hero Animal Collage Visual -->
                <div class="category-hero-visual">
                    <div class="category-hero-img-wrapper">
                        <img src="{{ asset('images/Rectangle 5.svg') }}" class="hero-shape hero-shape-5" alt="">
                        <img src="{{ asset('images/Rectangle 6.svg') }}" class="hero-shape hero-shape-6" alt="">
                        <img src="{{ asset('images/Rectangle 7.svg') }}" class="hero-shape hero-shape-7" alt="">
                        <img src="{{ asset($finalImage) }}" alt="Pets Collage" class="category-hero-pets-img" onerror="this.src='{{ asset('images/category-hero-img.png') }}'">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Search/Filter Slot -->
    {{ $slot }}
</section>
