<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // In local development environment, if no user is logged in, auto-login seeded Admin for preview
        if (!Auth::check() && app()->environment('local')) {
            $adminUser = User::where('role', 'admin')->first();
            if ($adminUser) {
                Auth::login($adminUser);
            }
        }

        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login')->with('error', 'Please log in with admin privileges.');
        }

        if ($user->role !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
            }
            abort(403, 'Unauthorized. Administrator access required.');
        }

        return $next($request);
    }
}
