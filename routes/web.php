<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\SiteController::class, 'index']);
Route::get('/getStatesByCountry/{countryId}', [App\Http\Controllers\SiteController::class, 'getStatesByCountry']);
Route::get('/getCitiesByState/{stateId}', [App\Http\Controllers\SiteController::class, 'getCitiesByState']);
Route::post('/getWeather', [App\Http\Controllers\WeatherController::class, 'getWeather']);
