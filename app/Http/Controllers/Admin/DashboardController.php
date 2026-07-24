<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Album;
use App\Models\Lecturer;
use App\Models\Member;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'members' => Member::count(),
            'core_members' => Member::where('member_is_core', 1)->count(),
            'projects' => Project::count(),
            'activities' => Activity::count(),
            'albums' => Album::count(),
            'lecturers' => Lecturer::count(),
        ];

        $latestMembers = Member::latest()->take(5)->get();

        return view('admin.dashboard', compact('counts', 'latestMembers'));
    }
}
