@extends('layouts.app')

@section('title', 'Galeri Foto Kegiatan - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-emerald-950 via-teal-900 to-sky-950 text-white py-16 sm:py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-15 mix-blend-overlay pointer-events-none">
        <img src="{{ asset('images/1769446551_desa3.jpg') }}" alt="Desa Kupal" class="w-full h-full object-cover">
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 border border-amber-400/30 text-amber-300 font-bold text-xs uppercase tracking-widest mb-3">
            <i class="fa-solid fa-camera-retro"></i> Dokumentasi Visual
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white">Galeri Foto Desa Kupal</h1>
        <p class="text-emerald-100/90 text-sm sm:text-base mt-2 max-w-2xl leading-relaxed">Dokumentasi momen penting, pembangunan fisik, kearifan lokal, dan kegiatan kemasyarakatan di Bumi Saruma.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($fotos as $foto)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-200/80 group flex flex-col hover:-translate-y-1">
                    <div class="relative h-60 overflow-hidden bg-slate-100 cursor-pointer" onclick="openPhotoModal('{{ asset('images/' . $foto->nama_file) }}', '{{ addslashes($foto->keterangan ?? '') }}')">
                        <img src="{{ asset('images/' . $foto->nama_file) }}" alt="{{ $foto->keterangan ?? 'Foto Kegiatan' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-3xl">
                            <span class="w-12 h-12 rounded-full bg-amber-500/90 text-slate-950 flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <i class="fa-solid fa-magnifying-glass-plus text-base"></i>
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <p class="text-sm font-bold text-slate-800 line-clamp-2 mb-3 group-hover:text-emerald-600 transition-colors">
                            {{ $foto->keterangan ?: 'Kegiatan Kemasyarakatan & Pembangunan' }}
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-sky-700 bg-sky-50 px-2 py-0.5 rounded-md">
                                <i class="fa-solid fa-tag text-[9px]"></i> Dokumentasi
                            </span>
                            <span class="text-[11px] text-slate-400">
                                <i class="fa-regular fa-calendar-days mr-1"></i>
                                {{ $foto->tanggal_upload ? $foto->tanggal_upload->format('d M Y') : date('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 text-slate-400">
                    Belum ada foto kegiatan diunggah.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $fotos->links() }}
        </div>

    </div>
</section>

<!-- Lightbox Modal -->
<div id="photo-modal" class="fixed inset-0 z-50 bg-slate-950/90 hidden items-center justify-center p-4" onclick="closePhotoModal()">
    <div class="max-w-4xl max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
        <img id="modal-img" src="" alt="Preview" class="w-full max-h-[75vh] object-contain bg-black">
        <div class="p-4 bg-white flex justify-between items-center">
            <span id="modal-caption" class="text-sm font-semibold text-slate-800"></span>
            <button onclick="closePhotoModal()" class="px-3 py-1 bg-slate-100 hover:bg-slate-200 rounded-lg text-xs font-bold text-slate-700">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openPhotoModal(src, caption) {
        document.getElementById('modal-img').src = src;
        document.getElementById('modal-caption').innerText = caption || 'Foto Kegiatan';
        const modal = document.getElementById('photo-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closePhotoModal() {
        const modal = document.getElementById('photo-modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endpush
