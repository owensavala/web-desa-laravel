@extends('layouts.app')

@section('title', 'Beranda - Portal Resmi Desa Kupal, Kec. Bacan Selatan')

@section('content')
<!-- ================= 1. HERO SLIDER SECTION (TRI-COLOR & GLASSMORPHISM) ================= -->
<section class="relative bg-slate-950 text-white overflow-hidden">
    @if($sliders->count() > 0)
        <div id="hero-carousel" class="relative min-h-[520px] lg:min-h-[620px] flex items-center">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                    <!-- Background Image with Ambient Zoom Effect -->
                    <div class="absolute inset-0 bg-cover bg-center transform scale-105 duration-[8000ms] transition-transform ease-out" 
                         style="background-image: url('{{ asset('images/' . $slider->gambar) }}');">
                    </div>
                    
                    <!-- Sophisticated Multi-Color Overlay: Deep Slate to Emerald to Ocean Blue -->
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-emerald-950/85 to-sky-950/60"></div>
                    
                    <!-- Decorative Light Orbs -->
                    <div class="absolute top-10 right-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-10 left-1/3 w-80 h-80 rounded-full bg-sky-500/10 blur-3xl pointer-events-none"></div>

                    <!-- Hero Content Container -->
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative h-full flex items-center py-20 z-20">
                        <div class="max-w-3xl">
                            
                            <!-- Tri-Color Badges -->
                            <div class="flex flex-wrap items-center gap-2.5 mb-5">
                                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20">
                                    <i class="fa-solid fa-crown text-slate-900 text-[11px]"></i> Desa Wisata & Bahari
                                </span>
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold text-sky-200 bg-sky-950/70 border border-sky-400/30 backdrop-blur-md">
                                    <i class="fa-solid fa-satellite-dish text-sky-400"></i> Sistem Informasi Digital
                                </span>
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white mb-5 leading-tight drop-shadow-lg">
                                {{ $slider->judul ?? 'Selamat Datang di Portal Resmi Desa Kupal' }}
                            </h1>

                            <p class="text-base sm:text-lg text-slate-200/90 mb-9 leading-relaxed font-normal max-w-2xl drop-shadow">
                                {{ $slider->subjudul ?? 'Mewujudkan Desa Kupal yang maju, mandiri, berdaya saing dan melayani masyarakat dengan sepenuh hati berbasis potensi kelautan dan kearifan lokal.' }}
                            </p>

                            <!-- Tri-Color Action Buttons -->
                            <div class="flex flex-wrap items-center gap-3.5 sm:gap-4">
                                <a href="{{ route('layanan.index', ['tab' => 'pengajuan']) }}" class="px-7 py-4 rounded-2xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 font-black text-sm shadow-xl shadow-amber-500/30 hover:scale-105 transition-all flex items-center gap-2.5">
                                    <i class="fa-solid fa-file-signature text-base"></i> Layanan E-Surat Online
                                </a>

                                <a href="{{ route('infografis.apbd') }}" class="px-6 py-4 rounded-2xl bg-sky-600/80 hover:bg-sky-600 text-white font-bold text-sm backdrop-blur-md border border-sky-400/40 shadow-lg shadow-sky-900/40 hover:scale-105 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-chart-pie text-sky-300"></i> Transparansi APBDes
                                </a>

                                <a href="{{ route('profil') }}" class="px-5 py-4 rounded-2xl bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white font-semibold text-sm backdrop-blur-md border border-white/20 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-compass text-emerald-400"></i> Jelajahi Profil
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Slider Navigation Controls -->
            @if($sliders->count() > 1)
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2.5 bg-slate-950/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/15">
                @foreach($sliders as $index => $slider)
                    <button class="slider-dot h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-amber-400 w-8' : 'bg-white/40 hover:bg-white w-2.5' }}" onclick="goToSlide({{ $index }})" title="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    @else
        <!-- Fallback Hero -->
        <div class="py-24 container mx-auto px-4 text-center">
            <h1 class="text-4xl font-extrabold text-white">Selamat Datang di Website Resmi Desa Kupal</h1>
            <p class="text-slate-300 mt-4 max-w-xl mx-auto">Sistem Informasi dan Pelayanan Masyarakat Berbasis Digital</p>
        </div>
    @endif
