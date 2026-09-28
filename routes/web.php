<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\BidController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| هنا فين كانديرو الروابط اللي كاتبان فـ المتصفح
*/

// --- 1. Pages for Everyone (Guests & Users) ---
Route::get('/', [ServiceController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/artisan/{id}', [SearchController::class, 'show'])->name('artisan.profile');


// --- 2. Routes for Logged-in Users Only (auth) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // -- Dashboard (Smart Routing) --
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // -- Profile Settings --
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // -- Client Actions (InDrive System) --
    Route::get('/post-job', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/post-job', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/my-jobs', [JobController::class, 'myJobs'])->name('jobs.my-jobs');
    Route::post('/bids/{bid}/accept', [BidController::class, 'accept'])->name('bids.accept');
    
    // -- Artisan Actions --
    Route::post('/submit-bid', [BidController::class, 'store'])->name('bids.store');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    
    // -- Shared Actions (Reviews, Bookings) --
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}', [BookingController::class, 'updateStatus'])->name('bookings.update');

    // -- API for Notifications --
    Route::get('/api/notifications/count', function() {
        return response()->json(['count' => auth()->user()->unreadNotifications->count()]);
    })->name('notifications.count');
    Route::post('/update-location', [ProfileController::class, 'updateLocation'])->name('profile.location.update');
    
});

// --- 3. Authentication Routes (Login, Register, etc.) ---
require __DIR__.'/auth.php';