<?php

use Illuminate\Support\Facades\Route;
use Modules\Ekonomi\Http\Controllers\EkonomiController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('ekonomis', EkonomiController::class)->names('ekonomi');
});
