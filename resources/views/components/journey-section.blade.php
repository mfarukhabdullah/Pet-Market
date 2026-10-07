

<div class="home-journey-section">
    <h2 class="home-sec-title home-sec-title--center">A Simple Marketplace Journey</h2>
    <p class="home-sec-desc home-sec-desc--center">How to buy or sell pets easily and safely.</p>
    <div class="home-journey">
        <div class="home-step home-step--1">
            <img src="{{ asset('images/search.svg') }}" class="home-step-bg-icon" alt="">
            <div class="home-step-body">
                <div class="home-step-icon"><img src="{{ asset('images/search.svg') }}" alt=""></div>
                <h3 class="home-step-title">Search and Filter</h3>
                <p class="home-step-text">Search by pet category, breed, location and price to find relevant listings.</p>
            </div>
        </div>
        <div class="home-step home-step--2">
            <img src="{{ asset('images/review-icon.svg') }}" class="home-step-bg-icon" alt="">
            <div class="home-step-body">
                <div class="home-step-icon"><img src="{{ asset('images/review-icon.svg') }}" alt=""></div>
                <h3 class="home-step-title">Review the Listing</h3>
                <p class="home-step-text">Check photos, pet details, health information and seller profile before making contact.</p>
            </div>
        </div>
        <div class="home-step home-step--3">
            <!-- Floating Animals on top of card -->
            @if(!request()->is('about'))
                <img src="{{ asset('images/cat-journey.png') }}" class="home-step-cat" alt="">
                <img src="{{ asset('images/dog-journey.png') }}" class="home-step-dog" alt="">
            @endif

            <img src="{{ asset('images/contact-seller.svg') }}" class="home-step-bg-icon" alt="">
            <div class="home-step-body">
                <div class="home-step-icon"><img src="{{ asset('images/contact-seller.svg') }}" alt=""></div>
                <h3 class="home-step-title">Contact the Seller</h3>
                <p class="home-step-text">Send an inquiry or message without exposing private contact details by default.</p>
            </div>
        </div>
    </div>
</div>
