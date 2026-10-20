@extends('layouts.app')

@section('title', 'Kritik & Saran - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Partisipasi Warga</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Kotak Aspirasi, Kritik & Saran</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Sampaikan masukan, pengaduan, atau apresiasi untuk kemajuan pembangunan dan peningkatan pelayanan Desa Kupal.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Form Kirim Saran -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm">
                <div class="flex items-center gap-3 text-emerald-600 font-bold text-xs uppercase tracking-widest mb-3">
                    <i class="fa-solid fa-paper-plane"></i> Form Pengaduan & Aspirasi
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Sampaikan Suara Anda</h2>

                <form action="{{ route('kritik-saran.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap / Inisial</label>
                        <input 
                            type="text" 
                            name="nama" 
                            id="nama" 
                            value="{{ old('nama') }}" 
                            required 
                            placeholder="Contoh: Warga Dusun 1 / Nama Anda"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('nama') border-rose-500 @enderror"
                        >
                        @error('nama')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="komentar" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Saran / Pengaduan / Aspirasi</label>
                        <textarea 
                            name="komentar" 
                            id="komentar" 
                            rows="5" 
                            required 
                            placeholder="Tuliskan pesan Anda secara jelas, sopan, dan membangun..."
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('komentar') border-rose-500 @enderror"
                        >{{ old('komentar') }}</textarea>
                        @error('komentar')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> Kirimkan Aspirasi Sekarang
                    </button>
                </form>
            </div>

            <!-- List Aspirasi Terakhir -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-comments text-emerald-600"></i> Aspirasi Masyarakat Terkini
                    </h3>

                    <div class="space-y-4">
                        @forelse($aspirasiList as $saran)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle-user text-emerald-600"></i> {{ $saran->nama }}
                                    </span>
                                    <span class="text-[11px] text-slate-400">
                                        {{ $saran->tanggal_kirim ? $saran->tanggal_kirim->diffForHumans() : 'Baru saja' }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed italic">
                                    “{{ $saran->komentar }}”
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-400 text-xs">
                                Belum ada kritik atau saran masuk.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-100 text-emerald-950 text-xs leading-relaxed">
                    <span class="font-bold block mb-1"><i class="fa-solid fa-shield-cat text-emerald-600 mr-1"></i> Kebijakan Privasi</span>
                    Setiap aspirasi masyarakat yang dikirimkan akan ditinjau langsung oleh Aparatur Pemerintah Desa Kupal untuk ditindaklanjuti secara bertanggung jawab.
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
