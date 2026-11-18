@extends('layouts.app')

@section('title', 'Struktur Organisasi (SOTK) - Desa Kupal')

@section('content')
<!-- Page Header Banner with Visual Background -->
<section class="relative bg-slate-950 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-30 transform scale-105" 
         style="background-image: url('{{ asset('images/1769446350_kantor desa.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-emerald-950/90 to-sky-950/80"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center gap-2 mb-3">
            <span class="px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-amber-500 text-slate-950 shadow-md">
                <i class="fa-solid fa-sitemap mr-1 text-xs"></i> Pemerintahan Desa
            </span>
            <span class="text-xs font-semibold text-sky-300">
                Pemerintah Desa Kupal • Periode 2024 - 2029
            </span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">Struktur Organisasi & Tata Kerja (SOTK)</h1>
        <p class="text-slate-200 text-sm sm:text-base mt-3 max-w-2xl leading-relaxed font-light">
            Aparatur Pemerintah Desa Kupal yang berdedikasi, siap melayani kebutuhan administrasi, pembangunan, dan kesejahteraan masyarakat secara prima.
        </p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Pengantar -->
        <div class="text-center max-w-xl mx-auto mb-14">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 border border-emerald-300 text-emerald-900 text-xs font-black uppercase tracking-wider mb-3">
                <i class="fa-solid fa-users text-emerald-600"></i> Aparatur Desa
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Perangkat Pemerintah Desa Kupal</h2>
            <p class="text-sm text-slate-600 mt-2">Menjalankan tugas dan fungsi pelayanan prima untuk seluruh warga Desa Kupal.</p>
        </div>

        <!-- Grid Aparatur Desa (Tri-Color Role Distinct Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-20">
            @forelse($aparatur as $orang)
                @php
                    // Dynamic Tri-Color Badge by Rank
                    $roleBadge = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                    $frameGlow = 'border-slate-200';
                    if (str_contains(strtolower($orang->jabatan), 'kepala desa')) {
                        $roleBadge = 'bg-amber-100 text-amber-900 border-amber-300 font-black shadow-sm';
                        $frameGlow = 'ring-2 ring-amber-400 border-amber-400';
                    } elseif (str_contains(strtolower($orang->jabatan), 'sekretaris')) {
                        $roleBadge = 'bg-sky-100 text-sky-900 border-sky-300 font-bold';
                        $frameGlow = 'border-sky-300';
                    } elseif (str_contains(strtolower($orang->jabatan), 'keuangan') || str_contains(strtolower($orang->jabatan), 'bendahara')) {
                        $roleBadge = 'bg-emerald-100 text-emerald-900 border-emerald-300 font-bold';
                    }
                @endphp
                <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border {{ $frameGlow }} group text-center flex flex-col items-center p-6 card-lift">
                    
                    <!-- Photo Frame with Soft Inner Shadow -->
                    <div class="w-40 h-52 rounded-2xl overflow-hidden mb-5 bg-slate-100 shadow-md relative group-hover:scale-105 transition-transform duration-300">
                        @if($orang->foto)
                            <img src="{{ asset('images/' . $orang->foto) }}" alt="{{ $orang->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 text-6xl">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>

                    <!-- Role Badge -->
                    <span class="inline-block px-3 py-1 rounded-full text-[11px] border mb-2.5 {{ $roleBadge }}">
                        {{ $orang->jabatan }}
                    </span>

                    <h3 class="text-base sm:text-lg font-black text-slate-900 mb-1 group-hover:text-emerald-700 transition-colors">
                        {{ $orang->nama }}
                    </h3>
                    
                    <p class="text-xs text-slate-500 font-medium">Pemerintah Desa Kupal</p>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 text-slate-400">
                    Belum ada data aparatur desa.
                </div>
            @endforelse
        </div>

        <!-- Bagan Visual Struktur Organisasi (Bagan 1 & Bagan 2) -->
        @if($profil?->gambar_bagan1 || $profil?->gambar_bagan2)
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/80 shadow-lg">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-black uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-diagram-project text-sky-600"></i> Hierarki Pemerintahan
                </span>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900">Bagan Struktur Organisasi Visual</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Struktur tata kelola dan garis koordinasi Pemerintah Desa Kupal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($profil->gambar_bagan1)
                <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-md group relative">
                    <img src="{{ asset('images/' . $profil->gambar_bagan1) }}" alt="Bagan Struktur 1" class="w-full h-auto group-hover:scale-102 transition-transform cursor-pointer" onclick="window.open('{{ asset('images/' . $profil->gambar_bagan1) }}', '_blank')">
                    <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600">
                        <span class="font-bold">Bagan Struktur Organisasi Utama</span>
                        <a href="{{ asset('images/' . $profil->gambar_bagan1) }}" target="_blank" class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-expand text-[10px]"></i> Perbesar
                        </a>
                    </div>
                </div>
                @endif

                @if($profil->gambar_bagan2)
                <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-md group relative">
                    <img src="{{ asset('images/' . $profil->gambar_bagan2) }}" alt="Bagan Struktur 2" class="w-full h-auto group-hover:scale-102 transition-transform cursor-pointer" onclick="window.open('{{ asset('images/' . $profil->gambar_bagan2) }}', '_blank')">
                    <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600">
                        <span class="font-bold">Bagan Alur Koordinasi Wilayah Dusun</span>
                        <a href="{{ asset('images/' . $profil->gambar_bagan2) }}" target="_blank" class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-expand text-[10px]"></i> Perbesar
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
