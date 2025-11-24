<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// Added these two missing controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/rates', [RatesController::class, 'index'])->name('rates');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Package Routes - Updated with new package types
Route::get('/packages/couple', [PackageController::class, 'couples'])->name('packages.couple');
Route::get('/packages/family', [PackageController::class, 'family'])->name('packages.family');
Route::get('/packages/group', [PackageController::class, 'group'])->name('packages.group');
Route::get('/packages/wedding', [PackageController::class, 'wedding'])->name('packages.wedding');
Route::get('/packages/engagement', [PackageController::class, 'engagement'])->name('packages.engagement');
Route::get('/packages/birthday', [PackageController::class, 'birthday'])->name('packages.birthday');
Route::get('/packages/honeymoon', [PackageController::class, 'honeymoon'])->name('packages.honeymoon');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Room Public Routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/rooms/{room}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/rooms/{room}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my-bookings');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Room Management
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::put('/rooms/{room}/availability', [RoomController::class, 'updateAvailability'])->name('rooms.updateAvailability');

    // Package Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/packages', [App\Http\Controllers\Admin\PackageController::class, 'index'])->name('packages.index');
        Route::get('/packages/create', [App\Http\Controllers\Admin\PackageController::class, 'create'])->name('packages.create');
        Route::post('/packages', [App\Http\Controllers\Admin\PackageController::class, 'store'])->name('packages.store');
        Route::get('/packages/{package}', [App\Http\Controllers\Admin\PackageController::class, 'show'])->name('packages.show');
        Route::get('/packages/{package}/edit', [App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('packages.edit');
        Route::put('/packages/{package}', [App\Http\Controllers\Admin\PackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}', [App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('packages.destroy');
        Route::patch('/packages/{package}/toggle-status', [App\Http\Controllers\Admin\PackageController::class, 'toggleStatus'])->name('packages.toggle-status');
        Route::post('/packages/sort', [App\Http\Controllers\Admin\PackageController::class, 'updateSortOrder'])->name('packages.sort');
    });

    // Booking Management
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/{booking}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::put('/admin/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    
    // User Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // --- ADD THIS LINE BELOW ---
    Route::patch('/admin/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});

// --- Package Builder Processing (Public) ---
Route::post('/package-builder/proceed', [App\Http\Controllers\PackageBuilderController::class, 'proceedToBooking'])
    ->name('package-builder.proceed');

// --- Booking Confirmation (Protected - Requires Login) ---
Route::middleware(['auth'])->group(function () {
    // 1. Review the package booking (The page they land on after login)
    Route::get('/bookings/package/review', [BookingController::class, 'reviewPackage'])
        ->name('bookings.package.review');

    // 2. Finalize/Store the booking (When they click "Confirm Booking")
    Route::post('/bookings/package/store', [BookingController::class, 'storePackage'])
        ->name('bookings.package.store');
});


// Error Pages
Route::fallback(function () {
    return view('errors.404');
});

// Public calendar view
Route::get('/availability', [CalendarController::class, 'index'])->name('calendar.index');

// Admin routes (protected)
Route::middleware(['auth', 'admin'])->group(function () {
    // View availability (no editing)
    Route::get('/admin/availability', [App\Http\Controllers\CalendarController::class, 'admin'])->name('admin.calendar');
    
    // Edit availability page
    Route::get('/admin/availability/edit', [App\Http\Controllers\CalendarController::class, 'edit'])->name('admin.calendar.edit');
    
    // Update availability (AJAX endpoint)
    Route::post('/admin/availability/update', [App\Http\Controllers\CalendarController::class, 'update'])->name('calendar.update');
});

// ============================================================================
// PUBLIC GALLERY ROUTES
// ============================================================================

// Original 6 Categories
Route::get('/gallery/rooms', [App\Http\Controllers\GalleryController::class, 'rooms'])->name('gallery.rooms');
Route::get('/gallery/rooms/family-cottages', [App\Http\Controllers\GalleryController::class, 'familyCottages'])->name('gallery.family_cottages');
Route::get('/gallery/rooms/couple-cottages', [App\Http\Controllers\GalleryController::class, 'coupleCottages'])->name('gallery.couple_cottages');
Route::get('/gallery/rooms/family-rooms', [App\Http\Controllers\GalleryController::class, 'familyRooms'])->name('gallery.family_rooms');
Route::get('/gallery/outdoor', [App\Http\Controllers\GalleryController::class, 'outdoor'])->name('gallery.outdoor');
Route::get('/gallery/weddings', [App\Http\Controllers\GalleryController::class, 'weddings'])->name('gallery.weddings');

// New 6 Categories
Route::get('/gallery/conference-hall', [App\Http\Controllers\GalleryController::class, 'conferenceHall'])->name('gallery.conference_hall');
Route::get('/gallery/events', [App\Http\Controllers\GalleryController::class, 'events'])->name('gallery.events');
Route::get('/gallery/indoor-games', [App\Http\Controllers\GalleryController::class, 'indoorGames'])->name('gallery.indoor_games');
Route::get('/gallery/outdoor-games', [App\Http\Controllers\GalleryController::class, 'outdoorGames'])->name('gallery.outdoor_games');
Route::get('/gallery/swimming-pool', [App\Http\Controllers\GalleryController::class, 'swimmingPool'])->name('gallery.swimming_pool');
Route::get('/gallery/dining-area', [App\Http\Controllers\GalleryController::class, 'diningArea'])->name('gallery.dining_area');

// ============================================================================
// ADMIN GALLERY ROUTES - All 12 Categories (Protected with admin middleware)
// ============================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gallery Management Dashboard
    Route::get('/gallery', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');
    
    // Original 6 Categories
    Route::get('/gallery/rooms', [App\Http\Controllers\Admin\GalleryController::class, 'rooms'])->name('gallery.rooms');
    Route::get('/gallery/family-cottages', [App\Http\Controllers\Admin\GalleryController::class, 'familyCottages'])->name('gallery.family-cottages');
    Route::get('/gallery/couple-cottages', [App\Http\Controllers\Admin\GalleryController::class, 'coupleCottages'])->name('gallery.couple-cottages');
    Route::get('/gallery/family-rooms', [App\Http\Controllers\Admin\GalleryController::class, 'familyRooms'])->name('gallery.family-rooms');
    Route::get('/gallery/outdoor', [App\Http\Controllers\Admin\GalleryController::class, 'outdoor'])->name('gallery.outdoor');
    Route::get('/gallery/weddings', [App\Http\Controllers\Admin\GalleryController::class, 'weddings'])->name('gallery.weddings');
    
    // New 6 Categories
    Route::get('/gallery/conference-hall', [App\Http\Controllers\Admin\GalleryController::class, 'conferenceHall'])->name('gallery.conference-hall');
    Route::get('/gallery/events', [App\Http\Controllers\Admin\GalleryController::class, 'events'])->name('gallery.events');
    Route::get('/gallery/indoor-games', [App\Http\Controllers\Admin\GalleryController::class, 'indoorGames'])->name('gallery.indoor-games');
    Route::get('/gallery/outdoor-games', [App\Http\Controllers\Admin\GalleryController::class, 'outdoorGames'])->name('gallery.outdoor-games');
    Route::get('/gallery/swimming-pool', [App\Http\Controllers\Admin\GalleryController::class, 'swimmingPool'])->name('gallery.swimming-pool');
    Route::get('/gallery/dining-area', [App\Http\Controllers\Admin\GalleryController::class, 'diningArea'])->name('gallery.dining-area');
    
    // Gallery Actions (Upload, Delete, Sort)
    Route::post('/gallery/upload', [App\Http\Controllers\Admin\GalleryController::class, 'upload'])->name('gallery.upload');
    Route::delete('/gallery/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'delete'])->name('gallery.delete');
    Route::post('/gallery/sort', [App\Http\Controllers\Admin\GalleryController::class, 'updateSortOrder'])->name('gallery.sort');
});

// ============================================================================
// PACKAGE BUILDER ROUTES (Public)
// ============================================================================

Route::get('/package-builder', [App\Http\Controllers\PackageBuilderController::class, 'index'])->name('package-builder');
Route::post('/package-builder/get-packages', [App\Http\Controllers\PackageBuilderController::class, 'getPackages'])->name('package-builder.get-packages');
Route::post('/package-builder/calculate-price', [App\Http\Controllers\PackageBuilderController::class, 'calculatePrice'])->name('package-builder.calculate-price');

// ============================================================================
// ADMIN CUSTOM PACKAGE ROUTES (Protected)
// ============================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('custom-packages', App\Http\Controllers\Admin\CustomPackageController::class);
    Route::post('/custom-packages/{customPackage}/remove-image', [App\Http\Controllers\Admin\CustomPackageController::class, 'removeImage'])->name('custom-packages.remove-image');
});