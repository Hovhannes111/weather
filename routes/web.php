<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    LocationController,
    WeatherController
};
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

Route::get('/', fn() => view('index', ['countries' => \App\Models\Country::all()]));

// API routes
Route::middleware(['api'])->group(function () {
    // LocationController routes
    Route::get('/country/{country}', [LocationController::class, 'country']);
    Route::get('/state/{state}', [LocationController::class, 'state']);

    // WeatherController routes
    Route::post('/weather', [WeatherController::class, 'show']);
});
