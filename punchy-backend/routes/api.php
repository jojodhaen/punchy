<?php

use App\Http\Controllers\API\GetWeeklyClockTimesController;
use App\Http\Controllers\API\SetWeeklyClockTimesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json(['message' => 'Authenticated']);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out']);
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => '/clocktimes'], function () {
        Route::get('/{date}', GetWeeklyClockTimesController::class);
        Route::post('/', SetWeeklyClockTimesController::class);
    });
});
