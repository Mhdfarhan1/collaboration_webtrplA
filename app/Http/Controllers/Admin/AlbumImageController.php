<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;

class AlbumImageController extends Controller
{
    public function index($albumId)
    {
        $album = Album::findOrFail($albumId);
        $images = AlbumImage::where('album_id', $albumId)->latest()->get();

        return view('admin.albums.images.index', compact('album', 'images'));
    }

    public function store(Request $request, $albumId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'images' => 'required|array|min:1|max:10',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('assets/img/albums/gallery'), $imageName);
                $imageUrl = 'assets/img/albums/gallery/' . $imageName;

                AlbumImage::create([
                    'album_id' => $albumId,
                    'image_url' => $imageUrl,
                ]);
            }
            return redirect()->route('admin.albums.images.index', $albumId)
                ->with('success', 'Foto galeri berhasil diunggah.');
        }

        return redirect()->route('admin.albums.images.index', $albumId)
            ->with('error', 'Gagal mengunggah foto.');
    }

    public function update(Request $request, $albumId, $imageId)
    {
        $album = Album::findOrFail($albumId);
        $image = AlbumImage::where('album_id', $albumId)->findOrFail($imageId);

        // Update the main album cover with this image's URL
        $album->update([
            'album_cover' => $image->image_url
        ]);

        return redirect()->route('admin.albums.images.index', $albumId)
            ->with('success', 'Sampul album berhasil diperbarui dari galeri.');
    }

    public function destroy($albumId, $imageId)
    {
        $image = AlbumImage::where('album_id', $albumId)->findOrFail($imageId);

        if ($image->image_url && file_exists(public_path($image->image_url))) {
            unlink(public_path($image->image_url));
        }

        $image->delete();

        return redirect()->route('admin.albums.images.index', $albumId)
            ->with('success', 'Foto berhasil dihapus.');
    }
}
