<!-- SELL PET CTA BANNER COMPONENT -->
<section id="sell-pet-banner" class="sell-pet-section">
    <div class="shell-1440">
        <div class="container">
            <div class="sell-banner-card">
                
                <!-- Left Content Area -->
                <div class="sell-banner-content">
                    <div class="sell-badge">
                        <span class="sell-badge-text">Sell Pet</span>
                        <img src="{{ asset('images/sell-pet-icon.svg') }}" alt="Sell Pet Icon" class="sell-badge-icon">
                    </div>

                    <h2 class="sell-banner-title">
                        Want to Sell or Rehome <br>a Pet?
                    </h2>

                    <p class="sell-banner-desc">
                        Create a pet listing with the required details and photos, then submit it for review.
                    </p>

                    <a href="{{ route('login') }}?redirect={{ urlencode(route('seller.create-listing')) }}" class="btn-sell-pet-banner">Sell a Pet</a>
                </div>

                <!-- Right Positioned Visual Images (Exact Figma Positioned Elements) -->
                <div class="sell-banner-visuals">
                    <!-- Animals Image (cta-animal-img.png) -->
                    <img src="{{ asset('images/cta-animal-img.png') }}" alt="Pets Rehome Group" class="cta-animal-img">

                    <!-- Hand & Dog Paw Image (cta-hand-img.png) -->
                    <img src="{{ asset('images/cta-hand-img.png') }}" alt="Human Hand Holding Dog Paw" class="cta-hand-img">
                </div>

            </div>
        </div>
    </div>
</section>
