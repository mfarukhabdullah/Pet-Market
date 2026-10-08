<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Pet Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
    <x-header />

    <main class="site-wrapper">
        <!-- Hero Section -->
        <x-contact-hero />

        <!-- Main Content Section -->
        <section class="contact-main">
            <div class="shell-1440">
                <div class="container">
                    <div class="contact-grid">
                        
                        <!-- Left Side: Contact Info -->
                        <div class="contact-info">
                            <h2 class="contact-info-title">Contact & Support</h2>
                            <p class="contact-info-desc">Use the details below or send us a message through the form.</p>

                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h3 class="contact-method-title">Email Support</h3>
                                    <p class="contact-method-value">support@petmarket.com</p>
                                </div>
                            </div>

                            <div class="contact-separator"></div>

                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h3 class="contact-method-title">Phone</h3>
                                    <p class="contact-method-value">+92 310 0865755</p>
                                </div>
                            </div>

                            <div class="contact-separator"></div>

                            <div class="contact-social">
                                <h3 class="contact-method-title" style="margin-bottom: 12px;">Follow Us</h3>
                                <div class="social-icons">
                                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Contact Form -->
                        <div class="contact-form-wrapper">
                            <div class="contact-form-card">
                                <h2 class="form-title">Send us a message</h2>
                                <p class="form-desc">Tell us what you need help with and provide enough detail for the support team.</p>

                                <form class="contact-form" onsubmit="event.preventDefault();">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-input" placeholder="Your full name" pattern="^[^0-9]*$" title="Numbers are not allowed in the name" oninput="this.value = this.value.replace(/[0-9]/g, '')" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-input" placeholder="Your email address">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="tel" class="form-input" placeholder="Your phone number" pattern="^[0-9\+\-\s\(\)]+$" title="Only numbers and phone symbols are allowed" oninput="this.value = this.value.replace(/[^0-9\+\-\s\(\)]/g, '')" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Subject</label>
                                            <input type="text" class="form-input" placeholder="Message subject">
                                        </div>
                                    </div>
                                    <div class="form-group full-width">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-input form-textarea" placeholder="Type your message here..."></textarea>
                                    </div>

                                    <div class="form-submit">
                                        <button type="submit" class="submit-btn">
                                            Send Message <i class="fa-regular fa-paper-plane" style="margin-left: 8px;"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-footer />

    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>
