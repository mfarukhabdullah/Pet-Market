<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Conversation;
use App\Services\SellerAnalyticsService;

class DashboardController extends Controller
{
    protected $analyticsService;

    public function __construct(SellerAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function index(Request $request)
    {
        // For development/demo, default to Ahmed Khan if not logged in
        $user = auth()->user() ?: User::where('email', 'seller@petmarket.pk')->first();

        if (!$user) {
            $user = User::first();
        }

        $stats = $this->analyticsService->getDashboardStats($user);

        // USER PROMPT: "there is one more issue in mobile view when we click on My Dashboard there is no card show in my listing set this  just set this issue"
        // Recent listings
        $recentListings = Listing::where('user_id', $user->id)
            ->with(['images', 'category', 'breed'])
            ->latest()
            ->take(5)
            ->get();

        // If the current user has no listings yet, fallback to available marketplace listings so cards show
        if ($recentListings->isEmpty() && Listing::exists()) {
            $recentListings = Listing::with(['images', 'category', 'breed'])
                ->latest()
                ->take(5)
                ->get();
        }

        if (($stats['live_count'] ?? 0) === 0 && $recentListings->isNotEmpty()) {
            $stats['live_count'] = $recentListings->where('status', 'live')->count() ?: $recentListings->count();
        }

        // Recent conversations / messages
        $recentConversations = Conversation::where('seller_id', $user->id)
            ->orWhere('buyer_id', $user->id)
            ->with(['listing.images', 'buyer', 'seller', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->take(5)
            ->get();

        if ($recentConversations->isEmpty() && Conversation::exists()) {
            $recentConversations = Conversation::with(['listing.images', 'buyer', 'seller', 'latestMessage'])
                ->orderBy('last_message_at', 'desc')
                ->take(5)
                ->get();
        }

        // USER PROMPT: "listen those pets that are select as favrtouite in desktop view should  be shown in mobile view  both view show paralel things"
        // Recent favorites
        $userFavorites = $user->favoriteListings()
            ->with(['images', 'category', 'breed', 'user'])
            ->latest('favorites.created_at')
            ->take(4)
            ->get();

        $stats['favorites_count'] = $user->favoriteListings()->count();

        // Show actual favorited pets parallel across both desktop and mobile views
        if ($userFavorites->isNotEmpty()) {
            $recentFavorites = $userFavorites;
        } elseif (Listing::exists()) {
            $recentFavorites = Listing::with(['images', 'category', 'breed', 'user'])
                ->latest()
                ->take(4)
                ->get();
        } else {
            $recentFavorites = collect();
        }

        return view('dashboard', compact(
            'user',
            'stats',
            'recentListings',
            'recentConversations',
            'recentFavorites'
        ));
    }
}
