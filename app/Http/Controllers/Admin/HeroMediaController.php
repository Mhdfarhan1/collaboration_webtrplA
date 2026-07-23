<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroMediaController extends Controller
{
    public function index()
    {
        $heroMedias = HeroMedia::latest('created_at')->paginate(10);
        return view('admin.heromedia.index', compact('heroMedias'));
    }

    public function create()
    {
        return view('admin.heromedia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = $request->file('image_file')->store('hero-media', 'public');

        HeroMedia::create([
            'hero_title' => $request->hero_title,
            'image_url' => 'storage/' . $imagePath,
        ]);

        return redirect()->route('admin.heromedia.index')->with('success', 'Hero Media created successfully.');
    }

    public function edit(HeroMedia $heromedia) // Route model binding uses singular typical name, but let's just make it $id for simplicity or explicitly match the route
    {
        return view('admin.heromedia.edit', compact('heromedia'));
    }

    public function update(Request $request, HeroMedia $heromedia)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = ['hero_title' => $request->hero_title];

        if ($request->hasFile('image_file')) {
            // Delete old image if exists
            $oldPath = str_replace('storage/', '', $heromedia->image_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            // Store new
            $imagePath = $request->file('image_file')->store('hero-media', 'public');
            $data['image_url'] = 'storage/' . $imagePath;
        }

        $heromedia->update($data);

        return redirect()->route('admin.heromedia.index')->with('success', 'Hero Media updated successfully.');
    }

    public function destroy(HeroMedia $heromedia)
    {
        // Delete image file
        $oldPath = str_replace('storage/', '', $heromedia->image_url);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        $heromedia->delete();

        return redirect()->route('admin.heromedia.index')->with('success', 'Hero Media deleted successfully.');
    }
}
