<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Pet Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <x-header />

    <main class="site-wrapper">
        <!-- Hero Section -->
        <x-contact-hero title="About Us" subtitle="A trusted place to discover, list and connect around pets." />

        <!-- Our Purpose Section -->
        {{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
        <section class="about-purpose">
            <div class="shell-1440">
                <div class="container about-purpose-container">
                    <div class="about-purpose-image">
                        <img src="{{ asset(\App\Models\SiteSetting::get('about_purpose_image', 'images/about-purpose.jpg')) }}" alt="Our Purpose Visual" onerror="this.src='{{ asset('images/about-purpose.jpg') }}'">
                    </div>
                    <div class="about-purpose-content">
                        <span class="about-badge-text">{{ \App\Models\SiteSetting::get('about_purpose_badge', 'OUR PURPOSE') }}</span>
                        <h2 class="about-sec-title">{{ \App\Models\SiteSetting::get('about_purpose_title', 'A marketplace built around better information, not just listings.') }}</h2>
                        <p class="about-sec-desc">
                            {{ \App\Models\SiteSetting::get('about_purpose_desc1', 'Finding a pet is different from buying an ordinary classified item. Buyers need to understand the animal, its health information, seller details and long-term care requirements before making a decision.') }}
                        </p>
                        <p class="about-sec-desc">
                            {{ \App\Models\SiteSetting::get('about_purpose_desc2', 'That is why the marketplace brings pet details, seller profiles, messaging, moderation and safety guidance into one consistent journey.') }}
                        </p>
                        @php
                            $purposePoints = array_values(array_filter(array_map('trim', explode("\n", \App\Models\SiteSetting::get('about_purpose_points', "Clear breed, age, gender, price and location information.\nHealth and vaccination details where applicable.\nSeller information and marketplace messaging before contact.")))));
                        @endphp
                        <ul class="about-features-list">
                            @foreach($purposePoints as $point)
                                <li><i class="fa-solid fa-check"></i> {{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- One Marketplace Section -->
        {{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
        <section class="about-marketplace">
            <div class="shell-1440">
                <div class="container about-marketplace-container">
                    <div class="about-marketplace-content">
                        <h2 class="about-sec-title">{{ \App\Models\SiteSetting::get('about_marketplace_title', 'One marketplace for different pet-related needs.') }}</h2>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">{{ \App\Models\SiteSetting::get('about_need_1_title', 'Individual pet owners') }}</h3>
                            <p class="about-need-desc">{{ \App\Models\SiteSetting::get('about_need_1_desc', 'People who want to sell or responsibly rehome a pet through a structured listing.') }}</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">{{ \App\Models\SiteSetting::get('about_need_2_title', 'Pet buyers') }}</h3>
                            <p class="about-need-desc">{{ \App\Models\SiteSetting::get('about_need_2_desc', 'Users looking for specific breeds, ages, genders, price ranges or locations.') }}</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">{{ \App\Models\SiteSetting::get('about_need_3_title', 'Breeders and pet businesses') }}</h3>
                            <p class="about-need-desc">{{ \App\Models\SiteSetting::get('about_need_3_desc', 'Professional sellers that need profiles, listings and marketplace visibility.') }}</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">{{ \App\Models\SiteSetting::get('about_need_4_title', 'Platform moderators') }}</h3>
                            <p class="about-need-desc">{{ \App\Models\SiteSetting::get('about_need_4_desc', 'Teams responsible for listings, reports, categories and marketplace quality.') }}</p>
                        </div>
                    </div>
                    <div class="about-marketplace-image">
                        <img src="{{ asset(\App\Models\SiteSetting::get('about_marketplace_image', 'images/about-dogs.jpg')) }}" alt="Marketplace Needs Visual" onerror="this.src='{{ asset('images/about-dogs.jpg') }}'">
                    </div>
                </div>
            </div>
        </section>

        <!-- JOURNEY COMPONENT -->
        <x-journey-section />

        <!-- SAFER INTERACTIONS SECTION (NEW) -->
        <x-safer-interactions />


        <!-- SELL PET BANNER COMPONENT -->
        <x-sell-banner />

    </main>

    <x-footer />

    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>
