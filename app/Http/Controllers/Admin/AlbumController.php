<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'album_description' => 'required',
            'album_cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('album_cover')) {
            $imageName = time() . '.' . $request->album_cover->extension();
            $request->album_cover->move(public_path('assets/img/albums'), $imageName);
            $data['album_cover'] = 'assets/img/albums/' . $imageName;
        }

        Album::create($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil ditambahkan.');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'album_description' => 'required',
            'album_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('album_cover')) {
            // Hapus gambar lama jika ada
            if ($album->album_cover && file_exists(public_path($album->album_cover))) {
                unlink(public_path($album->album_cover));
            }
            
            $imageName = time() . '.' . $request->album_cover->extension();
            $request->album_cover->move(public_path('assets/img/albums'), $imageName);
            $data['album_cover'] = 'assets/img/albums/' . $imageName;
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        if ($album->album_cover && file_exists(public_path($album->album_cover))) {
            unlink(public_path($album->album_cover));
        }

        // Hapus juga semua media di dalamnya (asumsi image file ada)
        foreach($album->images as $img) {
            if (file_exists(public_path($img->image_url))) {
                unlink(public_path($img->image_url));
            }
        }

        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus.');
    }
}
