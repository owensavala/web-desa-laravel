@extends('layouts.app')

@section('title', 'Beranda - Portal Resmi Desa Kupal, Kec. Bacan Selatan')

@section('content')
<!-- Hero Slider Section -->
<section class="relative bg-slate-900 text-white overflow-hidden">
    @if($sliders->count() > 0)
        <div id="hero-carousel" class="relative min-h-[480px] lg:min-h-[580px] flex items-center">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                    <!-- Background Image with Gradient Overlay -->
                    <div class="absolute inset-0 bg-cover bg-center transform scale-105 duration-[7000ms] transition-transform ease-out" 
                         style="background-image: url('{{ asset('images/' . $slider->gambar) }}');">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-emerald-950/80 to-transparent"></div>
                    
                    <!-- Hero Content -->
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative h-full flex items-center py-20 z-20">
                        <div class="max-w-2xl">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 mb-4 backdrop-blur-md">
                                <i class="fa-solid fa-map-pin"></i> Desa Wisata & Mandiri
                            </span>
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-4 leading-tight drop-shadow-md">
                                {{ $slider->judul ?? 'Selamat Datang di Desa Kupal' }}
                            </h1>
                            <p class="text-base sm:text-lg text-slate-200 mb-8 leading-relaxed font-light drop-shadow">
                                {{ $slider->subjudul ?? 'Mewujudkan Desa Kupal yang maju, mandiri, berdaya saing dan melayani masyarakat dengan sepenuh hati.' }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4">
                                <a href="{{ route('layanan.index') }}" class="px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-900/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-file-lines"></i> Layanan Surat Warga
                                </a>
                                <a href="{{ route('profil') }}" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm backdrop-blur-md border border-white/20 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-circle-info"></i> Jelajahi Profil Desa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Slider Navigation Dots -->
            @if($sliders->count() > 1)
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
                @foreach($sliders as $index => $slider)
                    <button class="slider-dot w-3 h-3 rounded-full transition-all {{ $index === 0 ? 'bg-emerald-400 w-8' : 'bg-white/50 hover:bg-white' }}" onclick="goToSlide({{ $index }})"></button>
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

<!-- Quick Stats Counter Strip -->
<section class="relative z-30 -mt-10 container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 sm:p-8 border border-slate-100">
        
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_penduduk ?? 170) }}</span>
                <span class="text-xs sm:text-sm text-slate-500 font-medium">Total Penduduk</span>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fa-solid fa-house-chimney-user"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_kk ?? 67) }}</span>
                <span class="text-xs sm:text-sm text-slate-500 font-medium">Kepala Keluarga (KK)</span>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div>
                <span class="block text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $profil->luas_desa ?? '708 Ha' }}</span>
                <span class="text-xs sm:text-sm text-slate-500 font-medium">Luas Wilayah</span>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="block text-xl sm:text-2xl font-extrabold text-slate-900">
                    Rp {{ number_format(($apbdes->total_pendapatan ?? 100000000) / 1000000, 0) }} Jt
                </span>
                <span class="text-xs sm:text-sm text-slate-500 font-medium">APBDes {{ $apbdes->tahun ?? 2025 }}</span>
            </div>
        </div>

    </div>
</section>

