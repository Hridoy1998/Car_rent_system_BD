<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Owner\DamageReportController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/cars/{car}', [HomeController::class, 'show'])->name('cars.show');

// Educational Pages
Route::get('/how-it-works', [PagesController::class, 'howItWorks'])->name('pages.how-it-works');
Route::get('/safety', [PagesController::class, 'safety'])->name('pages.safety');
Route::get('/faq', [PagesController::class, 'faq'])->name('pages.faq');

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if ($role === 'owner') {
        return redirect()->route('owner.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Profiles
Route::get('/profiles/{user}', [PublicProfileController::class, 'show'])->name('profiles.show');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', CarController::class);
    Route::resource('users', UserController::class)->only(['index', 'update']);
    Route::resource('verifications', VerificationController::class)->only(['index', 'update']);
    Route::resource('bookings', BookingController::class)->only(['index', 'show', 'update']);
    Route::resource('promo-codes', PromoCodeController::class)->only(['index', 'store', 'destroy']);
    Route::put('/damage-reports/{damageReport}/resolve', [DamageReportController::class, 'resolve'])->name('damage-reports.resolve');
});

// Owner Routes
Route::middleware(['auth', 'verified', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', App\Http\Controllers\Owner\CarController::class);
    Route::resource('bookings', App\Http\Controllers\Owner\BookingController::class)->only(['index', 'show', 'update']);
    Route::resource('bookings.damage-reports', DamageReportController::class)->only(['store']);
});

// Customer Routes
Route::middleware(['auth', 'verified', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bookings', App\Http\Controllers\Customer\BookingController::class)->only(['index', 'show', 'store', 'update']);
    Route::post('/bookings/{booking}/pay', [App\Http\Controllers\Customer\BookingController::class, 'pay'])->name('bookings.pay');
    Route::resource('bookings.reviews', ReviewController::class)->only(['store']);
    Route::resource('verifications', App\Http\Controllers\Customer\VerificationController::class)->only(['index', 'store']);
    Route::put('/damage-reports/{damageReport}/respond', [App\Http\Controllers\Customer\DamageReportController::class, 'update'])->name('damage-reports.respond');
});

Route::middleware('auth')->group(function () {
    Route::resource('bookings.messages', MessageController::class)->only(['index', 'store']);
    Route::get('/invoices/{booking}/download', [InvoiceController::class, 'download'])->name('invoices.download');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Success Pages
    Route::get('/booking-success/{booking}', [PagesController::class, 'bookingSuccess'])->name('success.booking');
    Route::get('/car-success', [PagesController::class, 'carSuccess'])->name('success.car');
});

require __DIR__.'/auth.php';
