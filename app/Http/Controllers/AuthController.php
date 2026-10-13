<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
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

        // Check if email or phone
        $field = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();
            $redirectUrl = $request->input('redirect', route('dashboard'));
            return redirect()->intended($redirectUrl);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('sign');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20|unique:users',
            'role' => 'nullable|in:buyer,seller',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'seller',
            'trust_score' => 30,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome to Pet Marketplace!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Quick switcher for test environment
     */
    public function switchDemoUser($role = 'seller')
    {
        $email = $role === 'admin' 
            ? 'admin@petmarket.pk' 
            : ($role === 'buyer' ? 'buyer@petmarket.pk' : 'seller@petmarket.pk');

        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user);
        }

        return redirect()->route('dashboard');
    }
}