<!-- Sambutan Kepala Desa & Transparansi APBDes -->
<section class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Kades Photo & Greeting -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-0"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-emerald-600 font-bold text-xs uppercase tracking-widest mb-3">
                        <i class="fa-solid fa-comment-dots"></i> Sambutan Resmi
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-6 leading-snug">
                        Kepala Desa Kupal, Kec. Bacan Selatan
                    </h2>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-start mb-6">
                        @if($profil?->sambutan_foto)
                            <div class="w-28 h-36 rounded-2xl overflow-hidden shrink-0 shadow-md border-2 border-emerald-500/30">
                                <img src="{{ asset('images/' . $profil->sambutan_foto) }}" alt="Kepala Desa" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-28 h-36 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-3xl shrink-0">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        @endif

                        <div class="prose prose-slate text-sm sm:text-base text-slate-600 leading-relaxed font-light italic">
                            “{!! nl2br(e(Str::limit($profil->sambutan_isi ?? 'Assalamu Alaikum Warahmatullahi Wabarakatuh. Selamat datang di Portal Informasi Desa Kupal...', 320))) !!}”
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-slate-900 text-base">{{ $profil->sambutan_nama_pejabat ?? 'Sanusi La Riaga' }}</h4>
                            <p class="text-xs text-emerald-600 font-semibold">{{ $profil->sambutan_jabatan ?? 'Kepala Desa Kupal' }}</p>
                        </div>
                        <a href="{{ route('profil') }}" class="text-xs font-bold text-slate-700 hover:text-emerald-700 flex items-center gap-1">
                            Baca Profil Lengkap <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- APBDes Ringkas Card -->
            <div class="lg:col-span-5 bg-gradient-to-br from-emerald-800 to-teal-900 rounded-3xl p-8 sm:p-10 text-white shadow-xl shadow-emerald-950/20 relative">
                <div class="flex items-center justify-between mb-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-emerald-200">
                        <i class="fa-solid fa-shield-halved"></i> Transparansi Publik
                    </span>
                    <span class="text-sm font-semibold text-emerald-200">Tahun {{ $apbdes->tahun ?? 2025 }}</span>
                </div>

                <h3 class="text-2xl font-bold mb-2">Anggaran Pendapatan & Belanja Desa</h3>
                <p class="text-xs text-emerald-200/80 mb-8">Keterbukaan informasi pengelolaan keuangan Desa Kupal demi terwujudnya tata kelola yang bersih & transparan.</p>

                <div class="space-y-5 mb-8">
                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/10">
                        <div class="flex justify-between text-xs text-emerald-200 font-medium mb-1">
                            <span>Total Pendapatan</span>
                            <span class="text-emerald-300 font-bold">100%</span>
                        </div>
                        <div class="text-xl font-extrabold text-white">
                            Rp {{ number_format($apbdes->total_pendapatan ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/10">
                        <div class="flex justify-between text-xs text-emerald-200 font-medium mb-1">
                            <span>Total Belanja</span>
                            <span class="text-amber-300 font-bold">Terealisasi</span>
                        </div>
                        <div class="text-xl font-extrabold text-amber-300">
                            Rp {{ number_format($apbdes->total_belanja ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <a href="{{ route('infografis.apbd') }}" class="w-full py-3.5 px-4 rounded-xl bg-white text-emerald-900 font-bold text-sm text-center block hover:bg-emerald-50 transition-colors shadow-lg">
                    <i class="fa-solid fa-chart-pie mr-2"></i> Lihat Rincian Infografis APBDes
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Berita Terkini Desa -->
<section class="py-20 bg-slate-100/60 border-y border-slate-200/60">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest block mb-2">Kabar Terbaru</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Berita & Kegiatan Desa</h2>
            </div>
            <a href="{{ route('berita.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700">
                Lihat Semua Berita <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritaTerbaru as $item)
                <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200/70 flex flex-col group">
                    <div class="relative h-52 overflow-hidden bg-slate-200">
                        @if($item->gambar)
                            <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-newspaper text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-emerald-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-3 py-1 rounded-full">
                            <i class="fa-regular fa-calendar-days mr-1"></i>
                            {{ $item->tanggal_posting ? $item->tanggal_posting->format('d M Y') : date('d M Y') }}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                            <span><i class="fa-solid fa-user-pen mr-1"></i> Admin Desa</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-eye mr-1"></i> {{ $item->views ?? 0 }} dilihat</span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                            <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}">
                                {{ $item->judul }}
                            </a>
                        </h3>

                        <p class="text-sm text-slate-600 line-clamp-3 mb-6 font-light leading-relaxed flex-grow">
                            {{ strip_tags($item->isi) }}
                        </p>

                        <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700 mt-auto">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500">
                    Belum ada artikel berita yang dipublikasikan.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Layanan Mandiri CTA Banner -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-emerald-700 to-teal-800 rounded-3xl p-8 sm:p-14 text-white shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="max-w-xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/20 text-emerald-200 mb-4">
                    <i class="fa-solid fa-bolt"></i> Pelayanan Cepat & Mudah
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Butuh Surat Keterangan Desa?</h2>
                <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                    Unduh blanko persyaratan permohonan surat seperti SKTM, Keterangan Domisili, Surat Izin Usaha, dan administrasi kependudukan lainnya tanpa antre lama.
                </p>
            </div>
            <div class="shrink-0 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('layanan.index') }}" class="px-7 py-4 rounded-xl bg-white text-emerald-900 font-extrabold text-sm hover:bg-emerald-50 transition-all shadow-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-download"></i> Unduh Formulir Surat
                </a>
                <a href="{{ route('kritik-saran.index') }}" class="px-7 py-4 rounded-xl bg-emerald-900/60 hover:bg-emerald-900/80 text-white font-bold text-sm border border-emerald-500/40 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Aspirasi Warga
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
            dots[currentSlide].classList.remove('bg-emerald-400', 'w-8');
            dots[currentSlide].classList.add('bg-white/50');
        }

        currentSlide = (index + items.length) % items.length;

        items[currentSlide].classList.remove('opacity-0', 'z-0');
        items[currentSlide].classList.add('opacity-100', 'z-10');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('bg-emerald-400', 'w-8');
            dots[currentSlide].classList.remove('bg-white/50');
        }
    }

    if (items.length > 1) {
        setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 6000);
    }
</script>
@endpush
