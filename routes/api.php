<?php

use App\Http\Controllers\Api as Controllers;
use App\Http\Middleware\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api', 'auth:api,sanctum'])->group(function () {
    Route::middleware(UserActivity::class)->group(function () {
        /**
         * REST API to products
         */
        Route::resource('/products', Controllers\ProductController::class)
            ->only(['index', 'store']);

        /**
         * RESST API to catalogues
         */
        Route::resource('/catalogues', Controllers\CatalogueController::class)
            ->only(['index', 'store']);

        // Demonstration purposes
        Route::get('/generate', [Controllers\GenerateRandomCatalogue::class, 'generate']);
    });
});
