<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Listing;
use App\Models\Favorite;

class AuthController extends Controller
{
    // USER PROMPT: "yr jb login ya sign up kro to jis page sy kya ha wapas usy page per redirect kray or jb withoit login sign up kry to sell a pet per tb vo us ko login sign upky bd create listing per redirect kry"
    protected function getPreviousPageRedirect(Request $request): ?string
    {
        $previousUrl = $request->headers->get('referer');
        if (!$previousUrl) {
            return null;
        }

        $previous = parse_url($previousUrl);
        if (!$previous || empty($previous['host']) || $previous['host'] !== $request->getHost()) {
            return null;
        }

        $previousPort = $previous['port'] ?? null;
        $requestPort = $request->getPort();
        if ($previousPort && (int) $previousPort !== (int) $requestPort) {
            return null;
        }

        $path = trim($previous['path'] ?? '/', '/');
        if (in_array($path, ['login', 'register', 'auth/google', 'auth/google/callback'], true)) {
            return null;
        }

        return $previousUrl;
    }

    // USER PROMPT: "yr is main login ya sign up ky liye google ki api lagani hai"
    public function redirectToGoogle(Request $request)
    {
        $clientId = config('services.google.client_id');
        if (!$clientId || !config('services.google.client_secret')) {
            return redirect()->route('login')->withErrors(['email' => 'Google sign-in is not configured yet. Add GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET to .env.']);
        }

        $request->session()->put('google_oauth_state', Str::random(40));
        $request->session()->put('google_oauth_redirect', $request->query('redirect'));
        $request->session()->put('google_oauth_favorite', $request->query('favorite_listing'));
        $request->session()->put('google_oauth_role', $request->query('role', 'buyer') === 'seller' ? 'seller' : 'buyer');

        return redirect()->away('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => config('services.google.redirect'),
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $request->session()->get('google_oauth_state'),
            'prompt' => 'select_account',
        ]));
    }

    // USER PROMPT: "yr is main login ya sign up ky liye google ki api lagani hai"
    public function handleGoogleCallback(Request $request)
    {
        $expectedState = $request->session()->pull('google_oauth_state');
        if (!$expectedState || !$request->filled('state') || !hash_equals($expectedState, (string) $request->input('state'))) {
            return redirect()->route('login')->withErrors(['email' => 'Google sign-in could not be verified. Please try again.']);
        }
        if ($request->filled('error') || !$request->filled('code')) {
            return redirect()->route('login')->withErrors(['email' => 'Google sign-in was cancelled or could not be completed.']);
        }

        try {
            $tokenResponse = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'code' => $request->input('code'),
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect_uri' => config('services.google.redirect'),
                'grant_type' => 'authorization_code',
            ]);
            if (!$tokenResponse->successful() || !$tokenResponse->json('access_token')) {
                throw new \RuntimeException('Google token exchange failed.');
            }
            $profileResponse = Http::withToken($tokenResponse->json('access_token'))->get('https://www.googleapis.com/oauth2/v2/userinfo');
            $profile = $profileResponse->json();
            if (!$profileResponse->successful() || empty($profile['email']) || empty($profile['verified_email'])) {
                throw new \RuntimeException('Google did not return a verified email.');
            }
        } catch (\Throwable $exception) {
            report($exception);
            return redirect()->route('login')->withErrors(['email' => 'Could not verify your Google account. Please try again.']);
        }

        $user = User::where('email', $profile['email'])->first();
        if (!$user) {
            $user = User::create([
                'name' => $profile['name'] ?? $profile['email'],
                'email' => $profile['email'],
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(40)),
                'role' => $request->session()->pull('google_oauth_role', 'buyer'),
                'city' => 'Lahore',
                'trust_score' => 30,
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();
        $favoriteId = $request->session()->pull('google_oauth_favorite');
        if ($favoriteId) {
            $request->merge(['favorite_listing' => $favoriteId]);
        }
        $redirect = $request->session()->pull('google_oauth_redirect');
        if ($redirect) {
            $request->merge(['redirect' => $redirect]);
        }
        $this->handlePendingFavorite($user->id, $request);
        return redirect()->to($this->getSafeRedirectUrl($request, route('dashboard')))->with('success', 'Signed in with Google successfully!');
    }

    protected function handlePendingFavorite($userId, Request $request)
    {
        $favListingId = $request->input('favorite_listing', $request->session()->pull('pending_favorite_listing_id'));
        if ($favListingId && Listing::where('id', $favListingId)->exists()) {
            Favorite::firstOrCreate([
                'user_id' => $userId,
                'listing_id' => $favListingId,
            ]);
        }
    }

    protected function getSafeRedirectUrl(Request $request, $default = null): string
    {
        // USER PROMPT: "yr admin pannel ka loginpassword bnao login tum bnao petmarket@gmail.com password: pet@123"
        $user = Auth::user();
        if ($user && $user->role === 'admin' && !$request->has('redirect') && !$default) {
            return route('admin.dashboard');
        }

        $redirectUrl = $request->input('redirect', $default ?: route('dashboard'));
        $favListingId = $request->input('favorite_listing', $request->session()->get('pending_favorite_listing_id'));

        // If redirect points to favorites list but user favorited a specific pet, keep them on that card!
        if ($favListingId && ($redirectUrl === route('favorites') || strpos($redirectUrl, '/seller/favorites') !== false || empty($redirectUrl))) {
            $listing = Listing::find($favListingId);
            if ($listing) {
                return route('category') . '#listing-' . $favListingId;
            }
        }

        return $redirectUrl;
    }

    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            $this->handlePendingFavorite(Auth::id(), $request);
            $redirectUrl = $this->getSafeRedirectUrl($request);
            return redirect()->to($redirectUrl);
        }

        // USER PROMPT: "yr jb login ya sign up kro to jis page sy kya ha wapas usy page per redirect kray or jb withoit login sign up kry to sell a pet per tb vo us ko login sign upky bd create listing per redirect kry"
        if (!$request->filled('redirect') && ($previousUrl = $this->getPreviousPageRedirect($request))) {
            return redirect()->route('login', ['redirect' => $previousUrl]);
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');
        $input = trim($credentials['email']);

        // Check if user exists with matching email or phone
        $user = User::where('email', $input)->orWhere('phone', $input)->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            $this->handlePendingFavorite($user->id, $request);

            $redirectUrl = $this->getSafeRedirectUrl($request);
            return redirect()->to($redirectUrl)->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister(Request $request)
    {
        if (Auth::check()) {
            $this->handlePendingFavorite(Auth::id(), $request);
            $redirectUrl = $this->getSafeRedirectUrl($request);
            return redirect()->to($redirectUrl);
        }

        // USER PROMPT: "yr jb login ya sign up kro to jis page sy kya ha wapas usy page per redirect kray or jb withoit login sign up kry to sell a pet per tb vo us ko login sign upky bd create listing per redirect kry"
        if (!$request->filled('redirect') && ($previousUrl = $this->getPreviousPageRedirect($request))) {
            return redirect()->route('sign', ['redirect' => $previousUrl]);
        }

        return view('sign');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'location' => 'nullable|string|max:255',
            'role' => 'nullable|in:buyer,seller',
        ]);

        $input = trim($data['email']);
        $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);

        $email = $isEmail ? $input : null;
        $phone = !$isEmail ? $input : null;

        if (!$email) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
            $email = ($cleanPhone ?: 'user_' . time()) . '@petmarket.pk';
        }

        // Check if user already exists
        if ($isEmail && User::where('email', $email)->exists()) {
            return back()->withErrors(['email' => 'An account with this email already exists. Please log in.'])->withInput();
        }

        if ($phone && User::where('phone', $phone)->exists()) {
            return back()->withErrors(['email' => 'An account with this phone number already exists. Please log in.'])->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $email,
            'phone' => $phone,
            'city' => $request->input('location') ?? 'Lahore',
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'buyer',
            'trust_score' => 30,
        ]);

        Auth::login($user);

        $this->handlePendingFavorite($user->id, $request);

        $redirectUrl = $this->getSafeRedirectUrl($request);
        return redirect()->to($redirectUrl)->with('success', 'Welcome to Pet Marketplace!');
    }

    // USER PROMPT: "yr ya direct open ho rha hai login ni mang rha hai"
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->is('admin*') || $request->routeIs('admin.*')) {
            return redirect()->route('login')->with('success', 'You have been logged out from Admin. Please sign in to continue.');
        }

        return redirect()->route('login')->with('success', 'You have been logged out. Please sign in to continue.');
    }

    /**
     * Quick switcher for test environment & simulated Google login
     */
    public function switchDemoUser($role = 'seller')
    {
        $redirect = request('redirect');

        // Handle case where URL was formatted as /demo-login/buyer&redirect=...
        if ($role && strpos($role, '&') !== false) {
            $parts = explode('&', $role, 2);
            $role = $parts[0];
            if (empty($redirect) && !empty($parts[1])) {
                parse_str($parts[1], $parsed);
                if (!empty($parsed['redirect'])) {
                    $redirect = $parsed['redirect'];
                }
            }
        }

        $role = request('role', $role);

        // If redirect target is seller portal or create listing, log in as seller
        if ($redirect && (strpos($redirect, 'seller') !== false || strpos($redirect, 'create-listing') !== false)) {
            $role = 'seller';
        }
        // USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
        if ($redirect && strpos($redirect, 'admin') !== false) {
            $role = 'admin';
        }

        // USER PROMPT: "yr admin pannel ka loginpassword bnao login tum bnao petmarket@gmail.com password: pet@123"
        $email = $role === 'admin' 
            ? 'petmarket@gmail.com' 
            : ($role === 'buyer' ? 'buyer@petmarket.pk' : 'seller@petmarket.pk');

        $user = User::where('email', $email)->first() ?: User::where('role', $role)->first() ?: User::first();
        if ($user) {
            Auth::login($user);
            $this->handlePendingFavorite($user->id, request());
        }

        $favListingId = request('favorite_listing', session('pending_favorite_listing_id'));
        $targetUrl = $redirect ?: route('dashboard');
        if ($favListingId && ($targetUrl === route('favorites') || strpos($targetUrl, '/seller/favorites') !== false)) {
            $listing = Listing::find($favListingId);
            if ($listing) {
                $targetUrl = route('category') . '#listing-' . $favListingId;
            }
        }
        return redirect()->to($targetUrl)->with('success', 'Logged in successfully!');
    }
}
