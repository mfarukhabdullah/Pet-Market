<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Listing;
use App\Models\Report;
use App\Models\Category;
use App\Models\Breed;
use App\Models\SiteSetting;

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
class AdminController extends Controller
{
    /**
     * Display unified Admin Panel with tab navigation.
     */
    // USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi"
    public function dashboard(Request $request, $tab = 'overview')
    {
        $validTabs = ['overview', 'hero', 'seo', 'categories', 'listings', 'users', 'reports', 'settings'];
        if (!in_array($tab, $validTabs)) {
            $tab = 'overview';
        }

        // Global Platform Stats
        $stats = [
            'total_users' => User::count(),
            'verified_sellers' => User::where('is_verified', true)->count(),
            'banned_users' => User::where('is_banned', true)->count(),
            'total_listings' => Listing::count(),
            'live_listings' => Listing::where('status', 'live')->count(),
            'pending_listings' => Listing::where('status', 'pending')->count(),
            'rejected_listings' => Listing::where('status', 'rejected')->count(),
            'sold_listings' => Listing::where('status', 'sold')->count(),
            'total_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'total_categories' => Category::count(),
            'total_breeds' => Breed::count(),
        ];

        // Overview Queue
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

        // Categories & Breeds Tab Data
        $categories = Category::withCount(['breeds', 'listings', 'activeListings'])
            ->orderBy('sort_order', 'asc')
            ->get();

        $breeds = Breed::with('category')
            ->withCount('listings')
            ->orderBy('name', 'asc')
            ->get();

        // Listings Tab Data (Search & Filter Support)
        $listingStatus = $request->query('listing_status', 'all');
        $listingSearch = $request->query('listing_q');
        $listingsQuery = Listing::with(['images', 'category', 'breed', 'user'])->latest();

        if ($listingStatus && $listingStatus !== 'all') {
            $listingsQuery->where('status', $listingStatus);
        }
        if ($listingSearch) {
            $listingsQuery->where(function ($q) use ($listingSearch) {
                $q->where('title', 'like', "%{$listingSearch}%")
                  ->orWhere('city', 'like', "%{$listingSearch}%")
                  ->orWhereHas('user', function ($uq) use ($listingSearch) {
                      $uq->where('name', 'like', "%{$listingSearch}%")
                        ->orWhere('email', 'like', "%{$listingSearch}%");
                  });
            });
        }
        $listings = $listingsQuery->paginate(15, ['*'], 'listings_page')->withQueryString();

        // Users Tab Data (Search Support)
        $userSearch = $request->query('user_q');
        $usersQuery = User::withCount('listings')->latest();
        if ($userSearch) {
            $usersQuery->where(function ($q) use ($userSearch) {
                $q->where('name', 'like', "%{$userSearch}%")
                  ->orWhere('email', 'like', "%{$userSearch}%")
                  ->orWhere('phone', 'like', "%{$userSearch}%")
                  ->orWhere('city', 'like', "%{$userSearch}%");
            });
        }
        $users = $usersQuery->paginate(15, ['*'], 'users_page')->withQueryString();

        // Reports Tab Data
        $allReports = Report::with(['reporter', 'listing', 'seller'])
            ->latest()
            ->paginate(15, ['*'], 'reports_page')
            ->withQueryString();

        // Dynamic Settings & SEO Meta
        SiteSetting::seedDefaults();

        // USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi"
        $heroSettings = [
            'hero_title' => SiteSetting::get('hero_title', 'Find the right pet for <br />your family.'),
            'hero_desc' => SiteSetting::get('hero_desc', 'Search pets by category, breed, location and price, then review the listing and seller before making contact.'),
            'hero_image' => SiteSetting::get('hero_image', 'images/home-hero-image.png'),
            'hero_cta_text' => SiteSetting::get('hero_cta_text', 'Find a Pet'),
            'hero_filter_cat_label' => SiteSetting::get('hero_filter_cat_label', 'PET CATEGORY'),
            'hero_filter_cat_placeholder' => SiteSetting::get('hero_filter_cat_placeholder', 'Any category'),
            'hero_filter_breed_label' => SiteSetting::get('hero_filter_breed_label', 'BREED'),
            'hero_filter_breed_placeholder' => SiteSetting::get('hero_filter_breed_placeholder', 'Any breed'),
            'hero_filter_loc_label' => SiteSetting::get('hero_filter_loc_label', 'LOCATION'),
            'hero_filter_loc_placeholder' => SiteSetting::get('hero_filter_loc_placeholder', 'Any location'),
            'hero_filter_price_label' => SiteSetting::get('hero_filter_price_label', 'PRICE'),
            'hero_filter_price_placeholder' => SiteSetting::get('hero_filter_price_placeholder', 'Any price'),
            'hero_locations' => SiteSetting::get('hero_locations', 'Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta'),
        ];

        $seoSettings = [
            'seo_meta_title' => SiteSetting::get('seo_meta_title'),
            'seo_meta_description' => SiteSetting::get('seo_meta_description'),
            'seo_meta_keywords' => SiteSetting::get('seo_meta_keywords'),
            'seo_canonical_base' => SiteSetting::get('seo_canonical_base'),
            'seo_robots' => SiteSetting::get('seo_robots'),
            'seo_og_title' => SiteSetting::get('seo_og_title'),
            'seo_og_description' => SiteSetting::get('seo_og_description'),
            'seo_og_image' => SiteSetting::get('seo_og_image'),
            'seo_header_scripts' => SiteSetting::get('seo_header_scripts'),
        ];

        $generalSettings = [
            'site_name' => SiteSetting::get('site_name', 'Pet Marketplace'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Buy & Sell Pets Responsibly'),
            'site_top_notice' => SiteSetting::get('site_top_notice', 'Buy responsibly. Verify the animal and seller before completing a transaction.'),
            'site_support_email' => SiteSetting::get('site_support_email', 'support@petmarket.pk'),
            'site_support_phone' => SiteSetting::get('site_support_phone', '+92 300 1234567'),
            'site_whatsapp' => SiteSetting::get('site_whatsapp', '+92 300 1234567'),
            'site_city_default' => SiteSetting::get('site_city_default', 'Lahore'),
            'site_currency' => SiteSetting::get('site_currency', 'PKR'),
            'site_auto_approve_listings' => SiteSetting::get('site_auto_approve_listings', '0'),
        ];

        return view('admin.dashboard', compact(
            'tab',
            'stats',
            'pendingListings',
            'recentReports',
            'categories',
            'breeds',
            'listings',
            'users',
            'allReports',
            'heroSettings',
            'seoSettings',
            'generalSettings'
        ));
    }

    /* ========================================================
       HOMEPAGE HERO & BUTTONS ACTIONS
       ======================================================== */

    // USER PROMPT: "yr dynamic kro in ko heome page hero or in btns ko bhi"
    public function updateHero(Request $request)
    {
        $keys = [
            'hero_title',
            'hero_desc',
            'hero_image',
            'hero_cta_text',
            'hero_filter_cat_label',
            'hero_filter_cat_placeholder',
            'hero_filter_breed_label',
            'hero_filter_breed_placeholder',
            'hero_filter_loc_label',
            'hero_filter_loc_placeholder',
            'hero_filter_price_label',
            'hero_filter_price_placeholder',
            'hero_locations',
        ];

        // USER PROMPT: "yr idher koi html code na ho"
        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'hero');
        }

