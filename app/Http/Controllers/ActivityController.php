<?php

namespace App\Http\Controllers;

use App\Helpers\SecurityHelper;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the activities.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $activities = Activity::latest()
            ->when($search, function ($query) use ($search) {
                $query->where('activity_name', 'like', "%{$search}%")
                    ->orWhere('activity_description', 'like', "%{$search}%");
            })
            ->paginate(6)
            ->withQueryString();

        return view('activities', compact('activities'));
    }

    /**
     * Display the specified activity.
     */
    public function show($id)
    {
        $realId = SecurityHelper::decode($id) ?? $id;
        $activity = Activity::with('activityMedia')->findOrFail($realId);

        return view('activities-detail', compact('activity'));
    }
}
