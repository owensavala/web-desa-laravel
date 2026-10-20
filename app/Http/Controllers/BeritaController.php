<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $query = Berita::orderBy('tanggal_posting', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $beritaList = $query->paginate(6)->withQueryString();
        $beritaPopuler = Berita::orderBy('views', 'desc')->take(5)->get();

        return view('frontend.berita.index', compact('beritaList', 'search', 'beritaPopuler'));
    }

    public function detail($slugOrId)
    {
        $berita = Berita::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        // Increment view count
        $berita->increment('views');

        $beritaTerkait = Berita::where('id', '!=', $berita->id)
            ->orderBy('tanggal_posting', 'desc')
            ->take(4)
            ->get();

        return view('frontend.berita.detail', compact('berita', 'beritaTerkait'));
    }
}
