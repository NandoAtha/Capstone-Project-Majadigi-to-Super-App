<?php

use Illuminate\Support\Facades\Route;
use Modules\Rsud\Http\Controllers\RsudController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('rsuds', RsudController::class)->names('rsud');
});
