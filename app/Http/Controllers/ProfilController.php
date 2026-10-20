<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use App\Models\Sotk;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        return view('frontend.profil', compact('profil'));
    }

    public function sotk()
    {
        $profil = ProfilDesa::first();
        $aparatur = Sotk::orderBy('urutan', 'asc')->get();
        return view('frontend.sotk', compact('profil', 'aparatur'));
    }
}
