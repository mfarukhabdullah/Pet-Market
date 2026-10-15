<?php

use Illuminate\Support\Facades\Route;
// [AI UPDATE] Added Request for handling login/register redirect requests
// User Prompt: "reslove this issue" (resolving Route [login.post] not defined error)
use Illuminate\Http\Request;
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
Route::get('/category', [CategoryController::class, 'index'])->middleware('throttle:120,1')->name('category');
Route::view('/breeds', 'breeds')->name('breeds');
Route::get('/pet-details', [PetController::class, 'details'])->name('pet.details');
Route::get('/listings/{id}/reveal-phone', [PetController::class, 'revealPhone'])->middleware('throttle:30,1')->name('listings.reveal-phone');
Route::get('/seller-profile', [SellerController::class, 'profile'])->name('seller.profile');
Route::view('/notifications', 'notifications')->name('notifications');
Route::get('/favorites/ids', [InteractionActionController::class, 'getFavoriteIds'])->name('favorites.ids');

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
    Route::get('/seller/listings', [SellerController::class, 'listings'])->name('seller.listings');
    Route::get('/seller/create-listing', [SellerController::class, 'createListing'])->name('seller.create-listing');
    Route::get('/seller/messages', [SellerController::class, 'messages'])->name('seller.messages');
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

    // Wishlist Toggle
    Route::post('/favorites/toggle/{listingId}', [InteractionActionController::class, 'toggleFavorite'])->name('favorites.toggle');
});

// Community Safety & Fraud Reporting (Rate-Limited)
Route::post('/reports/submit', [InteractionActionController::class, 'submitReport'])->middleware('throttle:15,1')->name('reports.submit');

// Protected Admin Moderation & Anti-Scam Shield (Secured with Admin Middleware)
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/listings/{id}/approve', [AdminController::class, 'approveListing'])->name('admin.listings.approve');
    Route::post('/listings/{id}/reject', [AdminController::class, 'rejectListing'])->name('admin.listings.reject');
    Route::post('/users/{id}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
});
