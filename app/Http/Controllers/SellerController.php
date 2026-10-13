<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Listing;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Favorite;

class SellerController extends Controller
{
    protected function getActiveUser()
    {
        return auth()->user() ?: User::where('email', 'seller@petmarket.pk')->first() ?: User::first();
    }

    public function profile(Request $request)
    {
        $userId = $request->query('id');
        $user = $userId ? User::findOrFail($userId) : $this->getActiveUser();

        $activeListings = Listing::where('user_id', $user->id)
            ->where('status', 'live')
            ->with(['images', 'category', 'breed'])
            ->latest()
            ->get();

        $soldListings = Listing::where('user_id', $user->id)
            ->where('status', 'sold')
            ->with(['images', 'category', 'breed'])
            ->latest()
            ->get();

        $reviews = $user->reviewsReceived()->with('reviewer')->latest()->get();
        $averageRating = $reviews->avg('rating') ?: 5.0;

        return view('seller-profile', compact('user', 'activeListings', 'soldListings', 'reviews', 'averageRating'));
    }

    public function listings(Request $request)
    {
        $user = $this->getActiveUser();
        $tab = $request->query('tab', 'all');

        $listingsQuery = Listing::where('user_id', $user->id)
            ->with(['images', 'category', 'breed'])
            ->latest();

        $allListings = $listingsQuery->get();

        // If the current user has no listings yet, fallback to available marketplace listings
        if ($allListings->isEmpty() && Listing::exists()) {
            $allListings = Listing::with(['images', 'category', 'breed'])->latest()->get();
        }

        $counts = [
            'all' => $allListings->count(),
            'live' => $allListings->where('status', 'live')->count(),
            'pending' => $allListings->where('status', 'pending')->count(),
            'draft' => $allListings->where('status', 'draft')->count(),
            'rejected' => $allListings->where('status', 'rejected')->count(),
            'sold' => $allListings->where('status', 'sold')->count(),
        ];

        $filteredListings = $tab === 'all' 
            ? $allListings 
            : $allListings->where('status', $tab);

        return view('seller-listings', compact('user', 'filteredListings', 'counts', 'tab'));
    }

    public function createListing()
    {
        $user = $this->getActiveUser();
        $categories = Category::with('breeds')->where('is_active', true)->orderBy('sort_order')->get();
        $breeds = Breed::all();

        return view('create-listings', compact('user', 'categories', 'breeds'));
    }

    public function messages(Request $request)
    {
        $user = $this->getActiveUser();
        $activeConversationId = $request->query('conversation_id');

        $conversations = Conversation::where('seller_id', $user->id)
            ->orWhere('buyer_id', $user->id)
            ->with(['listing.images', 'buyer', 'seller', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get();

        $activeConversation = null;
        if ($activeConversationId) {
            $activeConversation = $conversations->firstWhere('id', $activeConversationId);
        }
        if (!$activeConversation && $conversations->isNotEmpty()) {
            $activeConversation = $conversations->first();
        }

        $messages = collect();
        if ($activeConversation) {
            $messages = $activeConversation->messages()->with('sender')->get();
        }

        return view('seller-messages', compact('user', 'conversations', 'activeConversation', 'messages'));
    }

    public function settings()
    {
        $user = $this->getActiveUser();
        return view('seller-settings', compact('user'));
    }

    public function settingsContact()
    {
        $user = $this->getActiveUser();
        return view('seller-settings-contact', compact('user'));
    }

    public function settingsSecurity()
    {
        $user = $this->getActiveUser();
        return view('seller-settings-security', compact('user'));
    }

    public function settingsNotifications()
    {
        $user = $this->getActiveUser();
        return view('seller-settings-notifications', compact('user'));
    }

    public function settingsAccount()
    {
        $user = $this->getActiveUser();
        return view('seller-settings-account', compact('user'));
    }

    public function favorites()
    {
        $user = $this->getActiveUser();
        $favorites = $user->favoriteListings()
            ->with(['images', 'category', 'breed', 'user'])
            ->latest('favorites.created_at')
            ->get();

        return view('favorites', compact('user', 'favorites'));
    }
}
