<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
// Dashboard route (this blade template)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Lost Items routes
Route::get('/items/lost/create', [ItemController::class, 'createLost'])->name('items.lost.create');
Route::post('/items/lost', [ItemController::class, 'storeLost'])->name('items.lost.store');

// Found Items routes
Route::get('/items/found/create', [ItemController::class, 'createFound'])->name('items.found.create');
Route::post('/items/found', [ItemController::class, 'storeFound'])->name('items.found.store');

// Search/Browse Items routes
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms.show');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.show');

// Optional: Additional routes you might need
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
