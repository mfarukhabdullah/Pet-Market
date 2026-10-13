<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Listing;
use App\Models\User;

class ChatService
{
    protected $antiScam;

    public function __construct(AntiScamService $antiScam)
    {
        $this->antiScam = $antiScam;
    }

    /**
     * Get or create a conversation between buyer and seller for an ad.
     */
    public function getOrCreateConversation(Listing $listing, User $buyer): Conversation
    {
        return Conversation::firstOrCreate(
            [
                'listing_id' => $listing->id,
                'buyer_id' => $buyer->id,
            ],
            [
                'seller_id' => $listing->user_id,
                'last_message_at' => now(),
            ]
        );
    }

    /**
     * Send a text message with anti-scam inspection.
     */
    public function sendMessage(Conversation $conversation, User $sender, string $text): Message
    {
        $inspection = $this->antiScam->inspectChatMessage($sender, $text);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $sender->id,
            'type' => 'text',
            'body' => $inspection['body'],
            'has_warning' => $inspection['has_warning'],
            'warning_text' => $inspection['warning_text'],
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return $message;
    }

    /**
     * Submit a formal price offer in chat.
     */
    public function sendOffer(Conversation $conversation, User $buyer, float $amount, ?string $note = null): Message
    {
        $body = $note ?: "I would like to make an offer of PKR " . number_format($amount, 0);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $buyer->id,
            'type' => 'offer',
            'body' => $body,
            'offer_amount' => $amount,
            'offer_status' => 'pending',
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return $message;
    }

    /**
     * Accept or reject an offer.
     */
    public function respondToOffer(Message $offerMessage, User $seller, string $status): Message
    {
        $offerMessage->update(['offer_status' => $status]);
        return $offerMessage;
    }

    /**
     * Mark all unread messages in conversation as read for the current user.
     */
    public function markAsRead(Conversation $conversation, User $reader): int
    {
        return Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', $reader->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }
}
