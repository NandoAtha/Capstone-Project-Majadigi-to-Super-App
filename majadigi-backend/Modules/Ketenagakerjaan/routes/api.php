<?php

use Illuminate\Support\Facades\Route;
use Modules\Ketenagakerjaan\Http\Controllers\KetenagakerjaanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ketenagakerjaans', KetenagakerjaanController::class)->names('ketenagakerjaan');
});
