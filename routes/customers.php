<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customers\V1\Auth\AuthController;
use App\Http\Controllers\Api\Customers\V1\RealEstate\RealEstateController;


Route::get('now', function () {
    return Carbon::now()->timestamp;
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'check']);
Route::post('verify-change-password', [AuthController::class, 'verifyChangePassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);

Route::apiResource('real-estates', RealEstateController::class)->only('index', 'show');
/*
Route::get('home', [HomeController::class, 'home']);
Route::get('orders', [OrderController::class, 'indexGuest']);
Route::get('orders/{order}', [OrderController::class, 'show']);

Route::get('real-estates/{real_estate}', [RealEstateController::class, 'show']);
*/