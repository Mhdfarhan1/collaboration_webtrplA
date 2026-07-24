<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the lecturers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $lecturers = Lecturer::with('projects')
            ->latest()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('lecturer_name', 'like', "%{$search}%")
                        ->orWhere('lecturer_expertise', 'like', "%{$search}%");
                });
            })
            ->when($type == 'manpro', function ($query) {
                $query->where(function ($q) {
                    $q->where('lecturer_type', 'manpro')
                        ->orWhereHas('projects');
                });
            })
            ->when($type == 'advisor', function ($query) {
                $query->where('is_advisor', true);
            })
            ->paginate(8)
            ->withQueryString();

        return view('lecturers', compact('lecturers'));
    }
}
