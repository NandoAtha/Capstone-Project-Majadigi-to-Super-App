<?php

use Illuminate\Support\Facades\Route;
use Modules\Pemerintahan\Http\Controllers\PemerintahanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pemerintahans', PemerintahanController::class)->names('pemerintahan');
});
