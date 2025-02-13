<?php

namespace App\Http\Controllers;

use App\Models\Ucapan;
use Illuminate\Http\Request;

class UcapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ucapan = Ucapan::all();
        return view('admin.time.index', compact('ucapan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'text' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i', // Format jam:menit
            'waktu_end' => 'required|date_format:H:i|after:waktu', // Pastikan lebih besar dari waktu
        ]);

        // Debugging: Cek request sebelum disimpan
        // dd($request->all());

        // Simpan ke database
        Ucapan::create([
            'text' => $request->text,
            'waktu' => $request->waktu . ":00", // Format jam:menit:detik
            'waktu_end' => $request->waktu_end . ":00", // Format jam:menit:detik
        ]);

        return redirect()->route('ucapan.index')->with('success', 'Ucapan berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Ucapan $ucapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ucapan = Ucapan::findorfail($id);

        return view("admin.time.edit", compact('ucapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'text' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i', // Format jam:menit
            'waktu_end' => 'required|date_format:H:i|after:waktu', // Pastikan lebih besar dari waktu
        ]);

        // Cari data ucapan berdasarkan ID
        $ucapan = Ucapan::findOrFail($id);

        // Update data
        $ucapan->update([
            'text' => $request->text,
            'waktu' => $request->waktu . ":00", // Format jam:menit:detik
            'waktu_end' => $request->waktu_end . ":00", // Format jam:menit:detik
        ]);

        return redirect()->route('ucapan.index')->with('success', 'Ucapan berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ucapan = Ucapan::findOrFail($id);
        $ucapan->delete();

        return redirect()->route('ucapan.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}
