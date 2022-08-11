<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\V1\BookingController;
use App\Http\Controllers\V1\TripsController;
use App\Http\Controllers\V1\ApiHelpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| The reason why login | register | logout | authorize
| are not prefixed unser api/v1 is because
| in normal instances the authentication should be global
| ene if the api versioning changes
| security should be improved everywhere
*/

/**
 * Public route for API helper
 */
Route::get('/', [ApiHelpController::class, 'index']);

/**
 * Make an account
 */
Route::post('/register', [AuthenticateController::class, 'register']);

/**
 * Use this method
 * to be able to generate
 * protected endpoints
 * Warning: a token expires in 5 mins
 * config/sanctum.php -> 'expiration' => 5 (minutes)
 */

Route::post('/authorize', [AuthenticateController::class, 'authorization']);

/**
 * Login
 */

Route::post('/login', [AuthenticateController::class, 'login']);

/**
 * Logout / delete access tokens
 */

Route::get('/logout',[AuthenticateController::class,'logout'])->middleware('auth:sanctum');

/**
 * Protect any requests to the actual API
 * uses sanctum/airlock to secure api endpoints
 * using tokens
 */

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('/trips', TripsController::class);
    Route::apiResource('/bookings', BookingController::class)->except(['reserve']);
    Route::post('/reserve-trip',[BookingController::class,'reserve']);
});

