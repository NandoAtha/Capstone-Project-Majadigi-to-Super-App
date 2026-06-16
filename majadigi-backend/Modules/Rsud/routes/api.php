<?php

use Illuminate\Support\Facades\Route;
use Modules\Rsud\Http\Controllers\RsudController;
use Modules\Rsud\Http\Controllers\RoomController;

//Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('rsud')->group(function () {

        Route::get('/dashboard', [
            RoomController::class,
            'dashboard'
        ]);

        Route::get('/categories', [
            RoomController::class,
            'categories'
        ]);

        Route::get('/rooms', [
            RoomController::class,
            'index'
        ]);

        Route::get('/rooms/category/{id}', [
            RoomController::class,
            'byCategory'
        ]);

        Route::get(
            '/availability',
            [RoomController::class, 'availability']
        );
    });

//});
