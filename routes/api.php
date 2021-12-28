<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GeneralController;


Route::group(['prefix' => 'v1'], function () {

    Route::post('upload', [GeneralController::class, 'upload']);
});
