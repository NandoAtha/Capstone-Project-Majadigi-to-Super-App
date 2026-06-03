<?php

use Illuminate\Support\Facades\Route;
use Modules\Darurat\Http\Controllers\DaruratController;
use Modules\Darurat\Http\Controllers\NomorDaruratController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('darurats', DaruratController::class)->names('darurat');
});

Route::prefix('darurat')->group(function() {
    
    Route::get('/nomor', [NomorDaruratController::class, 'index']);
    
});