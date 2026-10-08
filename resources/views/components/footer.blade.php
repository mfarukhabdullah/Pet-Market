<!-- FOOTER COMPONENT (#223129 - Full Screen Width Background) -->
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
                            <img src="{{ asset('images/Italic-text.png') }}" alt="Pet Marketplace Logo" class="footer-logo-italic-img">
                        </div>
                        <span class="footer-brand-text">Pet Marketplace</span>
                    </a>
                    <p class="footer-brand-desc">
                        A trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses in one safe and easy-to-use platform.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-col-title">Quick Links</h4>
                    <ul class="footer-link-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('category') }}">Categories</a></li>
                        <li><a href="{{ route('breeds') }}">Breeds</a></li>
                    </ul>
                </div>

                <!-- Column 3: Pet Categories -->
                <div class="footer-col">
                    <h4 class="footer-col-title">Pet Categories</h4>
                    <ul class="footer-link-list">
                        <li><a href="{{ route('category', ['category' => 'dogs']) }}">Dogs</a></li>
                        <li><a href="{{ route('category', ['category' => 'cats']) }}">Cats</a></li>
                        <li><a href="{{ route('category', ['category' => 'birds']) }}">Birds</a></li>
                        <li><a href="{{ route('category', ['category' => 'rabbits']) }}">Rabbits</a></li>
                        <li><a href="{{ route('category', ['category' => 'fish']) }}">Fish</a></li>
                        <li><a href="{{ route('category', ['category' => 'horses-farm']) }}">Horses & Farm</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact & Support & Social -->
                <div class="footer-col">
                    <h4 class="footer-col-title">Contact & Support</h4>
                    <div class="footer-contact-items">
                        <div class="contact-item">
                            <i class="far fa-envelope contact-icon"></i>
                            <span>Support@petmarket.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <span>+92 3100865765</span>
                        </div>
                    </div>

                    <div class="footer-social-wrapper">
                        <span class="social-title">Follow Us:</span>
                        <div class="social-icons-row">
                            <a href="#" class="social-icon-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon-btn" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bottom-row">
                <div class="copyright-text">
                    © 2026 Pet Marketplace. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
