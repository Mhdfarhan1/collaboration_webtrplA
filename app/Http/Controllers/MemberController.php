<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('member_nim', 'asc')->paginate(8);

        return view('members', compact('members'));
    }

    public function searchMembers(Request $request)
    {
        $query = $request->input('q');

        $members = Member::where('member_name', 'like', "%{$query}%")
                            ->orWhere('member_nim', 'like', "%{$query}%")
                            ->orderBy('member_id', 'asc')
                            ->paginate(8);
        
        return view('members', compact('members'));
    }
}
