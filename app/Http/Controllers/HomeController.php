<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\ProfilDesa;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Demografi;
use App\Models\ApbdesSummary;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('urutan', 'asc')->get();
        $profil = ProfilDesa::first();
        $beritaTerbaru = Berita::orderBy('tanggal_posting', 'desc')->take(3)->get();
        
        $today = now()->toDateString();
        $pengumuman = Pengumuman::where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->orderBy('id', 'desc')
            ->get();

        $demografi = Demografi::first();
        $apbdes = ApbdesSummary::orderBy('tahun', 'desc')->first();
        $galeriFoto = GaleriFoto::orderBy('id', 'desc')->take(6)->get();

        return view('frontend.home', compact(
            'sliders',
            'profil',
            'beritaTerbaru',
            'pengumuman',
            'demografi',
            'apbdes',
            'galeriFoto'
        ));
    }
}
