<?php

use Illuminate\Support\Facades\Route;
use Modules\Pariwisata\Http\Controllers\PariwisataController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pariwisatas', PariwisataController::class)->names('pariwisata');
});
