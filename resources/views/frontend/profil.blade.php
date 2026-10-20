@extends('layouts.app')

@section('title', 'Profil & Sejarah Desa Kupal - Halmahera Selatan')

@section('content')
<!-- Page Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Tentang Kami</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Profil & Wilayah Desa Kupal</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Mengenal sejarah berdirinya desa, visi & misi kepemimpinan, dan batas wilayah administratif.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Main Content (Visi Misi, Sejarah, Geografis) -->
            <div class="lg:col-span-8 space-y-12">
                
                <!-- Visi & Misi Card -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center gap-3 text-emerald-600 font-bold text-xs uppercase tracking-widest mb-4">
                        <i class="fa-solid fa-compass"></i> Arah & Tujuan
                    </div>
                    
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Visi & Misi Desa Kupal</h2>

                    <div class="bg-emerald-50/70 border-l-4 border-emerald-600 p-6 rounded-r-2xl mb-8">
                        <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-2">Visi Desa</h3>
                        <p class="text-base sm:text-lg font-bold text-slate-900 italic">
                            {{ $profil->visi ?? '“Desa Kupal sebagai Desa Wisata yang mampu mengelolah potensi Desa dan pembangunan berkelanjutan untuk mewujudkan masyarakat yang sejahtera”' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-emerald-600"></i> Misi Pembangunan Desa
                        </h3>
                        @php
                            $misiItems = explode("\n", $profil->misi ?? '');
                        @endphp
                        <ul class="space-y-3">
                            @foreach($misiItems as $misi)
                                @if(trim($misi))
                                <li class="flex items-start gap-3 text-sm text-slate-700">
                                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span>{{ trim($misi) }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Sejarah Desa Card -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center gap-3 text-emerald-600 font-bold text-xs uppercase tracking-widest mb-4">
                        <i class="fa-solid fa-landmark-dome"></i> Jejak Sejarah
                    </div>
                    
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Sejarah & Asal Usul Desa Kupal</h2>

                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm sm:text-base space-y-4">
                        {!! nl2br(e($profil->sejarah ?? 'Sejarah penamaan Desa Kupal tidak lepas dari keterikatan dengan Kesultanan Bacan...')) !!}
                    </div>
                </div>

                <!-- Batas & Geografis Card -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center gap-3 text-emerald-600 font-bold text-xs uppercase tracking-widest mb-4">
                        <i class="fa-solid fa-map"></i> Letak Geografis
                    </div>
                    
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Batas Administratif Wilayah</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base">U</div>
                            <div>
                                <span class="text-xs text-slate-500 font-semibold block">Sebelah Utara</span>
                                <span class="text-sm font-bold text-slate-800">{{ $profil->batas_utara ?? 'Desa Tembal' }}</span>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base">S</div>
                            <div>
                                <span class="text-xs text-slate-500 font-semibold block">Sebelah Selatan</span>
                                <span class="text-sm font-bold text-slate-800">{{ $profil->batas_selatan ?? 'Desa Gandasuli' }}</span>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base">B</div>
                            <div>
                                <span class="text-xs text-slate-500 font-semibold block">Sebelah Barat</span>
                                <span class="text-sm font-bold text-slate-800">{{ $profil->batas_barat ?? 'Pantai Kupal' }}</span>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base">T</div>
                            <div>
                                <span class="text-xs text-slate-500 font-semibold block">Sebelah Timur</span>
                                <span class="text-sm font-bold text-slate-800">{{ $profil->batas_timur ?? 'Pegunungan Bacan' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Peta Interaktif -->
                    <div class="rounded-2xl overflow-hidden border border-slate-200 h-80 w-full shadow-sm">
                        @php
                            $mapUrl = $profil->gambar_peta ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1393.6099631158868!2d127.4771603029561!3d-0.6672357875266723!2m3!1f90!2f0!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x2d633928247195d7%3A0x50371dc95a3280e8!2sKnt%2C%20Desa%20Kupal!5e1!3m2!1sid!2sid!4v1755110';
                            if (str_contains($mapUrl, 'src="')) {
                                preg_match('/src="([^"]+)"/', $mapUrl, $matches);
                                $mapUrl = $matches[1] ?? $mapUrl;
                            }
                        @endphp
                        <iframe 
                            src="{{ $mapUrl }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Info Ringkas -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">Statistik Wilayah</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex justify-between items-center py-1">
                            <span class="text-slate-500">Kecamatan</span>
                            <span class="font-bold text-slate-800">Bacan Selatan</span>
                        </li>
                        <li class="flex justify-between items-center py-1">
                            <span class="text-slate-500">Kabupaten</span>
                            <span class="font-bold text-slate-800">Halmahera Selatan</span>
                        </li>
                        <li class="flex justify-between items-center py-1">
                            <span class="text-slate-500">Provinsi</span>
                            <span class="font-bold text-slate-800">Maluku Utara</span>
                        </li>
                        <li class="flex justify-between items-center py-1">
                            <span class="text-slate-500">Luas Wilayah</span>
                            <span class="font-bold text-emerald-600">{{ $profil->luas_desa ?? '708 Ha' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Link Cepat Aparatur -->
                <div class="bg-gradient-to-br from-emerald-800 to-teal-900 rounded-3xl p-6 text-white shadow-lg">
                    <i class="fa-solid fa-users-gear text-3xl text-emerald-300 mb-3"></i>
                    <h3 class="text-lg font-bold mb-2">Aparatur Pemerintahan Desa</h3>
                    <p class="text-xs text-emerald-200 mb-4">Ketahui susunan perangkat desa yang siap melayani kebutuhan administrasi warga Kupal.</p>
                    <a href="{{ route('profil.sotk') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-emerald-900 font-bold text-xs hover:bg-emerald-50 transition-colors">
                        Lihat Struktur SOTK <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
