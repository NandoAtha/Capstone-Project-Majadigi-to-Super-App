<?php

use Illuminate\Support\Facades\Route;
use Modules\Kesehatan\Http\Controllers\KesehatanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('kesehatans', KesehatanController::class)->names('kesehatan');
});
