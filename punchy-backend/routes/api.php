<?php

use App\Http\Controllers\ClockTimeController;
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

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'Logged out']);
})->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clocktimes/{date}', [ClockTimeController::class, 'getClockTimes'])->middleware('auth:sanctum');

Route::post('/clocktimes', [ClockTimeController::class, 'setClockTime'])
    ->middleware('auth:sanctum');

Route::get('/worked-hours/{weekNumber}', [ClockTimeController::class, 'getWorkedHours'])
    ->middleware('auth:sanctum');
