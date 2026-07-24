<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecturers = Lecturer::orderBy('lecturer_name', 'asc')->paginate(10);
        return view('admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = \App\Models\Project::orderBy('title')->get();
        return view('admin.lecturers.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_name' => 'required|string|max:255',
            'lecturer_title' => 'required|string|max:255',
            'lecturer_nip' => 'required|string|max:255',
            'lecturer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'lecturer_position' => 'nullable|string|max:255',
            'lecturer_email' => 'required|email|max:255',
            'last_education' => 'required|string|max:255',
            'education_history' => 'required|string',
            'lecturer_expertise' => 'required|string|max:255',
            'lecturer_type' => 'required|in:dosen,manpro',
            'scholar_url' => 'nullable|url|max:255',
            'scopus_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'is_advisor' => 'nullable|boolean',
            'project_ids' => 'nullable|array',
            'project_ids.*' => 'exists:projects,project_id',
        ]);

        $data = $request->except(['lecturer_image', 'project_ids']);
        $data['is_advisor'] = $request->has('is_advisor') ? 1 : 0;

        if ($request->hasFile('lecturer_image')) {
            $image = $request->file('lecturer_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('storage/lecturers'), $imageName);
            $data['lecturer_image'] = 'storage/lecturers/' . $imageName;
        }

        $lecturer = Lecturer::create($data);

        // Sync Projects
        if ($request->has('project_ids')) {
            \App\Models\Project::whereIn('project_id', $request->project_ids)->update(['project_manager_id' => $lecturer->lecturer_id]);
        }

        return redirect()->route('admin.lecturers.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
        $projects = \App\Models\Project::orderBy('title')->get();
        $managed_project_ids = $lecturer->projects->pluck('project_id')->toArray();
        return view('admin.lecturers.edit', compact('lecturer', 'projects', 'managed_project_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'lecturer_name' => 'required|string|max:255',
            'lecturer_title' => 'required|string|max:255',
            'lecturer_nip' => 'required|string|max:255',
            'lecturer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'lecturer_position' => 'nullable|string|max:255',
            'lecturer_email' => 'required|email|max:255',
            'last_education' => 'required|string|max:255',
            'education_history' => 'required|string',
            'lecturer_expertise' => 'required|string|max:255',
            'lecturer_type' => 'required|in:dosen,manpro',
            'scholar_url' => 'nullable|url|max:255',
            'scopus_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'is_advisor' => 'nullable|boolean',
            'project_ids' => 'nullable|array',
            'project_ids.*' => 'exists:projects,project_id',
        ]);

        $data = $request->except(['lecturer_image', 'project_ids']);
        $data['is_advisor'] = $request->has('is_advisor') ? 1 : 0;

        if ($request->hasFile('lecturer_image')) {
            // Delete old image
            if ($lecturer->lecturer_image && file_exists(public_path($lecturer->lecturer_image))) {
                unlink(public_path($lecturer->lecturer_image));
            }

            $image = $request->file('lecturer_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('storage/lecturers'), $imageName);
            $data['lecturer_image'] = 'storage/lecturers/' . $imageName;
        }

        $lecturer->update($data);

        // Sync Projects
        // 1. Reset projects currently managed by this lecturer
        \App\Models\Project::where('project_manager_id', $lecturer->lecturer_id)->update(['project_manager_id' => null]);

        // 2. Assign new projects
        if ($request->has('project_ids')) {
            \App\Models\Project::whereIn('project_id', $request->project_ids)->update(['project_manager_id' => $lecturer->lecturer_id]);
        }

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        if ($lecturer->lecturer_image) {
            $oldPath = str_replace('storage/', '', $lecturer->lecturer_image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $lecturer->delete();

        return redirect()->route('admin.lecturers.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
