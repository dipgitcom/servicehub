<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;

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

// Service routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/category/{category}', [ServiceController::class, 'byCategory'])->name('services.by-category');
Route::get('/services/show/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/search', [ServiceController::class, 'search'])->name('services.search');
Route::get('/services/featured', [ServiceController::class, 'featured'])->name('services.featured');

// Payment routes
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// User routes
Route::get('/profile', function () {
    return view('user.profile');
})->name('profile')->middleware('auth');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
Route::get('/bookings', function () {
    return view('bookings.my-bookings');
})->name('bookings')->middleware('auth');


// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard Routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

// Admin Service and Category Management Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Admin Service Routes
    Route::get('/services', [AdminServiceController::class, 'index'])->name('admin.services');
    Route::get('/services/create', [AdminServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{id}/edit', [AdminServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('admin.services.destroy');

    // Admin Category Routes
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

// Other pages
Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');

Route::get('/help', function () {
    return view('pages.help');
})->name('help');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/refund', function () {
    return view('pages.refund');
})->name('refund');

Route::get('/sitemap', function () {
    return view('pages.sitemap');
})->name('sitemap');

Route::get('/manager', function () {
    return view('pages.manager');
})->name('manager');

Route::get('/business', function () {
    return view('pages.business');
})->name('business');

Route::get('/delivery', function () {
    return view('pages.delivery');
})->name('delivery');

Route::get('/bondhu', function () {
    return view('pages.bondhu');
})->name('bondhu');