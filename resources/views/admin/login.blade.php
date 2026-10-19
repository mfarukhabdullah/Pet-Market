{{-- USER PROMPT: "ni yr ya to alag ha admin pannel in sy is ky liye login ya sin up no need just admin open ho is url sy or login mangy" --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Console Login | Pet Marketplace</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* USER PROMPT: "ni yr ya to alag ha admin pannel in sy is ky liye login ya sin up no need just admin open ho is url sy or login mangy" */
        :root {
            --admin-primary: #147A4D;
            --admin-primary-dark: #0D5C38;
            --admin-primary-light: #EAF7F0;
            --admin-dark-bg: #0B1120;
            --admin-card-bg: #111827;
            --admin-input-bg: #1F2937;
            --admin-border: #374151;
            --admin-text-main: #F9FAFB;
            --admin-text-muted: #9CA3AF;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 50% 20%, #172554 0%, #0B1120 70%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: var(--admin-text-main);
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow & Grid */
        .ambient-glow {
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(20, 122, 77, 0.22) 0%, rgba(20, 122, 77, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .admin-login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            background: rgba(17, 24, 39, 0.94);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 22px;
            padding: 42px 36px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.65), 0 0 0 1px rgba(255, 255, 255, 0.05);
            animation: cardAppear 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* BRAND HEADER */
        .admin-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .admin-brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #147A4D 0%, #0D5C38 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #FFFFFF;
            box-shadow: 0 6px 18px rgba(20, 122, 77, 0.45);
        }

        .admin-brand-info h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: -0.3px;
        }

        .admin-brand-info span {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #34D399;
        }

        /* CARD HEADER */
        .login-header {
            text-align: center;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .login-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #F3F4F6;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 13px;
            color: var(--admin-text-muted);
            line-height: 1.5;
        }

        /* ALERTS */
        .alert-box {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #FCA5A5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #6EE7B7;
        }

        /* FORM CONTROLS */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #D1D5DB;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #6B7280;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-input {
            width: 100%;
            height: 48px;
            background: var(--admin-input-bg);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 0 44px 0 44px;
            font-family: inherit;
            font-size: 14px;
            color: #F9FAFB;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            background: #111827;
        }

        .form-input:focus + .input-icon,
        .input-wrap:focus-within .input-icon {
            color: #10B981;
        }

        .password-toggle-btn {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #6B7280;
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
        }

        .password-toggle-btn:hover {
            color: #D1D5DB;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 13px;
            color: var(--admin-text-muted);
        }

        .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-checkbox input {
            accent-color: #10B981;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* SUBMIT BUTTON */
        .btn-submit-admin {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #147A4D 0%, #0D5C38 100%);
            border: 1px solid rgba(52, 211, 153, 0.3);
            border-radius: 12px;
            color: #FFFFFF;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(20, 122, 77, 0.4);
            transition: all 0.2s;
        }

        .btn-submit-admin:hover {
            background: linear-gradient(135deg, #10B981 0%, #0F766E 100%);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
            transform: translateY(-1px);
        }

        .btn-submit-admin:active {
            transform: translateY(0);
        }

        /* CARD FOOTER */
        .card-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            font-size: 13px;
            color: var(--admin-text-muted);
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }

        .back-link {
            color: #9CA3AF;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #34D399;
        }

        .badge-authorized {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            font-size: 11px;
            color: #6EE7B7;
            font-family: monospace;
        }
    </style>
</head>
<body>

    <div class="ambient-glow"></div>

    <div class="admin-login-card">
        <!-- BRAND -->
        <div class="admin-brand">
            <div class="admin-brand-logo">
                <i class="fa-solid fa-shield-cat"></i>
            </div>
            <div class="admin-brand-info">
                <h1>PetMarket Admin</h1>
                <span>Command &amp; SEO Engine</span>
            </div>
        </div>

        <!-- HEADER -->
        <div class="login-header">
            <h2>Administrator Authentication</h2>
            <p>Master console access for ecosystem control, content moderation, and SEO management.</p>
        </div>

        @if(session('error'))
            <div class="alert-box alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert-box alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
            @csrf

            {{-- USER PROMPT: "yr ya auto main a rha hai" --}}
            {{-- Prevent browsers from auto-populating saved passwords or default emails --}}
            <div class="form-group">
                <label class="form-label" for="admin-email">Admin Email Address</label>
                <div class="input-wrap">
                    <i class="fa-regular fa-envelope input-icon"></i>
                    <input 
                        type="email" 
                        name="email" 
                        id="admin-email" 
                        class="form-input" 
                        value="{{ old('email', '') }}" 
                        placeholder="Enter administrator email" 
                        autocomplete="off"
                        readonly
                        onfocus="this.removeAttribute('readonly');"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="admin-password">Administrator Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="admin-password" 
                        class="form-input" 
                        placeholder="Enter master password" 
                        autocomplete="new-password"
                        readonly
                        onfocus="this.removeAttribute('readonly');"
                        required
                    >
                    <button type="button" class="password-toggle-btn" id="togglePasswordBtn" aria-label="Toggle password visibility">
                        <i class="fa-regular fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="remember-row">
                <label class="remember-checkbox">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep admin session active</span>
                </label>
                <span class="badge-authorized"><i class="fa-solid fa-lock"></i> SSL Secured</span>
            </div>

            <button type="submit" class="btn-submit-admin">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Authenticate &amp; Open Console
            </button>
        </form>

        <div class="card-footer">
            <span class="badge-authorized">
                <i class="fa-solid fa-key"></i> Authorized Admin Access Only
            </span>
            <a href="{{ route('home') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Return to Public Marketplace
            </a>
        </div>
    </div>

    <script>
        // Password toggle script
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('admin-password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        }

        // USER PROMPT: "yr ya auto main a rha hai"
        // Force clear any browser-injected autofill values on page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                const email = document.getElementById('admin-email');
                const pass = document.getElementById('admin-password');
                if (email && !email.value.trim()) {
                    email.value = '';
                }
                if (pass) {
                    pass.value = '';
                }
            }, 100);
        });
    </script>
</body>
</html>
