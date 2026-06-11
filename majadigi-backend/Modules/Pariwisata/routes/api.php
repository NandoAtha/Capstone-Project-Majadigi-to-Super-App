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

use Modules\Pariwisata\Http\Controllers\NaskahController;
use Modules\Pariwisata\Http\Controllers\DestinasiWisataController;
use Modules\Pariwisata\Http\Controllers\EventWisataController;
use Modules\Pariwisata\Http\Controllers\AkomodasiWisataController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    
    // 1. Endpoint Eksplorasi, Pencarian, & Filter (GET)
    Route::get('/naskah', [NaskahController::class, 'index']);
    
    // 2. Endpoint Pendaftaran Naskah Baru (POST)
    Route::post('/naskah/register', [NaskahController::class, 'store']);
    
    // 3. Endpoint Detail Naskah Berdasarkan ID
    Route::get('/naskah/{id}', [NaskahController::class, 'show']);
    
    // 4. Endpoint Kirim Komentar Naskah
    Route::post('/naskah/{id}/komentar', [NaskahController::class, 'storeKomentar']);

    // 5. Endpoint Destinasi Wisata (GET & POST)
    Route::get('/wisata', [DestinasiWisataController::class, 'index']);
    Route::post('/wisata', [DestinasiWisataController::class, 'store']);

    // 6. Endpoint Event Wisata (GET & POST)
    Route::get('/event', [EventWisataController::class, 'index']);
    Route::post('/event', [EventWisataController::class, 'store']);

    Route::get('/akomodasi', [AkomodasiWisataController::class, 'index']);
    Route::post('/akomodasi', [AkomodasiWisataController::class, 'store']);
});
