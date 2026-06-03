<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\Http\Controllers\PariwisataController;
use Modules\Pariwisata\Http\Controllers\FacilityController;
use Modules\Pariwisata\Http\Controllers\RoomController;
use Modules\Pariwisata\Http\Controllers\BookingController;
use Modules\Pariwisata\Http\Controllers\FacilityReviewController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('pariwisatas', PariwisataController::class)->names('pariwisata');

    Route::prefix('facilities')->group(function () {

    Route::get('/', [
        FacilityController::class,
        'index'
    ]);

    Route::get('/{id}', [
        FacilityController::class,
        'show'
    ]);

    Route::get('/{id}/reviews', [
        FacilityReviewController::class,
        'index'
    ]);

    Route::post('/{id}/reviews', [
        FacilityReviewController::class,
        'store'
    ]);
});

Route::prefix('rooms')->group(function () {

    Route::get('/{id}', [
        RoomController::class,
        'show'
    ]);
});

Route::post('/bookings', [
    BookingController::class,
    'store'
]);
});

