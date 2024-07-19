<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClockTimes\GetWeeklyClockTimesController;
use App\Http\Controllers\API\ClockTimes\SetWeeklyClockTimesController;
use App\Http\Controllers\API\WorkedHours\GetWeeklyWorkedHoursController;
use App\Http\Controllers\API\WorkedHours\GetYearlyWorkedHoursController;
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
        Route::post('/', SetWeeklyClockTimesController::class);
    });

    Route::group(['prefix' => '/workedhours'], function () {
        Route::get('/week/{date}', GetWeeklyWorkedHoursController::class);
    });
});

Route::get('/test/{year}', GetYearlyWorkedHoursController::class);
