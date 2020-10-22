<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Default
Route::get('/', fn () => redirect()->route('home'));

// Authentication
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [Controllers\AuthenticationController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [Controllers\AuthenticationController::class, 'login'])->name('login');
});

// Protected routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', fn () => view('app'))->name('home');
});