</section>

<!-- ================= 2. QUICK STATS STRIP (TRI-COLOR HARMONY CARDS) ================= -->
<section class="relative z-30 -mt-14 container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Stat 1: Total Penduduk (Ocean Sky / Cyan Theme) -->
        <div class="bg-gradient-to-br from-white via-sky-50/40 to-blue-50/60 rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-200/60 border border-sky-100 card-lift flex items-center gap-4 group">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-sky-500 to-blue-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-sky-500/25 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($demografi->total_penduduk ?? 1845) }}</span>
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mt-0.5">Total Penduduk</span>
                <span class="text-[11px] text-slate-500 hidden sm:block">942 Laki-Laki • 903 Perempuan</span>
            </div>
        </div>

        <!-- Stat 2: Kepala Keluarga (Warm Amber / Gold Theme) -->
        <div class="bg-gradient-to-br from-white via-amber-50/40 to-yellow-50/60 rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-200/60 border border-amber-100 card-lift flex items-center gap-4 group">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-500 text-slate-950 flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-amber-500/25 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-house-chimney-user"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($demografi->total_kk ?? 512) }}</span>
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider block mt-0.5">Kepala Keluarga (KK)</span>
                <span class="text-[11px] text-slate-500 hidden sm:block">Terbagi dalam 2 Dusun</span>
            </div>
        </div>

        <!-- Stat 3: Luas Wilayah (Emerald / Tropical Green Theme) -->
        <div class="bg-gradient-to-br from-white via-emerald-50/40 to-teal-50/60 rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-200/60 border border-emerald-100 card-lift flex items-center gap-4 group">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-emerald-600/25 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ $profil->luas_desa ?? '708 Ha' }}</span>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block mt-0.5">Luas Wilayah</span>
                <span class="text-[11px] text-slate-500 hidden sm:block">Pesisir & Perbukitan Asri</span>
            </div>
        </div>

        <!-- Stat 4: APBDes (Deep Indigo / Violet Theme) -->
        <div class="bg-gradient-to-br from-white via-indigo-50/40 to-violet-50/60 rounded-3xl p-5 sm:p-6 shadow-xl shadow-slate-200/60 border border-indigo-100 card-lift flex items-center gap-4 group">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-indigo-600/25 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    @if(($apbdes->total_pendapatan ?? 0) >= 1000000000)
                        Rp {{ number_format(($apbdes->total_pendapatan) / 1000000000, 2, ',', '.') }} M
                    @else
                        Rp {{ number_format(($apbdes->total_pendapatan ?? 0) / 1000000, 0, ',', '.') }} Jt
                    @endif
                </span>
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider block mt-0.5">APBDes {{ $apbdes->tahun ?? 2026 }}</span>
                <span class="text-[11px] text-emerald-600 font-semibold hidden sm:block">Transparansi 100% Terbuka</span>
            </div>
        </div>

    </div>
</section>

