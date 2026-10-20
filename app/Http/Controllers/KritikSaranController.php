<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function index()
    {
        $aspirasiList = KritikSaran::orderBy('tanggal_kirim', 'desc')->take(10)->get();
        return view('frontend.kritik_saran', compact('aspirasiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'komentar' => 'required|string|min:5|max:2000',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'komentar.required' => 'Pesan atau saran wajib diisi.',
            'komentar.min' => 'Pesan minimal 5 karakter.',
        ]);

        KritikSaran::create([
            'nama' => strip_tags($request->input('nama')),
            'komentar' => strip_tags($request->input('komentar')),
            'tanggal_kirim' => now(),
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Aspirasi / saran Anda telah berhasil dikirimkan ke Pemerintah Desa.');
    }
}
