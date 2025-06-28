<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;




Route::get('/', [HomeController::class, 'index'])->name('home');


//Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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

// Optional: Additional routes you might need
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// If you have authentication routes
Auth::routes();

// // Home route (redirect to dashboard if authenticated)
// Route::get('/', function () {
//     return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
// })->name('home');
