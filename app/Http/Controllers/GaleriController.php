<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function foto()
    {
        $fotos = GaleriFoto::orderBy('id', 'desc')->paginate(12);
        return view('frontend.galeri.foto', compact('fotos'));
    }

    public function video()
    {
        $videos = GaleriVideo::orderBy('id', 'desc')->paginate(9);
        return view('frontend.galeri.video', compact('videos'));
    }
}
