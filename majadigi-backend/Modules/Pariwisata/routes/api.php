<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\Http\Controllers\PariwisataController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pariwisatas', PariwisataController::class)->names('pariwisata');
});
