<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'buyer_id',
        'seller_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function unreadMessagesFor(int $userId)
    {
        return $this->hasMany(Message::class)
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false);
    }

    public function getOtherUser(int $currentUserId): User
    {
        return $this->buyer_id === $currentUserId ? $this->seller : $this->buyer;
    }

    public function otherParticipant($currentUserId)
    {
        return $this->buyer_id == $currentUserId ? $this->seller : $this->buyer;
    }
}
