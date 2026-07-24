<?php

namespace App\Http\Controllers;

use App\Helpers\SecurityHelper;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the albums.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $albums = Album::latest()
            ->when($search, function ($query) use ($search) {
                $query->where('album_name', 'like', "%{$search}%")
                    ->orWhere('album_description', 'like', "%{$search}%");
            })
            ->paginate(4)
            ->withQueryString();

        return view('albums', compact('albums'));
    }

    /**
     * Display the specified album.
     */
    public function show($id)
    {
        $realId = SecurityHelper::decode($id) ?? $id;
        $album = Album::with('images')->findOrFail($realId);

        return view('albums-detail', compact('album'));
    }
}
