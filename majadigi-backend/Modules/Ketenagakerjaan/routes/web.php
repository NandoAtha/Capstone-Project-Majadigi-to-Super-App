<?php

use Illuminate\Support\Facades\Route;
use Modules\Ketenagakerjaan\Http\Controllers\KetenagakerjaanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('ketenagakerjaans', KetenagakerjaanController::class)->names('ketenagakerjaan');
});
