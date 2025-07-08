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

use Illuminate\Support\Facades\Mail;






Route::get('/', [HomeController::class, 'index'])->name('home');


//Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Forgot Password routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

//Claim routes

Route::middleware('auth')->group(function () {
    Route::get('/claims/create', [ClaimController::class, 'create'])
        ->name('claims.create');

    Route::post('/claims/{item}', [ClaimController::class, 'store'])
        ->name('claims.store');
});


    // Dashboard route (this blade template)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Lost Items routes
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

// Found Items routes
Route::middleware('auth')->group(function () {
    Route::get('/items/found/create', [ItemController::class, 'createFound'])
        ->name('items.found.create');

    Route::post('/items/found/store', [ItemController::class, 'storeFound'])
        ->name('items.found.store');
});


// Search/Browse Items routes
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');

// Optional: Additional routes you might need
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');


// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/items', [AdminItemController::class, 'index'])->name('admin.items.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/claims', [AdminClaimController::class, 'index'])->name('admin.claims.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
});

// If you have authentication routes
//Auth::routes();



// // Home route (redirect to dashboard if authenticated)
// Route::get('/', function () {
//     return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
// })->name('home');
