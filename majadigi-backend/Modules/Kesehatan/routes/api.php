<?php

use Illuminate\Support\Facades\Route;
use Modules\Kesehatan\Http\Controllers\KesehatanController;
use Modules\Kesehatan\Http\Controllers\TbcScreeningController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('kesehatans', KesehatanController::class)->names('kesehatan');
});


Route::prefix('kesehatan')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/tbc/screening', [TbcScreeningController::class, 'store']);
    });
    // Route::post('/tbc/screening', [TbcScreeningController::class, 'store']);
    Route::get('/tbc/questions', [TbcScreeningController::class, 'questions']);
    Route::get('/tbc/symptoms', [TbcScreeningController::class, 'symptoms']);
});