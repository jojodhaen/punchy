<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->intended(route('verification.verified', absolute: false).'?verified=1');
})->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

Route::get('/email/verified', function () {
    return view('auth.verify-email');
})->name('verification.verified');

Route::get('/test', function () {
    return view('mail.signup', ['user' => App\Models\User::first()]);
});

Route::get('/test/2', function () {
    return view('auth.verify-email');
});

require __DIR__.'/auth.php';
