<?php

namespace App\Http\Controllers;

use App\Helpers\SecurityHelper;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $semester = $request->input('semester');
        $search = $request->input('search');

        $projects = Project::with(['projectTechs', 'projectMembers.member', 'projectManager'])
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
            ->when(!$semester && !$search, function ($query) {
                return $query->orderBy('semester', 'asc')->latest();
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(9)
            ->withQueryString();

        return view('projects', compact('projects', 'semester', 'search'));
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        $realId = SecurityHelper::decode($id) ?? $id;
        $project = Project::with(['projectTechs', 'projectMembers.member', 'projectManager'])->findOrFail($realId);

        return view('projects-detail', compact('project'));
    }
}
