<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Album;
use App\Models\HeroMedia;
use App\Models\Link;
use App\Models\Member;
use App\Models\Project;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $heroMedia = HeroMedia::latest()->first();

        $projects = Project::with([
            'projectTechs',
            'projectMembers.member',
            'projectManager'
        ])->latest()->paginate(3)->fragment('projects');

        $activities = Activity::latest()->take(3)->get();

        $albums = Album::latest()->take(4)->get();

        $links = Link::whereIn('link_type', [
            'schedule',
            'notion',
            'instagram'
        ])->get()->keyBy('link_type');

        $s = Setting::pluck('value', 'key');

        $totalMembersCount = Member::count();

        $members = Member::orderBy('member_is_core', 'desc')
            ->orderBy('member_name', 'asc')
            ->take(4)
            ->get();

        return view('home', compact(
            'heroMedia',
            'projects',
            'activities',
            'albums',
            'links',
            's',
            'members',
            'totalMembersCount'
        ));
    }
}
