<?php

use Illuminate\Support\Facades\Route;
use MillCloud\LaravelIgnition\Http\Controllers\ExecuteSolutionController;
use MillCloud\LaravelIgnition\Http\Controllers\HealthCheckController;
use MillCloud\LaravelIgnition\Http\Controllers\UpdateConfigController;
use MillCloud\LaravelIgnition\Http\Middleware\RunnableSolutionsEnabled;

Route::group([
    'as' => 'ignition.',
    'prefix' => config('ignition.housekeeping_endpoint_prefix'),
    'middleware' => [RunnableSolutionsEnabled::class],
], function () {
    Route::get('health-check', HealthCheckController::class)->name('healthCheck');

    Route::post('execute-solution', ExecuteSolutionController::class)
        ->name('executeSolution');

    Route::post('update-config', UpdateConfigController::class)->name('updateConfig');
});
