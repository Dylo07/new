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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});

// Error Pages
Route::fallback(function () {
    return view('errors.404');
});


// Public calendar view
// Add this public route
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


// Public Gallery Routes
Route::get('/gallery/rooms', [App\Http\Controllers\GalleryController::class, 'rooms'])->name('gallery.rooms');
Route::get('/gallery/outdoor', [App\Http\Controllers\GalleryController::class, 'outdoor'])->name('gallery.outdoor');
Route::get('/gallery/weddings', [App\Http\Controllers\GalleryController::class, 'weddings'])->name('gallery.weddings');

// Admin Gallery Routes - Protected with admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gallery Management
    Route::get('/gallery', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/rooms', [App\Http\Controllers\Admin\GalleryController::class, 'rooms'])->name('gallery.rooms');
    Route::get('/gallery/outdoor', [App\Http\Controllers\Admin\GalleryController::class, 'outdoor'])->name('gallery.outdoor');
    Route::get('/gallery/weddings', [App\Http\Controllers\Admin\GalleryController::class, 'weddings'])->name('gallery.weddings');
    Route::post('/gallery/upload', [App\Http\Controllers\Admin\GalleryController::class, 'upload'])->name('gallery.upload');
    Route::delete('/gallery/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'delete'])->name('gallery.delete');
    Route::post('/gallery/sort', [App\Http\Controllers\Admin\GalleryController::class, 'updateSortOrder'])->name('gallery.sort');
});