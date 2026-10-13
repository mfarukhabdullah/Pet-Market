<?php

namespace App\Services;

use App\Models\User;
use App\Models\ListingImage;

class AntiScamService
{
    /**
     * Regex patterns for high-risk scam triggers:
     * - Pakistani Phone numbers (03xx, +923xx)
     * - WhatsApp URLs
     * - Advance payment / wallet terms (Easypaisa, JazzCash, Bank, Token, Advance)
     */
    protected $phoneRegex = '/((\+92|0092|0)?3[0-9]{2}[ -]?[0-9]{7})/i';
    protected $advancePaymentRegex = '/(easypaisa|jazzcash|nayapay|sadapay|advance|token money|bank transfer|cargo advance)/i';
    protected $externalLinkRegex = '/(https?:\/\/[^\s]+|wa\.me\/[0-9]+)/i';

    /**
     * Inspect and sanitize a chat message.
     * If user is new (< 24 hours) or unverified and shares advance payment keywords,
     * we flag with an in-chat safety warning.
     */
    public function inspectChatMessage(User $sender, string $text): array
    {
        $hasWarning = false;
        $warningText = null;

        $hasPhone = (bool) preg_match($this->phoneRegex, $text);
        $hasAdvance = (bool) preg_match($this->advancePaymentRegex, $text);
        $hasLink = (bool) preg_match($this->externalLinkRegex, $text);

        if ($hasAdvance) {
            $hasWarning = true;
            $warningText = 'Safety Alert: Never send advance token money via Easypaisa or JazzCash. Always inspect the pet in person before paying.';
            // Dispatch async fraud alert for moderation review
            \App\Jobs\LogScamAlertJob::dispatch($sender->id, 'Advance Token Payment Scam Attempt', $text);
        } elseif ($hasLink) {
            $hasWarning = true;
            $warningText = 'Security Warning: Be cautious of external links or unfamiliar websites.';
        } elseif ($hasPhone && (!$sender->is_verified || $sender->created_at->diffInHours(now()) < 24)) {
            $hasWarning = true;
            $warningText = 'Safety Notice: For your security, complete preliminary negotiations through the platform chat.';
        }

        return [
            'body' => $text,
            'has_warning' => $hasWarning,
            'warning_text' => $warningText,
        ];
    }

    /**
     * Check if an uploaded image is a duplicate of an existing listing image.
     */
    public function isDuplicateImage(string $hash): bool
    {
        if (empty($hash)) {
            return false;
        }

        return ListingImage::where('phash', $hash)->exists();
    }
}
