<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Listing;
use App\Models\Report;
use App\Models\Category;
use App\Models\Breed;
use App\Models\SiteSetting;

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
class AdminController extends Controller
{
    // USER PROMPT: "ni yr ya to alag ha admin pannel in sy is ky liye login ya sin up no need just admin open ho is url sy or login mangy"
    /**
     * Show dedicated Admin Portal login page.
     */
    public function showLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Authenticate Administrator credentials.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');
        // USER PROMPT: "i have put right credentials butt not lgged in"
        $email = strtolower(trim($credentials['email']));
        if ($email === 'permarket@gmail.com') {
            $email = 'petmarket@gmail.com';
        }
        $user = User::where('email', $email)->first();

        if ($user && $user->role === 'admin' && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Authenticated as Platform Administrator.');
        }

        return back()->withErrors([
            'email' => 'Invalid administrator credentials. Access restricted to platform admins.',
        ])->onlyInput('email');
    }

    /**
     * Log out administrator and return strictly to admin login.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Admin session ended successfully.');
    }

    /**
     * Display unified Admin Panel with tab navigation.
     */
    // USER PROMPT: "ya ption ni chal rha hai"
    public function dashboard(Request $request, $tab = 'overview')
    {
        if ($request->has('tab')) {
            $tab = $request->query('tab');
        }

        // USER PROMPT: "category page ka heroo section bhi dynamic kro"
        // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
        // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
        // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
        // USER PROMPT: "yr home page main in sections ko dynamic kro"
        // USER PROMPT: "admin main contact us click able ni hai"
        $validTabs = ['overview', 'featured_pets', 'hero', 'hero_filters', 'home_categories', 'home_cta', 'home_locations', 'category_hero', 'safety', 'footer', 'about', 'contact', 'seo', 'categories', 'breeds', 'listings', 'users', 'reports', 'settings'];
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
            'featured_listings' => Listing::where('is_featured', true)->count(),
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

        // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
        $breedSearch = $request->query('breed_q');
        $breedCategoryFilter = $request->query('breed_cat');
        $breedsQuery = Breed::with('category')
            ->withCount('listings')
            ->orderBy('name', 'asc');

        if ($breedSearch) {
            $breedsQuery->where(function ($q) use ($breedSearch) {
                $q->where('name', 'like', "%{$breedSearch}%")
                  ->orWhere('slug', 'like', "%{$breedSearch}%");
            });
        }

        if ($breedCategoryFilter && $breedCategoryFilter !== 'all') {
            $breedsQuery->where('category_id', $breedCategoryFilter);
        }

        $breeds = $breedsQuery->get();

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

        // USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai"
        $heroSettings = [
            'hero_title' => SiteSetting::get('hero_title', 'Find the right pet for your family.'),
            'hero_desc' => SiteSetting::get('hero_desc', 'Search pets by category, breed, location and price, then review the listing and seller before making contact.'),
            'hero_image' => SiteSetting::get('hero_image', 'images/home-hero-image.png'),
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

        // USER PROMPT: "ya admin pannel home page main ya section dynamic kro"
        $safetySettings = [
            'safety_title' => SiteSetting::get('safety_title', 'Safety & Responsible'),
            'safety_title_highlight' => SiteSetting::get('safety_title_highlight', 'Pet Ownership'),
            'safety_lead_bold' => SiteSetting::get('safety_lead_bold', 'We promote safe pet transactions'),
            'safety_lead_text' => SiteSetting::get('safety_lead_text', 'and responsible ownership to help protect both pets and people.'),
            'safety_image' => SiteSetting::get('safety_image', 'images/safety-responsible.png'),
            'safety_points' => SiteSetting::get('safety_points', "Verify the pet’s health and vaccination details before buying.\nMeet the seller and pet in a safe location.\nNever send advance payment without proper verification.\nUnderstand the pet’s food, care, medical, and exercise needs.\nReport suspicious or misleading listings."),
        ];

        // USER PROMPT: "footer to dynamic kro"
        $footerSettings = [
            'footer_brand_title' => SiteSetting::get('footer_brand_title', 'Pet Marketplace'),
            'footer_brand_logo' => SiteSetting::get('footer_brand_logo', 'images/Italic-text.png'),
            'footer_brand_desc' => SiteSetting::get('footer_brand_desc', 'A trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses in one safe and easy-to-use platform.'),
            'footer_quick_links_title' => SiteSetting::get('footer_quick_links_title', 'Quick Links'),
            // USER PROMPT: "ni in ko bhi dynamic kro"
            'footer_quick_links' => SiteSetting::getQuickLinks(),
            'footer_categories_title' => SiteSetting::get('footer_categories_title', 'Pet Categories'),
            'footer_contact_title' => SiteSetting::get('footer_contact_title', 'Contact & Support'),
            'footer_email' => SiteSetting::get('footer_email', 'Support@petmarket.com'),
            'footer_phone' => SiteSetting::get('footer_phone', '+92 3100865765'),
            'footer_social_title' => SiteSetting::get('footer_social_title', 'Follow Us:'),
            'footer_facebook_url' => SiteSetting::get('footer_facebook_url', '#'),
            'footer_instagram_url' => SiteSetting::get('footer_instagram_url', '#'),
            'footer_youtube_url' => SiteSetting::get('footer_youtube_url', '#'),
            'footer_copyright' => SiteSetting::get('footer_copyright', '© 2026 Pet Marketplace. All rights reserved.'),
        ];

        // USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main"
        $aboutSettings = [
            'about_purpose_badge' => SiteSetting::get('about_purpose_badge', 'OUR PURPOSE'),
            'about_purpose_title' => SiteSetting::get('about_purpose_title', 'A marketplace built around better information, not just listings.'),
            'about_purpose_desc1' => SiteSetting::get('about_purpose_desc1', 'Finding a pet is different from buying an ordinary classified item. Buyers need to understand the animal, its health information, seller details and long-term care requirements before making a decision.'),
            'about_purpose_desc2' => SiteSetting::get('about_purpose_desc2', 'That is why the marketplace brings pet details, seller profiles, messaging, moderation and safety guidance into one consistent journey.'),
            'about_purpose_points' => SiteSetting::get('about_purpose_points', "Clear breed, age, gender, price and location information.\nHealth and vaccination details where applicable.\nSeller information and marketplace messaging before contact."),
            'about_purpose_image' => SiteSetting::get('about_purpose_image', 'images/about-purpose.jpg'),

            'about_marketplace_title' => SiteSetting::get('about_marketplace_title', 'One marketplace for different pet-related needs.'),
            'about_marketplace_image' => SiteSetting::get('about_marketplace_image', 'images/about-dogs.jpg'),
            'about_need_1_title' => SiteSetting::get('about_need_1_title', 'Individual pet owners'),
            'about_need_1_desc' => SiteSetting::get('about_need_1_desc', 'People who want to sell or responsibly rehome a pet through a structured listing.'),
            'about_need_2_title' => SiteSetting::get('about_need_2_title', 'Pet buyers'),
            'about_need_2_desc' => SiteSetting::get('about_need_2_desc', 'Users looking for specific breeds, ages, genders, price ranges or locations.'),
            'about_need_3_title' => SiteSetting::get('about_need_3_title', 'Breeders and pet businesses'),
            'about_need_3_desc' => SiteSetting::get('about_need_3_desc', 'Professional sellers that need profiles, listings and marketplace visibility.'),
            'about_need_4_title' => SiteSetting::get('about_need_4_title', 'Platform moderators'),
            'about_need_4_desc' => SiteSetting::get('about_need_4_desc', 'Teams responsible for listings, reports, categories and marketplace quality.'),

            'about_safer_title' => SiteSetting::get('about_safer_title', 'Safer interactions start with better information.'),
            'about_safer_desc' => SiteSetting::get('about_safer_desc', 'Pet transactions require more care than a typical classified listing. That is why the platform keeps safety, moderation and responsible ownership visible throughout the experience.'),
            'about_safer_points' => SiteSetting::get('about_safer_points', "Verify the animal, seller, ownership and available health information.\nUse reporting tools for suspicious or misleading listings and users.\nKeep exact seller address private by default.\nReview local requirements and responsible ownership considerations before proceeding."),
            'about_safer_card_1_icon' => SiteSetting::get('about_safer_card_1_icon', 'fas fa-user-shield'),
            'about_safer_card_1_title' => SiteSetting::get('about_safer_card_1_title', 'Seller Profiles'),
            'about_safer_card_1_desc' => SiteSetting::get('about_safer_card_1_desc', 'Buyers can review seller information, active listings and relevant verification status before making contact.'),
            'about_safer_card_2_icon' => SiteSetting::get('about_safer_card_2_icon', 'fas fa-comments'),
            'about_safer_card_2_title' => SiteSetting::get('about_safer_card_2_title', 'Marketplace Messaging'),
            'about_safer_card_2_desc' => SiteSetting::get('about_safer_card_2_desc', 'Users can communicate through the platform without automatically exposing private contact information.'),
            'about_safer_card_3_icon' => SiteSetting::get('about_safer_card_3_icon', 'fas fa-flag'),
            'about_safer_card_3_title' => SiteSetting::get('about_safer_card_3_title', 'Reporting & Moderation'),
            'about_safer_card_3_desc' => SiteSetting::get('about_safer_card_3_desc', 'Listings and users can be reported so marketplace moderators can review possible policy or safety concerns.'),
        ];

        // USER PROMPT: "contact us ka ya section dynamic kro"
        $contactSettings = [
            'contact_title' => SiteSetting::get('contact_title', 'Contact & Support'),
            'contact_desc' => SiteSetting::get('contact_desc', 'Use the details below or send us a message through the form.'),
            'contact_email_title' => SiteSetting::get('contact_email_title', 'Email Support'),
            'contact_email' => SiteSetting::get('contact_email', 'support@petmarket.com'),
            'contact_phone_title' => SiteSetting::get('contact_phone_title', 'Phone'),
            'contact_phone' => SiteSetting::get('contact_phone', '+92 310 0865755'),
            'contact_social_title' => SiteSetting::get('contact_social_title', 'Follow Us'),
            'contact_facebook_url' => SiteSetting::get('contact_facebook_url', '#'),
            'contact_instagram_url' => SiteSetting::get('contact_instagram_url', '#'),
            'contact_youtube_url' => SiteSetting::get('contact_youtube_url', '#'),
        ];

        // USER PROMPT: "category page ka heroo section bhi dynamic kro"
        $categoryHeroSettings = [
            'category_hero_title' => SiteSetting::get('category_hero_title', 'Browse Pet Listings'),
            'category_hero_desc' => SiteSetting::get('category_hero_desc', 'Search and filter pet listings by category, breed, location, price, age, gender and other relevant details.'),
            'category_hero_image' => SiteSetting::get('category_hero_image', 'images/category-hero-img.png'),
            'featured_hero_title' => SiteSetting::get('featured_hero_title', 'Featured Pet Listings'),
            'featured_hero_desc' => SiteSetting::get('featured_hero_desc', 'Discover premium and featured pet listings from top verified sellers.'),
        ];

        // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
        $heroFilterSettings = [
            'filter_cat_label' => SiteSetting::get('filter_cat_label', 'PET CATEGORY'),
            'filter_cat_placeholder' => SiteSetting::get('filter_cat_placeholder', 'Any category'),
            'filter_breed_label' => SiteSetting::get('filter_breed_label', 'BREED'),
            'filter_breed_placeholder' => SiteSetting::get('filter_breed_placeholder', 'Any breed'),
            'filter_loc_label' => SiteSetting::get('filter_loc_label', 'LOCATION'),
            'filter_loc_placeholder' => SiteSetting::get('filter_loc_placeholder', 'Any location'),
            'filter_price_label' => SiteSetting::get('filter_price_label', 'PRICE'),
            'filter_price_placeholder' => SiteSetting::get('filter_price_placeholder', 'Any price'),
            'filter_btn_text' => SiteSetting::get('filter_btn_text', 'Find a Pet'),
            'hero_locations' => SiteSetting::get('hero_locations', 'Islamabad, Karachi, Lahore, Rawalpindi, Faisalabad, Multan, Sialkot, Peshawar, Gujranwala, Quetta'),
            'hero_price_ranges' => SiteSetting::get('hero_price_ranges'),
            'price_ranges_list' => SiteSetting::getPriceRanges(),
            'locations_list' => SiteSetting::getLocationsList(),
        ];

        // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
        $homeCatSettings = [
            'home_cat_title' => SiteSetting::get('home_cat_title', 'Browse by Pet Category'),
            'home_cat_subtitle' => SiteSetting::get('home_cat_subtitle', "Start your search by choosing the type of companion you're looking for."),
        ];

        // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
        // Featured Pets Management Data
        $featuredPets = Listing::where('is_featured', true)
            ->with(['images', 'category', 'breed', 'user'])
            ->latest()
            ->get();

        $featuredSearch = $request->query('featured_q');
        $featuredCat = $request->query('featured_cat');
        // USER PROMPT: "yr ya jb feature main a gy hai to nichay waly main abhi q ha oper walay sy hi un feature ho"
        $availablePetsQuery = Listing::where('status', 'live')
            ->where('is_featured', false)
            ->with(['images', 'category', 'breed', 'user'])
            ->latest();

        if ($featuredSearch) {
            $availablePetsQuery->where(function ($q) use ($featuredSearch) {
                $q->where('title', 'like', "%{$featuredSearch}%")
                  ->orWhere('city', 'like', "%{$featuredSearch}%")
                  ->orWhereHas('breed', function ($bq) use ($featuredSearch) {
                      $bq->where('name', 'like', "%{$featuredSearch}%");
                  })
                  ->orWhereHas('category', function ($cq) use ($featuredSearch) {
                      $cq->where('name', 'like', "%{$featuredSearch}%");
                  })
                  ->orWhereHas('user', function ($uq) use ($featuredSearch) {
                      $uq->where('name', 'like', "%{$featuredSearch}%")
                        ->orWhere('email', 'like', "%{$featuredSearch}%");
                  });
            });
        }
        if ($featuredCat && $featuredCat !== 'all') {
            $availablePetsQuery->where('category_id', $featuredCat);
        }

        $availableLivePets = $availablePetsQuery->paginate(12, ['*'], 'featured_page')->withQueryString();

        $featuredSecSettings = [
            'featured_sec_title' => SiteSetting::get('featured_sec_title', 'Featured Pets'),
            'featured_sec_subtitle' => SiteSetting::get('featured_sec_subtitle', 'Highlighted pet listings from sellers on the marketplace.'),
        ];

        // USER PROMPT: "yr home page main in sections ko dynamic kro"
        $homeCtaSettings = [
            'home_cta_title' => SiteSetting::get('home_cta_title', 'One More Friend'),
            'home_cta_subtitle' => SiteSetting::get('home_cta_subtitle', 'Thousands More Fun!'),
            'home_cta_desc' => SiteSetting::get('home_cta_desc', 'Having a pet means you have more joy, a new friend, a happy person who will always be with you to have fun. We have 200+ different pets that can meet your needs!'),
            'home_cta_image' => SiteSetting::get('home_cta_image', 'images/more-friend.png'),
            'home_cta_btn1_text' => SiteSetting::get('home_cta_btn1_text', 'Browse Dogs'),
            'home_cta_btn1_link' => SiteSetting::get('home_cta_btn1_link', '/category/dogs'),
            'home_cta_btn2_text' => SiteSetting::get('home_cta_btn2_text', 'Browse Cats'),
            'home_cta_btn2_link' => SiteSetting::get('home_cta_btn2_link', '/category/cats'),
        ];

        $homeLocSettings = [
            'loc_sec_title' => SiteSetting::get('loc_sec_title', 'Find Pets by Location'),
            'loc_sec_subtitle' => SiteSetting::get('loc_sec_subtitle', 'Browse pets available in major cities and find listings closer to your location.'),
            'loc_sec_cities' => SiteSetting::get('loc_sec_cities', 'Lahore, Faisalabad, Multan, Sialkot, Karachi, Peshawar, Islamabad'),
            'loc_sec_card_subtext' => SiteSetting::get('loc_sec_card_subtext', 'Browse listings'),
            'loc_sec_all_text' => SiteSetting::get('loc_sec_all_text', 'All Locations'),
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
            // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
            'featuredPets',
            'availableLivePets',
            'featuredSecSettings',
            // USER PROMPT: "yr home page main in sections ko dynamic kro"
            'homeCtaSettings',
            'homeLocSettings',
            'heroSettings',
            'categoryHeroSettings',
            // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
            'heroFilterSettings',
            // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
            'homeCatSettings',
            'safetySettings',
            'footerSettings',
            'aboutSettings',
            // USER PROMPT: "contact us ka ya section dynamic kro"
            'contactSettings',
            'seoSettings',
            'generalSettings'
        ));
    }

    // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
    /**
     * Update Homepage Hero & Category dynamic search filter settings.
     */
    public function updateHeroFilters(Request $request)
    {
        $simpleFields = [
            'filter_cat_label',
            'filter_cat_placeholder',
            'filter_breed_label',
            'filter_breed_placeholder',
            'filter_loc_label',
            'filter_loc_placeholder',
            'filter_price_label',
            'filter_price_placeholder',
            'filter_btn_text',
            'hero_locations',
        ];

        foreach ($simpleFields as $field) {
            if ($request->has($field)) {
                $val = trim(strip_tags((string) $request->input($field, '')));
                SiteSetting::set($field, $val, 'hero_filters');
            }
        }

        // Process price ranges array if submitted
        if ($request->has('price_ranges') && is_array($request->input('price_ranges'))) {
            $ranges = [];
            foreach ($request->input('price_ranges') as $r) {
                $min = trim((string)($r['min'] ?? ''));
                $max = trim((string)($r['max'] ?? ''));
                $label = trim(strip_tags((string)($r['label'] ?? '')));
                if ($label !== '') {
                    $val = ($max !== '' && $max !== null) ? "{$min}-{$max}" : "{$min}+";
                    $ranges[] = [
                        'min' => $min,
                        'max' => $max,
                        'label' => $label,
                        'val' => $val,
                    ];
                }
            }
            if (!empty($ranges)) {
                SiteSetting::set('hero_price_ranges', json_encode($ranges), 'hero_filters');
            }
        }

        // Flush all related cache keys so changes immediately reflect everywhere
        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');
        \Illuminate\Support\Facades\Cache::forget('site_locations_list');
        \Illuminate\Support\Facades\Cache::forget('home_locations_list');
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');
        \Illuminate\Support\Facades\Cache::forget('catalog_categories_tree');
        \Illuminate\Support\Facades\Cache::forget('catalog_all_breeds');
        \Illuminate\Support\Facades\Cache::forget('all_breed_slugs_list');

        return redirect()->route('admin.dashboard', ['tab' => 'hero_filters'])
            ->with('success', 'Hero and Category Search Filters updated and synchronized successfully!');
    }

    /* ========================================================
       HOMEPAGE HERO ACTIONS
       ======================================================== */

    // USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai"
    public function updateHero(Request $request)
    {
        $title = trim(strip_tags((string) $request->input('hero_title', '')));
        $desc = trim(strip_tags((string) $request->input('hero_desc', '')));

        SiteSetting::set('hero_title', $title, 'hero');
        SiteSetting::set('hero_desc', $desc, 'hero');

        // Direct image file upload or URL/path
        // USER PROMPT: "yr image ka aik do"
        if ($request->hasFile('hero_image') && $request->file('hero_image')->isValid()) {
            $file = $request->file('hero_image');
            $uploadDir = public_path('uploads/hero');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'hero_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('hero_image', 'uploads/hero/' . $filename, 'hero');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'hero'])->with('success', 'Homepage Hero settings updated successfully!');
    }

    /* ========================================================
       CATEGORY PAGE HERO ACTIONS
       ======================================================== */

    // USER PROMPT: "category page ka heroo section bhi dynamic kro"
    public function updateCategoryHero(Request $request)
    {
        $keys = [
            'category_hero_title',
            'category_hero_desc',
            'featured_hero_title',
            'featured_hero_desc',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'category_hero');
        }

        // Direct single image file upload for category hero pets collage
        if ($request->hasFile('category_hero_image') && $request->file('category_hero_image')->isValid()) {
            $file = $request->file('category_hero_image');
            $uploadDir = public_path('uploads/category_hero');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'category_hero_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('category_hero_image', 'uploads/category_hero/' . $filename, 'category_hero');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'category_hero'])->with('success', 'Category page hero settings updated successfully!');
    }

    /* ========================================================
       HOMEPAGE SAFETY & RESPONSIBLE PET OWNERSHIP ACTIONS
       ======================================================== */

    // USER PROMPT: "ya admin pannel home page main ya section dynamic kro"
    public function updateSafety(Request $request)
    {
        $title = trim(strip_tags((string) $request->input('safety_title', 'Safety & Responsible')));
        $highlight = trim(strip_tags((string) $request->input('safety_title_highlight', 'Pet Ownership')));
        $leadBold = trim(strip_tags((string) $request->input('safety_lead_bold', 'We promote safe pet transactions')));
        $leadText = trim(strip_tags((string) $request->input('safety_lead_text', 'and responsible ownership to help protect both pets and people.')));
        $points = trim(strip_tags((string) $request->input('safety_points', '')));

        SiteSetting::set('safety_title', $title, 'safety');
        SiteSetting::set('safety_title_highlight', $highlight, 'safety');
        SiteSetting::set('safety_lead_bold', $leadBold, 'safety');
        SiteSetting::set('safety_lead_text', $leadText, 'safety');
        SiteSetting::set('safety_points', $points, 'safety');

        // Direct single image file upload or keep current
        if ($request->hasFile('safety_image') && $request->file('safety_image')->isValid()) {
            $file = $request->file('safety_image');
            $uploadDir = public_path('uploads/safety');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'safety_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('safety_image', 'uploads/safety/' . $filename, 'safety');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'safety'])->with('success', 'Safety & Responsible Pet Ownership Section updated successfully!');
    }

    /* ========================================================
       HOMEPAGE DYNAMIC FOOTER ACTIONS
       ======================================================== */

    // USER PROMPT: "footer to dynamic kro"
    public function updateFooter(Request $request)
    {
        $keys = [
            'footer_brand_title',
            'footer_brand_desc',
            'footer_quick_links_title',
            'footer_categories_title',
            'footer_contact_title',
            'footer_email',
            'footer_phone',
            'footer_social_title',
            'footer_facebook_url',
            'footer_instagram_url',
            'footer_youtube_url',
            'footer_copyright',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'footer');
        }

        // USER PROMPT: "ni in ko bhi dynamic kro"
        if ($request->has('quick_links') && is_array($request->input('quick_links'))) {
            $links = [];
            foreach ($request->input('quick_links') as $item) {
                $label = trim(strip_tags((string)($item['label'] ?? '')));
                $url = trim(strip_tags((string)($item['url'] ?? '')));
                if (!empty($label)) {
                    $links[] = [
                        'label' => $label,
                        'url' => !empty($url) ? $url : '#'
                    ];
                }
            }
            if (!empty($links)) {
                SiteSetting::set('footer_quick_links', json_encode($links), 'footer');
            }
        }

        // Direct single image file upload for footer logo or keep current
        if ($request->hasFile('footer_brand_logo') && $request->file('footer_brand_logo')->isValid()) {
            $file = $request->file('footer_brand_logo');
            $uploadDir = public_path('uploads/footer');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'footer_logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('footer_brand_logo', 'uploads/footer/' . $filename, 'footer');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'footer'])->with('success', 'Dynamic Footer settings updated successfully!');
    }

    /* ========================================================
       ABOUT US DYNAMIC SECTIONS ACTIONS
       ======================================================== */

    // USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main"
    public function updateAbout(Request $request)
    {
        $keys = [
            'about_purpose_badge',
            'about_purpose_title',
            'about_purpose_desc1',
            'about_purpose_desc2',
            'about_purpose_points',
            'about_marketplace_title',
            'about_need_1_title',
            'about_need_1_desc',
            'about_need_2_title',
            'about_need_2_desc',
            'about_need_3_title',
            'about_need_3_desc',
            'about_need_4_title',
            'about_need_4_desc',
            'about_safer_title',
            'about_safer_desc',
            'about_safer_points',
            'about_safer_card_1_icon',
            'about_safer_card_1_title',
            'about_safer_card_1_desc',
            'about_safer_card_2_icon',
            'about_safer_card_2_title',
            'about_safer_card_2_desc',
            'about_safer_card_3_icon',
            'about_safer_card_3_title',
            'about_safer_card_3_desc',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'about');
        }

        $uploadDir = public_path('uploads/about');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Section 1: Purpose Image Upload
        if ($request->hasFile('about_purpose_image') && $request->file('about_purpose_image')->isValid()) {
            $file = $request->file('about_purpose_image');
            $filename = 'purpose_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('about_purpose_image', 'uploads/about/' . $filename, 'about');
        }

        // Section 2: Marketplace Image Upload
        if ($request->hasFile('about_marketplace_image') && $request->file('about_marketplace_image')->isValid()) {
            $file = $request->file('about_marketplace_image');
            $filename = 'dogs_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('about_marketplace_image', 'uploads/about/' . $filename, 'about');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'about'])->with('success', 'About Us sections updated successfully!');
    }

    /* ========================================================
       CONTACT US DYNAMIC SECTION ACTIONS
       ======================================================== */

    // USER PROMPT: "contact us ka ya section dynamic kro"
    public function updateContact(Request $request)
    {
        $keys = [
            'contact_title',
            'contact_desc',
            'contact_email_title',
            'contact_email',
            'contact_phone_title',
            'contact_phone',
            'contact_social_title',
            'contact_facebook_url',
            'contact_instagram_url',
            'contact_youtube_url',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'contact');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'contact'])->with('success', 'Contact Us section settings updated successfully!');
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

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    /**
     * Update Homepage Browse by Pet Category section title & subtitle.
     */
    public function updateHomeCategories(Request $request)
    {
        $title = trim(strip_tags((string) $request->input('home_cat_title', 'Browse by Pet Category')));
        $subtitle = trim(strip_tags((string) $request->input('home_cat_subtitle', "Start your search by choosing the type of companion you're looking for.")));

        SiteSetting::set('home_cat_title', $title, 'home_categories');
        SiteSetting::set('home_cat_subtitle', $subtitle, 'home_categories');

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'home_categories'])->with('success', 'Homepage Pet Categories headline and description updated!');
    }

    // USER PROMPT: "yr home page main in sections ko dynamic kro"
    /**
     * Update Homepage Promotional CTA Banner section.
     */
    public function updateHomeCta(Request $request)
    {
        $keys = [
            'home_cta_title',
            'home_cta_subtitle',
            'home_cta_desc',
            'home_cta_btn1_text',
            'home_cta_btn1_link',
            'home_cta_btn2_text',
            'home_cta_btn2_link',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'home_cta');
        }

        // Direct single image file upload or keep current
        if ($request->hasFile('home_cta_image') && $request->file('home_cta_image')->isValid()) {
            $file = $request->file('home_cta_image');
            $uploadDir = public_path('uploads/cta');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'cta_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            SiteSetting::set('home_cta_image', 'uploads/cta/' . $filename, 'home_cta');
        } elseif ($request->filled('home_cta_image_path')) {
            SiteSetting::set('home_cta_image', trim((string) $request->input('home_cta_image_path')), 'home_cta');
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');

        return redirect()->route('admin.dashboard', ['tab' => 'home_cta'])->with('success', 'Homepage Promotional CTA Banner updated successfully!');
    }

    // USER PROMPT: "yr home page main in sections ko dynamic kro"
    /**
     * Update Homepage Find Pets by Location section.
     */
    public function updateHomeLocations(Request $request)
    {
        $keys = [
            'loc_sec_title',
            'loc_sec_subtitle',
            'loc_sec_cities',
            'loc_sec_card_subtext',
            'loc_sec_all_text',
        ];

        foreach ($keys as $key) {
            $value = trim(strip_tags((string) $request->input($key, '')));
            SiteSetting::set($key, $value, 'home_locations');
        }

        // USER PROMPT: "when i add cities from admin panel they are added in every page but when i look at create liting page they are not shown there just add same logic there if add cities from admin panell they also show there"
        \Illuminate\Support\Facades\Cache::forget('site_settings_cache');
        \Illuminate\Support\Facades\Cache::forget('site_locations_list');
        \Illuminate\Support\Facades\Cache::forget('home_locations_list');

        return redirect()->route('admin.dashboard', ['tab' => 'home_locations'])->with('success', 'Homepage Find Pets by Location section updated successfully!');
    }

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    /**
     * Quick upload / update for Category circular thumbnail image.
     */
    public function updateCategoryImage(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'image' => 'required|image|max:4096',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $category->update(['image' => 'uploads/categories/' . $filename]);
        }

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        $redirectTab = $request->input('redirect_tab', 'home_categories');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Image for category '{$category->name}' updated successfully!");
    }

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'nullable|string|max:100|unique:categories,slug',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));

        $imagePath = 'images/cat_dog.jpg';
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $imagePath = 'uploads/categories/' . $filename;
        } elseif ($request->filled('image_path')) {
            $imagePath = trim($request->input('image_path'));
        }

        Category::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'icon' => $request->input('icon', 'fa-solid fa-paw'),
            'image' => $imagePath,
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');
        \Illuminate\Support\Facades\Cache::forget('all_category_slugs_list');

        $redirectTab = $request->input('redirect_tab', 'home_categories');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Category '{$request->input('name')}' created successfully!");
    }

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:100|unique:categories,slug,' . $category->id,
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'nullable|integer',
        ]);

        $categoryData = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name')),
            'icon' => $request->input('icon', $category->icon),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/categories');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $categoryData['image'] = 'uploads/categories/' . $filename;
        } elseif ($request->filled('image_path')) {
            $categoryData['image'] = trim($request->input('image_path'));
        }

        $category->update($categoryData);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');
        \Illuminate\Support\Facades\Cache::forget('all_category_slugs_list');

        $redirectTab = $request->input('redirect_tab', 'home_categories');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Category '{$category->name}' updated!");
    }

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    public function toggleCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);

        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        $redirectTab = $request->input('redirect_tab', 'home_categories');
        $status = $category->is_active ? 'activated and is visible on Homepage' : 'deactivated and hidden from Homepage';
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Category '{$category->name}' is now {$status}.");
    }

    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    public function deleteCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $redirectTab = $request->input('redirect_tab', 'home_categories');
        if ($category->listings()->count() > 0) {
            return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('error', "Cannot delete category '{$category->name}' because it contains active listings.");
        }

        $category->delete();
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_breeds');

        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Category '{$category->name}' removed.");
    }

    // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
    public function storeBreed(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:4096',
            'image_path' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $baseSlug = $request->filled('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
        if (empty($baseSlug)) {
            $baseSlug = 'breed-' . time();
        }

        // Ensure unique slug within category
        $slug = $baseSlug;
        $counter = 1;
        while (Breed::where('category_id', $request->input('category_id'))->where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/breeds');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'breed_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $imagePath = 'uploads/breeds/' . $filename;
        } elseif ($request->filled('image_path')) {
            $imagePath = trim($request->input('image_path'));
        }

        $breed = Breed::create([
            'category_id' => $request->input('category_id'),
            'name' => trim($request->input('name')),
            'slug' => $slug,
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        $this->flushBreedCaches();

        $redirectTab = $request->input('redirect_tab', 'breeds');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Breed '{$breed->name}' added successfully and synced across all pages!");
    }

    // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
    public function updateBreed(Request $request, $id)
    {
        $breed = Breed::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:4096',
            'image_path' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $baseSlug = $request->filled('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
        if (empty($baseSlug)) {
            $baseSlug = 'breed-' . time();
        }

        // Ensure unique slug within category (excluding this breed)
        $slug = $baseSlug;
        $counter = 1;
        while (Breed::where('category_id', $request->input('category_id'))->where('slug', $slug)->where('id', '!=', $breed->id)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $breedData = [
            'category_id' => $request->input('category_id'),
            'name' => trim($request->input('name')),
            'slug' => $slug,
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $uploadDir = public_path('uploads/breeds');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'breed_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $breedData['image'] = 'uploads/breeds/' . $filename;
        } elseif ($request->filled('image_path')) {
            $breedData['image'] = trim($request->input('image_path'));
        }

        $breed->update($breedData);

        $this->flushBreedCaches();

        $redirectTab = $request->input('redirect_tab', 'breeds');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Breed '{$breed->name}' updated and synced successfully!");
    }

    // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
    public function deleteBreed(Request $request, $id)
    {
        $breed = Breed::findOrFail($id);
        $name = $breed->name;
        $breed->delete();

        $this->flushBreedCaches();

        $redirectTab = $request->input('redirect_tab', 'breeds');
        return redirect()->route('admin.dashboard', ['tab' => $redirectTab])->with('success', "Breed '{$name}' deleted.");
    }

    // USER PROMPT: "yr breeds ki admin kro access do vo addd kry or vo jo add kry vo breeds hr jaga apply hon jahan per exist krti hain"
    private function flushBreedCaches(): void
    {
        \Illuminate\Support\Facades\Cache::forget('home_breeds');
        \Illuminate\Support\Facades\Cache::forget('catalog_all_breeds');
        \Illuminate\Support\Facades\Cache::forget('all_breed_slugs_list');
        \Illuminate\Support\Facades\Cache::forget('catalog_categories_tree');
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('home_popular_breeds');
    }

    /* ========================================================
       LISTINGS ACTIONS
       ======================================================== */

    // USER PROMPT: "jb koi seller listing bna dy pehly vo admin sy approve ho gy"
    public function approveListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['status' => 'live']);

        // Invalidate cached catalog & home listings so newly approved pet appears immediately
        \Illuminate\Support\Facades\Cache::forget('home_featured_listings');
        \Illuminate\Support\Facades\Cache::forget('home_categories');
        \Illuminate\Support\Facades\Cache::forget('catalog_categories_tree');
        \Illuminate\Support\Facades\Cache::forget('catalog_all_breeds');
        \Illuminate\Support\Facades\Cache::forget('all_category_slugs_list');
        \Illuminate\Support\Facades\Cache::forget('all_breed_slugs_list');

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

    // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
    public function toggleFeaturedListing(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['is_featured' => !$listing->is_featured]);

        // Invalidate cached home page featured listings immediately
        \Illuminate\Support\Facades\Cache::forget('home_featured_listings');

        $state = $listing->is_featured ? 'marked as Featured ⭐' : 'removed from Featured';

        if ($request->input('redirect_tab') === 'featured_pets') {
            return redirect()->route('admin.dashboard', ['tab' => 'featured_pets'])->with('success', "Listing '{$listing->title}' {$state}!");
        }

        return redirect()->back()->with('success', "Listing '{$listing->title}' {$state}!");
    }

    // USER PROMPT: "admin panne main feture pets ka option do jis main admin apni mzarzi sy pet ko feature main daly"
    /**
     * Update Homepage Featured Pets section title and subtitle.
     */
    public function updateFeaturedSection(Request $request)
    {
        $request->validate([
            'featured_sec_title' => 'required|string|max:255',
            'featured_sec_subtitle' => 'nullable|string|max:500',
        ]);

        SiteSetting::set('featured_sec_title', $request->input('featured_sec_title'), 'featured_pets');
        SiteSetting::set('featured_sec_subtitle', $request->input('featured_sec_subtitle', ''), 'featured_pets');

        \Illuminate\Support\Facades\Cache::forget('home_featured_listings');

        return redirect()->route('admin.dashboard', ['tab' => 'featured_pets'])->with('success', 'Featured Pets section settings updated successfully!');
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
