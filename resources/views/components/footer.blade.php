<!-- FOOTER COMPONENT (#223129 - Full Screen Width Background) -->
@if(request()->is('seller/*') || request()->is('dashboard'))
<style>
    @media (max-width: 768px) {
        .marketplace-footer {
            display: none !important;
        }
    }
</style>
@endif
{{-- USER PROMPT: "footer to dynamic kro" --}}
@php
    $footerBrandTitle = \App\Models\SiteSetting::get('footer_brand_title', 'Pet Marketplace');
    $footerBrandLogo = \App\Models\SiteSetting::get('footer_brand_logo', 'images/Italic-text.png');
    $footerBrandDesc = \App\Models\SiteSetting::get('footer_brand_desc', 'A trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses in one safe and easy-to-use platform.');
    
    $footerQuickLinksTitle = \App\Models\SiteSetting::get('footer_quick_links_title', 'Quick Links');
    // USER PROMPT: "ni in ko bhi dynamic kro"
    $footerQuickLinks = \App\Models\SiteSetting::getQuickLinks();
    $footerCategoriesTitle = \App\Models\SiteSetting::get('footer_categories_title', 'Pet Categories');
    $footerContactTitle = \App\Models\SiteSetting::get('footer_contact_title', 'Contact & Support');

    $footerEmail = \App\Models\SiteSetting::get('footer_email', 'Support@petmarket.com');
    $footerPhone = \App\Models\SiteSetting::get('footer_phone', '+92 3100865765');
    
    $footerSocialTitle = \App\Models\SiteSetting::get('footer_social_title', 'Follow Us:');
    $footerFacebook = \App\Models\SiteSetting::get('footer_facebook_url', '#');
    $footerInstagram = \App\Models\SiteSetting::get('footer_instagram_url', '#');
    $footerYoutube = \App\Models\SiteSetting::get('footer_youtube_url', '#');

    $footerCopyright = \App\Models\SiteSetting::get('footer_copyright', '© 2026 Pet Marketplace. All rights reserved.');

    $footerCategories = \App\Models\Category::where('is_active', true)->orderBy('sort_order', 'asc')->take(6)->get();
@endphp
<footer class="marketplace-footer">
    <div class="shell-1440" style="position: relative;">
        <!-- Watermark Paw Image as specified in 3rd Image -->
        <img src="{{ asset('images/paw.png') }}" alt="Watermark Paw" class="footer-paw-watermark">

        <div class="container footer-container-relative">
            <div class="footer-main-grid">

                <!-- Column 1: Brand Info -->
                <div class="footer-col footer-col-brand">
                    <a href="/" class="footer-brand-logo">
                        <div class="footer-logo-white-box">
                            <img src="{{ asset($footerBrandLogo) }}" alt="{{ $footerBrandTitle }} Logo" class="footer-logo-italic-img" onerror="this.src='{{ asset('images/Italic-text.png') }}'">
                        </div>
                        <span class="footer-brand-text">{{ $footerBrandTitle }}</span>
                    </a>
                    <p class="footer-brand-desc">
                        {{ $footerBrandDesc }}
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                {{-- USER PROMPT: "ni in ko bhi dynamic kro" --}}
                <div class="footer-col">
                    <h4 class="footer-col-title">{{ $footerQuickLinksTitle }}</h4>
                    <ul class="footer-link-list">
                        @forelse($footerQuickLinks as $qlink)
                            @php
                                $targetUrl = $qlink['url'] ?? '#';
                                $href = (str_starts_with($targetUrl, 'http://') || str_starts_with($targetUrl, 'https://') || str_starts_with($targetUrl, '#')) 
                                    ? $targetUrl 
                                    : url($targetUrl);
                            @endphp
                            <li><a href="{{ $href }}">{{ $qlink['label'] ?? '' }}</a></li>
                        @empty
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('category') }}">Categories</a></li>
                            <li><a href="{{ route('breeds') }}">Breeds</a></li>
                        @endforelse
                    </ul>
                </div>

                <!-- Column 3: Pet Categories -->
                <div class="footer-col">
                    <h4 class="footer-col-title">{{ $footerCategoriesTitle }}</h4>
                    {{-- USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main" --}}
                    <ul class="footer-link-list">
                        @if($footerCategories && $footerCategories->count() > 0)
                            @foreach($footerCategories as $cat)
                                <li><a href="{{ route('category', ['param1' => $cat->slug]) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="{{ route('category', ['param1' => 'dogs']) }}">Dogs</a></li>
                            <li><a href="{{ route('category', ['param1' => 'cats']) }}">Cats</a></li>
                            <li><a href="{{ route('category', ['param1' => 'birds']) }}">Birds</a></li>
                            <li><a href="{{ route('category', ['param1' => 'rabbits']) }}">Rabbits</a></li>
                            <li><a href="{{ route('category', ['param1' => 'fish']) }}">Fish</a></li>
                            <li><a href="{{ route('category', ['param1' => 'horses-farm']) }}">Horses &amp; Farm</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Column 4: Contact & Support & Social -->
                <div class="footer-col">
                    <h4 class="footer-col-title">{{ $footerContactTitle }}</h4>
                    <div class="footer-contact-items">
                        @if(!empty($footerEmail))
                            <a href="mailto:{{ $footerEmail }}" class="contact-item">
                                <i class="far fa-envelope contact-icon"></i>
                                <span>{{ $footerEmail }}</span>
                            </a>
                        @endif
                        @if(!empty($footerPhone))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="contact-item">
                                <i class="fas fa-phone-alt contact-icon"></i>
                                <span>{{ $footerPhone }}</span>
                            </a>
                        @endif
                    </div>

                    <div class="footer-social-wrapper">
                        <span class="social-title">{{ $footerSocialTitle }}</span>
                        <div class="social-icons-row">
                            <a href="{{ !empty($footerFacebook) ? $footerFacebook : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ !empty($footerInstagram) ? $footerInstagram : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="{{ !empty($footerYoutube) ? $footerYoutube : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bottom-row">
                <div class="copyright-text">
                    {{ $footerCopyright }}
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/pet-script.js') }}"></script>
