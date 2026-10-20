@extends('layouts.app')

@section('title', 'Galeri Video Kegiatan - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Multimedia</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Galeri Video Desa Kupal</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Liputan video seputar keindahan alam, potensi wisata, kebudayaan, dan kegiatan masyarakat Desa Kupal.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $vid)
                @php
                    // Helper to convert youtube watch or short link to embed
                    $embedUrl = $vid->link_video;
                    if (str_contains($embedUrl, 'watch?v=')) {
                        $parts = explode('watch?v=', $embedUrl);
                        $id = explode('&', $parts[1] ?? '')[0];
                        $embedUrl = "https://www.youtube.com/embed/" . $id;
                    } elseif (str_contains($embedUrl, 'youtu.be/')) {
                        $parts = explode('youtu.be/', $embedUrl);
                        $id = explode('?', $parts[1] ?? '')[0];
                        $embedUrl = "https://www.youtube.com/embed/" . $id;
                    }
                @endphp
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200/80 flex flex-col">
                    <div class="relative h-56 bg-slate-900">
                        <iframe 
                            src="{{ $embedUrl }}" 
                            title="{{ $vid->judul }}" 
                            class="w-full h-full" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6 flex flex-col flex-grow justify-between">
                        <h3 class="text-base font-bold text-slate-900 mb-2">
                            {{ $vid->judul }}
                        </h3>
                        <span class="text-xs text-slate-400 block mt-2">
                            <i class="fa-regular fa-calendar-days mr-1"></i>
                            {{ $vid->tanggal_upload ? $vid->tanggal_upload->format('d M Y') : date('d M Y') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-slate-400">
                    Belum ada video kegiatan yang ditambahkan.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $videos->links() }}
        </div>

    </div>
</section>
@endsection
