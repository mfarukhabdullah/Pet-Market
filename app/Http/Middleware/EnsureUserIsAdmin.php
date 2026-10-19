<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // USER PROMPT: "ni yr ya to alag ha admin pannel in sy is ky liye login ya sin up no need just admin open ho is url sy or login mangy"
        // Strict check: unauthenticated users or non-admins are redirected directly to dedicated Admin Login
        if (!$user || $user->role !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Administrator access required.'], 403);
            }
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