<!-- ================= 3. NEW: VISUAL SHOWCASE (POTENSI & LAYANAN UNGGULAN DESA DENGAN FOTO) ================= -->
<section class="py-20 bg-gradient-to-b from-slate-50 via-white to-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 border border-amber-300 text-amber-900 text-xs font-black uppercase tracking-wider mb-3">
                <i class="fa-solid fa-gem text-amber-600"></i> Potensi & Keunggulan Desa
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Membangun Desa Kupal Lebih Maju & Berdaya
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Harmoni keindahan bahari, kekuatan adat istiadat, dan transformasi pelayanan digital desa untuk kesejahteraan seluruh warga.
            </p>
        </div>

        <!-- 4-Column Feature Cards with Real Photos & Tri-Color Accents -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            
            <!-- Card 1: Wisata Bahari & Pesisir (Sky Theme) -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md card-lift flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('images/1769446538_desa 2.jpg') }}" alt="Wisata Bahari" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-black bg-sky-500 text-white shadow-md">
                        <i class="fa-solid fa-water mr-1"></i> Bahari & Wisata
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-sky-600 transition-colors mb-2">
                        Pesona Pesisir Selat Bacan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed flex-grow">
                        Garis pantai alami dengan air jernih, terumbu karang terjaga, serta panorama matahari terbenam yang memukau sebagai daya tarik ekowisata.
                    </p>
                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-600 hover:text-sky-700 mt-4">
                        Pelajari Potensi <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2: Layanan Digital Desa (Amber/Gold Theme) -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md card-lift flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('images/1769446350_kantor desa.jpg') }}" alt="Kantor Desa Kupal" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-black bg-amber-500 text-slate-950 shadow-md">
                        <i class="fa-solid fa-bolt mr-1"></i> Smart Village
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition-colors mb-2">
                        Pelayanan E-Surat Online
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed flex-grow">
                        Kemudahan pengajuan surat keterangan mandiri secara digital tanpa antre, dilengkapi kode pelacakan realtime dan notifikasi WhatsApp.
                    </p>
                    <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-800 mt-4">
                        Ajukan Surat Sekarang <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3: Tradisi & Kearifan Lokal (Emerald Theme) -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md card-lift flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('images/1769448622_galeri3.jpg') }}" alt="Tradisi & Gotong Royong" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-black bg-emerald-600 text-white shadow-md">
                        <i class="fa-solid fa-hands-holding-child mr-1"></i> Adat & Budaya
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-600 transition-colors mb-2">
                        Kearifan Adat Kesultanan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed flex-grow">
                        Nilai luhur gotong royong dan ikatan sejarah Kesultanan Bacan senantiasa menjadi nafas kebersamaan dan kerukunan warga desa.
                    </p>
                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-4">
                        Baca Sejarah Lengkap <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Card 4: Ekonomi Nelayan & Pertanian (Rose Theme) -->
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-md card-lift flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('images/1769447041_berita2.jpg') }}" alt="Pemberdayaan Nelayan" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-black bg-rose-500 text-white shadow-md">
                        <i class="fa-solid fa-fish-fins mr-1"></i> Ekonomi Warga
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-600 transition-colors mb-2">
                        Pemberdayaan Maritim
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed flex-grow">
                        Bantuan mesin tempel, alat tangkap ramah lingkungan, dan sarana pendingin hasil tangkap laut mendorong kemandirian ekonomi keluarga nelayan.
                    </p>
                    <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-700 mt-4">
                        Lihat Program Desa <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ================= 4. SAMBUTAN KEPALA DESA & APBDES (NON-RIGID ASYMMETRIC DESIGN) ================= -->
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Ambient Blur Background Orbs -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-emerald-100/50 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-sky-100/50 blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left: Kades Photo & Greeting Card -->
            <div class="lg:col-span-7 bg-gradient-to-br from-white via-slate-50 to-emerald-50/30 rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-xl relative overflow-hidden">
                <div class="flex items-center gap-2.5 text-emerald-700 font-black text-xs uppercase tracking-widest mb-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <i class="fa-solid fa-comment-dots text-amber-500"></i> Sambutan Resmi Pemimpin Desa
                </div>

                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mb-6 leading-tight">
                    Kepala Desa Kupal, Kec. Bacan Selatan
                </h2>
                
                <div class="flex flex-col sm:flex-row gap-6 items-start mb-6">
                    <!-- Layered Photo Frame with Gold/Cyan Accents -->
                    <div class="relative shrink-0 mx-auto sm:mx-0">
                        <div class="w-32 h-44 rounded-2xl overflow-hidden shadow-xl border-4 border-white bg-slate-100 relative z-10">
                            @if($profil?->sambutan_foto)
                                <img src="{{ asset('images/' . $profil->sambutan_foto) }}" alt="Kepala Desa Kupal" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-emerald-700 text-4xl">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-32 h-44 rounded-2xl bg-gradient-to-tr from-amber-400 to-emerald-500 -z-0 opacity-80"></div>
                    </div>

                    <!-- Greeting Prose -->
                    <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed font-light italic">
                        “{!! nl2br(e(Str::limit($profil->sambutan_isi ?? 'Assalamu Alaikum Warahmatullahi Wabarakatuh. Selamat datang di Portal Informasi Desa Kupal...', 340))) !!}”
                    </div>
                </div>

                <div class="pt-5 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-lg leading-tight">{{ $profil->sambutan_nama_pejabat ?? 'Sanusi La Riaga' }}</h4>
                        <p class="text-xs text-emerald-700 font-bold uppercase tracking-wider">{{ $profil->sambutan_jabatan ?? 'Kepala Desa Kupal' }}</p>
                    </div>
                    <a href="{{ route('profil') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-emerald-700 text-white text-xs font-bold transition-colors flex items-center gap-2 shadow-sm">
                        Profil & Visi Misi <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Right: APBDes Transparency Card (Tri-Color Highlight) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 rounded-3xl p-8 sm:p-10 text-white shadow-2xl relative overflow-hidden border border-emerald-500/20">
                <!-- Background Glow -->
                <div class="absolute -right-16 -top-16 w-60 h-60 rounded-full bg-amber-500/10 blur-2xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 uppercase tracking-wider">
                        <i class="fa-solid fa-shield-halved"></i> Transparansi
                    </span>
                    <span class="text-xs font-bold text-sky-300 bg-sky-950/80 px-3 py-1 rounded-full border border-sky-500/30">
                        Tahun Anggaran {{ $apbdes->tahun ?? 2026 }}
                    </span>
                </div>

                <h3 class="text-2xl font-black mb-2 text-white">Anggaran Pendapatan & Belanja Desa</h3>
                <p class="text-xs text-slate-300 mb-8 leading-relaxed">
                    Pengelolaan keuangan desa yang akuntabel, transparan, dan terbuka untuk kemajuan seluruh masyarakat Desa Kupal.
                </p>

                <!-- 3-Color Metric Blocks -->
                <div class="space-y-4 mb-8">
                    <!-- Total Pendapatan (Emerald + Sky) -->
                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-md border border-white/15">
                        <div class="flex justify-between items-center text-xs text-sky-200 mb-1">
                            <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-arrow-down text-emerald-400"></i> Total Pendapatan</span>
                            <span class="bg-emerald-500/30 text-emerald-300 font-extrabold px-2 py-0.5 rounded text-[10px]">100% Sah</span>
                        </div>
                        <div class="text-2xl font-black text-white">
                            Rp {{ number_format($apbdes->total_pendapatan ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Total Belanja (Warm Amber) -->
                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-md border border-white/15">
                        <div class="flex justify-between items-center text-xs text-amber-200 mb-1">
                            <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-arrow-up text-amber-400"></i> Total Belanja Program</span>
                            <span class="bg-amber-500/30 text-amber-300 font-extrabold px-2 py-0.5 rounded text-[10px]">Realisasi Fisik</span>
                        </div>
                        <div class="text-2xl font-black text-amber-300">
                            Rp {{ number_format($apbdes->total_belanja ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <a href="{{ route('infografis.apbd') }}" class="w-full py-4 px-4 rounded-2xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-black text-sm text-center block shadow-lg shadow-sky-600/30 hover:scale-[1.02] transition-all">
                    <i class="fa-solid fa-chart-pie mr-2 text-amber-300"></i> Rincian Infografis Keuangan APBDes
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ================= 5. BERITA & KEGIATAN DESA TERKINI ================= -->
<section class="py-20 bg-slate-100/70 border-y border-slate-200/80">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-black text-emerald-700 uppercase tracking-widest block mb-2 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span> Warta & Publikasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Kabar Terkini Desa Kupal</h2>
            </div>
            <a href="{{ route('berita.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-800 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm transition-all hover:shadow">
                Lihat Semua Warta <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritaTerbaru as $item)
                <article class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border border-slate-200/80 flex flex-col group card-lift">
                    <div class="relative h-56 overflow-hidden bg-slate-200">
                        @if($item->gambar)
                            <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-newspaper text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Tri-Color Date Badge -->
                        <div class="absolute top-4 left-4 bg-slate-950/80 backdrop-blur-md text-amber-300 text-[11px] font-bold px-3 py-1 rounded-full border border-amber-400/30 shadow-md">
                            <i class="fa-regular fa-calendar-days mr-1.5 text-sky-400"></i>
                            {{ $item->tanggal_posting ? $item->tanggal_posting->format('d M Y') : date('d M Y') }}
                        </div>
                    </div>

                    <div class="p-7 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                            <span class="text-emerald-700 font-bold"><i class="fa-solid fa-user-pen mr-1"></i> Admin Desa</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-eye mr-1 text-sky-600"></i> {{ $item->views ?? 0 }} dilihat</span>
                        </div>

                        <h3 class="text-lg font-black text-slate-900 mb-3 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}">
                                {{ $item->judul }}
                            </a>
                        </h3>

                        <p class="text-sm text-slate-600 line-clamp-3 mb-6 font-normal leading-relaxed flex-grow">
                            {{ strip_tags($item->isi) }}
                        </p>

                        <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-emerald-700 hover:text-emerald-800 mt-auto pt-4 border-t border-slate-100">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[10px] transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-16 text-slate-400">
                    Belum ada artikel berita yang dipublikasikan.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- ================= 6. LAYANAN MANDIRI CTA BANNER (TRI-COLOR GRADIENT) ================= -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-emerald-900 via-slate-900 to-sky-900 rounded-3xl p-8 sm:p-14 text-white shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8 border border-white/10">
            <!-- Decorative Glow -->
            <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-amber-500/15 blur-3xl pointer-events-none"></div>

            <div class="max-w-xl relative z-10">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 mb-4 shadow-md">
                    <i class="fa-solid fa-bolt-lightning text-slate-950"></i> Pelayanan Digital Warga
                </span>
                <h2 class="text-3xl sm:text-4xl font-black mb-4 tracking-tight">Butuh Surat Keterangan Desa?</h2>
                <p class="text-slate-200 text-sm sm:text-base leading-relaxed font-light">
                    Kini warga dapat mengajukan permohonan surat keterangan (SKU, SKTM, Domisili, Pengantar SKCK, dll.) langsung dari handphone dan melacak status berkas secara realtime tanpa perlu bolak-balik antre.
                </p>
            </div>
            
            <div class="shrink-0 flex flex-col sm:flex-row gap-3.5 relative z-10 w-full sm:w-auto">
                <a href="{{ route('layanan.index', ['tab' => 'pengajuan']) }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 font-black text-sm shadow-xl shadow-amber-500/20 hover:scale-105 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-file-signature text-base"></i> Buat Surat Online
                </a>
                <a href="{{ route('layanan.index', ['tab' => 'lacak']) }}" class="px-7 py-4 rounded-2xl bg-sky-600/80 hover:bg-sky-600 text-white font-bold text-sm border border-sky-400/40 backdrop-blur-md shadow-lg shadow-sky-900/40 hover:scale-105 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-barcode text-sky-300"></i> Lacak Status Berkas
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Hero Slider Carousel Script
    let currentSlide = 0;
    const items = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.slider-dot');

    function goToSlide(index) {
        if (!items.length) return;
        items[currentSlide].classList.remove('opacity-100', 'z-10');
        items[currentSlide].classList.add('opacity-0', 'z-0');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.remove('bg-amber-400', 'w-8');
            dots[currentSlide].classList.add('bg-white/40', 'w-2.5');
        }

        currentSlide = (index + items.length) % items.length;

        items[currentSlide].classList.remove('opacity-0', 'z-0');
        items[currentSlide].classList.add('opacity-100', 'z-10');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('bg-amber-400', 'w-8');
            dots[currentSlide].classList.remove('bg-white/40', 'w-2.5');
        }
    }

    if (items.length > 1) {
        setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 7000);
    }
</script>
@endpush
