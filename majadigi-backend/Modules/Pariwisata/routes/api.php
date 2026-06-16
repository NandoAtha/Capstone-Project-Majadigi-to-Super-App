<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\app\Http\Controllers\NaskahController;
use Modules\Pariwisata\app\Http\Controllers\DestinasiWisataController;  
use Modules\Pariwisata\app\Http\Controllers\EventWisataController;
use Modules\Pariwisata\app\Http\Controllers\AkomodasiWisataController;

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