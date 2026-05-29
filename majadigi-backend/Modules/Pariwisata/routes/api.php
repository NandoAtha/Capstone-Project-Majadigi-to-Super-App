<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\app\Http\Controllers\NaskahController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    
    // 1. Endpoint Eksplorasi, Pencarian, & Filter (GET)
    Route::get('/naskah', [NaskahController::class, 'index']);
    
    // 2. Endpoint Pendaftaran Naskah Baru (POST)
    Route::post('/naskah/register', [NaskahController::class, 'store']);
    
});