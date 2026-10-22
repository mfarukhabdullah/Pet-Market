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
                        {{-- USER PROMPT: "contact us ka ya section dynamic kro" --}}
                        @php
                            $contactTitle = \App\Models\SiteSetting::get('contact_title', 'Contact & Support');
                            $contactDesc = \App\Models\SiteSetting::get('contact_desc', 'Use the details below or send us a message through the form.');
                            $contactEmailTitle = \App\Models\SiteSetting::get('contact_email_title', 'Email Support');
                            $contactEmail = \App\Models\SiteSetting::get('contact_email', 'support@petmarket.com');
                            $contactPhoneTitle = \App\Models\SiteSetting::get('contact_phone_title', 'Phone');
                            $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+92 310 0865755');
                            $contactSocialTitle = \App\Models\SiteSetting::get('contact_social_title', 'Follow Us');
                            $contactFacebook = \App\Models\SiteSetting::get('contact_facebook_url', '#');
                            $contactInstagram = \App\Models\SiteSetting::get('contact_instagram_url', '#');
                            $contactYoutube = \App\Models\SiteSetting::get('contact_youtube_url', '#');
                        @endphp
                        <div class="contact-info">
                            <h2 class="contact-info-title">{{ $contactTitle }}</h2>
                            <p class="contact-info-desc">{{ $contactDesc }}</p>

                            @if(!empty($contactEmail))
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3 class="contact-method-title">{{ $contactEmailTitle }}</h3>
                                        <p class="contact-method-value">
                                            <a href="mailto:{{ $contactEmail }}" style="color: inherit; text-decoration: none;">{{ $contactEmail }}</a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="contact-separator"></div>

                            @if(!empty($contactPhone))
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3 class="contact-method-title">{{ $contactPhoneTitle }}</h3>
                                        <p class="contact-method-value">
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" style="color: inherit; text-decoration: none;">{{ $contactPhone }}</a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="contact-separator"></div>

                            <div class="contact-social">
                                <h3 class="contact-method-title" style="margin-bottom: 12px;">{{ $contactSocialTitle }}</h3>
                                <div class="social-icons">
                                    <a href="{{ (!empty($contactFacebook) && $contactFacebook !== '#') ? $contactFacebook : '#' }}" class="social-icon" target="{{ (!empty($contactFacebook) && $contactFacebook !== '#') ? '_blank' : '_self' }}" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="{{ (!empty($contactInstagram) && $contactInstagram !== '#') ? $contactInstagram : '#' }}" class="social-icon" target="{{ (!empty($contactInstagram) && $contactInstagram !== '#') ? '_blank' : '_self' }}" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="{{ (!empty($contactYoutube) && $contactYoutube !== '#') ? $contactYoutube : '#' }}" class="social-icon" target="{{ (!empty($contactYoutube) && $contactYoutube !== '#') ? '_blank' : '_self' }}" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Contact Form -->
                        <div class="contact-form-wrapper">
                            <div class="contact-form-card">
                                <h2 class="form-title">Send us a message</h2>
                                <p class="form-desc">Tell us what you need help with and provide enough detail for the support team.</p>

                                {{-- USER PROMPT: "yr msg professional way main close ho" --}}
                                <div id="contactFormAlert" class="contact-alert" style="display: none;"></div>

                                @if(session('success'))
                                    <div class="contact-alert contact-alert-success" id="sessionSuccessAlert">
                                        <div class="contact-alert-icon-box">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </div>
                                        <div class="contact-alert-content">
                                            <div class="contact-alert-title">Message Sent Successfully!</div>
                                            <div class="contact-alert-text">{{ session('success') }}</div>
                                        </div>
                                        <button type="button" class="contact-alert-close" onclick="closeContactAlert(this.closest('.contact-alert'))" aria-label="Close message">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <div class="contact-alert-progress">
                                            <div class="contact-alert-progress-fill"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="contact-alert contact-alert-error" id="sessionErrorAlert">
                                        <div class="contact-alert-icon-box">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                        </div>
                                        <div class="contact-alert-content">
                                            <div class="contact-alert-title">Please check the errors below</div>
                                            <div class="contact-alert-text">
                                                <ul style="margin: 0; padding-left: 18px;">
                                                    @foreach($errors->all() as $err)
                                                        <li>{{ $err }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="button" class="contact-alert-close" onclick="closeContactAlert(this.closest('.contact-alert'))" aria-label="Close message">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <div class="contact-alert-progress">
                                            <div class="contact-alert-progress-fill" style="animation-duration: 7s;"></div>
                                        </div>
                                    </div>
                                @endif

                                {{-- USER PROMPT: "yr ya auto main q  a rha hai or msg send main ya via smptp kh rha hai" --}}
                                <form class="contact-form" id="contactUsForm" action="{{ route('contact.send') }}" method="POST" autocomplete="off">
                                    @csrf
                                    {{-- USER PROMPT: "yr ya auto main q  a rha hai or msg send main ya via smptp kh rha hai" --}}
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label" for="contact_name">Full Name <span style="color: #EF4444;">*</span></label>
                                            <input type="text" name="name" id="contact_name" class="form-input" placeholder="Your full name" value="{{ old('name') }}" pattern="^[^0-9]*$" title="Numbers are not allowed in the name" oninput="this.value = this.value.replace(/[0-9]/g, '')" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="contact_email">Email Address <span style="color: #EF4444;">*</span></label>
                                            <input type="email" name="email" id="contact_email" class="form-input" placeholder="Your email address" value="{{ old('email') }}" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label" for="contact_phone">Phone</label>
                                            <input type="tel" name="phone" id="contact_phone" class="form-input" placeholder="Your phone number" value="{{ old('phone') }}" pattern="^[0-9\+\-\s\(\)]+$" title="Only numbers and phone symbols are allowed" oninput="this.value = this.value.replace(/[^0-9\+\-\s\(\)]/g, '')" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="contact_subject">Subject</label>
                                            <input type="text" name="subject" id="contact_subject" class="form-input" placeholder="Message subject" value="{{ old('subject') }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group full-width">
                                        <label class="form-label" for="contact_message">Message <span style="color: #EF4444;">*</span></label>
                                        <textarea name="message" id="contact_message" class="form-input form-textarea" placeholder="Type your message here..." required rows="5">{{ old('message') }}</textarea>
                                    </div>

                                    <div class="form-submit">
                                        <button type="submit" class="submit-btn" id="contactSubmitBtn">
                                            <span class="btn-text">Send Message</span>
                                            <i class="fa-regular fa-paper-plane" style="margin-left: 8px;"></i>
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
    <script>
        // USER PROMPT: "yr msg professional way main close ho"
        function closeContactAlert(el) {
            if (!el || el.classList.contains('closing')) return;
            el.classList.add('closing');
            setTimeout(function() {
                el.style.display = 'none';
                el.classList.remove('closing');
            }, 420);
        }

        function setupAlertAutoClose(alertEl, duration = 5000) {
            if (!alertEl) return;
            let timer = null;
            let isPaused = false;
            let remaining = duration;
            let start = Date.now();

            const startTimer = function() {
                start = Date.now();
                timer = setTimeout(function() {
                    closeContactAlert(alertEl);
                }, remaining);
            };

            const pauseTimer = function() {
                if (!isPaused && timer) {
                    clearTimeout(timer);
                    remaining = Math.max(0, remaining - (Date.now() - start));
                    isPaused = true;
                }
            };

            const resumeTimer = function() {
                if (isPaused && remaining > 0) {
                    isPaused = false;
                    startTimer();
                }
            };

            startTimer();
            alertEl.addEventListener('mouseenter', pauseTimer);
            alertEl.addEventListener('mouseleave', resumeTimer);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactUsForm');
            const alertBox = document.getElementById('contactFormAlert');
            const submitBtn = document.getElementById('contactSubmitBtn');

            // Attach auto-close to existing session alerts if present on page load
            const sessionSuccess = document.getElementById('sessionSuccessAlert');
            if (sessionSuccess) setupAlertAutoClose(sessionSuccess, 5000);

            const sessionError = document.getElementById('sessionErrorAlert');
            if (sessionError) setupAlertAutoClose(sessionError, 7000);

            function showContactAlert(type, title, message) {
                if (!alertBox) return;
                const isSuccess = (type === 'success');
                const icon = isSuccess ? 'fa-solid fa-circle-check' : 'fa-solid fa-triangle-exclamation';
                const duration = isSuccess ? 5000 : 7000;

                alertBox.classList.remove('closing');
                alertBox.className = 'contact-alert ' + (isSuccess ? 'contact-alert-success' : 'contact-alert-error');
                alertBox.innerHTML = `
                    <div class="contact-alert-icon-box">
                        <i class="${icon}"></i>
                    </div>
                    <div class="contact-alert-content">
                        <div class="contact-alert-title">${title}</div>
                        <div class="contact-alert-text">${message}</div>
                    </div>
                    <button type="button" class="contact-alert-close" aria-label="Close message">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="contact-alert-progress">
                        <div class="contact-alert-progress-fill" style="animation-duration: ${duration}ms;"></div>
                    </div>
                `;
                alertBox.style.display = 'flex';

                const closeBtn = alertBox.querySelector('.contact-alert-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        closeContactAlert(alertBox);
                    });
                }

                setupAlertAutoClose(alertBox, duration);
                alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            if (!form || !submitBtn) return;

            form.addEventListener('submit', function(e) {
                // Smooth asynchronous submission
                e.preventDefault();
                
                const originalHtml = submitBtn.innerHTML;
                submitBtn.disabled = true;
                // USER PROMPT: "yr ya auto main q  a rha hai or msg send main ya via smptp kh rha hai"
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right: 8px;"></i> Sending Message...';
                if (alertBox) alertBox.style.display = 'none';

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    // USER PROMPT: "yr msg professional way main close ho"
                    submitBtn.classList.add('btn-success');
                    submitBtn.innerHTML = '<i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> Sent Successfully!';

                    showContactAlert(
                        'success',
                        'Message Sent Successfully!',
                        data.message || 'Thank you! Your message has been sent successfully. Our team will contact you shortly.'
                    );
                    form.reset();

                    setTimeout(() => {
                        submitBtn.classList.remove('btn-success');
                        submitBtn.innerHTML = originalHtml;
                        submitBtn.disabled = false;
                    }, 2800);
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('btn-success');
                    submitBtn.innerHTML = originalHtml;

                    let msg = 'There was an issue sending your message. Please check the fields and try again.';
                    if (error && error.errors) {
                        msg = Object.values(error.errors).flat().join('<br>');
                    } else if (error && error.message) {
                        msg = error.message;
                    }

                    showContactAlert('error', 'Unable to Send Message', msg);
                });
            });
        });
    </script>
</body>
</html>
