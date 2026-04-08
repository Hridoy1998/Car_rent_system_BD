<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/cars/{car}', [HomeController::class, 'show'])->name('cars.show');

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'owner') return redirect()->route('owner.dashboard');
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'update']);
    Route::resource('verifications', \App\Http\Controllers\Admin\VerificationController::class)->only(['index', 'update']);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index']);
});

// Owner Routes
Route::middleware(['auth', 'verified', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', \App\Http\Controllers\Owner\CarController::class);
    Route::resource('bookings', \App\Http\Controllers\Owner\BookingController::class)->only(['index', 'update']);
    Route::resource('bookings.damage-reports', \App\Http\Controllers\Owner\DamageReportController::class)->only(['store']);
});

// Customer Routes
Route::middleware(['auth', 'verified', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bookings', \App\Http\Controllers\Customer\BookingController::class)->only(['index', 'store', 'update']);
    Route::resource('bookings.reviews', \App\Http\Controllers\Customer\ReviewController::class)->only(['store']);
    Route::resource('verifications', \App\Http\Controllers\Customer\VerificationController::class)->only(['index', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::resource('bookings.messages', \App\Http\Controllers\MessageController::class)->only(['index', 'store']);
    Route::get('/invoices/{booking}/download', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
