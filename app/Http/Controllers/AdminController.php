<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Report;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Admin dashboard stats.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'live_listings' => Listing::where('status', 'live')->count(),
            'pending_listings' => Listing::where('status', 'pending')->count(),
            'total_reports' => Report::where('status', 'pending')->count(),
        ];

        $pendingListings = Listing::where('status', 'pending')
            ->with(['images', 'category', 'breed', 'user'])
            ->latest()
            ->take(10)
            ->get();

        $recentReports = Report::where('status', 'pending')
            ->with(['reporter', 'listing', 'seller'])
            ->latest()
            ->take(10)
            ->get();

        if (request()->wantsJson()) {
            return response()->json([
                'stats' => $stats,
                'pending_listings' => $pendingListings,
                'recent_reports' => $recentReports,
            ]);
        }

        return view('admin.dashboard', compact('stats', 'pendingListings', 'recentReports'));
    }

    /**
     * Approve listing in moderation queue.
     */
    public function approveListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['status' => 'live']);

        return redirect()->back()->with('success', "Listing '{$listing->title}' has been approved and is now live!");
    }

    /**
     * Reject listing with moderation feedback.
     */
    public function rejectListing(Request $request, $id)
    {
        $reason = $request->input('reason', 'Listing does not comply with community guidelines.');
        
        $listing = Listing::findOrFail($id);
        $listing->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        return redirect()->back()->with('info', "Listing '{$listing->title}' has been rejected.");
    }

    /**
     * Ban scammer user and take down their listings.
     */
    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => true]);

        // Take down all active listings
        Listing::where('user_id', $user->id)->update(['status' => 'rejected', 'rejection_reason' => 'User account suspended.']);

        return redirect()->back()->with('success', "User '{$user->name}' has been banned and their listings taken down.");
    }
}
