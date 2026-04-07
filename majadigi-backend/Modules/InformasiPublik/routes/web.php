<?php

use Illuminate\Support\Facades\Route;
use Modules\InformasiPublik\Http\Controllers\InformasiPublikController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('informasipubliks', InformasiPublikController::class)->names('informasipublik');
});
