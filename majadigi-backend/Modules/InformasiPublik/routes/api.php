<?php

use Illuminate\Support\Facades\Route;
use Modules\InformasiPublik\Http\Controllers\InformasiPublikController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('informasipubliks', InformasiPublikController::class)->names('informasipublik');
});
