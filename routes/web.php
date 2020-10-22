<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// Authentication
Route::get('/login', [Controllers\AuthenticationController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [Controllers\AuthenticationController::class, 'login'])->name('login');

// Protected routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', fn () => view('app'))->name('home');
});