        \Illuminate\Support\Facades\Cache::forget('home_locations_list');
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');
        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'hero'])->with('success', 'Homepage Hero & Search Filter Controls updated successfully!');
    }

    /* ========================================================
       SEO & META ACTIONS
       ======================================================== */

    public function updateSeo(Request $request)
    {
        $keys = [
            'seo_meta_title',
            'seo_meta_description',
            'seo_meta_keywords',
            'seo_canonical_base',
            'seo_robots',
            'seo_og_title',
            'seo_og_description',
            'seo_og_image',
            'seo_header_scripts',
        ];

        foreach ($keys as $key) {
            SiteSetting::set($key, $request->input($key, ''), 'seo');
        }

        return redirect()->route('admin.dashboard', ['tab' => 'seo'])->with('success', 'SEO & Meta configuration saved successfully! Google search preview updated.');
    }

    /* ========================================================
       GENERAL SETTINGS ACTIONS
       ======================================================== */

    public function updateSettings(Request $request)
    {
        $keys = [
            'site_name',
            'site_tagline',
            'site_top_notice',
            'site_support_email',
            'site_support_phone',
            'site_whatsapp',
            'site_city_default',
            'site_currency',
        ];

        foreach ($keys as $key) {
            SiteSetting::set($key, $request->input($key, ''), 'general');
        }

        SiteSetting::set('site_auto_approve_listings', $request->has('site_auto_approve_listings') ? '1' : '0', 'general');

        return redirect()->route('admin.dashboard', ['tab' => 'settings'])->with('success', 'General site settings and announcement banner updated!');
    }

    /* ========================================================
       CATEGORIES & BREEDS ACTIONS
       ======================================================== */

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'nullable|string|max:100|unique:categories,slug',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));

        Category::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'icon' => $request->input('icon', 'fa-solid fa-paw'),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Category '{$request->input('name')}' created successfully!");
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:100|unique:categories,slug,' . $category->id,
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name')),
            'icon' => $request->input('icon', $category->icon),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Category '{$category->name}' updated!");
    }

    public function toggleCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        $status = $category->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Category '{$category->name}' is now {$status}.");
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->listings()->count() > 0) {
            return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('error', "Cannot delete category '{$category->name}' because it contains active listings.");
        }

        $category->delete();
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Category '{$category->name}' removed.");
    }

    public function storeBreed(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->input('name'));

        Breed::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description'),
        ]);

        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Breed '{$request->input('name')}' added successfully!");
    }

    public function deleteBreed($id)
    {
        $breed = Breed::findOrFail($id);
        $name = $breed->name;
        $breed->delete();

        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => 'categories'])->with('success', "Breed '{$name}' deleted.");
    }

    /* ========================================================
       LISTINGS ACTIONS
       ======================================================== */

    public function approveListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['status' => 'live']);

        return redirect()->back()->with('success', "Listing '{$listing->title}' approved and is now live!");
    }

    public function rejectListing(Request $request, $id)
    {
        $reason = $request->input('reason', 'Listing does not comply with community guidelines.');
        
        $listing = Listing::findOrFail($id);
        $listing->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        return redirect()->back()->with('info', "Listing '{$listing->title}' rejected.");
    }

    public function toggleFeaturedListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['is_featured' => !$listing->is_featured]);

        $state = $listing->is_featured ? 'marked as Featured' : 'unmarked from Featured';
        return redirect()->back()->with('success', "Listing '{$listing->title}' {$state}!");
    }

    public function deleteListing($id)
    {
        $listing = Listing::findOrFail($id);
        $title = $listing->title;
        $listing->delete();

        return redirect()->back()->with('success', "Listing '{$title}' deleted from platform.");
    }

    /* ========================================================
       USERS ACTIONS
       ======================================================== */

    public function toggleBanUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Administrator accounts cannot be banned.');
        }

        $user->update(['is_banned' => !$user->is_banned]);

        if ($user->is_banned) {
            Listing::where('user_id', $user->id)->update([
                'status' => 'rejected',
                'rejection_reason' => 'User account suspended by moderation.',
            ]);
        }

        $state = $user->is_banned ? 'banned and their listings taken down' : 'unbanned and account restored';
        return redirect()->back()->with('success', "User '{$user->name}' is now {$state}.");
    }

    public function toggleVerifyUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_verified' => !$user->is_verified]);

        $state = $user->is_verified ? 'granted Verified Seller status' : 'revoked from Verified Seller status';
        return redirect()->back()->with('success', "User '{$user->name}' {$state}.");
    }

    public function updateUserTrust(Request $request, $id)
    {
        $request->validate(['trust_score' => 'required|integer|min:0|max:100']);
        $user = User::findOrFail($id);
        $user->update(['trust_score' => $request->input('trust_score')]);

        return redirect()->back()->with('success', "Trust score for {$user->name} set to {$user->trust_score}%.");
    }

    /* ========================================================
       REPORTS ACTIONS
       ======================================================== */

    public function resolveReport($id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status' => 'resolved',
            'admin_notes' => 'Reviewed and resolved by admin.',
        ]);

        return redirect()->back()->with('success', "Report #{$report->id} marked as resolved.");
    }

    public function dismissReport($id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status' => 'dismissed',
            'admin_notes' => 'Dismissed as false report or insufficient evidence.',
        ]);

        return redirect()->back()->with('info', "Report #{$report->id} dismissed.");
    }

    public function banUser(Request $request, $id)
    {
        return $this->toggleBanUser($id);
    }
}
