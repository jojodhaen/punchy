<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClockTimes\GetWeeklyClockTimesController;
use App\Http\Controllers\API\ClockTimes\SetWeeklyClockTimesController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\WorkedHoursController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => AuthController::class], function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', 'logout');
        Route::get('/user', 'getUser');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/clocktimes'], function () {
        Route::get('/{date}', GetWeeklyClockTimesController::class);
        // T0DO: Make Patch instead of Post, and make partially updatable
        Route::post('/', SetWeeklyClockTimesController::class);
    });

    Route::group(['prefix' => '/workedhours', 'controller' => WorkedHoursController::class], function () {
        Route::get('/week/{date}', 'getWeeklyWorkedHours');
    });

    Route::group(['prefix' => '/settings', 'controller' => SettingsController::class], function () {
        Route::get('/', 'getSettings');
        Route::patch('/', 'patchSettings');
    });
});
