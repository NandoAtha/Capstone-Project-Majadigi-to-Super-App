<?php

use Illuminate\Support\Facades\Route;
use Modules\InformasiPublik\Http\Controllers\InformasiPublikController;
use Modules\InformasiPublik\Http\Controllers\HoaxController;
use Modules\InformasiPublik\Http\Controllers\HargaBahanController;

    Route::get('/hoax', [HoaxController::class, 'index']);
    Route::get('/hoax/{id}', [HoaxController::class, 'show']);
    Route::post('/hoax/lapor', [HoaxController::class, 'store']);

    Route::get('/harga-bahan', [HargaBahanController::class, 'getHarga']);
    Route::get('/harga-bahan/{id}', [HargaBahanController::class, 'detail']);

