<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = ClassLogo::latest()->get();
        return view('admin.class_logos.index', compact('logos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo_url' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        if ($request->hasFile('logo_url')) {
            $image = $request->file('logo_url');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('storage/class_logos'), $imageName);
            $logoUrl = 'storage/class_logos/' . $imageName;

            ClassLogo::create([
                'logo_url' => $logoUrl,
            ]);

            return back()->with('success', 'Logo berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah logo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassLogo $logo)
    {
        if ($logo->logo_url && file_exists(public_path($logo->logo_url))) {
            unlink(public_path($logo->logo_url));
        }

        $logo->delete();

        return back()->with('success', 'Logo berhasil dihapus.');
    }
}
