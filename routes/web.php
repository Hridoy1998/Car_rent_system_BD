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
});

// Owner Routes
Route::middleware(['auth', 'verified', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', \App\Http\Controllers\Owner\CarController::class);
});

// Customer Routes
Route::middleware(['auth', 'verified', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
