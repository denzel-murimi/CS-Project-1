<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminClaimController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\StationController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Lost items
Route::middleware('auth')->group(function () {
    Route::get('/items/lost/create', [ItemController::class, 'createLost'])
        ->name('items.lost.create');

    Route::post('/items/lost/store', [ItemController::class, 'storeLost'])
        ->name('items.lost.store');

    Route::get('/items/search', [ItemController::class, 'search'])
        ->name('items.search');

    Route::get('/items/{item}', [ItemController::class, 'show'])
        ->name('items.show');
});

// Found items
Route::middleware('auth')->group(function () {
    Route::get('/items/found/create', [ItemController::class, 'createFound'])
        ->name('items.found.create');

    Route::post('/items/found/store', [ItemController::class, 'storeFound'])
        ->name('items.found.store');
});

// General browse
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// Profile
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Claims
Route::middleware('auth')->group(function () {
    Route::get('/claims/create', [ClaimController::class, 'create'])->name('claims.create');
    Route::post('/claims/{item}', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/my-claims', [ClaimController::class, 'myClaims'])->name('claims.my');
});

Route::post('/my-claims/{id}/appeal', [ClaimController::class, 'appeal'])
    ->middleware('auth')
    ->name('claims.appeal');

Route::get('/my-items/{item}', [ItemController::class, 'myItems'])->name('my.items.index');
Route::delete('/my-items/{item}', [ItemController::class, 'destroyMyItem'])->name('my.items.destroy');

// Found items deletion request
Route::get('/found-items/{item}/delete-reason', [ItemController::class, 'showDeleteReasonForm'])
    ->name('found.items.delete.reason.form');
Route::post('/found-items/{item}/delete-reason', [ItemController::class, 'submitDeleteReason'])
    ->name('found.items.delete.reason.submit');

// -------------------------
// Admin routes
// -------------------------

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('items', AdminItemController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('claims', AdminClaimController::class)->only(['index', 'update']);
    Route::get('claims/{claim}', [AdminClaimController::class, 'show'])->name('claims.show');
    Route::get('/items', [AdminItemController::class, 'index'])->name('items.index');
    Route::get('/claims', [AdminClaimController::class, 'index'])->name('claims.index');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');

    Route::post('/admin/items/{item}/claim', [AdminItemController::class, 'markAsClaimed'])
    ->name('admin.items.claim');
});

// -------------------------
// Admin Station routes
// -------------------------

Route::middleware(['auth'])->prefix('admin/station')->name('admin.station.')->group(function () {
    // Wrap closure-based middleware in a group instead of middleware array
    Route::group([
        'middleware' => function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized.');
            }
            return $next($request);
        }
    ], function () {
        Route::get('/scan', [StationController::class, 'scanForm'])->name('scan');
        Route::post('/scan', [StationController::class, 'processScan'])->name('processScan');
        Route::post('/return-item/{claim}', [StationController::class, 'markReturned'])->name('returnItem');
    });


});

// -------------------------
// Notification routes
// -------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
    Route::get('/items/confirm/{itemId}', [NotificationController::class, 'confirmFoundItem'])->name('notifications.confirmFoundItem');
    Route::get('/items/reject/{itemId}', [NotificationController::class, 'rejectFoundItem'])->name('notifications.rejectFoundItem');

    // Notification workflow for found item verification
    Route::get('/notifications/verify-found/{foundItemId}', [NotificationController::class, 'verifyFound'])->name('notifications.verifyFound');
    Route::post('/notifications/confirm-found-match/{foundItemId}', [NotificationController::class, 'confirmFoundMatch'])->name('notifications.confirmFoundMatch');
    Route::post('/notifications/reject-found-match/{foundItemId}', [NotificationController::class, 'rejectFoundMatch'])->name('notifications.rejectFoundMatch');
});
