@extends('layouts.app')

@section('title', 'Struktur Organisasi (SOTK) - Desa Kupal')

@section('content')
<!-- Page Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Pemerintahan Desa</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Struktur Organisasi & Tata Kerja (SOTK)</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Aparatur Pemerintah Desa Kupal Periode 2024 - 2029 yang berdedikasi melayani masyarakat.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Grid Aparatur Desa -->
        <div class="mb-16">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest block mb-2">Aparatur Desa</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Perangkat Desa Kupal</h2>
                <p class="text-sm text-slate-500 mt-2">Menjalankan roda pemerintahan desa, pembangunan, pembinaan, dan pemberdayaan masyarakat.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($aparatur as $orang)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200/80 group text-center flex flex-col items-center p-6">
                        <div class="w-36 h-44 rounded-2xl overflow-hidden mb-4 bg-slate-100 shadow-inner group-hover:scale-105 transition-transform duration-300">
                            @if($orang->foto)
                                <img src="{{ asset('images/' . $orang->foto) }}" alt="{{ $orang->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 text-5xl">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            @endif
                        </div>

                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                            {{ $orang->jabatan }}
                        </span>

                        <h3 class="text-lg font-extrabold text-slate-900 mb-1 group-hover:text-emerald-600 transition-colors">
                            {{ $orang->nama }}
                        </h3>
                        <p class="text-xs text-slate-500">Pemerintah Desa Kupal</p>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 text-slate-500">
                        Belum ada data aparatur desa.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Bagan Bagan Tambahan (jika diupload di profil_desa) -->
        @if($profil?->gambar_bagan1 || $profil?->gambar_bagan2)
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm mt-12">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-diagram-project text-emerald-600"></i> Bagan Struktur Organisasi Visual
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($profil->gambar_bagan1)
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                    <img src="{{ asset('images/' . $profil->gambar_bagan1) }}" alt="Bagan Struktur 1" class="w-full h-auto">
                </div>
                @endif
                @if($profil->gambar_bagan2)
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                    <img src="{{ asset('images/' . $profil->gambar_bagan2) }}" alt="Bagan Struktur 2" class="w-full h-auto">
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
