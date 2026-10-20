@extends('layouts.app')

@section('title', $berita->judul . ' - Desa Kupal')

@section('content')
<!-- Detail Berita Header -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-14">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="flex items-center gap-3 text-xs text-emerald-300 font-semibold mb-3">
            <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
            <span>/</span>
            <a href="{{ route('berita.index') }}" class="hover:underline">Berita</a>
            <span>/</span>
            <span class="text-white">Detail</span>
        </div>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight">
            {{ $berita->judul }}
        </h1>
        <div class="flex flex-wrap items-center gap-4 text-xs text-emerald-200 mt-4">
            <span><i class="fa-regular fa-calendar-days mr-1.5"></i> {{ $berita->tanggal_posting ? $berita->tanggal_posting->translatedFormat('l, d F Y') : date('d M Y') }}</span>
            <span>•</span>
            <span><i class="fa-solid fa-user-pen mr-1.5"></i> Administrator Desa Kupal</span>
            <span>•</span>
            <span><i class="fa-regular fa-eye mr-1.5"></i> {{ $berita->views }} kali dibaca</span>
        </div>
    </div>
</section>

<section class="py-14">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <!-- Main Article Container -->
        <article class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
            
            <!-- Featured Image -->
            @if($berita->gambar)
            <div class="rounded-2xl overflow-hidden mb-8 shadow-sm bg-slate-100 max-h-[480px]">
                <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Article Body -->
            <div class="prose prose-slate max-w-none text-slate-700 text-base sm:text-lg leading-relaxed font-light space-y-5">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <!-- Share & Tag Section -->
            <div class="pt-8 mt-10 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                    Bagikan Artikel Ini:
                </div>
                <div class="flex items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-emerald-500 text-white text-xs font-bold flex items-center gap-1.5 hover:bg-emerald-600 transition-colors">
                        <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-blue-600 text-white text-xs font-bold flex items-center gap-1.5 hover:bg-blue-700 transition-colors">
                        <i class="fa-brands fa-facebook-f text-sm"></i> Facebook
                    </a>
                </div>
            </div>

        </article>

        <!-- Berita Terkait -->
        @if($beritaTerkait->count() > 0)
        <div class="mt-14">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-emerald-600"></i> Berita Terkait Lainnya
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($beritaTerkait as $terkait)
                    <a href="{{ route('berita.detail', $terkait->slug ?? $terkait->id) }}" class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex gap-4 group">
                        <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                            @if($terkait->gambar)
                                <img src="{{ asset('images/' . $terkait->gambar) }}" alt="{{ $terkait->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="text-[11px] text-emerald-600 font-bold block mb-1">
                                {{ $terkait->tanggal_posting ? $terkait->tanggal_posting->format('d M Y') : date('d M Y') }}
                            </span>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-600 line-clamp-2 transition-colors">
                                {{ $terkait->judul }}
                            </h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
