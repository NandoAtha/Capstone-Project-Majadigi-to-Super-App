<?php

use Illuminate\Support\Facades\Route;
use Modules\Darurat\Http\Controllers\DaruratController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('darurats', DaruratController::class)->names('darurat');
});
