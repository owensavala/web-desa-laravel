@extends('layouts.app')

@section('title', 'Galeri Foto Kegiatan - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Dokumentasi</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Galeri Foto Kegiatan Desa Kupal</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Dokumentasi momen penting, pembangunan fisik, gotong royong, dan kegiatan kemasyarakatan di Desa Kupal.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($fotos as $foto)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200/80 group flex flex-col">
                    <div class="relative h-56 overflow-hidden bg-slate-100 cursor-pointer" onclick="openPhotoModal('{{ asset('images/' . $foto->nama_file) }}', '{{ addslashes($foto->keterangan ?? '') }}')">
                        <img src="{{ asset('images/' . $foto->nama_file) }}" alt="{{ $foto->keterangan ?? 'Foto Kegiatan' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-2xl">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                    </div>
                    <div class="p-4 flex-grow flex flex-col justify-between">
                        <p class="text-xs font-medium text-slate-700 line-clamp-2 mb-2">
                            {{ $foto->keterangan ?: 'Kegiatan Pembangunan Desa' }}
                        </p>
                        <span class="text-[11px] text-slate-400 block">
                            <i class="fa-regular fa-calendar-days mr-1"></i>
                            {{ $foto->tanggal_upload ? $foto->tanggal_upload->format('d M Y') : date('d M Y') }}
                        </span>
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
