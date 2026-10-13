<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureSellerAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // In local development environment, if no user is logged in, auto-login seeded Seller for preview
        if (!Auth::check() && app()->environment('local')) {
            $sellerUser = User::where('email', 'seller@petmarket.pk')->first() ?: User::first();
            if ($sellerUser) {
                Auth::login($sellerUser);
            }
        }

        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login')->with('info', 'Please log in to access your seller portal.');
        }

        return $next($request);
    }
}
