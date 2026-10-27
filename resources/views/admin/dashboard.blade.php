@extends('layouts.admin')

@section('title', 'Admin Dashboard - Desa Kupal')
@section('header_title', 'Ringkasan Dashboard')

@section('content')
<!-- Stats Counter Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
    
    <!-- Permohonan E-Surat (Utama) -->
    <a href="{{ route('admin.layanan.permohonan.index') }}" class="bg-gradient-to-tr from-emerald-600 to-teal-600 rounded-3xl p-6 text-white shadow-lg shadow-emerald-900/20 flex items-center justify-between hover:scale-[1.02] transition-transform">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-100 block mb-1">E-Surat Warga</span>
            <span class="text-3xl font-extrabold text-white">{{ $stats['total_permohonan'] ?? 0 }}</span>
            <span class="text-[11px] text-amber-300 block mt-1 font-semibold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span> {{ $stats['permohonan_menunggu'] ?? 0 }} Perlu Diproses
            </span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center text-xl">
            <i class="fa-solid fa-file-signature"></i>
        </div>
    </a>

    <!-- Berita -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Berita</span>
            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_berita'] }}</span>
            <span class="text-[11px] text-emerald-600 block mt-1 font-semibold">Artikel Publik</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-newspaper"></i>
        </div>
    </div>

    <!-- Penduduk -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Data Penduduk</span>
            <span class="text-3xl font-extrabold text-slate-900">{{ number_format($stats['total_penduduk']) }}</span>
            <span class="text-[11px] text-teal-600 block mt-1 font-semibold">Warga Terdata</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>

    <!-- Dokumen -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Dokumen Blanko</span>
            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_dokumen'] }}</span>
            <span class="text-[11px] text-blue-600 block mt-1 font-semibold">Siap Unduh</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-file-arrow-down"></i>
        </div>
    </div>

    <!-- Kritik & Saran -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Aspirasi Warga</span>
            <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_saran'] }}</span>
            <span class="text-[11px] text-amber-600 block mt-1 font-semibold">{{ $stats['saran_baru'] }} Pesan Baru</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
    </div>

</div>

<!-- Quick Actions & Recent Items -->
<div class="space-y-8">

    <!-- Permohonan E-Surat Terkini -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-file-signature text-emerald-600"></i> Permohonan E-Surat Masuk Terkini
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Surat permohonan yang baru diajukan oleh masyarakat.</p>
            </div>
            <a href="{{ route('admin.layanan.permohonan.index') }}" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5">
                Kelola Semua E-Surat <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3 px-4">Kode Tracking</th>
                        <th class="py-3 px-4">Nama Pemohon & NIK</th>
                        <th class="py-3 px-4">Jenis Surat</th>
                        <th class="py-3 px-4">Tanggal Pengajuan</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($permohonanTerbaru as $pt)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-mono font-bold text-emerald-700">{{ $pt->kode_tracking }}</td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-slate-900">{{ $pt->nama_lengkap }}</span>
                            <span class="text-slate-400 block text-[11px]">NIK: {{ $pt->nik }}</span>
                        </td>
                        <td class="py-3 px-4 font-medium text-slate-700">{{ $pt->jenis_surat }}</td>
                        <td class="py-3 px-4 text-slate-400">{{ $pt->created_at ? $pt->created_at->diffForHumans() : '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($pt->status === 'menunggu')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Menunggu</span>
                            @elseif($pt->status === 'diproses')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Diproses</span>
                            @elseif($pt->status === 'selesai')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Selesai</span>
                            @elseif($pt->status === 'ditolak')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('admin.layanan.permohonan.index') }}" class="text-emerald-600 hover:text-emerald-800 font-bold">
                                Tinjau
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-slate-400">Belum ada pengajuan surat masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grid Berita & Saran -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Berita Terkini -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-emerald-600"></i> Berita Terakhir
            </h3>
            <a href="{{ route('admin.berita.create') }}" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5">
                <i class="fa-solid fa-plus"></i> Tambah Berita
            </a>
        </div>

        <div class="space-y-4">
            @forelse($beritaTerbaru as $b)
                <div class="flex items-center justify-between p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden shrink-0">
                            @if($b->gambar)
                                <img src="{{ asset('images/' . $b->gambar) }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-800 line-clamp-1">{{ $b->judul }}</h4>
                            <span class="text-[11px] text-slate-400">
                                {{ $b->tanggal_posting ? $b->tanggal_posting->format('d M Y') : date('d M Y') }} • {{ $b->views }} views
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('admin.berita.edit', $b->id) }}" class="p-2 text-slate-400 hover:text-emerald-600">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400 text-xs">
                    Belum ada berita.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Kritik & Saran Masuk -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-comments text-amber-500"></i> Aspirasi Terbaru
            </h3>
            <a href="{{ route('admin.saran.index') }}" class="text-xs font-bold text-emerald-600 hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="space-y-4">
            @forelse($saranTerbaru as $s)
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 space-y-1">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-800">{{ $s->nama }}</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $s->status === 'baru' ? 'bg-amber-100 text-amber-800' : 'bg-slate-200 text-slate-600' }}">
                            {{ strtoupper($s->status) }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 line-clamp-2 italic">“{{ $s->komentar }}”</p>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400 text-xs">
                    Belum ada aspirasi masuk.
                </div>
            @endforelse
        </div>
    </div>

</div>
</div>
@endsection
