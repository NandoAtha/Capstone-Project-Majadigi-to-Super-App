<?php

use Illuminate\Support\Facades\Route;
use Modules\InformasiPublik\Http\Controllers\InformasiPublikController;
use Modules\InformasiPublik\Http\Controllers\HoaxController;
use Modules\InformasiPublik\Http\Controllers\HargaBahanController;

Route::prefix('v1')->group(function () {
    Route::get('/hoax', [HoaxController::class, 'index']);
    Route::get('/hoax/{id}', [HoaxController::class, 'show']);
    Route::post('/hoax/lapor', [HoaxController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('informasipubliks', InformasiPublikController::class)->names('informasipublik');
    Route::get('/harga-pokok', [HargaBahanController::class, 'getHarga']);
    Route::get('/bahan-pokok/{id}', [HargaBahanController::class, 'show']);
});