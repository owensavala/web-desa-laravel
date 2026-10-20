@extends('layouts.app')

@section('title', 'Layanan Mandiri & Download Dokumen - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Pelayanan Publik</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Layanan Mandiri & Blanko Surat</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Unduh berkas persyaratan permohonan surat keterangan untuk mempermudah dan mempercepat administrasi Anda di Kantor Desa Kupal.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 mb-10">
            <a href="{{ route('layanan.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ empty($kategori) ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                Semua Dokumen
            </a>
            @foreach($kategoriList as $kat)
                <a href="{{ route('layanan.index', ['kategori' => $kat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $kategori === $kat ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

        <!-- Dokumen List Table / Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($dokumenList as $doc)
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
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

                        <h3 class="text-base font-bold text-slate-900 mb-2">
                            {{ $doc->nama_dokumen }}
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 mb-6 leading-relaxed">
                            {{ $doc->keterangan ?: 'Blanko formulir pengajuan surat keterangan resmi dari Kantor Pemerintah Desa Kupal.' }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400 font-mono">
                            {{ strtoupper(pathinfo($doc->nama_file, PATHINFO_EXTENSION)) }} File
                        </span>
                        <a href="{{ route('layanan.download', $doc->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-colors">
                            <i class="fa-solid fa-download"></i> Unduh Berkas
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-16 bg-white rounded-3xl border border-slate-200 text-slate-400">
                    Tidak ada dokumen layanan yang ditemukan.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $dokumenList->links() }}
        </div>

    </div>
</section>
@endsection
