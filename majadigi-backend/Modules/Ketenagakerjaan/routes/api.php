<?php

use Illuminate\Support\Facades\Route;
use Modules\Ketenagakerjaan\Http\Controllers\KetenagakerjaanController;

use Modules\Ketenagakerjaan\Http\Controllers\JobTrainingController;
use Modules\Ketenagakerjaan\Http\Controllers\JobApplicationController;
use Modules\Ketenagakerjaan\Http\Controllers\TrainingController;
use Modules\Ketenagakerjaan\Http\Controllers\TrainingParticipantController;
use Modules\Ketenagakerjaan\Http\Controllers\TrainingCenterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ketenagakerjaans', KetenagakerjaanController::class)->names('ketenagakerjaan');
});


Route::prefix('ketenagakerjaan')->group(function () {

    Route::get('/training-centers', [TrainingCenterController::class, 'index']);
    Route::get('/training-centers/{id}', [TrainingCenterController::class, 'show']);

    // JOB
    Route::get('/jobs', [JobTrainingController::class, 'index']);
    Route::get('/jobs/{id}', [JobTrainingController::class, 'show']);

    // APPLY
    Route::post('/apply', [JobApplicationController::class, 'apply']);
    Route::get('/my-applications', [JobApplicationController::class, 'myApplications']);

    // TRAINING
    Route::get('/trainings', [TrainingController::class, 'index']);
    Route::get('/trainings/{id}', [TrainingController::class, 'show']);

    // JOIN TRAINING
    Route::post('/join-training', [TrainingParticipantController::class, 'join']);
    Route::get('/my-trainings', [TrainingParticipantController::class, 'myTrainings']);
    Route::get('/my-trainings/{id}', [TrainingParticipantController::class, 'show']);

});