<?php

namespace App\Http\Controllers;

use App\Models\DokumenLayanan;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'pengajuan'); // 'pengajuan', 'lacak', 'unduh'
        $kategori = $request->query('kategori');

        // Data Dokumen Blanko
        $queryDoc = DokumenLayanan::orderBy('id', 'desc');
        if ($kategori) {
            $queryDoc->where('kategori', $kategori);
        }
        $dokumenList = $queryDoc->paginate(8)->withQueryString();
        $kategoriList = DokumenLayanan::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        // Pencarian Lacak Permohonan
        $searchTrack = trim($request->query('kode_tracking', ''));
        $trackResults = null;
        if (!empty($searchTrack)) {
            $trackResults = PermohonanSurat::where('kode_tracking', $searchTrack)
                ->orWhere('nik', $searchTrack)
                ->orderBy('created_at', 'desc')
                ->get();
            $tab = 'lacak';
        }

        return view('frontend.layanan', compact('dokumenList', 'kategoriList', 'kategori', 'tab', 'searchTrack', 'trackResults'));
    }

    public function storePermohonan(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16',
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:300',
            'dusun' => 'nullable|string|max:100',
            'rt_rw' => 'nullable|string|max:30',
            'no_wa' => 'required|string|max:25',
            'jenis_surat' => 'required|string|max:120',
            'keperluan' => 'required|string|max:500',
            'catatan_pemohon' => 'nullable|string|max:500',
        ], [
            'nik.required' => 'Nomor Induk Kependudukan (NIK) wajib diisi.',
            'nik.digits' => 'NIK harus berjumlah 16 digit angka.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi agar petugas dapat menghubungi Anda.',
            'jenis_surat.required' => 'Pilih jenis surat yang diajukan.',
            'keperluan.required' => 'Tuliskan maksud atau keperluan surat ini.',
        ]);

        // Generate unique tracking code: SRT-TAHUN-4_HURUF_ANGKA
        do {
            $kode = 'SRT-' . date('Y') . '-' . strtoupper(Str::random(5));
        } while (PermohonanSurat::where('kode_tracking', $kode)->exists());

        $permohonan = PermohonanSurat::create([
            'kode_tracking' => $kode,
            'nik' => $validated['nik'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'pekerjaan' => $validated['pekerjaan'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'dusun' => $validated['dusun'] ?? null,
            'rt_rw' => $validated['rt_rw'] ?? null,
            'no_wa' => $validated['no_wa'],
            'jenis_surat' => $validated['jenis_surat'],
            'keperluan' => $validated['keperluan'],
            'catatan_pemohon' => $validated['catatan_pemohon'] ?? null,
            'status' => 'menunggu',
        ]);

        return redirect()->route('layanan.index', ['tab' => 'lacak', 'kode_tracking' => $kode])
            ->with('permohonan_success', [
                'kode' => $kode,
                'nama' => $permohonan->nama_lengkap,
                'jenis_surat' => $permohonan->jenis_surat,
            ]);
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
