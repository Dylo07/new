<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/rates', [RatesController::class, 'index'])->name('rates');
Route::resource('rooms', RoomController::class);
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rooms/{room}/book', [BookingController::class, 'create'])
    ->name('bookings.create');
Route::post('/rooms/{room}/book', [BookingController::class, 'store'])
    ->name('bookings.store');
Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])
    ->name('bookings.confirmation');