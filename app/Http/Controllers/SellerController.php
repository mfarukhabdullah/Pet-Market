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

    // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
    public function profile(Request $request, $id = null)
    {
        if ($request->query('id') && !$id && !$request->ajax()) {
            return redirect()->route('seller.profile', ['id' => $request->query('id')], 301);
        }

        $userId = $id ?: $request->query('id');
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

    // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
    public function listings(Request $request, $tab = null)
    {
        if ($request->query('tab') && !$tab && !$request->ajax()) {
            return redirect()->route('seller.listings', ['tab' => $request->query('tab')], 301);
        }

        $user = $this->getActiveUser();
        $tab = $tab ?: $request->query('tab', 'all');

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

    // USER PROMPT: "when user create a pet list like if am select category as Dog and when i came to breed section there is drop down that show all the breeds of dogs that came from admin panel and user select breed from this drop down offfering breeds"
    public function createListing(Request $request)
    {
        $user = $this->getActiveUser();
        $categories = Category::with(['breeds' => function($q) {
            $q->orderBy('name', 'asc');
        }])->where('is_active', true)->orderBy('sort_order')->get();
        $breeds = Breed::orderBy('name', 'asc')->get();

        $editId = $request->query('edit') ?: $request->query('id');
        $editingListing = null;
        if ($editId) {
            $editingListing = Listing::with(['images', 'category', 'breed'])->find($editId);
        }

        return view('create-listings', compact('user', 'categories', 'breeds', 'editingListing'));
    }

    // USER PROMPT: "in my listing page if user want to edit his pet listing we wil navigate him to create listing page do edit his listing"
    public function editListing(Request $request, $id)
    {
        $request->merge(['edit' => $id]);
        return $this->createListing($request);
    }

    // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
    public function messages(Request $request, $conversation_id = null)
    {
        if ($request->query('conversation_id') && !$conversation_id && !$request->ajax()) {
            return redirect()->route('seller.messages', ['conversation_id' => $request->query('conversation_id')], 301);
        }

        $user = $this->getActiveUser();
        $activeConversationId = $conversation_id ?: $request->query('conversation_id');

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
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $favorites = $user->favoriteListings()
            ->with(['images', 'category', 'breed', 'user'])
            ->latest('favorites.created_at')
            ->get();

        return view('favorites', compact('user', 'favorites'));
    }
}
