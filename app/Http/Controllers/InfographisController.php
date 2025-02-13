<?php

namespace App\Http\Controllers;

use App\Models\Infographis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfographisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infographis = Infographis::all();
        return view('admin.infographis.index', compact('infographis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.infographis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10048|prohibited_if:video,!null',
            'image_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:10048|required_with:image',
            'video' => 'nullable|url|prohibited_if:image,!null',
            'show' => 'boolean'
        ], [
            'image.prohibited_if' => 'Anda tidak dapat mengisi gambar jika sudah mengisi video.',
            'video.prohibited_if' => 'Anda tidak dapat mengisi video jika sudah mengisi gambar.',
            'image_thumbnail.required_with' => 'Thumbnail hanya bisa diisi jika gambar utama diisi.',
        ]);

        if ($request->hasFile('image') && $request->input('video')) {
            return back()->withErrors(['image' => 'Anda tidak bisa mengisi gambar dan video sekaligus.'])->withInput();
        }

        $infographis = new Infographis();
        $infographis->title = $request->title;
        $infographis->deskripsi = $request->deskripsi;
        $infographis->show = $request->input('show') == "1" ? true : false; // Default false, jika dicentang jadi true

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('infographis', 'public');
            $infographis->image = $path;

            if ($request->hasFile('image_thumbnail')) {
                $thumbnailPath = $request->file('image_thumbnail')->store('infographis/thumbnails', 'public');
                $infographis->image_thumbnail = $thumbnailPath;
            }
        } elseif ($request->video) {
            $infographis->video = $request->video;
        }

        $infographis->save();

        return redirect()->route('infographis.index')->with('success', 'Infografis berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Infographis $infographis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $infographis = Infographis::findorfail($id);

        return view("admin.infographis.edit", compact('infographis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infographis $infographis)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
            'image_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
            'video' => 'nullable|url|max:255',
            'show' => 'in:0,1' // Pastikan hanya menerima 0 atau 1
        ]);

        $data = $request->only(['title', 'deskripsi']);

        // Fix: Pastikan nilai show benar-benar boolean 0 atau 1
        $data['show'] = (bool) $request->input('show', 0);

        // Jika pengguna mengunggah gambar baru
        if ($request->hasFile('image')) {
            if ($infographis->image) {
                Storage::disk('public')->delete($infographis->image);
            }
            $data['image'] = $request->file('image')->store('images/infographis', 'public');
            $data['video'] = null;
        } elseif (!$request->hasFile('image') && !$request->filled('video')) {
            unset($data['image'], $data['video']);
        } elseif ($request->filled('video')) {
            if ($infographis->image) {
                Storage::disk('public')->delete($infographis->image);
            }
            $data['video'] = $request->video;
            $data['image'] = null;
        }

        $infographis->update($data);

        return redirect()->route('infographis.index')->with('success', 'Infografis berhasil diperbarui!');
    }








    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $infographis = Infographis::findOrFail($id);
        $infographis->delete();

        return redirect()->route('infographis.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}
