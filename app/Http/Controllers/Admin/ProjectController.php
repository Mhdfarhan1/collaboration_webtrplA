<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semester = $request->query('semester');
        $search = $request->query('search');

        $projects = Project::with(['projectTechs', 'projectManager'])
            ->when($semester, function ($query, $semester) {
                return $query->where('semester', $semester);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('project_type', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('projectTechs', function ($qt) use ($search) {
                          $qt->where('tech_name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects', 'semester', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lecturers = \App\Models\Lecturer::orderBy('lecturer_name')
            ->get();
        return view('admin.projects.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'project_type' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'demo_url' => 'nullable|url|max:255',
            'project_manager_id' => 'nullable|exists:lecturers,lecturer_id',
        ]);

        $data = $request->only(['title', 'project_type', 'semester', 'description', 'demo_url', 'project_manager_id']);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('storage/projects'), $imageName);
            $data['image_url'] = 'storage/projects/' . $imageName;
        }

        $project = Project::create($data);

        // Process technologies
        $this->syncTechnologies($project, $request->technologies);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $lecturers = \App\Models\Lecturer::orderBy('lecturer_name')
            ->get();
        $techs = $project->projectTechs->pluck('tech_name')->toArray();
        $techs_string = implode(', ', $techs);
        return view('admin.projects.edit', compact('project', 'techs_string', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'project_type' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'demo_url' => 'nullable|url|max:255',
            'project_manager_id' => 'nullable|exists:lecturers,lecturer_id',
        ]);

        $data = $request->only(['title', 'project_type', 'semester', 'description', 'demo_url', 'project_manager_id']);

        if ($request->hasFile('image_url')) {
            // Hapus gambar lama
            if ($project->image_url && file_exists(public_path($project->image_url))) {
                unlink(public_path($project->image_url));
            }

            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('storage/projects'), $imageName);
            $data['image_url'] = 'storage/projects/' . $imageName;
        }

        $project->update($data);

        // Process technologies
        $this->syncTechnologies($project, $request->technologies);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete image
        if ($project->image_url && file_exists(public_path($project->image_url))) {
            unlink(public_path($project->image_url));
        }

        $project->delete(); // automatically deletes related tech due to cascadeOnDelete in migration

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Sync technologies string to project_techs table.
     */
    private function syncTechnologies(Project $project, string $techString)
    {
        // Parse comma-separated string into an array and trim whitespaces
        $techArray = array_map('trim', explode(',', $techString));

        // Remove empty values
        $techArray = array_filter($techArray);

        // First, delete existing techs for this project to re-sync them simply
        $project->projectTechs()->delete();

        // Re-insert the new ones
        foreach ($techArray as $tech) {
            ProjectTech::create([
                'project_id' => $project->project_id,
                'tech_name' => $tech,
            ]);
        }
    }
}
