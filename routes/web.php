<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\UserController;

Route::get('/dashboard', function () {
    // Redirect admin ke admin.index, user biasa ke home
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.index');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// ═══════════════════════════════════════════════════════════════
// PUBLIC ROUTES
// ═══════════════════════════════════════════════════════════════
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// NAVBAR TEST PAGE (untuk debugging)
Route::get('/test-navbar', function () {
    return view('test-navbar');
})->name('test.navbar');

// ═══════════════════════════════════════════════════════════════
// AUTH ROUTES (dari Breeze - otomatis ditambahkan)
// ═══════════════════════════════════════════════════════════════
require __DIR__.'/auth.php';

// ═══════════════════════════════════════════════════════════════
// USER ROUTES (perlu login)
// ═══════════════════════════════════════════════════════════════
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/events/{event}/order', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/events/{event}/order', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/upload-payment', [OrderController::class, 'uploadPaymentProof'])->name('orders.upload-payment');
});

// ═══════════════════════════════════════════════════════════════
// ADMIN ROUTES (perlu login + role admin)
// ═══════════════════════════════════════════════════════════════
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // ═══════════════════════════════════════════════════════════════
    // USER MANAGEMENT
    // ═══════════════════════════════════════════════════════════════
    
    // Admin Users
    Route::get('users/admins', [UserController::class, 'admins'])->name('users.admins');
    Route::post('users/admins', [UserController::class, 'storeAdmin'])->name('users.admins.store');
    Route::put('users/admins/{user}', [UserController::class, 'updateAdmin'])->name('users.admins.update');
    Route::delete('users/admins/{user}', [UserController::class, 'destroyAdmin'])->name('users.admins.destroy');
    
    // Event Organizers
    Route::get('users/event-organizers', [UserController::class, 'eventOrganizers'])->name('users.event-organizers');
    Route::post('users/event-organizers/{user}/approve', [UserController::class, 'approveEO'])->name('users.event-organizers.approve');
    Route::post('users/event-organizers/{user}/suspend', [UserController::class, 'suspendEO'])->name('users.event-organizers.suspend');
    Route::post('users/event-organizers/{user}/reject', [UserController::class, 'rejectEO'])->name('users.event-organizers.reject');
    
    // Customers
    Route::get('users/customers', [UserController::class, 'customers'])->name('users.customers');
    Route::get('users/customers/{user}', [UserController::class, 'showCustomer'])->name('users.customers.show');
    Route::post('users/customers/{user}/suspend', [UserController::class, 'suspendCustomer'])->name('users.customers.suspend');
    Route::post('users/customers/{user}/activate', [UserController::class, 'activateCustomer'])->name('users.customers.activate');
    
    // ═══════════════════════════════════════════════════════════════
    // CMS & CONTENT MANAGEMENT
    // ═══════════════════════════════════════════════════════════════
    
    // Home Banners
    Route::resource('banners', HomeBannerController::class);
    Route::post('banners/{banner}/toggle-status', [HomeBannerController::class, 'toggleStatus'])->name('banners.toggle-status');
    
    // Homepage Settings
    Route::get('homepage-settings', [\App\Http\Controllers\Admin\HomepageSettingController::class, 'index'])->name('homepage-settings.index');
    Route::put('homepage-settings', [\App\Http\Controllers\Admin\HomepageSettingController::class, 'update'])->name('homepage-settings.update');
    
    // ═══════════════════════════════════════════════════════════════
    // EVENT MANAGEMENT
    // ═══════════════════════════════════════════════════════════════
    
    // Events Management
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    
    // Event Approval
    Route::get('events-pending', [\App\Http\Controllers\Admin\EventController::class, 'pending'])->name('events.pending');
    Route::post('events/{event}/approve', [\App\Http\Controllers\Admin\EventController::class, 'approve'])->name('events.approve');
    Route::post('events/{event}/reject', [\App\Http\Controllers\Admin\EventController::class, 'reject'])->name('events.reject');
    
    // Event Featured
    Route::post('events/{event}/toggle-featured', [\App\Http\Controllers\Admin\EventController::class, 'toggleFeatured'])->name('events.toggle-featured');
    
     // Event Duplicate
    Route::post('events/{event}/duplicate', [\App\Http\Controllers\Admin\EventController::class, 'duplicate'])->name('events.duplicate');
    
        // Event Featured Page
    Route::get('events-featured', [\App\Http\Controllers\Admin\EventController::class, 'featured'])->name('events.featured');
    
    // Event Categories
    Route::get('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('categories/{category}/toggle-active', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleActive'])->name('categories.toggle-active');
    
    // ═══════════════════════════════════════════════════════════════
    // TRANSACTION MANAGEMENT

    // ═══════════════════════════════════════════════════════════════
    
    // Orders Management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'destroy']);
    Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
});
