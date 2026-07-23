<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityMediaController extends Controller
{
    /**
     * Display a listing of the resource (gallery) for a specific activity.
     */
    public function index($activityId)
    {
        $activity = Activity::findOrFail($activityId);
        $media = ActivityMedia::where('activity_id', $activityId)->latest()->get();

        return view('admin.activities.media.index', compact('activity', 'media'));
    }

    /**
     * Store newly created resources (multiple images) in storage.
     */
    public function store(Request $request, $activityId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'images' => 'required|array|min:1|max:10', // Max 10 images at once
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('storage/activities/media'), $imageName);
                $mediaUrl = 'storage/activities/media/' . $imageName;

                ActivityMedia::create([
                    'activity_id' => $activityId,
                    'activity_media_url' => $mediaUrl,
                    'activity_media_is_thumbnail' => false,
                ]);
            }
            return redirect()->route('admin.activities.media.index', $activityId)
                ->with('success', 'Foto galeri berhasil diunggah.');
        }

        return redirect()->route('admin.activities.media.index', $activityId)
            ->with('error', 'Gagal mengunggah foto.');
    }

    /**
     * Update the specified resource (Set as Thumbnail)
     */
    public function update(Request $request, $activityId, $mediaId)
    {
        $activity = Activity::findOrFail($activityId);
        $media = ActivityMedia::where('activity_id', $activityId)->findOrFail($mediaId);

        // Update the main activity image with this media's URL
        $activity->update([
            'activity_image' => $media->activity_media_url
        ]);

        return redirect()->route('admin.activities.media.index', $activityId)
            ->with('success', 'Gambar sampul utama berhasil diperbarui dari galeri.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($activityId, $mediaId)
    {
        $media = ActivityMedia::where('activity_id', $activityId)->findOrFail($mediaId);

        if ($media->activity_media_url && file_exists(public_path($media->activity_media_url))) {
            unlink(public_path($media->activity_media_url));
        }

        $media->delete();

        return redirect()->route('admin.activities.media.index', $activityId)
            ->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}
