<?php

use Illuminate\Support\Facades\Route;
use Modules\Darurat\Http\Controllers\DaruratController;
use Modules\Darurat\Http\Controllers\NomorDaruratController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('darurats', DaruratController::class)->names('darurat');
});

Route::prefix('darurat')->middleware(['auth:sanctum'])->group(function() {
    
    Route::get('/nomor', [NomorDaruratController::class, 'index']);
    
});