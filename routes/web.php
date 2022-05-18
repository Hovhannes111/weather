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

Route::get('/', fn() => view('index'));

// API routes
Route::middleware(['api'])->group(function () {
    // LocationController routes
    Route::get('/countries/', [LocationController::class, 'countries']);
    Route::get('/states/{country}', [LocationController::class, 'states']);
    Route::get('/cities/state/{state}', [LocationController::class, 'citiesByState']);
    Route::get('/cities/country/{country}', [LocationController::class, 'citiesByCountry']);

    // WeatherController routes
    Route::post('/weather', [WeatherController::class, 'show']);
});
