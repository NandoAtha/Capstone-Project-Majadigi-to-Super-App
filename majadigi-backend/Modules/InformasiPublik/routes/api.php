<?php

use Illuminate\Support\Facades\Route;
use Modules\InformasiPublik\Http\Controllers\InformasiPublikController;
use Modules\InformasiPublik\Http\Controllers\HoaxController;
use Modules\InformasiPublik\Http\Controllers\HargaBahanController;

// Gunakan satu prefix 'v1' saja di paling luar
//Route::middleware(['auth:sanctum'])->group(function () {
    
    // Rute Resource yang sudah ada
    Route::apiResource('informasipubliks', InformasiPublikController::class)->names('informasipublik');

    // Tambahkan Rute Klinik Hoax di sini
    // (Tidak perlu tambah middleware auth lagi karena sudah dibungkus di grup luar)
    Route::post('/hoax/lapor', [HoaxController::class, 'store']);

    Route::get('/harga-bahan', [HargaBahanController::class, 'getHarga']);
    Route::get('/harga-bahan/{id}', [HargaBahanController::class, 'detail']);
//});