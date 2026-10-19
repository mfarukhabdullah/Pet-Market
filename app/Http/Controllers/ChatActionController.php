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
        return auth()->user();
    }

    /**
     * Start chat from pet-details.blade.php
     */
    public function startChat($listingId)
    {
        if (!auth()->check()) {
            return redirect()->route('sign', [
                'redirect' => route('chat.start', ['listingId' => $listingId])
            ])->with('info', 'Please create an account to message the seller.');
        }

        $buyer = auth()->user();
        $listing = Listing::findOrFail($listingId);

        if ($listing->user_id === $buyer->id) {
            $conversation = Conversation::where('listing_id', $listing->id)->latest('last_message_at')->first();
            if ($conversation) {
                return redirect()->route('seller.messages', ['conversation_id' => $conversation->id]);
            }

            $otherUser = User::where('id', '!=', $buyer->id)->first();
            if ($otherUser) {
                $conversation = Conversation::firstOrCreate(
                    [
                        'listing_id' => $listing->id,
                        'buyer_id' => $otherUser->id,
                    ],
                    [
                        'seller_id' => $listing->user_id,
                        'last_message_at' => now(),
                    ]
                );
                return redirect()->route('seller.messages', ['conversation_id' => $conversation->id]);
            }

            return redirect()->route('seller.messages');
        }

        $conversation = $this->chatService->getOrCreateConversation($listing, $buyer);

        return redirect()->route('seller.messages', ['conversation_id' => $conversation->id]);
    }

    /**
     * Send message via AJAX.
     */
    public function sendMessage(Request $request)
    {
        $sender = $this->getActiveUser();

        if (!$request->has('body') && $request->has('message')) {
            $request->merge(['body' => $request->input('message')]);
        }

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

    // USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do"
    public function deleteMessage(Request $request, $messageId)
    {
        $user = $this->getActiveUser();
        $message = Message::findOrFail($messageId);
        $conversation = $message->conversation;

        if ($user && $conversation && $conversation->buyer_id !== $user->id && $conversation->seller_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $deleteType = $request->input('delete_type', 'for_me');
        if ($deleteType === 'for_everyone' && $user && $message->sender_id === $user->id) {
            $message->body = 'This message was deleted';
            $message->type = 'deleted';
            $message->save();
        } else {
            $message->delete();
        }

        return response()->json(['success' => true]);
    }

    // USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do"
    public function deleteConversation(Request $request, $id)
    {
        $user = $this->getActiveUser();
        $conversation = Conversation::findOrFail($id);

        if ($user && $conversation->buyer_id !== $user->id && $conversation->seller_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $conversation->messages()->delete();
        $conversation->delete();

        return response()->json(['success' => true]);
    }

    // USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do"
    public function clearConversation(Request $request, $id)
    {
        $user = $this->getActiveUser();
        $conversation = Conversation::findOrFail($id);

        if ($user && $conversation->buyer_id !== $user->id && $conversation->seller_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $conversation->messages()->delete();

        return response()->json(['success' => true]);
    }
}
