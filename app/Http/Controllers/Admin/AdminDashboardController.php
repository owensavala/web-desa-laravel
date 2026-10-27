<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ApbdesDetail;
use App\Models\ApbdesSummary;
use App\Models\Berita;
use App\Models\Demografi;
use App\Models\DokumenLayanan;
use App\Models\FooterSetting;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\Pengumuman;
use App\Models\PermohonanSurat;
use App\Models\ProfilDesa;
use App\Models\Slider;
use App\Models\Sotk;
use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_berita' => Berita::count(),
            'total_penduduk' => Demografi::value('total_penduduk') ?? 0,
            'total_dokumen' => DokumenLayanan::count(),
            'total_saran' => KritikSaran::count(),
            'saran_baru' => KritikSaran::where('status', 'baru')->count(),
            'total_foto' => GaleriFoto::count(),
            'total_aparatur' => Sotk::count(),
            'total_permohonan' => PermohonanSurat::count(),
            'permohonan_menunggu' => PermohonanSurat::where('status', 'menunggu')->count(),
        ];

        $beritaTerbaru = Berita::orderBy('id', 'desc')->take(5)->get();
        $saranTerbaru = KritikSaran::orderBy('id', 'desc')->take(5)->get();
        $permohonanTerbaru = PermohonanSurat::orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'beritaTerbaru', 'saranTerbaru', 'permohonanTerbaru'));
    }

    // ================= BERITA =================
    public function berita()
    {
        $beritas = Berita::orderBy('id', 'desc')->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function beritaCreate()
    {
        return view('admin.berita.create');
    }

    public function beritaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('images'), $namaGambar);
            @copy(public_path('images/' . $namaGambar), storage_path('app/public/images/' . $namaGambar));
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'isi' => $request->isi,
            'gambar' => $namaGambar,
            'tanggal_posting' => now(),
            'views' => 0,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('images'), $namaGambar);
            @copy(public_path('images/' . $namaGambar), storage_path('app/public/images/' . $namaGambar));
            $data['gambar'] = $namaGambar;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && file_exists(public_path('images/' . $berita->gambar))) {
            @unlink(public_path('images/' . $berita->gambar));
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    // ================= SLIDER =================
    public function slider()
    {
        $sliders = Slider::orderBy('urutan', 'asc')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
            'judul' => 'nullable|string|max:255',
            'subjudul' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $file = $request->file('gambar');
        $namaGambar = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->move(public_path('images'), $namaGambar);
        @copy(public_path('images/' . $namaGambar), storage_path('app/public/images/' . $namaGambar));

        Slider::create([
            'gambar' => $namaGambar,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'urutan' => $request->urutan ?? (Slider::max('urutan') + 1),
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider banner berhasil ditambahkan.');
    }

    public function sliderDestroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->gambar && file_exists(public_path('images/' . $slider->gambar))) {
            @unlink(public_path('images/' . $slider->gambar));
        }
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider banner berhasil dihapus.');
    }

    // ================= SOTK =================
    public function sotk()
    {
        $aparatur = Sotk::orderBy('urutan', 'asc')->get();
        return view('admin.sotk.index', compact('aparatur'));
    }

    public function sotkStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('images'), $namaFoto);
            @copy(public_path('images/' . $namaFoto), storage_path('app/public/images/' . $namaFoto));
        }

        Sotk::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $namaFoto,
            'urutan' => $request->urutan ?? (Sotk::max('urutan') + 1),
        ]);

        return redirect()->route('admin.sotk.index')->with('success', 'Aparatur desa berhasil ditambahkan.');
    }

    public function sotkDestroy($id)
    {
        $item = Sotk::findOrFail($id);
        if ($item->foto && file_exists(public_path('images/' . $item->foto))) {
            @unlink(public_path('images/' . $item->foto));
        }
        $item->delete();
        return redirect()->route('admin.sotk.index')->with('success', 'Data aparatur berhasil dihapus.');
    }

    // ================= PENGUMUMAN =================
    public function pengumuman()
    {
        $pengumumans = Pengumuman::orderBy('id', 'desc')->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function pengumumanStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Pengumuman::create($request->only('judul', 'tanggal_mulai', 'tanggal_selesai', 'status'));
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil disimpan.');
    }

    public function pengumumanDestroy($id)
    {
        Pengumuman::findOrFail($id)->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    // ================= APBDES =================
    public function apbdes()
    {
        $summaries = ApbdesSummary::with('details')->orderBy('tahun', 'desc')->get();
        return view('admin.apbdes.index', compact('summaries'));
    }

    public function apbdesStoreSummary(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'total_pendapatan' => 'required|numeric',
            'total_belanja' => 'required|numeric',
            'pendapatan_pad' => 'nullable|numeric',
            'pendapatan_transfer' => 'nullable|numeric',
            'pendapatan_lain' => 'nullable|numeric',
        ]);

        ApbdesSummary::updateOrCreate(
            ['tahun' => $request->tahun],
            $request->all()
        );

        return redirect()->route('admin.apbdes.index')->with('success', 'Summary APBDes berhasil disimpan.');
    }

    public function apbdesStoreDetail(Request $request)
    {
        $request->validate([
            'id_summary' => 'required|exists:apbdes_summary,id',
            'bidang' => 'required|string',
            'kegiatan' => 'required|string',
            'anggaran' => 'required|numeric',
        ]);

        ApbdesDetail::create($request->all());
        return redirect()->route('admin.apbdes.index')->with('success', 'Rincian kegiatan APBDes berhasil ditambahkan.');
    }

    public function apbdesDestroyDetail($id)
    {
        ApbdesDetail::findOrFail($id)->delete();
        return redirect()->route('admin.apbdes.index')->with('success', 'Rincian kegiatan APBDes berhasil dihapus.');
    }

    // ================= DEMOGRAFI =================
    public function demografi()
    {
        $demografi = Demografi::first() ?? new Demografi();
        return view('admin.demografi.index', compact('demografi'));
    }

    public function demografiUpdate(Request $request)
    {
        $demografi = Demografi::first();
        if (!$demografi) {
            $demografi = new Demografi();
        }

        $demografi->fill($request->all());
        $demografi->save();

        return redirect()->route('admin.demografi.index')->with('success', 'Data kependudukan demografi berhasil diperbarui.');
    }

    // ================= PROFIL DESA =================
    public function profil()
    {
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        return view('admin.profil.index', compact('profil'));
    }

    public function profilUpdate(Request $request)
    {
        $profil = ProfilDesa::first();
        if (!$profil) {
            $profil = new ProfilDesa();
        }

        $data = $request->except(['sambutan_foto', 'gambar_bagan1', 'gambar_bagan2']);

        if ($request->hasFile('sambutan_foto')) {
            $file = $request->file('sambutan_foto');
            $nama = time() . '_kades.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $nama);
            $data['sambutan_foto'] = $nama;
        }

        if ($request->hasFile('gambar_bagan1')) {
            $file = $request->file('gambar_bagan1');
            $nama = time() . '_bagan1.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $nama);
            $data['gambar_bagan1'] = $nama;
        }

        if ($request->hasFile('gambar_bagan2')) {
            $file = $request->file('gambar_bagan2');
            $nama = time() . '_bagan2.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $nama);
            $data['gambar_bagan2'] = $nama;
        }

        $profil->fill($data);
        $profil->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil Desa berhasil diperbarui.');
    }

    // ================= GALERI =================
    public function galeri()
    {
        $fotos = GaleriFoto::orderBy('id', 'desc')->paginate(12);
        $videos = GaleriVideo::orderBy('id', 'desc')->paginate(6);
        return view('admin.galeri.index', compact('fotos', 'videos'));
    }

    public function fotoStore(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'keterangan' => 'nullable|string',
        ]);

        $file = $request->file('foto');
        $nama = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->move(public_path('images'), $nama);
        @copy(public_path('images/' . $nama), storage_path('app/public/images/' . $nama));

        GaleriFoto::create([
            'nama_file' => $nama,
            'keterangan' => $request->keterangan,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diunggah.');
    }

    public function fotoDestroy($id)
    {
        $item = GaleriFoto::findOrFail($id);
        if ($item->nama_file && file_exists(public_path('images/' . $item->nama_file))) {
            @unlink(public_path('images/' . $item->nama_file));
        }
        $item->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function videoStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link_video' => 'required|string',
        ]);

        GaleriVideo::create([
            'judul' => $request->judul,
            'link_video' => $request->link_video,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function videoDestroy($id)
    {
        GaleriVideo::findOrFail($id)->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Video berhasil dihapus.');
    }

    // ================= DOKUMEN LAYANAN =================
    public function layanan()
    {
        $dokumens = DokumenLayanan::orderBy('id', 'desc')->paginate(10);
        return view('admin.layanan.index', compact('dokumens'));
    }

    public function layananStore(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $file = $request->file('file_dokumen');
        $nama = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
        $file->move(public_path('dokumen'), $nama);
        @copy(public_path('dokumen/' . $nama), storage_path('app/public/dokumen/' . $nama));

        DokumenLayanan::create([
            'nama_dokumen' => $request->nama_dokumen,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'nama_file' => $nama,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Dokumen layanan berhasil ditambahkan.');
    }

    public function layananDestroy($id)
    {
        $item = DokumenLayanan::findOrFail($id);
        if ($item->nama_file && file_exists(public_path('dokumen/' . $item->nama_file))) {
            @unlink(public_path('dokumen/' . $item->nama_file));
        }
        $item->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Dokumen layanan berhasil dihapus.');
    }

    // ================= KRITIK & SARAN =================
    public function saran()
    {
        $sarans = KritikSaran::orderBy('id', 'desc')->paginate(15);
        return view('admin.saran.index', compact('sarans'));
    }

    public function saranUpdateStatus($id)
    {
        $item = KritikSaran::findOrFail($id);
        $item->status = ($item->status === 'baru') ? 'dibaca' : 'baru';
        $item->save();
        return redirect()->route('admin.saran.index')->with('success', 'Status saran berhasil diperbarui.');
    }

    public function saranDestroy($id)
    {
        KritikSaran::findOrFail($id)->delete();
        return redirect()->route('admin.saran.index')->with('success', 'Pesan kritik & saran telah dihapus.');
    }

    // ================= FOOTER & KONTAK =================
    public function footer()
    {
        $footer = FooterSetting::first() ?? new FooterSetting();
        return view('admin.footer.index', compact('footer'));
    }

    public function footerUpdate(Request $request)
    {
        $footer = FooterSetting::first();
        if (!$footer) {
            $footer = new FooterSetting();
        }

        $data = $request->except(['logo_desa']);

        if ($request->hasFile('logo_desa')) {
            $file = $request->file('logo_desa');
            $namaLogo = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $namaLogo);
            @copy(public_path('images/' . $namaLogo), storage_path('app/public/images/' . $namaLogo));
            $data['logo_desa'] = $namaLogo;
        }

        $footer->fill($data);
        $footer->save();

        return redirect()->route('admin.footer.index')->with('success', 'Identitas desa, logo, dan tema warna berhasil disimpan.');
    }

    // ================= MANAJEMEN ADMIN =================
    public function adminList()
    {
        $admins = Admin::all();
        return view('admin.pengguna.index', compact('admins'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:admins,username',
            'nama' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Administrator baru berhasil ditambahkan.');
    }

    public function adminDestroy($id)
    {
        if (Admin::count() <= 1) {
            return redirect()->route('admin.pengguna.index')->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        Admin::where('id_admin', $id)->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Administrator berhasil dihapus.');
    }

    // ================= PERMOHONAN SURAT ONLINE =================
    public function permohonanIndex(Request $request)
    {
        $status = $request->query('status');
        $query = PermohonanSurat::orderBy('id', 'desc');

        if ($status && in_array($status, ['menunggu', 'diproses', 'selesai', 'ditolak'])) {
            $query->where('status', $status);
        }

        $permohonanList = $query->paginate(15)->withQueryString();
        $counts = [
            'all' => PermohonanSurat::count(),
            'menunggu' => PermohonanSurat::where('status', 'menunggu')->count(),
            'diproses' => PermohonanSurat::where('status', 'diproses')->count(),
            'selesai' => PermohonanSurat::where('status', 'selesai')->count(),
            'ditolak' => PermohonanSurat::where('status', 'ditolak')->count(),
        ];

        return view('admin.layanan.permohonan', compact('permohonanList', 'counts', 'status'));
    }

    public function permohonanUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan_petugas' => 'nullable|string|max:500',
        ]);

        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->status = $request->status;
        $permohonan->catatan_petugas = $request->catatan_petugas;
        if ($request->status === 'selesai' && !$permohonan->tanggal_selesai) {
            $permohonan->tanggal_selesai = now();
        }
        $permohonan->save();

        return redirect()->back()->with('success', "Status permohonan {$permohonan->kode_tracking} berhasil diperbarui.");
    }

    public function permohonanDestroy($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->delete();

        return redirect()->back()->with('success', 'Data permohonan surat berhasil dihapus.');
    }
}
