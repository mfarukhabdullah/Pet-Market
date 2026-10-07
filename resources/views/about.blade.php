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
        <section class="about-purpose">
            <div class="shell-1440">
                <div class="container about-purpose-container">
                    <div class="about-purpose-image">
                        <img src="{{ asset('images/about-purpose.jpg') }}" alt="Dog playing with frisbee">
                    </div>
                    <div class="about-purpose-content">
                        <span class="about-badge-text">OUR PURPOSE</span>
                        <h2 class="about-sec-title">A marketplace built around better information, not just listings.</h2>
                        <p class="about-sec-desc">
                            Finding a pet is different from buying an ordinary classified item. Buyers need to understand the animal, its health information, seller details and long-term care requirements before making a decision.
                        </p>
                        <p class="about-sec-desc">
                            That is why the marketplace brings pet details, seller profiles, messaging, moderation and safety guidance into one consistent journey.
                        </p>
                        <ul class="about-features-list">
                            <li><i class="fa-solid fa-check"></i> Clear breed, age, gender, price and location information.</li>
                            <li><i class="fa-solid fa-check"></i> Health and vaccination details where applicable.</li>
                            <li><i class="fa-solid fa-check"></i> Seller information and marketplace messaging before contact.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- One Marketplace Section -->
        <section class="about-marketplace">
            <div class="shell-1440">
                <div class="container about-marketplace-container">
                    <div class="about-marketplace-content">
                        <h2 class="about-sec-title">One marketplace for different pet-related needs.</h2>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">Individual pet owners</h3>
                            <p class="about-need-desc">People who want to sell or responsibly rehome a pet through a structured listing.</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">Pet buyers</h3>
                            <p class="about-need-desc">Users looking for specific breeds, ages, genders, price ranges or locations.</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">Breeders and pet businesses</h3>
                            <p class="about-need-desc">Professional sellers that need profiles, listings and marketplace visibility.</p>
                        </div>
                        
                        <div class="about-need-item">
                            <h3 class="about-need-title">Platform moderators</h3>
                            <p class="about-need-desc">Teams responsible for listings, reports, categories and marketplace quality.</p>
                        </div>
                    </div>
                    <div class="about-marketplace-image">
                        <img src="{{ asset('images/about-dogs.jpg') }}" alt="Dogs running">
                    </div>
                </div>
            </div>
        </section>

        <!-- JOURNEY COMPONENT -->
        <x-journey-section />

        <!-- SAFETY & RESPONSIBLE PET OWNERSHIP SECTION COMPONENT -->
        <x-safety-section />

        <!-- SELL PET BANNER COMPONENT -->
        <x-sell-banner />

    </main>

    <x-footer />

    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>
