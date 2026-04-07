<?php

use Illuminate\Support\Facades\Route;
use Modules\Pemerintahan\Http\Controllers\PemerintahanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pemerintahans', PemerintahanController::class)->names('pemerintahan');
});
