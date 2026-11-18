@extends('layouts.app')

@section('title', 'Profil & Sejarah Desa Kupal - Halmahera Selatan')

@section('content')
<!-- Page Header Banner with Background Photo & Tri-Color Glow -->
<section class="relative bg-slate-950 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-30 transform scale-105" 
         style="background-image: url('{{ asset('images/1769446551_desa3.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-emerald-950/90 to-sky-950/80"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center gap-2 mb-3">
            <span class="px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-amber-500 text-slate-950 shadow-md">
                <i class="fa-solid fa-landmark text-xs mr-1"></i> Profil Daerah
            </span>
            <span class="text-xs font-semibold text-sky-300">
                Pemerintah Desa Kupal • Halmahera Selatan
            </span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">Profil & Wilayah Desa Kupal</h1>
        <p class="text-slate-200 text-sm sm:text-base mt-3 max-w-2xl leading-relaxed font-light">
            Mengenal sejarah berdirinya desa, visi & misi pembangunan kepemimpinan desa, serta batas wilayah administratif di pesisir Bacan Selatan.
        </p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Main Content (Visi Misi, Sejarah, Geografis) -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- Visi & Misi Card with Landscape Photo -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-md card-lift">
                    <div class="flex items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2.5 text-emerald-700 font-black text-xs uppercase tracking-widest">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                            <i class="fa-solid fa-compass text-amber-500"></i> Arah & Tujuan Pembangunan
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                            Periode 2024 - 2029
                        </span>
                    </div>

                    <!-- Visual Landscape Thumbnail -->
                    <div class="rounded-2xl overflow-hidden mb-6 h-56 sm:h-64 shadow-md relative group">
                        <img src="{{ asset('images/1769446538_desa 2.jpg') }}" alt="Pemandangan Desa Kupal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent flex items-end p-5">
                            <span class="text-white text-xs font-bold tracking-wide">
                                <i class="fa-solid fa-location-dot text-amber-400 mr-1.5"></i> Lanskap Pesisir Desa Kupal, Kec. Bacan Selatan
                            </span>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-black text-slate-900 mb-6">Visi & Misi Desa Kupal</h2>

                    <!-- Visi Box with Gold Accent -->
                    <div class="bg-gradient-to-r from-amber-50 via-yellow-50/50 to-white border-l-4 border-amber-500 p-6 rounded-r-2xl mb-8 shadow-sm">
                        <h3 class="text-xs font-black text-amber-900 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-star text-amber-500"></i> VISI PEMBANGUNAN DESA
                        </h3>
                        <p class="text-base sm:text-lg font-bold text-slate-900 leading-relaxed italic">
                            {{ $profil->visi ?? '“Terwujudnya Desa Kupal yang Mandiri, Sejahtera, Transparan, Berakhlak, dan Berdaya Saing melalui Optimalisasi Potensi Bahari serta Pelayanan Publik Berbasis Digital Menuju Halmahera Selatan yang Maju”' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-emerald-600"></i> 6 Misi Strategis Desa
                        </h3>
                        @php
                            $misiItems = explode("\n", $profil->misi ?? '');
                        @endphp
                        <ul class="space-y-3.5">
                            @foreach($misiItems as $misi)
                                @if(trim($misi))
                                <li class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/50 transition-colors">
                                    <span class="w-7 h-7 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white flex items-center justify-center text-xs font-black shrink-0 shadow-sm mt-0.5">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ trim($misi) }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Sejarah Desa Card with Heritage Photo -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-md card-lift">
                    <div class="flex items-center gap-2.5 text-amber-700 font-black text-xs uppercase tracking-widest mb-4">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                        <i class="fa-solid fa-landmark-dome text-emerald-600"></i> Jejak Sejarah & Asal-Usul
                    </div>
                    
                    <h2 class="text-2xl font-black text-slate-900 mb-6">Hikayat & Sejarah Desa Kupal</h2>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6 items-center">
                        <div class="md:col-span-5 rounded-2xl overflow-hidden shadow-md h-52 bg-slate-100">
                            <img src="{{ asset('images/1769448609_galeri1.jpg') }}" alt="Tradisi & Musyawarah Desa" class="w-full h-full object-cover">
                        </div>
                        <div class="md:col-span-7 bg-emerald-50/60 p-5 rounded-2xl border border-emerald-100 text-xs sm:text-sm text-emerald-900 leading-relaxed">
                            <p class="font-bold text-slate-900 mb-1">“Kupal: Simpul Sejarah Bahari Kesultanan Bacan”</p>
                            Penamaan Desa Kupal sarat akan hikayat leluhur maritim yang kokoh berdiri sejak era Kesultanan Bacan sebagai basis pelaut dan petani rempah pala serta cengkih.
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm sm:text-base space-y-4 font-normal">
                        {!! nl2br(e($profil->sejarah ?? 'Sejarah penamaan Desa Kupal tidak lepas dari keterikatan dengan Kesultanan Bacan...')) !!}
                    </div>
                </div>

                <!-- Batas & Geografis Card with Map -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-md card-lift">
                    <div class="flex items-center gap-2.5 text-sky-700 font-black text-xs uppercase tracking-widest mb-4">
                        <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                        <i class="fa-solid fa-map-location-dot text-sky-600"></i> Letak Geografis & Batas Wilayah
                    </div>
                    
                    <h2 class="text-2xl font-black text-slate-900 mb-6">Batas Administratif Wilayah</h2>

                    <!-- 4 Compass Borders in Tri-Color Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <!-- Utara (Sky) -->
                        <div class="p-4 rounded-2xl bg-gradient-to-br from-sky-50 to-white border border-sky-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sky-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-sky-600/20">U</div>
                            <div>
                                <span class="text-xs text-sky-700 font-bold block uppercase tracking-wider">Sebelah Utara</span>
                                <span class="text-sm font-black text-slate-900">{{ $profil->batas_utara ?? 'Desa Amasing Kota / Selat Bacan' }}</span>
                            </div>
                        </div>

                        <!-- Selatan (Rose) -->
                        <div class="p-4 rounded-2xl bg-gradient-to-br from-rose-50 to-white border border-rose-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-rose-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-rose-600/20">S</div>
                            <div>
                                <span class="text-xs text-rose-700 font-bold block uppercase tracking-wider">Sebelah Selatan</span>
                                <span class="text-sm font-black text-slate-900">{{ $profil->batas_selatan ?? 'Desa Tuwokona / Selat Bacan' }}</span>
                            </div>
                        </div>

                        <!-- Barat (Emerald) -->
                        <div class="p-4 rounded-2xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-emerald-600/20">B</div>
                            <div>
                                <span class="text-xs text-emerald-700 font-bold block uppercase tracking-wider">Sebelah Barat</span>
                                <span class="text-sm font-black text-slate-900">{{ $profil->batas_barat ?? 'Selat Bacan / Teluk Labuha' }}</span>
                            </div>
                        </div>

                        <!-- Timur (Amber) -->
                        <div class="p-4 rounded-2xl bg-gradient-to-br from-amber-50 to-white border border-amber-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black text-base shadow-md shadow-amber-500/20">T</div>
                            <div>
                                <span class="text-xs text-amber-800 font-bold block uppercase tracking-wider">Sebelah Timur</span>
                                <span class="text-sm font-black text-slate-900">{{ $profil->batas_timur ?? 'Hutan Lindung Bacan Selatan' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Peta Interaktif Google Maps -->
                    <div class="rounded-3xl overflow-hidden border border-slate-200 h-80 w-full shadow-inner">
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

            <!-- Sidebar Info & Visual Card -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Kantor Desa Photo Card -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md">
                    <div class="h-44 overflow-hidden relative">
                        <img src="{{ asset('images/1769446350_kantor desa.jpg') }}" alt="Kantor Desa Kupal" class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full">
                            Kantor Desa Kupal
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-base font-black text-slate-900 mb-3 pb-3 border-b border-slate-100 flex items-center justify-between">
                            <span>Informasi Wilayah</span>
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        </h3>
                        <ul class="space-y-3.5 text-xs sm:text-sm">
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Kecamatan</span>
                                <span class="font-bold text-slate-800">Bacan Selatan</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Kabupaten</span>
                                <span class="font-bold text-slate-800">Halmahera Selatan</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Provinsi</span>
                                <span class="font-bold text-slate-800">Maluku Utara</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Kode Pos</span>
                                <span class="font-bold text-slate-800 font-mono">97791</span>
                            </li>
                            <li class="flex justify-between items-center pt-2 border-t border-slate-100">
                                <span class="text-slate-500">Luas Wilayah</span>
                                <span class="font-black text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">{{ $profil->luas_desa ?? '708 Ha' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Link Cepat Aparatur with Tri-Color Gradient -->
                <div class="bg-gradient-to-br from-slate-950 via-emerald-950 to-sky-950 rounded-3xl p-7 text-white shadow-xl border border-emerald-500/30">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center text-xl mb-4 font-black shadow-md">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <h3 class="text-lg font-black mb-2">Struktur Aparatur Desa (SOTK)</h3>
                    <p class="text-xs text-slate-300 mb-5 leading-relaxed">Kenali 8 aparatur perangkat desa yang berdedikasi melayani seluruh kebutuhan masyarakat Kupal.</p>
                    <a href="{{ route('profil.sotk') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-950 font-black text-xs transition-all shadow-md">
                        Lihat Struktur Lengkap <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
