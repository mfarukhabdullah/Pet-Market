@props(['title', 'description'])

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
                    <h1 class="category-hero-title">{{ $title }}</h1>
                    <p class="category-hero-desc">
                        {{ $description }}
                    </p>
                </div>

                <!-- Right Hero Animal Collage Visual -->
                <div class="category-hero-visual">
                    <div class="category-hero-img-wrapper">
                        <img src="{{ asset('images/Rectangle 5.svg') }}" class="hero-shape hero-shape-5" alt="">
                        <img src="{{ asset('images/Rectangle 6.svg') }}" class="hero-shape hero-shape-6" alt="">
                        <img src="{{ asset('images/Rectangle 7.svg') }}" class="hero-shape hero-shape-7" alt="">
                        <img src="{{ asset('images/category-hero-img.png') }}" alt="Pets Collage" class="category-hero-pets-img">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Search/Filter Slot -->
    {{ $slot }}
</section>
