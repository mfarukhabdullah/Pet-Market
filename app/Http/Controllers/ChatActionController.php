<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatService;
use App\Models\User;
use App\Models\Listing;
use App\Models\Conversation;
use App\Models\Message;

class ChatActionController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    protected function getActiveUser()
    {
        return auth()->user() ?: User::where('email', 'buyer@petmarket.pk')->first() ?: User::first();
    }

    /**
     * Start chat from pet-details.blade.php
     */
    public function startChat($listingId)
    {
        $buyer = $this->getActiveUser();
        $listing = Listing::findOrFail($listingId);

        $conversation = $this->chatService->getOrCreateConversation($listing, $buyer);

        return redirect()->route('seller.messages', ['conversation_id' => $conversation->id]);
    }

    /**
     * Send message via AJAX.
     */
    public function sendMessage(Request $request)
    {
        $sender = $this->getActiveUser();

        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'body' => 'required|string|max:2000',
        ]);

        $conversation = Conversation::findOrFail($request->input('conversation_id'));
        $message = $this->chatService->sendMessage($conversation, $sender, $request->input('body'));

        return response()->json([
            'success' => true,
            'message' => $message,
            'sender_name' => $sender->name,
            'sender_avatar' => $sender->avatar_url,
            'created_at_human' => $message->created_at->diffForHumans(),
        ]);
    }

    /**
     * Send structured offer in chat.
     */
    public function sendOffer(Request $request)
    {
        $buyer = $this->getActiveUser();

        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'offer_amount' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:500',
        ]);

        $conversation = Conversation::findOrFail($request->input('conversation_id'));
        $message = $this->chatService->sendOffer(
            $conversation,
            $buyer,
            (float) $request->input('offer_amount'),
            $request->input('note')
        );

        return response()->json([
            'success' => true,
            'message' => $message,
            'formatted_offer' => 'PKR ' . number_format($message->offer_amount, 0),
        ]);
    }

    /**
     * Accept or reject offer.
     */
    public function respondOffer(Request $request, $messageId)
    {
        $user = $this->getActiveUser();
        $status = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ])['status'];

        $message = Message::where('type', 'offer')->findOrFail($messageId);
        $updatedMessage = $this->chatService->respondToOffer($message, $user, $status);

        return response()->json([
            'success' => true,
            'offer_status' => $updatedMessage->offer_status,
        ]);
    }

    /**
     * Fetch conversation messages via AJAX.
     */
    public function getMessages($conversationId)
    {
        $user = $this->getActiveUser();
        $conversation = Conversation::with(['listing.images', 'buyer', 'seller'])->findOrFail($conversationId);
        $messages = $conversation->messages()->with('sender')->get();

        // Mark unread as read
        $this->chatService->markAsRead($conversation, $user);

        return response()->json([
            'success' => true,
            'conversation' => $conversation,
            'listing' => $conversation->listing,
            'messages' => $messages,
        ]);
    }
}
