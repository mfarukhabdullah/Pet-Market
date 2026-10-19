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
        if (!Auth::check()) {
            // Check if it's a favorite toggle request
            if ($request->is('favorites/toggle/*') || $request->routeIs('favorites.toggle')) {
                $listingId = $request->route('listingId');
                if ($listingId) {
                    session(['pending_favorite_listing_id' => $listingId]);
                }

                $returnUrl = $request->input('redirect')
                    ?: $request->header('referer')
                    ?: route('home');

                if ($listingId && strpos($returnUrl, '#') === false) {
                    $returnUrl .= '#listing-' . $listingId;
                }

                $loginUrl = route('login', [
                    'favorite_listing' => $listingId,
                    'redirect' => $returnUrl
                ]);

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'error' => 'Unauthenticated.',
                        'redirect' => $loginUrl,
                        'favorite_listing' => $listingId,
                    ], 401);
                }

                return redirect()->to($loginUrl)
                    ->with('info', 'Please log in to add this pet to your favorites.');
            }

            // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
            if ($request->expectsJson() || $request->ajax() || $request->isJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            // If a buyer clicks to chat/message a seller, redirect them to register first
            if ($request->is('chat/*') || $request->routeIs('chat.*')) {
                return redirect()->route('sign', ['redirect' => $request->fullUrl()])
                    ->with('info', 'Please create an account to message the seller.');
            }

            return redirect()->route('login', ['redirect' => $request->fullUrl()])
                ->with('info', 'Please log in to continue.');
        }

        return $next($request);
    }
}
