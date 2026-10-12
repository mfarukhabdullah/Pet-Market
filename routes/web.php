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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/account', function () { return view('account'); })->name('account');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::view('/breeds', 'breeds')->name('breeds');
Route::get('/pet-details', [PetController::class, 'details'])->name('pet.details');
Route::get('/seller-profile', [SellerController::class, 'profile'])->name('seller.profile');
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
Route::view('/login', 'login')->name('login');

/*
 |--------------------------------------------------------------------------
 | [AI UPDATE - START]
 | User Prompt: "reslove this issue" (resolving Route [login.post] not defined error)
 | Description: Added login.post, sign.post, and logout routes with redirect handling
 | to prevent RouteNotFoundException when submitting auth forms or logging out.
 |--------------------------------------------------------------------------
 */
Route::post('/login', function (Request $request) {
    if ($request->filled('redirect')) {
        return redirect()->to($request->input('redirect'));
    }
    return redirect()->route('dashboard');
})->name('login.post');

Route::view('/register', 'sign')->name('sign');
Route::post('/register', function (Request $request) {
    if ($request->filled('redirect')) {
        return redirect()->to($request->input('redirect'));
    }
    return redirect()->route('dashboard');
})->name('sign.post');

Route::get('/logout', function () {
    return redirect()->route('home');
})->name('logout');
/*
 |--------------------------------------------------------------------------
 | [AI UPDATE - END]
 |--------------------------------------------------------------------------
 */

Route::view('/notifications', 'notifications')->name('notifications');
