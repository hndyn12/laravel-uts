<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarreturnController;
use App\Http\Controllers\Api\CustomesController;
use App\Http\Controllers\Api\RentalController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::resource('car', CarController::class);

    Route::resource('customer', CustomesController::class);

    Route::resource('rental', RentalController::class);

    Route::resource('carreturn', CarreturnController::class);

    Route::get('/uts', function () {
        return view('welcome');
    });
});
