<?php

use Illuminate\Support\Facades\Route;
use Modules\Ekonomi\Http\Controllers\BapendaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    
    // Endpoint Bapenda Jatim (Layanan PKB & NJKB)
    Route::post('/bapenda/cek-pajak', [BapendaController::class, 'cekPajak']);
    Route::get('/bapenda/cek-njkb', [BapendaController::class, 'cekNjkb']);
    
});