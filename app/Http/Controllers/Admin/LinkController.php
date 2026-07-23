<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::latest()->paginate(10);
        return view('admin.links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'link_url' => 'required|url|max:255',
            'link_type' => 'required|in:notion,instagram,schedule',
        ], [
            'link_url.required' => 'URL tautan wajib diisi.',
            'link_url.url' => 'Format URL tidak valid.',
            'link_url.max' => 'URL maksimal 255 karakter.',
            'link_type.required' => 'Tipe tautan wajib dipilih.',
            'link_type.in' => 'Tipe tautan tidak valid.',
        ]);

        Link::create($validated);

        return redirect()->route('admin.links.index')
            ->with('success', 'Tautan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $link = Link::findOrFail($id);
        return view('admin.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::findOrFail($id);

        $validated = $request->validate([
            'link_url' => 'required|url|max:255',
            'link_type' => 'required|in:notion,instagram,schedule',
        ], [
            'link_url.required' => 'URL tautan wajib diisi.',
            'link_url.url' => 'Format URL tidak valid.',
            'link_url.max' => 'URL maksimal 255 karakter.',
            'link_type.required' => 'Tipe tautan wajib dipilih.',
            'link_type.in' => 'Tipe tautan tidak valid.',
        ]);

        $link->update($validated);

        return redirect()->route('admin.links.index')
            ->with('success', 'Tautan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.links.index')
            ->with('success', 'Tautan berhasil dihapus.');
    }
}
