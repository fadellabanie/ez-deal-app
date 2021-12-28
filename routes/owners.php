<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Owners\V1\Auth\AuthController;
use App\Http\Controllers\Api\Owners\V1\Coupons\CouponController;
use App\Http\Controllers\Api\Owners\V1\General\GeneralController;
use App\Http\Controllers\Api\Owners\V1\Discounts\DiscountController;
use App\Http\Controllers\Api\Owners\V1\RealEstate\RealEstateController;
use App\Http\Controllers\Api\Owners\V1\Reservations\ReservationController;

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


Route::get('now', function () {
    return Carbon::now()->timestamp;
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'check']);
Route::post('verify-change-password', [AuthController::class, 'verifyChangePassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);

Route::group(['middleware' => 'auth:owner'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('realEstates', RealEstateController::class);
    Route::post('realEstates-prices', [RealEstateController::class, 'updatePrice']);

    Route::get('home', [GeneralController::class, 'home']);
    Route::get('videos', [GeneralController::class, 'video']);
    Route::post('update-profile', [GeneralController::class, 'updateProfile']);
    Route::apiResource('reservations', ReservationController::class)->except('show');
    Route::get('active-reservations', [ReservationController::class, 'active']);
    Route::get('finished-reservations', [ReservationController::class, 'finished']);
    Route::apiResource('coupons', CouponController::class)->except('show');
    Route::apiResource('discounts', DiscountController::class)->except('show');
});
