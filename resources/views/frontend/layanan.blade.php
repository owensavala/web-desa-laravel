@extends('layouts.app')

@section('title', 'Layanan Mandiri & Permohonan Surat Online - ' . ($globalFooter->nama_desa ?? 'Desa Kupal'))

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-14 lg:py-18 relative overflow-hidden">
    <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-700/50 text-emerald-200 font-bold text-xs uppercase tracking-wider mb-3 border border-emerald-600/40">
            <i class="fa-solid fa-bolt-lightning text-amber-300"></i> Pelayanan Publik Digital Desa
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
            Layanan Mandiri & E-Surat Warga
        </h1>
        <p class="text-emerald-100/90 text-sm sm:text-base mt-3 max-w-2xl leading-relaxed">
            Ajukan permohonan surat keterangan secara online dari rumah, lacak proses penyelesaian berkas secara transparan, atau unduh blanko persyaratan resmi Pemerintah {{ $globalFooter->nama_desa ?? 'Desa Kupal' }}.
        </p>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-8">
            <a href="{{ route('layanan.index', ['tab' => 'pengajuan']) }}" class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all {{ ($tab ?? 'pengajuan') === 'pengajuan' ? 'bg-white text-emerald-900 shadow-lg scale-105' : 'bg-emerald-800/80 hover:bg-emerald-700 text-emerald-100 border border-emerald-700' }}">
                <i class="fa-solid fa-file-signature text-emerald-600"></i> Buat Pengajuan Surat
            </a>
            <a href="{{ route('layanan.index', ['tab' => 'lacak']) }}" class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all {{ ($tab ?? 'pengajuan') === 'lacak' ? 'bg-white text-emerald-900 shadow-lg scale-105' : 'bg-emerald-800/80 hover:bg-emerald-700 text-emerald-100 border border-emerald-700' }}">
                <i class="fa-solid fa-magnifying-glass text-emerald-600"></i> Lacak Status Surat
            </a>
            <a href="{{ route('layanan.index', ['tab' => 'unduh']) }}" class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all {{ ($tab ?? 'pengajuan') === 'unduh' ? 'bg-white text-emerald-900 shadow-lg scale-105' : 'bg-emerald-800/80 hover:bg-emerald-700 text-emerald-100 border border-emerald-700' }}">
                <i class="fa-solid fa-folder-open text-emerald-600"></i> Unduh Blanko Dokumen
            </a>
        </div>
    </div>
</section>

