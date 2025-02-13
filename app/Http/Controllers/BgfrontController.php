<?php

namespace App\Http\Controllers;

use App\Models\bgfront;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BgfrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bg = bgfront::all();
        return view('admin.bg.index', compact('bg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bg.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image_bg' => 'required|image|mimes:jpg,jpeg,png|max:4048',
            'image_bgres' => 'required|image|mimes:jpg,jpeg,png|max:4048', // Tambahan validasi
        ], [
            'image_bg.required' => 'Gambar background wajib diunggah.',
            'image_bg.image' => 'File harus berupa gambar.',
            'image_bg.mimes' => 'Format gambar yang diperbolehkan: jpg, jpeg, png.',
            'image_bg.max' => 'Ukuran gambar maksimal 2MB.',
            'image_bgres.required' => 'Gambar background resolusi lain wajib diunggah.',
            'image_bgres.image' => 'File harus berupa gambar.',
            'image_bgres.mimes' => 'Format gambar yang diperbolehkan: jpg, jpeg, png.',
            'image_bgres.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Simpan gambar ke storage
        $path_bg = $request->file('image_bg')->store('bgfronts', 'public');
        $path_bgres = $request->file('image_bgres')->store('bgfronts', 'public'); // Simpan image_bgres

        // Simpan data ke database
        $bgfront = new Bgfront();
        $bgfront->image_bg = $path_bg;
        $bgfront->image_bgres = $path_bgres; // Simpan image_bgres ke database
        $bgfront->save();

        return redirect()->route('bg.index')->with('success', 'Background berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(bgfront $bgfront)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bgfront = Bgfront::findOrFail($id);
        return view('admin.bg.edit', compact('bgfront'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'image_bg' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            'image_bgres' => 'nullable|image|mimes:jpg,jpeg,png|max:4048', // Tambahan validasi
        ], [
            'image_bg.image' => 'File harus berupa gambar.',
            'image_bg.mimes' => 'Format gambar yang diperbolehkan: jpg, jpeg, png.',
            'image_bg.max' => 'Ukuran gambar maksimal 2MB.',
            'image_bgres.image' => 'File harus berupa gambar.',
            'image_bgres.mimes' => 'Format gambar yang diperbolehkan: jpg, jpeg, png.',
            'image_bgres.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $bgfront = Bgfront::findOrFail($id);

        // Update image_bg jika ada file baru
        if ($request->hasFile('image_bg')) {
            // Hapus gambar lama
            if ($bgfront->image_bg) {
                Storage::disk('public')->delete($bgfront->image_bg);
            }

            // Simpan gambar baru
            $path_bg = $request->file('image_bg')->store('bgfronts', 'public');
            $bgfront->image_bg = $path_bg;
        }

        // Update image_bgres jika ada file baru
        if ($request->hasFile('image_bgres')) {
            // Hapus gambar lama
            if ($bgfront->image_bgres) {
                Storage::disk('public')->delete($bgfront->image_bgres);
            }

            // Simpan gambar baru
            $path_bgres = $request->file('image_bgres')->store('bgfronts', 'public');
            $bgfront->image_bgres = $path_bgres;
        }

        $bgfront->save();

        return redirect()->route('bg.index')->with('success', 'Background berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bg = bgfront::findOrFail($id);
        $bg->delete();

        return redirect()->route('bg.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}
