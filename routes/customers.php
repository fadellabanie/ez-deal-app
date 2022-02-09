<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customers\V1\GeneralController;
use App\Http\Controllers\Api\Customers\V1\Auth\AuthController;
use App\Http\Controllers\Api\Customers\V1\Home\HomeController;
use App\Http\Controllers\Api\Customers\V1\Booking\BookingController;
use App\Http\Controllers\Api\Customers\V1\Generals\ReviewController;
use App\Http\Controllers\Api\Customers\V1\Generals\AddressController;
use App\Http\Controllers\Api\Customers\V1\Generals\BankCardController;
use App\Http\Controllers\Api\Customers\V1\Favorites\FavoriteController;
use App\Http\Controllers\Api\Customers\V1\RealEstate\RealEstateController;


Route::get('now', function () {
    return Carbon::now()->timestamp;
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'check']);
Route::post('verify-change-password', [AuthController::class, 'verifyChangePassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);

Route::group(['middleware' => 'auth:customer'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('home', [HomeController::class, 'home']);

    Route::apiResource('real-estates', RealEstateController::class)->only('index', 'show');
    Route::get('real-estates-on-map', [RealEstateController::class, 'displayOnMap']);
    Route::apiResource('favorites', FavoriteController::class)->only('index', 'store');
    Route::get('entertainments', [GeneralController::class, 'getEntertainmentByType']);
    Route::post('chack-copone', [BookingController::class, 'chackCopone']);
    Route::post('book', [BookingController::class, 'book']);

    Route::apiResource('bank-cards', BankCardController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('reviews', ReviewController::class);
});


/*
Route::get('orders', [OrderController::class, 'indexGuest']);
Route::get('orders/{order}', [OrderController::class, 'show']);

Route::get('real-estates/{real_estate}', [RealEstateController::class, 'show']);
*/