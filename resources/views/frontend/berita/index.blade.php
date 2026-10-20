@extends('layouts.app')

@section('title', 'Berita & Informasi - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Pusat Informasi</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Kabar & Agenda Desa Kupal</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Perkembangan pembangunan, pengumuman kegiatan kemasyarakatan, dan berita aktual desa.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Main Berita Grid -->
            <div class="lg:col-span-8">
                
                <!-- Search bar for mobile / desktop -->
                <form action="{{ route('berita.index') }}" method="GET" class="mb-8">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $search ?? '' }}" 
                            placeholder="Cari judul atau topik berita..." 
                            class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent shadow-sm"
                        >
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    </div>
                </form>

                @if($search)
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 text-emerald-800 text-sm flex items-center justify-between">
                        <span>Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong></span>
                        <a href="{{ route('berita.index') }}" class="text-emerald-700 font-bold hover:underline">Reset</a>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($beritaList as $item)
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200/80 flex flex-col group">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                @if($item->gambar)
                                    <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-newspaper text-3xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-3 left-3 bg-emerald-600/90 text-white text-[11px] font-bold px-3 py-1 rounded-full">
                                    {{ $item->tanggal_posting ? $item->tanggal_posting->format('d M Y') : date('d M Y') }}
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-base font-bold text-slate-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                    <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}">
                                        {{ $item->judul }}
                                    </a>
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 mb-4 font-light leading-relaxed flex-grow">
                                    {{ strip_tags($item->isi) }}
                                </p>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 mt-auto">
                                    <span><i class="fa-regular fa-eye mr-1"></i> {{ $item->views ?? 0 }} views</span>
                                    <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="font-bold text-emerald-600 hover:text-emerald-700">
                                        Baca <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-2 text-center py-16 text-slate-500 bg-white rounded-3xl border border-slate-200">
                            <i class="fa-solid fa-inbox text-4xl text-slate-300 mb-3 block"></i>
                            Tidak ada berita ditemukan.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $beritaList->links() }}
                </div>

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Populer Berita -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-fire text-amber-500"></i> Berita Terpopuler
                    </h3>
                    <div class="space-y-4">
                        @foreach($beritaPopuler as $pop)
                            <a href="{{ route('berita.detail', $pop->slug ?? $pop->id) }}" class="flex items-start gap-3 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                    @if($pop->gambar)
                                        <img src="{{ asset('images/' . $pop->gambar) }}" alt="{{ $pop->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-emerald-600 line-clamp-2 transition-colors">
                                        {{ $pop->judul }}
                                    </h4>
                                    <span class="text-[11px] text-slate-400 mt-1 block">
                                        <i class="fa-regular fa-eye mr-1"></i> {{ $pop->views }} views
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Layanan Banner -->
                <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-100 text-emerald-950">
                    <i class="fa-solid fa-file-circle-check text-3xl text-emerald-600 mb-3 block"></i>
                    <h4 class="font-bold text-base mb-2">Layanan Administrasi Desa</h4>
                    <p class="text-xs text-slate-600 mb-4 leading-relaxed">Unduh berbagai surat permohonan resmi desa dengan mudah dan praktis melalui portal layanan kami.</p>
                    <a href="{{ route('layanan.index') }}" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 text-white font-bold text-xs text-center block hover:bg-emerald-700 transition-colors">
                        Unduh Blanko Surat
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
