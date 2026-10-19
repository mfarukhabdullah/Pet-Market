<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingActionController;
use App\Http\Controllers\ChatActionController;
use App\Http\Controllers\InteractionActionController;
use App\Http\Controllers\AdminController;
// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
use App\Http\Controllers\SeoController;

/*
|--------------------------------------------------------------------------
| Web Routes & High-Scale Architecture (Protected & Rate Limited)
|--------------------------------------------------------------------------
*/

// Public Browsing & Search (with Bot-Scraping Rate Limiters)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/account', function () { return view('account'); })->name('account');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
// Public Dynamic SEO Routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');
// USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
$knownCitiesRegex = 'islamabad|karachi|lahore|rawalpindi|faisalabad|multan|sialkot|peshawar';
$knownCategoriesRegex = 'birds|cats|dogs|exotic|exotic-pets|fish|fishes|horses-farm|horse|horses|rabbits|reptiles|reptile';

Route::get('/category/{param1?}/{param2?}/{param3?}', [CategoryController::class, 'index'])->middleware('throttle:120,1')->name('category');
Route::get('/city/{city}', [CategoryController::class, 'index'])->where('city', $knownCitiesRegex)->name('city.show');
Route::get('/featured-pets', [CategoryController::class, 'featured'])->middleware('throttle:120,1')->name('featured.pets');
// USER PROMPT: "and when seller upload fish and when user come in breed section and click on fish user new uploaded fish is not shown in breed and section sort out this"
Route::get('/breeds', [CategoryController::class, 'breeds'])->name('breeds');
Route::get('/pet-details/{slug?}', [PetController::class, 'details'])->name('pet.details');
Route::get('/listings/{id}/reveal-phone', [PetController::class, 'revealPhone'])->middleware('throttle:30,1')->name('listings.reveal-phone');
Route::get('/seller-profile/{id?}', [SellerController::class, 'profile'])->name('seller.profile');
Route::view('/notifications', 'notifications')->name('notifications');
Route::get('/favorites/ids', [InteractionActionController::class, 'getFavoriteIds'])->name('favorites.ids');

// Direct clean root paths for categories and cities (e.g. /dogs, /cats, /lahore, /karachi)
Route::get('/{category}', [CategoryController::class, 'index'])->where('category', $knownCategoriesRegex)->name('category.direct');
Route::get('/{city}', [CategoryController::class, 'index'])->where('city', $knownCitiesRegex)->name('city.direct');

// Authentication Routes (with Brute-Force Rate Limiting)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');
Route::get('/register', [AuthController::class, 'showRegister'])->name('sign');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/demo-login/{role?}', [AuthController::class, 'switchDemoUser'])->where('role', '.*')->name('demo.login');

// Protected User & Seller Portal (Secured with seller.auth & not_banned Middlewares)
Route::middleware(['seller.auth', 'not_banned'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
    Route::get('/seller/listings/{tab?}', [SellerController::class, 'listings'])->name('seller.listings');
    Route::get('/seller/create-listing', [SellerController::class, 'createListing'])->name('seller.create-listing');
    // USER PROMPT: "in my listing page if user want to edit his pet listing we wil navigate him to create listing page do edit his listing"
    Route::get('/seller/edit-listing/{id}', [SellerController::class, 'editListing'])->name('seller.edit-listing');
    // USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
    Route::get('/seller/messages/{conversation_id?}', [SellerController::class, 'messages'])->name('seller.messages');
    Route::get('/seller/settings', [SellerController::class, 'settings'])->name('seller.settings');
    Route::get('/seller/settings/contact', [SellerController::class, 'settingsContact'])->name('seller.settings.contact');
    Route::get('/seller/settings/security', [SellerController::class, 'settingsSecurity'])->name('seller.settings.security');
    Route::get('/seller/settings/notifications', [SellerController::class, 'settingsNotifications'])->name('seller.settings.notifications');
    Route::get('/seller/settings/account', [SellerController::class, 'settingsAccount'])->name('seller.settings.account');
    Route::get('/seller/favorites', [SellerController::class, 'favorites'])->name('favorites');

    // Listing Action Endpoints
    Route::post('/listings/draft', [ListingActionController::class, 'saveDraft'])->name('listings.draft');
    Route::post('/listings/publish', [ListingActionController::class, 'publish'])->name('listings.publish');
    Route::post('/listings/{id}/media', [ListingActionController::class, 'uploadMedia'])->name('listings.media');
    Route::post('/listings/{id}/sold', [ListingActionController::class, 'markSold'])->name('listings.sold');
    Route::post('/listings/{id}/mark-sold', [ListingActionController::class, 'markSold'])->name('listings.mark-sold');
    Route::delete('/listings/{id}', [ListingActionController::class, 'destroy'])->name('listings.destroy');
    Route::delete('/listings/{id}/delete', [ListingActionController::class, 'destroy'])->name('listings.delete');

    // Chat & Negotiation Endpoints (with Anti-Spam Rate Limiters)
    Route::get('/chat/start/{listingId}', [ChatActionController::class, 'startChat'])->name('chat.start');
    Route::post('/chat/send-message', [ChatActionController::class, 'sendMessage'])->middleware('throttle:60,1')->name('chat.send');
    Route::post('/chat/message/send', [ChatActionController::class, 'sendMessage'])->middleware('throttle:60,1')->name('chat.send-message');
    Route::post('/chat/send-offer', [ChatActionController::class, 'sendOffer'])->middleware('throttle:30,1')->name('chat.offer');
    Route::post('/chat/respond-offer/{messageId}', [ChatActionController::class, 'respondOffer'])->name('chat.respond-offer');
    Route::post('/chat/offer/respond/{messageId}', [ChatActionController::class, 'respondOffer'])->name('chat.offer.respond');
    Route::get('/chat/conversation/{id}/messages', [ChatActionController::class, 'getMessages'])->name('chat.messages');
    // USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do"
    Route::post('/chat/message/{messageId}/delete', [ChatActionController::class, 'deleteMessage'])->name('chat.delete-message');
    Route::post('/chat/conversation/{id}/delete', [ChatActionController::class, 'deleteConversation'])->name('chat.delete-conversation');
    Route::post('/chat/conversation/{id}/clear', [ChatActionController::class, 'clearConversation'])->name('chat.clear-conversation');

    // Wishlist Toggle
    Route::post('/favorites/toggle/{listingId}', [InteractionActionController::class, 'toggleFavorite'])->name('favorites.toggle');
});

