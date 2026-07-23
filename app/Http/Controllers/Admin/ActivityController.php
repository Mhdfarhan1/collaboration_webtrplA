<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'activity_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('activity_image');

        if ($request->hasFile('activity_image')) {
            $image = $request->file('activity_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('storage/activities'), $imageName);
            $data['activity_image'] = 'storage/activities/' . $imageName;
        }

        Activity::create($data);

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    
    public function show(string $id)
    {
        // View handled mostly by index
    }

    
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'activity_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('activity_image');

        if ($request->hasFile('activity_image')) {
            // Delete old image
            if ($activity->activity_image && file_exists(public_path($activity->activity_image))) {
                unlink(public_path($activity->activity_image));
            }

            $image = $request->file('activity_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('storage/activities'), $imageName);
            $data['activity_image'] = 'storage/activities/' . $imageName;
        }

        $activity->update($data);

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    
    public function destroy(Activity $activity)
    {
        // Delete main image
        if ($activity->activity_image && file_exists(public_path($activity->activity_image))) {
            unlink(public_path($activity->activity_image));
        }


        foreach ($activity->activityMedia as $media) {
            if ($media->activity_media_url && file_exists(public_path($media->activity_media_url))) {
                unlink(public_path($media->activity_media_url));
            }
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
