<?php

use Illuminate\Support\Facades\Route;
use Modules\Ekonomi\Http\Controllers\EkonomiController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ekonomis', EkonomiController::class)->names('ekonomi');
});
