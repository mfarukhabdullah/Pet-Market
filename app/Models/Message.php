<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'type',
        'body',
        'attachment_path',
        'offer_amount',
        'offer_status',
        'has_warning',
        'warning_text',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'offer_amount' => 'decimal:2',
        'has_warning' => 'boolean',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
    public function getMessageAttribute()
    {
        return $this->body;
    }

    public function getFormattedOfferAmountAttribute()
    {
        return $this->offer_amount ? 'PKR ' . number_format($this->offer_amount, 0) : null;
    }

    public function getIsFlaggedAttribute()
    {
        return (bool) $this->has_warning;
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
