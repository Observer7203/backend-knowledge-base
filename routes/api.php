<?php

use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;

Route::prefix('progress')->group(function () {
    Route::get('/modules',          [ProgressController::class, 'modules']);
    Route::get('/modules/{id}/topics', [ProgressController::class, 'topics']);
    Route::patch('/topics/{id}',    [ProgressController::class, 'updateTopic']);
    Route::get('/stats',            [ProgressController::class, 'stats']);
    Route::post('/sessions',        [ProgressController::class, 'logSession']);
    Route::post('/seed',            [ProgressController::class, 'seed']);
    Route::get('/state',            [ProgressController::class, 'getState']);
    Route::post('/state',           [ProgressController::class, 'saveState']);
});
