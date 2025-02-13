<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portal = Portal::all();
        return view('admin.portal.index', compact('portal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'portal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('portal_image')) {
            $imagePath = $request->file('portal_image')->store('portals', 'public');
        }

        Portal::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'portal_image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('portal.index')->with('success', 'Data Portal berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Portal $portal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portal = Portal::findorfail($id);
        return  view('admin.portal.edit', compact('portal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portal $portal)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'portal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string|max:255',
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('portal_image')) {
            if ($portal->portal_image) {
                Storage::disk('public')->delete($portal->portal_image);
            }
            $portal->portal_image = $request->file('portal_image')->store('portals', 'public');
        }

        // Update data portal
        $portal->title = $request->title;
        $portal->deskripsi = $request->deskripsi;
        $portal->link = $request->link;
        $portal->save(); // Simpan perubahan

        return redirect()->route('portal.index')->with('success', 'Data Portal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portal = Portal::findOrFail($id);
        $portal->delete();

        return redirect()->route('portal.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}
