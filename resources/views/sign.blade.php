<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Pet Marketplace</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Log in to your Pet Marketplace account.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Manrope:wght@600;700;800&family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">

    <style>
        .page-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 900; /* Covers header and footer */
        }

        .login-page-wrapper {
            position: relative;
            z-index: 1000; /* Stays above the overlay */
            min-height: calc(100vh - 80px); /* Adjust based on header height */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-container {
            width: 1120px;
            min-height: 520px;
            background: #FFFFFF;
            border-radius: 26px;
            border: 0.67px solid #E2E7E3;
            box-shadow: 0px 18px 50px rgba(20, 35, 28, 0.10);
            display: flex;
            overflow: hidden;
            max-width: 100%;
            position: relative;
        }

        .close-auth-btn {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 36px;
            height: 36px;
            background-color: #F2F9F5;
            color: #147A4D;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
            z-index: 10;
        }

        .close-auth-btn:hover {
            background-color: #e0f2e9;
            color: #0e5e39;
        }

        .login-image-side {
            width: 472px;
            position: relative;
            flex-shrink: 0;
            align-self: stretch;
        }

        .login-image-side::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(12, 94, 58, 0.06) 0%, rgba(12, 94, 58, 0.18) 100%);
            pointer-events: none;
        }

        .login-image-side img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form-side {
            flex: 1;
            padding: 24px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-family: 'Manrope', sans-serif;
            font-size: 34px;
            font-weight: 700;
            line-height: 52.7px;
            color: #17211C;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 21.7px;
            color: #000000;
            margin-bottom: 16px;
        }

        .auth-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            background-color: #FAFAF8;
            border-radius: 14px;
            border: 0.67px solid #E2E7E3;
            padding: 5.67px;
            margin-bottom: 16px;
        }

        .auth-tab {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 14px;
            line-height: 24.8px;
            color: #667069;
            cursor: pointer;
            border-radius: 10px;
        }

        .auth-tab.active {
            background-color: #FFFFFF;
            color: #147A4D;
            font-size: 15px;
            box-shadow: 0px 4px 14px rgba(20, 35, 28, 0.07);
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 20.15px;
            color: #17211C;
            margin-bottom: 6px;
        }

        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            color: #147A4D;
            font-size: 16px;
        }

        .input-with-icon i.fa-eye,
        .input-with-icon i.fa-eye-slash {
            left: auto;
            right: 15px;
            color: #147A4D;
            cursor: pointer;
        }

        .form-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #E2E7E3;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 100%;
            color: #333;
            outline: none;
            transition: all 0.3s;
        }

        .form-input:focus {
            border-color: #147A4D;
        }

        .form-input::placeholder {
            color: #757575;
        }

        /* Override browser autofill styles */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover, 
        .form-input:-webkit-autofill:focus, 
        .form-input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #333 !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .city-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #FFFFFF;
            border: 0.67px solid #EFEFEF;
            border-radius: 8px;
            margin-top: 4px;
            z-index: 100;
            display: none;
            max-height: 140px; /* Approximately 3 items */
            overflow-y: auto;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        .city-dropdown.active {
            display: block;
        }

        .city-option {
            padding: 12px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #333;
            cursor: pointer;
            transition: background 0.2s;
        }

        .city-option:hover {
            background-color: #F2F9F5;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 20.15px;
            color: #667069;
            cursor: pointer;
        }

        .remember-me input {
            cursor: pointer;
            width: 16px;
            height: 16px;
        }

        .forgot-password {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #147A4D;
            text-decoration: none;
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .form-row .form-group {
            margin-bottom: 0;
            flex: 1;
        }

        .account-type-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .account-type-card {
            cursor: pointer;
        }

        .account-type-card input {
            display: none;
        }

        .account-type-card .card-content {
            border: 1px solid #E2E7E3;
            border-radius: 10px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            height: 85px;
            background: #FFFFFF;
        }

        .account-type-card .card-content i {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F2F9F5;
            border-radius: 8px;
            font-size: 16px;
            color: #147A4D;
        }

        .account-type-card .card-content span {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            line-height: 20.15px;
            color: #17211C;
            text-align: center;
        }

        .account-type-card input:checked + .card-content {
            background-color: #eaf7f0;
            border-color: #147A4D;
        }

        .account-type-card input:checked + .card-content i {
            background-color: #FFFFFF;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.02);
        }

        .btn-login {
            width: 100%;
            height: 44px;
            background-color: #147A4D;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 21.7px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #0e5e39;
        }

        @media (max-width: 900px) {
            .login-page-wrapper {
                padding: 20px 16px;
            }
            
            .login-container {
                flex-direction: column;
                width: 100%;
                max-width: 364px;
                min-height: auto;
                height: auto;
                border-radius: 20px;
                box-shadow: 0px 0px 14px rgba(0, 0, 0, 0.10);
            }

            .login-image-side {
                display: none;
            }

            .login-form-side {
                width: 100%;
                padding: 32px 20px;
                flex: none;
            }

            .login-title {
                text-align: center;
                font-size: 28px;
                line-height: 38px;
            }

            .login-subtitle {
                text-align: center;
                font-size: 14px;
                margin-bottom: 24px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
                margin-bottom: 0;
            }
            
            .form-row .form-group {
                margin-bottom: 16px;
            }

            .account-type-options {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .account-type-card .card-content {
                flex-direction: row;
                justify-content: flex-start;
                padding: 10px 16px;
                height: 60px;
                gap: 16px;
            }

            .account-type-card .card-content i {
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #F2F9F5;
                border-radius: 8px;
                font-size: 16px;
            }

            .account-type-card input:checked + .card-content i {
                background-color: #FFFFFF;
                box-shadow: 0px 2px 4px rgba(0,0,0,0.02);
            }

            .form-options {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- OVERLAY THAT COVERS HEADER AND FOOTER -->
    <div class="page-overlay"></div>

    <!-- HEADER COMPONENT -->
    <x-header />

    <main class="login-page-wrapper">
        <div class="login-container">
            <a href="{{ route('home') }}" class="close-auth-btn" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <div class="login-image-side">
                <img src="{{ asset('images/login-img.png') }}" alt="Welcome Back Pet">
            </div>
            
            <div class="login-form-side">
                <h1 class="login-title">Create Your Account</h1>
                <p class="login-subtitle">Choose your account type and join the marketplace.</p>

                <div class="auth-tabs">
                    @php
                        $redirectSuffix = request()->has('redirect') ? '?redirect=' . urlencode(request()->get('redirect')) : '';
                    @endphp
                    <a href="{{ route('login') }}{{ $redirectSuffix }}" class="auth-tab" style="text-decoration: none;">Login</a>
                    <a href="{{ route('sign') }}{{ $redirectSuffix }}" class="auth-tab active" style="text-decoration: none;">Create Account</a>
                </div>
                
                <form action="#" method="POST" autocomplete="off">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <div class="input-with-icon">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" name="name" class="form-input" placeholder="Your full name" pattern="^[^0-9]*$" title="Numbers are not allowed in the name" oninput="this.value = this.value.replace(/[0-9]/g, '')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <div class="input-with-icon" style="position: relative;">
                                <svg class="input-icon-svg" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#147A4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 15px;">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <input type="text" name="location" id="location-input" class="form-input" placeholder="Select city" autocomplete="off" required>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#667069" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; right: 15px; cursor: pointer; pointer-events: none;">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                                <div class="city-dropdown" id="city-dropdown">
                                    <div class="city-option">New York</div>
                                    <div class="city-option">Los Angeles</div>
                                    <div class="city-option">Chicago</div>
                                    <div class="city-option">Houston</div>
                                    <div class="city-option">Phoenix</div>
                                    <div class="city-option">Philadelphia</div>
                                    <div class="city-option">San Antonio</div>
                                    <div class="city-option">San Diego</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email or Phone</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="text" name="email" class="form-input" placeholder="Enter email or phone number" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <div class="input-with-icon">
                                <svg class="input-icon-svg" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#147A4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 15px;">
                                    <rect x="4" y="11" width="16" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    <line x1="12" y1="15" x2="12" y2="17"></line>
                                </svg>
                                <input type="password" name="password" id="reg-password-input" class="form-input" placeholder="Create password" autocomplete="new-password" required minlength="8">
                                <i class="fa-regular fa-eye toggle-password-btn" data-target="reg-password-input"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-with-icon">
                                <svg class="input-icon-svg" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#147A4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 15px;">
                                    <rect x="4" y="11" width="16" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    <line x1="12" y1="15" x2="12" y2="17"></line>
                                </svg>
                                <input type="password" name="password_confirmation" id="reg-password-confirm" class="form-input" placeholder="Confirm password" autocomplete="new-password" required minlength="8">
                                <i class="fa-regular fa-eye toggle-password-btn" data-target="reg-password-confirm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-options" style="margin-bottom: 24px; margin-top: 8px;">
                        <label class="remember-me">
                            <input type="checkbox" required>
                            <span>I agree to the Terms, Privacy Policy and marketplace safety rules.</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fa-solid fa-user-plus"></i> Create Account
                    </button>
                    
                    <div style="display: flex; align-items: center; justify-content: center; margin: 16px 0;">
                        <div style="height: 1px; background-color: #E2E7E3; flex: 1;"></div>
                        <span style="padding: 0 16px; color: #667069; font-family: 'DM Sans', sans-serif; font-size: 14px;">or</span>
                        <div style="height: 1px; background-color: #E2E7E3; flex: 1;"></div>
                    </div>

                    <button type="button" class="btn-google" style="width: 100%; height: 44px; background-color: #FFFFFF; color: #17211C; border: 1px solid #E2E7E3; border-radius: 10px; font-family: 'DM Sans', sans-serif; font-weight: 600; font-size: 15px; display: flex; align-items: center; justify-content: center; gap: 12px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#F9FAFB'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo" style="width: 20px; height: 20px;">
                        Continue with Google
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.toggle-password-btn');
            toggleBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (input) {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        
                        if (type === 'text') {
                            this.classList.remove('fa-eye');
                            this.classList.add('fa-eye-slash');
                        } else {
                            this.classList.remove('fa-eye-slash');
                            this.classList.add('fa-eye');
                        }
                    }
                });
            });

            // City Dropdown Search Logic
            const locInput = document.getElementById('location-input');
            const cityDropdown = document.getElementById('city-dropdown');
            if (locInput && cityDropdown) {
                const cityOptions = cityDropdown.querySelectorAll('.city-option');

                locInput.addEventListener('focus', () => {
                    cityDropdown.classList.add('active');
                });

                document.addEventListener('click', (e) => {
                    if (!locInput.contains(e.target) && !cityDropdown.contains(e.target)) {
                        cityDropdown.classList.remove('active');
                    }
                });

                locInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();
                    let hasVisible = false;
                    
                    cityOptions.forEach(option => {
                        const text = option.textContent.toLowerCase();
                        if (text.includes(filter)) {
                            option.style.display = 'block';
                            hasVisible = true;
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    
                    if (hasVisible) {
                        cityDropdown.classList.add('active');
                    } else {
                        cityDropdown.classList.remove('active');
                    }
                });

                cityOptions.forEach(option => {
                    option.addEventListener('click', function() {
                        locInput.value = this.textContent;
                        cityDropdown.classList.remove('active');
                    });
                });
            }

            const registerForm = document.querySelector('.login-form-side form');
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectUrl = urlParams.get('redirect');
                    
                    const pass = document.getElementById('reg-password-input').value;
                    const confirmPass = document.getElementById('reg-password-confirm').value;
                    
                    if (pass !== confirmPass) {
                        alert("Passwords do not match!");
                        return;
                    }
                    
                    // Simulate registration delay
                    const btn = registerForm.querySelector('.btn-login');
                    if (btn) {
                        if (!btn.dataset.originalText) btn.dataset.originalText = btn.innerHTML;
                        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Creating Account...';
                        btn.style.opacity = '0.8';
                    }

                    setTimeout(() => {
                        if (redirectUrl) {
                            window.location.href = decodeURIComponent(redirectUrl);
                        } else {
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    }, 800);
                });
            }

            const googleBtn = document.querySelector('.btn-google');
            if (googleBtn) {
                googleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const termsCheckbox = document.querySelector('.form-options input[type="checkbox"]');
                    if (termsCheckbox && !termsCheckbox.checked) {
                        alert("Please agree to the Terms and Privacy Policy before continuing with Google.");
                        return;
                    }
                    
                    // Simulate Google Account Selection
                    const userEmail = prompt("Simulating Google Login...\n\nPlease choose an account to continue to Pet Marketplace:", "user@gmail.com");
                    
                    if (!userEmail) {
                        // User cancelled
                        return;
                    }
                    
                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectUrl = urlParams.get('redirect');
                    
                    if (!this.dataset.originalText) this.dataset.originalText = this.innerHTML;
                    this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Connecting...';
                    this.style.opacity = '0.8';

                    setTimeout(() => {
                        if (redirectUrl) {
                            window.location.href = decodeURIComponent(redirectUrl);
                        } else {
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    }, 800);
                });
            }
        });

        // Reset button states on back navigation (bfcache)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || window.performance && window.performance.navigation.type === 2) {
                const btn = document.querySelector('.btn-login');
                if (btn && btn.dataset.originalText) {
                    btn.innerHTML = btn.dataset.originalText;
                    btn.style.opacity = '1';
                }
                const googleBtn = document.querySelector('.btn-google');
                if (googleBtn && googleBtn.dataset.originalText) {
                    googleBtn.innerHTML = googleBtn.dataset.originalText;
                    googleBtn.style.opacity = '1';
                }
            }
        });
    </script>
</body>
</html>
