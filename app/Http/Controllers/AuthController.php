<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Listing;
use App\Models\Favorite;

class AuthController extends Controller
{
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
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

        $email = $role === 'admin' 
            ? 'admin@petmarket.pk' 
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