<section class="py-12 bg-slate-50 min-h-[600px]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- FLASH SUCCESS TRACKING --}}
        @if(session('permohonan_success'))
            @php $ps = session('permohonan_success'); @endphp
            <div class="mb-10 bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-400 p-6 sm:p-8 rounded-3xl shadow-sm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 text-2xl shadow-md">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Permohonan Berhasil Dikirim!</span>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">Terima Kasih, {{ $ps['nama'] }}</h3>
                            <p class="text-sm text-slate-600 mt-1">Permohonan <strong>{{ $ps['jenis_surat'] }}</strong> telah masuk ke sistem antrean pelayanan kantor desa.</p>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto bg-white p-4 rounded-2xl border border-emerald-200 text-center shadow-sm shrink-0">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest block mb-1">KODE PELACAKAN ANDA</span>
                        <div class="text-xl sm:text-2xl font-mono font-extrabold text-emerald-700 tracking-wider flex items-center justify-center gap-2">
                            <span id="kode-token">{{ $ps['kode'] }}</span>
                            <button onclick="navigator.clipboard.writeText('{{ $ps['kode'] }}'); alert('Kode pelacakan berhasil disalin!');" title="Salin Kode" class="text-slate-400 hover:text-emerald-600 text-base">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                        <span class="text-[11px] text-slate-400 block mt-1">Simpan kode ini untuk mengecek status</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================= TAB 1: FORMULIR PENGAJUAN SURAT ================= --}}
        @if(($tab ?? 'pengajuan') === 'pengajuan')
        <div class="max-w-4xl mx-auto">
            
            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm mb-8">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-5 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Formulir Pengajuan Surat Online</h2>
                        <p class="text-xs sm:text-sm text-slate-500">Isi data identitas diri dan rincian permohonan surat keterangan dengan benar.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-sm">
                        <div class="font-bold mb-1 flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Mohon periksa kembali isian formulir:</div>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('layanan.permohonan.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Section 1: Data Pemohon -->
                    <div>
                        <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-id-card"></i> 1. Identitas Pemohon
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIK (Nomor Induk Kependudukan) <span class="text-rose-500">*</span></label>
                                <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required placeholder="Contoh: 820401xxxxxxxxxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm font-mono transition-all">
                                <span class="text-[11px] text-slate-400 mt-1 block">Wajib 16 digit angka sesuai KTP/KK</span>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap (Sesuai KTP) <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Nama lengkap Anda" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jenis Kelamin <span class="text-rose-500">*</span></label>
                                <select name="jenis_kelamin" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all bg-white">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp Aktif <span class="text-rose-500">*</span></label>
                                <input type="text" name="no_wa" value="{{ old('no_wa') }}" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm font-mono transition-all">
                                <span class="text-[11px] text-slate-400 mt-1 block">Petugas akan mengirimkan pemberitahuan ke nomor ini</span>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Kupal / Labuha" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Contoh: Petani / Nelayan / Wiraswasta" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Dusun / RT / RW</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="dusun" value="{{ old('dusun') }}" placeholder="Dusun (Opsional)" class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                                    <input type="text" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="RT 01 / RW 02" class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Domisili Lengkap</label>
                            <textarea name="alamat" rows="2" placeholder="Nama jalan, gang, atau patokan rumah di desa" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Section 2: Rincian Surat -->
                    <div class="pt-6 border-t border-slate-100">
                        <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-file-lines"></i> 2. Rincian Permohonan Surat
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jenis Surat yang Dimohonkan <span class="text-rose-500">*</span></label>
                                <select name="jenis_surat" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm font-medium transition-all bg-white">
                                    <option value="">-- Pilih Jenis Surat Keterangan --</option>
                                    <option value="Surat Keterangan Usaha (SKU)" {{ old('jenis_surat') == 'Surat Keterangan Usaha (SKU)' ? 'selected' : '' }}>Surat Keterangan Usaha (SKU)</option>
                                    <option value="Surat Keterangan Tidak Mampu (SKTM)" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu (SKTM)' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu (SKTM) - Beasiswa / Berobat</option>
                                    <option value="Surat Pengantar SKCK" {{ old('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>Surat Pengantar SKCK Kepolisian</option>
                                    <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili Warga / Lembaga</option>
                                    <option value="Surat Keterangan Kelahiran" {{ old('jenis_surat') == 'Surat Keterangan Kelahiran' ? 'selected' : '' }}>Surat Keterangan Kelahiran</option>
                                    <option value="Surat Keterangan Kematian" {{ old('jenis_surat') == 'Surat Keterangan Kematian' ? 'selected' : '' }}>Surat Keterangan Kematian</option>
                                    <option value="Surat Keterangan Belum Menikah" {{ old('jenis_surat') == 'Surat Keterangan Belum Menikah' ? 'selected' : '' }}>Surat Keterangan Belum Menikah</option>
                                    <option value="Surat Keterangan Penghasilan Orang Tua" {{ old('jenis_surat') == 'Surat Keterangan Penghasilan Orang Tua' ? 'selected' : '' }}>Surat Keterangan Penghasilan Orang Tua</option>
                                    <option value="Surat Keterangan Ahli Waris" {{ old('jenis_surat') == 'Surat Keterangan Ahli Waris' ? 'selected' : '' }}>Surat Keterangan Ahli Waris</option>
                                    <option value="Surat Rekomendasi Desa" {{ old('jenis_surat') == 'Surat Rekomendasi Desa' ? 'selected' : '' }}>Surat Rekomendasi Desa</option>
                                    <option value="Surat Keterangan Lainnya" {{ old('jenis_surat') == 'Surat Keterangan Lainnya' ? 'selected' : '' }}>Lainnya / Surat Keterangan Khusus</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Maksud / Keperluan Permohonan Surat <span class="text-rose-500">*</span></label>
                                <textarea name="keperluan" rows="3" required placeholder="Contoh: Untuk persyaratan pendaftaran beasiswa anak di perguruan tinggi / Persyaratan pengajuan pinjaman modal usaha di bank" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">{{ old('keperluan') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Tambahan (Opsional)</label>
                                <input type="text" name="catatan_pemohon" value="{{ old('catatan_pemohon') }}" placeholder="Catatan tambahan untuk petugas kantor desa (jika ada)" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i> Data Anda dijamin aman & kerahasiaannya dilindungi oleh Pemerintah Desa.
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan Surat
                        </button>
                    </div>

                </form>
            </div>

            <!-- Informasi Alur Pelayanan -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                <h3 class="text-base font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-arrows-split-up-and-left text-emerald-600"></i> Alur Pemrosesan Surat Digital Desa
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 font-extrabold flex items-center justify-center shrink-0 border border-emerald-200">1</div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Pengajuan Online</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Warga mengisi formulir online dan memperoleh kode unik pelacakan surat.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 font-extrabold flex items-center justify-center shrink-0 border border-emerald-200">2</div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Verifikasi & Cetak</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Perangkat desa memverifikasi berkas, mencetak format resmi, dan meminta tanda tangan Kepala Desa.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 font-extrabold flex items-center justify-center shrink-0 border border-emerald-200">3</div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Pengambilan Surat</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Warga menerima notifikasi via WhatsApp dan dapat mengambil surat fisik di Kantor Desa.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endif


        {{-- ================= TAB 2: LACAK STATUS PERMOHONAN ================= --}}
        @if(($tab ?? 'pengajuan') === 'lacak')
        <div class="max-w-3xl mx-auto">
            
            <!-- Box Pencarian -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm mb-8">
                <div class="text-center max-w-lg mx-auto mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mx-auto mb-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Lacak Status Surat Anda</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Masukkan <strong>Kode Tracking</strong> yang Anda peroleh saat pengajuan atau nomor <strong>NIK</strong> Anda.</p>
                </div>

                <form action="{{ route('layanan.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="hidden" name="tab" value="lacak">
                    <div class="relative flex-grow">
                        <i class="fa-solid fa-barcode text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="kode_tracking" value="{{ $searchTrack ?? '' }}" required placeholder="Contoh: SRT-2026-XXXX atau 16 digit NIK" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm font-mono uppercase transition-all">
                    </div>
                    <button type="submit" class="px-7 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-search"></i> Cek Berkas
                    </button>
                </form>
            </div>

            <!-- Hasil Pencarian -->
            @if(isset($trackResults))
                @if($trackResults->count() > 0)
                    <div class="space-y-6">
                        <div class="flex items-center justify-between text-xs text-slate-500 px-2 font-medium">
                            <span>Ditemukan {{ $trackResults->count() }} data permohonan surat:</span>
                        </div>

                        @foreach($trackResults as $res)
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:shadow-md transition-all">
                            
                            <!-- Header Card -->
                            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4 mb-6">
                                <div>
                                    <span class="text-[11px] font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                                        {{ $res->kode_tracking }}
                                    </span>
                                    <h3 class="text-lg font-bold text-slate-900 mt-2">{{ $res->jenis_surat }}</h3>
                                    <span class="text-xs text-slate-400">Diajukan pada {{ $res->created_at ? $res->created_at->translatedFormat('d F Y, H:i') : '-' }} WIT</span>
                                </div>

                                <!-- Status Badge -->
                                <div>
                                    @if($res->status === 'menunggu')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Verifikasi
                                        </span>
                                    @elseif($res->status === 'diproses')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span> Sedang Diproses
                                        </span>
                                    @elseif($res->status === 'selesai')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Siap Diambil / Selesai
                                        </span>
                                    @elseif($res->status === 'ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <i class="fa-solid fa-circle-xmark text-rose-600"></i> Permohonan Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Timeline Progres -->
                            <div class="mb-6">
                                <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                    <div class="p-2.5 rounded-xl border {{ in_array($res->status, ['menunggu', 'diproses', 'selesai']) ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : 'bg-slate-50 border-slate-100 text-slate-400' }}">
                                        <i class="fa-solid fa-file-arrow-up block text-base mb-1"></i> 1. Masuk
                                    </div>
                                    <div class="p-2.5 rounded-xl border {{ in_array($res->status, ['diproses', 'selesai']) ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : ($res->status == 'ditolak' ? 'bg-rose-50 border-rose-200 text-rose-800 font-bold' : 'bg-slate-50 border-slate-100 text-slate-400') }}">
                                        <i class="fa-solid fa-gears block text-base mb-1"></i> 2. Proses
                                    </div>
                                    <div class="p-2.5 rounded-xl border {{ $res->status === 'selesai' ? 'bg-emerald-600 text-white font-bold' : ($res->status == 'ditolak' ? 'bg-rose-100 border-rose-200 text-rose-800 font-bold' : 'bg-slate-50 border-slate-100 text-slate-400') }}">
                                        <i class="fa-solid fa-stamp block text-base mb-1"></i> 3. Siap Diambil
                                    </div>
                                </div>
                            </div>

                            <!-- Data Rincian -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs bg-slate-50/80 p-4 rounded-2xl border border-slate-100 mb-6">
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Nama Pemohon:</span>
                                    <span class="font-bold text-slate-800">{{ $res->nama_lengkap }} (NIK: {{ substr($res->nik, 0, 6) }}******)</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Nomor WhatsApp:</span>
                                    <span class="font-bold text-slate-800">{{ $res->no_wa }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <span class="text-slate-400 block mb-0.5">Keperluan:</span>
                                    <span class="text-slate-700">{{ $res->keperluan }}</span>
                                </div>
                                @if($res->catatan_petugas)
                                <div class="sm:col-span-2 p-3 bg-amber-50 border border-amber-200 rounded-xl text-amber-800">
                                    <span class="font-bold block mb-1"><i class="fa-solid fa-bullhorn mr-1"></i> Catatan dari Petugas Kantor Desa:</span>
                                    <p>{{ $res->catatan_petugas }}</p>
                                </div>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                                <span class="text-[11px] text-slate-400">
                                    @if($res->status === 'selesai')
                                        <i class="fa-solid fa-circle-check text-emerald-600 mr-1"></i> Surat dapat diambil di Kantor Desa pada jam kerja.
                                    @else
                                        <i class="fa-solid fa-clock text-slate-400 mr-1"></i> Estimasi waktu pengerjaan 1x24 jam kerja.
                                    @endif
                                </span>

                                <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $globalFooter->telepon ?? '085218403628') }}&text={{ urlencode('Halo Petugas Kantor Desa Kupal, saya ingin menanyakan status surat ' . $res->jenis_surat . ' dengan Kode Tracking: ' . $res->kode_tracking . ' atas nama ' . $res->nama_lengkap) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs transition-colors">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> Konfirmasi ke Petugas WA
                                </a>
                            </div>

                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-10 border border-slate-200/80 text-center text-slate-400">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-slate-300"></i>
                        <p class="font-medium text-slate-600">Tidak ditemukan permohonan dengan kode atau NIK "<strong>{{ $searchTrack }}</strong>".</p>
                        <p class="text-xs text-slate-400 mt-1">Pastikan kode atau nomor NIK sudah benar, atau ajukan permohonan baru pada tab di atas.</p>
                    </div>
                @endif
            @endif

        </div>
        @endif


        {{-- ================= TAB 3: UNDUH BLANKO DOKUMEN ================= --}}
        @if(($tab ?? 'pengajuan') === 'unduh')
        <div>
            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 mb-10">
                <a href="{{ route('layanan.index', ['tab' => 'unduh']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ empty($kategori) ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    Semua Dokumen
                </a>
                @foreach($kategoriList as $kat)
                    <a href="{{ route('layanan.index', ['tab' => 'unduh', 'kategori' => $kat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $kategori === $kat ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>

            <!-- Dokumen List Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($dokumenList as $doc)
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $doc->kategori ?: 'Administrasi' }}
                                </span>
                                <span class="text-[11px] text-slate-400">
                                    <i class="fa-regular fa-calendar-days mr-1"></i>
                                    {{ $doc->tanggal_upload ? $doc->tanggal_upload->format('d M Y') : date('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors mb-2">
                                {{ $doc->nama_dokumen }}
                            </h3>

                            <p class="text-xs text-slate-600 mb-6 leading-relaxed line-clamp-3">
                                {{ $doc->keterangan ?: 'Blanko formulir pengajuan surat keterangan resmi dari Kantor Pemerintah Desa.' }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-400 font-mono uppercase">
                                <i class="fa-solid fa-file-pdf text-rose-500 mr-1"></i> {{ pathinfo($doc->nama_file, PATHINFO_EXTENSION) ?: 'PDF' }}
                            </span>
                            <a href="{{ route('layanan.download', $doc->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-colors">
                                <i class="fa-solid fa-download"></i> Unduh Berkas
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-slate-200 text-slate-400">
                        Tidak ada dokumen layanan yang ditemukan.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $dokumenList->links() }}
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
