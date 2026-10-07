<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pet Marketplace</title>

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
            height: 547px;
            background: #FFFFFF;
            border-radius: 26px;
            border: 0.67px solid #E2E7E3;
            box-shadow: 0px 0px 12px rgba(20, 35, 28, 0.16);
            display: flex;
            overflow: hidden;
            max-width: 100%;
        }

        .login-image-side {
            width: 472px;
            height: 100%;
            position: relative;
            flex-shrink: 0;
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
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form-side {
            flex: 1;
            padding: 40px 50px;
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
            height: 44px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 24.8px;
            color: #667069;
            cursor: pointer;
            border-radius: 10px;
        }

        .auth-tab.active {
            background-color: #FFFFFF;
            color: #147A4D;
            font-size: 18px;
            box-shadow: 0px 4px 14px rgba(20, 35, 28, 0.07);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 20.15px;
            color: #17211C;
            margin-bottom: 8px;
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
            padding: 14px 15px 14px 45px;
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
            font-size: 13px;
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

        .btn-login {
            width: 100%;
            height: 54px;
            background-color: #147A4D;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 20px;
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
            <div class="login-image-side">
                <img src="{{ asset('images/login-img.png') }}" alt="Welcome Back Pet">
            </div>
            
            <div class="login-form-side">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Login to continue to your Pet Marketplace account.</p>

                <div class="auth-tabs">
                    <a href="{{ route('login') }}" class="auth-tab active" style="text-decoration: none;">Login</a>
                    <a href="{{ route('sign') }}" class="auth-tab" style="text-decoration: none;">Create Account</a>
                </div>

                <form action="#" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label class="form-label">Email or Phone</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="text" name="email" class="form-input" placeholder="Enter email or phone number" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-with-icon">
                            <svg class="input-icon-svg" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#147A4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 15px;">
                                <rect x="4" y="11" width="16" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                <line x1="12" y1="15" x2="12" y2="17"></line>
                            </svg>
                            <input type="password" name="password" id="password-input" class="form-input" placeholder="Enter your password" autocomplete="new-password">
                            <i class="fa-regular fa-eye" id="toggle-password"></i>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Log In
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
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password-input');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'text') {
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>
