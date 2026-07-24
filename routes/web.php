<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ActivityMediaController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AlbumImageController;
use App\Http\Controllers\Admin\ClassLogoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroMediaController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectMemberController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', function () {
    $semester = request('semester');
    $search = request('search');

    $projects = \App\Models\Project::with(['projectTechs', 'projectMembers.member', 'projectManager'])
        ->when($semester, function ($query, $semester) {
            return $query->where('semester', $semester);
        })
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('projectTechs', function ($qt) use ($search) {
                        $qt->where('tech_name', 'like', "%{$search}%");
                    });
            });
        })
        ->when(!$semester && !$search, function ($query) {
            return $query->orderBy('semester', 'asc')->latest();
        }, function ($query) {
            return $query->latest();
        })
        ->paginate(9)
        ->withQueryString();

    return view('projects', compact('projects', 'semester', 'search'));
})->name('projects');

Route::get('/projects/{id}', function ($id) {
    $realId = \App\Helpers\SecurityHelper::decode($id) ?? $id;
    $project = \App\Models\Project::with(['projectTechs', 'projectMembers.member', 'projectManager'])->findOrFail($realId);
    return view('projects-detail', compact('project'));
})->name('projects.detail');

Route::get('/members', [MemberController::class, 'index'])->name('members');
Route::get('/search', [MemberController::class, 'searchMembers'])->name('members.search');

Route::get('/lecturers', function () {
    $search = request('search');
    $type = request('type');

    $lecturers = \App\Models\Lecturer::with('projects')
        ->latest()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('lecturer_name', 'like', "%$search%")
                    ->orWhere('lecturer_expertise', 'like', "%$search%");
            });
        })
        ->when($type == 'manpro', function ($query) {
            $query->where(function ($q) {
                $q->where('lecturer_type', 'manpro')
                    ->orWhereHas('projects');
            });
        })
        ->when($type == 'advisor', function ($query) {
            $query->where('is_advisor', true);
        })
        ->paginate(8)
        ->withQueryString();
    return view('lecturers', compact('lecturers'));
})->name('lecturers');



Route::get('/albums', function () {
    $search = request('search');
    $albums = \App\Models\Album::latest()
        ->when($search, function ($query) use ($search) {
            $query->where('album_name', 'like', "%$search%")
                ->orWhere('album_description', 'like', "%$search%");
        })
        ->paginate(4)
        ->withQueryString();
    return view('albums', compact('albums'));
})->name('albums');

Route::get('/activities', function () {
    $search = request('search');
    $activities = Activity::latest()
        ->when($search, function ($query) use ($search) {
            $query->where('activity_name', 'like', "%$search%")
                ->orWhere('activity_description', 'like', "%$search%");
        })
        ->paginate(6)
        ->withQueryString();
    return view('activities', compact('activities'));
})->name('activities');

Route::get('/activities/{id}', function ($id) {
    $realId = \App\Helpers\SecurityHelper::decode($id) ?? $id;
    $activity = \App\Models\Activity::with('activityMedia')->findOrFail($realId);
    return view('activities-detail', compact('activity'));
})->name('activities.detail');

Route::get('/albums/{id}', function ($id) {
    $realId = \App\Helpers\SecurityHelper::decode($id) ?? $id;
    $album = \App\Models\Album::with('images')->findOrFail($realId);
    return view('albums-detail', compact('album'));
})->name('albums.detail');

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
    Route::resource('members', MemberController::class);

    // Projects Routes
    Route::resource('projects', ProjectController::class);

    // Project Members (Team) Nested Routes
    Route::resource('projects.members', ProjectMemberController::class)->only(['index', 'store', 'destroy']);

    // Class Logos Routes
    Route::resource('logos', ClassLogoController::class)->only(['index', 'store', 'destroy']);

    // Activities Routes
    Route::resource('activities', ActivityController::class);

    // Activity Media (Gallery) Nested Routes
    Route::resource('activities.media', ActivityMediaController::class)->only(['index', 'store', 'destroy', 'update']);

    // Albums Routes
    Route::resource('albums', AlbumController::class);

    // Album Images (Gallery) Nested Routes
    Route::resource('albums.images', AlbumImageController::class)->only(['index', 'store', 'destroy', 'update']);

    // Links Routes
    Route::resource('links', LinkController::class);

    // Lecturers Routes
    Route::resource('lecturers', LecturerController::class);

    // Site Settings Routes
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