// Community Safety & Fraud Reporting (Rate-Limited)
Route::post('/reports/submit', [InteractionActionController::class, 'submitReport'])->middleware('throttle:15,1')->name('reports.submit');

// USER PROMPT: "ni yr ya to alag ha admin pannel in sy is ky liye login ya sin up no need just admin open ho is url sy or login mangy"
// Dedicated Admin Login & Session Routes (Independent from public site auth)
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:15,1')->name('admin.login.submit');
Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao"
// Protected Admin Panel & Dynamic Site Engine (Secured with Admin Middleware)
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/', function() { return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard/{tab?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // USER PROMPT: "yr home hero main sir image heading or text ko dynamic kro btns ko dynamic ni krna hai"
    // Homepage Hero Settings (Headline, Description & Image)
    Route::post('/hero/update', [AdminController::class, 'updateHero'])->name('admin.hero.update');

    // USER PROMPT: "hero home main in filter ko dynamic kro or jasy jsy ya filter admin main update krain gy to  saath category waly is  ky saath update hoty jain gy"
    // Dynamic Hero & Category Search Filters Actions
    Route::post('/hero-filters/update', [AdminController::class, 'updateHeroFilters'])->name('admin.hero_filters.update');

    // USER PROMPT: "category page ka heroo section bhi dynamic kro"
    // Category Page Hero Settings (Headline, Description & Pets Collage Image)
    Route::post('/category-hero/update', [AdminController::class, 'updateCategoryHero'])->name('admin.category_hero.update');

    // USER PROMPT: "ya admin pannel home page main ya section dynamic kro"
    // Safety & Responsible Pet Ownership Section Actions
    Route::post('/safety/update', [AdminController::class, 'updateSafety'])->name('admin.safety.update');

    // USER PROMPT: "footer to dynamic kro"
    // Dynamic Footer Section Actions
    Route::post('/footer/update', [AdminController::class, 'updateFooter'])->name('admin.footer.update');

    // USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main"
    // About Us Dynamic Sections Actions
    Route::post('/about/update', [AdminController::class, 'updateAbout'])->name('admin.about.update');

    // SEO Engine Actions
    Route::post('/seo/update', [AdminController::class, 'updateSeo'])->name('admin.seo.update');

    // General Site Settings Actions
    Route::post('/settings/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

    // Categories & Breeds Dynamic Actions
    // USER PROMPT: "admin main home page setting main in ko bhi dynamic kro"
    Route::post('/home-categories/update', [AdminController::class, 'updateHomeCategories'])->name('admin.home_categories.update');
    Route::post('/categories/{id}/image', [AdminController::class, 'updateCategoryImage'])->name('admin.categories.image');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::post('/categories/{id}/update', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::post('/categories/{id}/toggle', [AdminController::class, 'toggleCategory'])->name('admin.categories.toggle');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    Route::post('/breeds/store', [AdminController::class, 'storeBreed'])->name('admin.breeds.store');
    Route::delete('/breeds/{id}', [AdminController::class, 'deleteBreed'])->name('admin.breeds.delete');

    // Listings Moderation & Featured Toggles
    Route::post('/listings/{id}/approve', [AdminController::class, 'approveListing'])->name('admin.listings.approve');
    Route::post('/listings/{id}/reject', [AdminController::class, 'rejectListing'])->name('admin.listings.reject');
    Route::post('/listings/{id}/featured', [AdminController::class, 'toggleFeaturedListing'])->name('admin.listings.featured');
    Route::delete('/listings/{id}', [AdminController::class, 'deleteListing'])->name('admin.listings.delete');

    // User & Seller Moderation Actions
    Route::post('/users/{id}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/users/{id}/toggle-verify', [AdminController::class, 'toggleVerifyUser'])->name('admin.users.toggle-verify');
    Route::post('/users/{id}/trust', [AdminController::class, 'updateUserTrust'])->name('admin.users.trust');

    // Report Resolution Actions
    Route::post('/reports/{id}/resolve', [AdminController::class, 'resolveReport'])->name('admin.reports.resolve');
    Route::post('/reports/{id}/dismiss', [AdminController::class, 'dismissReport'])->name('admin.reports.dismiss');
});

// USER PROMPT: "yr is website per sary url / sy open hon or code na hon un main"
// Clean root listing route for any pet slug (e.g. /pure-persian-punch-face-kitten)
Route::get('/{slug}', function (\Illuminate\Http\Request $request, $slug) {
    $listing = \App\Models\Listing::where('slug', $slug)->first();
    if ($listing) {
        return app(\App\Http\Controllers\PetController::class)->details($request, $slug);
    }
    abort(404);
})->where('slug', '[a-zA-Z0-9\-]+')->name('pet.direct');

