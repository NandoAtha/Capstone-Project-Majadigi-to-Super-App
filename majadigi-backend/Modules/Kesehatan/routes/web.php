<?php

use Illuminate\Support\Facades\Route;
use Modules\Kesehatan\Http\Controllers\KesehatanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('kesehatans', KesehatanController::class)->names('kesehatan');
});
