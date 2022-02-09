<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\ConstantController;


Route::group(['prefix' => 'v1'], function () {

    Route::post('upload', [GeneralController::class, 'upload']);

    Route::get('real-estate-types', [ConstantController::class, 'getRealEstateType']);
    Route::get('cities', [ConstantController::class, 'getCity']);
    Route::get('counties', [ConstantController::class, 'getCountry']);
    Route::get('neighborhoods', [ConstantController::class, 'getNeighborhood']);
});
