<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\HeroMedia;
use App\Models\Activity;
use App\Models\Link;

Route::get('/', function () {
    $heroMedia = HeroMedia::latest()->first();
    $projects = \App\Models\Project::with(['projectTechs', 'projectMembers.member', 'projectManager'])->latest()->paginate(3)->fragment('projects');
    $activities = Activity::latest()->take(3)->get();
    $albums = \App\Models\Album::latest()->take(4)->get();
    $links = Link::whereIn('link_type', ['schedule', 'notion', 'instagram'])->get()->keyBy('link_type');
    $s = \App\Models\Setting::pluck('value', 'key'); // site settings shorthand

    $totalMembersCount = \App\Models\Member::count();
    $members = \App\Models\Member::orderBy('member_is_core', 'desc')->orderBy('member_name', 'asc')->take(4)->get();

    return view('home', compact('heroMedia', 'projects', 'activities', 'albums', 'links', 's', 'members', 'totalMembersCount'));
})->name('home');

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

// route dashboard
Route::get('/dashboard', function () {
    $counts = [
        'members' => \App\Models\Member::count(),
        'core_members' => \App\Models\Member::where('member_is_core', 1)->count(),
        'projects' => \App\Models\Project::count(),
        'activities' => \App\Models\Activity::count(),
        'albums' => \App\Models\Album::count(),
        'lecturers' => \App\Models\Lecturer::count(),
    ];

    $latestMembers = \App\Models\Member::latest()->take(5)->get();

    return view('admin.dashboard', compact('counts', 'latestMembers'));
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    // Other admin routes can go here...

    // Hero Media Routes
    Route::resource('heromedia', App\Http\Controllers\Admin\HeroMediaController::class);

    // Member Management Routes
    Route::resource('members', App\Http\Controllers\Admin\MemberController::class);

    // Projects Routes
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);

    // Project Members (Team) Nested Routes
    Route::resource('projects.members', App\Http\Controllers\Admin\ProjectMemberController::class)->only(['index', 'store', 'destroy']);

    // Class Logos Routes
    Route::resource('logos', App\Http\Controllers\Admin\ClassLogoController::class)->only(['index', 'store', 'destroy']);

    // Activities Routes
    Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class);

    // Activity Media (Gallery) Nested Routes
    Route::resource('activities.media', App\Http\Controllers\Admin\ActivityMediaController::class)->only(['index', 'store', 'destroy', 'update']);

    // Albums Routes
    Route::resource('albums', App\Http\Controllers\Admin\AlbumController::class);

    // Album Images (Gallery) Nested Routes
    Route::resource('albums.images', App\Http\Controllers\Admin\AlbumImageController::class)->only(['index', 'store', 'destroy', 'update']);

    // Links Routes
    Route::resource('links', App\Http\Controllers\Admin\LinkController::class);

    // Lecturers Routes
    Route::resource('lecturers', App\Http\Controllers\Admin\LecturerController::class);

    // Site Settings Routes
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
