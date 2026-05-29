<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\app\Http\Controllers\NaskahController;
use Modules\Pariwisata\app\Http\Controllers\DestinasiWisataController;  
use Modules\Pariwisata\app\Http\Controllers\EventWisataController;
use Modules\Pariwisata\app\Http\Controllers\AkomodasiWisataController;

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