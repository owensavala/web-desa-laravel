<?php

namespace App\Http\Controllers;

use App\Models\DokumenLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $query = DokumenLayanan::orderBy('id', 'desc');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $dokumenList = $query->paginate(10)->withQueryString();
        $kategoriList = DokumenLayanan::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('frontend.layanan', compact('dokumenList', 'kategoriList', 'kategori'));
    }

    public function download($id)
    {
        $dokumen = DokumenLayanan::findOrFail($id);
        
        $filePathPublic = public_path('dokumen/' . $dokumen->nama_file);
        $filePathStorage = storage_path('app/public/dokumen/' . $dokumen->nama_file);

        if (file_exists($filePathPublic)) {
            return response()->download($filePathPublic, $dokumen->nama_dokumen . '.' . pathinfo($dokumen->nama_file, PATHINFO_EXTENSION));
        } elseif (file_exists($filePathStorage)) {
            return response()->download($filePathStorage, $dokumen->nama_dokumen . '.' . pathinfo($dokumen->nama_file, PATHINFO_EXTENSION));
        }

        return redirect()->back()->with('error', 'Berkas dokumen tidak ditemukan di server.');
    }
}
