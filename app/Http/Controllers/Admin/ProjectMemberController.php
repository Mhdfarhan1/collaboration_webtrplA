<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Member;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);

        // Get members currently assigned to this project
        $teamMembers = ProjectMember::with('member')->where('project_id', $projectId)->get();

        // Get members NOT currently assigned to this project
        $assignedMemberIds = $teamMembers->pluck('member_id')->toArray();
        $availableMembers = Member::whereNotIn('member_id', $assignedMemberIds)
            ->orderBy('member_name')
            ->get();

        return view('admin.projects.members.index', compact('project', 'teamMembers', 'availableMembers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'member_id' => 'required|exists:members,member_id',
            'project_member_role' => 'required|string|max:255',
        ]);

        ProjectMember::create([
            'project_id' => $projectId,
            'member_id' => $request->member_id,
            'project_member_role' => $request->project_member_role,
        ]);

        return redirect()->route('admin.projects.members.index', $projectId)
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $projectMemberId)
    {
        $projectMember = ProjectMember::where('project_id', $projectId)
            ->where('project_member_id', $projectMemberId)
            ->firstOrFail();

        $projectMember->delete();

        return redirect()->route('admin.projects.members.index', $projectId)
            ->with('success', 'Anggota tim berhasil dikeluarkan dari project.');
    }
}
