<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $members = Member::orderBy('member_nim', 'asc')->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_nim' => 'required|integer|digits_between:1,20|unique:members,member_nim',
            'member_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only(['member_name', 'member_nim', 'instagram_url', 'linkedin_url', 'github_url']);
        $data['member_is_core'] = $request->has('member_is_core') ? 1 : 0;

        if ($request->hasFile('member_image')) {
            $imagePath = $request->file('member_image')->store('members', 'public');
            $data['member_image'] = 'storage/' . $imagePath;
        }

        Member::create($data);

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_nim' => 'required|integer|digits_between:1,20|unique:members,member_nim,' . $member->member_id . ',member_id',
            'member_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only(['member_name', 'member_nim', 'instagram_url', 'linkedin_url', 'github_url']);
        $data['member_is_core'] = $request->has('member_is_core') ? 1 : 0;

        if ($request->hasFile('member_image')) {
            // Delete old image if exists
            if ($member->member_image) {
                $oldPath = str_replace('storage/', '', $member->member_image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new image
            $imagePath = $request->file('member_image')->store('members', 'public');
            $data['member_image'] = 'storage/' . $imagePath;
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // Delete image file if exists
        if ($member->member_image) {
            $oldPath = str_replace('storage/', '', $member->member_image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
