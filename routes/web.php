<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/members', [MemberController::class, 'index'])->name('members');
Route::get('/search', [MemberController::class, 'searchMembers'])->name('members.search');

Route::get('/albums', function () {
    return view('albums');
})->name('albums');

Route::get('/albums/detail', function () {
    return view('albums-detail');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');


Route::prefix('password')->name('password.')->group(function () {
    Route::get('/email', function () {
        return view('auth.passwords.email');
    })->name('request');

    Route::post('/email', function () {
        // Placeholder send OTP logic
        return redirect()->route('password.verify', ['email' => request('email')]);
    })->name('email');

    Route::get('/verify', function () {
        return view('auth.passwords.otp');
    })->name('verify');

    Route::post('/verify', function () {
        // Placeholder verify OTP logic
        return redirect()->route('password.reset', [
            'email' => request('email'),
            'token' => 'dummy-token'
        ]);
    })->name('verify.check');

    Route::get('/reset', function () {
        return view('auth.passwords.reset');
    })->name('reset');

    Route::post('/reset', function () {
        // Placeholder reset password logic
        return redirect()->route('login');
    })->name('update');
});

// route dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');

