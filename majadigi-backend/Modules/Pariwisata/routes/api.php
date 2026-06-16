<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\Http\Controllers\PariwisataController;
use Modules\Pariwisata\Http\Controllers\FacilityController;
use Modules\Pariwisata\Http\Controllers\RoomController;
use Modules\Pariwisata\Http\Controllers\BookingController;
use Modules\Pariwisata\Http\Controllers\FacilityReviewController;


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


use Modules\Pariwisata\Http\Controllers\NaskahController;
use Modules\Pariwisata\Http\Controllers\DestinasiWisataController;
use Modules\Pariwisata\Http\Controllers\EventWisataController;
use Modules\Pariwisata\Http\Controllers\AkomodasiWisataController;

Route::prefix('v1')->group(function () {

    // Destinasi Wisata — READ ONLY public
    Route::get('/wisata', [DestinasiWisataController::class, 'index']);

    // Akomodasi Wisata — READ ONLY public
    Route::get('/akomodasi', [AkomodasiWisataController::class, 'index']);

    // Event Wisata — READ ONLY public
    Route::get('/event', [EventWisataController::class, 'index']);

    // Naskah Kuno — READ ONLY public
    Route::get('/naskah', [NaskahController::class, 'index']);
    Route::get('/naskah/{id}', [NaskahController::class, 'show']);
    Route::post('/naskah/register', [NaskahController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {

    // Naskah — WRITE (butuh login)
    Route::post('/naskah/{id}/komentar', [NaskahController::class, 'storeKomentar']);

    // Destinasi Wisata — WRITE (butuh login, untuk admin)
    Route::post('/wisata', [DestinasiWisataController::class, 'store']);

    // Event Wisata — WRITE (butuh login)
    Route::post('/event', [EventWisataController::class, 'store']);

    // Akomodasi — WRITE (butuh login)
    Route::post('/akomodasi', [AkomodasiWisataController::class, 'store']);
});
