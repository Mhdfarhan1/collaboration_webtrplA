<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\ActivityMediaController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\AlbumImageController;
use App\Http\Controllers\Admin\ClassLogoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroMediaController;
use App\Http\Controllers\Admin\LecturerController as AdminLecturerController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectMemberController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.detail');

Route::get('/members', [MemberController::class, 'index'])->name('members');
Route::get('/search', [MemberController::class, 'searchMembers'])->name('members.search');

Route::get('/lecturers', [LecturerController::class, 'index'])->name('lecturers');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums');
Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('albums.detail');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.detail');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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

// Route Admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hero Media Routes
    Route::resource('heromedia', HeroMediaController::class);

    // Member Management Routes
    Route::resource('members', AdminMemberController::class);

    // Projects Routes
    Route::resource('projects', AdminProjectController::class);

    // Project Members (Team) Nested Routes
    Route::resource('projects.members', ProjectMemberController::class)->only(['index', 'store', 'destroy']);

    // Class Logos Routes
    Route::resource('logos', ClassLogoController::class)->only(['index', 'store', 'destroy']);

    // Activities Routes
    Route::resource('activities', AdminActivityController::class);

    // Activity Media (Gallery) Nested Routes
    Route::resource('activities.media', ActivityMediaController::class)->only(['index', 'store', 'destroy', 'update']);

    // Albums Routes
    Route::resource('albums', AdminAlbumController::class);

    // Album Images (Gallery) Nested Routes
    Route::resource('albums.images', AlbumImageController::class)->only(['index', 'store', 'destroy', 'update']);

    // Links Routes
    Route::resource('links', LinkController::class);

    // Lecturers Routes
    Route::resource('lecturers', AdminLecturerController::class);

    // Site Settings Routes
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
