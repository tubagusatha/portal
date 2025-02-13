<?php

namespace App\Http\Controllers;

use App\Models\bgfront;
use App\Models\Infographis;
use App\Models\Portal;
use App\Models\Ucapan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $portals = Portal::all();

        // Ambil hanya infografis yang show = true dan urutkan dari yang terbaru, ambil max 10
        $infographis = Infographis::where('show', true)
            ->latest()
            ->take(10)
            ->get();

        $infographises = Infographis::all();

        // Ambil data terakhir dari tabel bgfronts
        $bg = bgfront::latest()->first();

        $count = $infographis->count();
        for ($i = $count; $i < 10; $i++) {
            $infographis->push((object) [
                'image' => null,
                'image_thumbnail' => null,
                'title' => 'Tidak ada data',
                'video' => null,
                'deskripsi' => 'Belum tersedia',
            ]);
        }
        // Ambil ucapan yang waktunya sesuai dengan waktu sekarang
        $current_time = now()->format('H:i:s');

        $ucapan = Ucapan::whereTime('waktu', '<=', $current_time)
            ->whereTime('waktu_end', '>=', $current_time)
            ->first();

        // Debugging - Cek apakah data ditemukan
        \Log::info("Current Time: " . $current_time);
        \Log::info("Ucapan Aktif: ", [$ucapan]);

        return view('welcome', compact('portals', 'infographis', 'infographises', 'bg', 'ucapan'));
    }

    public function portal()
    {
        $portals = Portal::all()->map(function ($portal) {
            $portal->bg_color = $this->randomDarkColor();
            return $portal;
        });

        return view('portal', compact('portals'));
    }

    private function randomDarkColor()
    {
        $r = rand(50, 100);  // Abu-abu (merah tidak terlalu tinggi)
        $g = rand(80, 150);  // Hijau agak tinggi
        $b = rand(100, 180); // Biru lebih dominan
        return "rgb($r, $g, $b)";
    }




    public function admin()
    {
        return view('admin.dashboard');
    }
}
