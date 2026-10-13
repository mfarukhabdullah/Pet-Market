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

        // Recent listings
        $recentListings = Listing::where('user_id', $user->id)
            ->with(['images', 'category', 'breed'])
            ->latest()
            ->take(5)
            ->get();

        // Recent conversations / messages
        $recentConversations = Conversation::where('seller_id', $user->id)
            ->orWhere('buyer_id', $user->id)
            ->with(['listing.images', 'buyer', 'seller', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->take(5)
            ->get();

        // Recent favorites
        $recentFavorites = $user->favoriteListings()
            ->with(['images', 'category', 'breed', 'user'])
            ->latest('favorites.created_at')
            ->take(4)
            ->get();

        return view('dashboard', compact(
            'user',
            'stats',
            'recentListings',
            'recentConversations',
            'recentFavorites'
        ));
    }
}
