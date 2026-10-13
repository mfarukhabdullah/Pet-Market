<?php

namespace App\Services;

use App\Models\User;
use App\Models\Listing;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class SellerAnalyticsService
{
    /**
     * Get aggregated metrics for seller dashboard.
     */
    public function getDashboardStats(User $seller): array
    {
        $cacheKey = "seller_dashboard_stats_{$seller->id}";

        return Cache::remember($cacheKey, 60, function () use ($seller) {
            $listings = Listing::where('user_id', $seller->id)->get();

            $liveCount = $listings->where('status', 'live')->count();
            $soldCount = $listings->where('status', 'sold')->count();
            $pendingCount = $listings->where('status', 'pending')->count();
            $draftCount = $listings->where('status', 'draft')->count();
            $totalViews = $listings->sum('views_count');

            $inquiriesCount = Conversation::where('seller_id', $seller->id)->count();

            $unreadMessagesCount = Message::whereHas('conversation', function ($q) use ($seller) {
                $q->where('seller_id', $seller->id);
            })->where('sender_id', '!=', $seller->id)->where('is_read', false)->count();

            return [
                'live_count' => $liveCount,
                'sold_count' => $soldCount,
                'pending_count' => $pendingCount,
                'draft_count' => $draftCount,
                'total_views' => $totalViews,
                'inquiries_count' => $inquiriesCount,
                'unread_messages_count' => $unreadMessagesCount,
            ];
        });
    }
}
