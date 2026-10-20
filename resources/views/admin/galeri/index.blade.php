@extends('layouts.admin')

@section('title', 'Kelola Galeri - Admin Desa Kupal')
@section('header_title', 'Galeri Foto & Video')

@section('content')
<div class="space-y-10">
    
    <!-- Bagian 1: Galeri Foto -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-images text-emerald-600"></i> Kelola Foto Kegiatan
                </h3>
                <p class="text-xs text-slate-500">Unggah dokumentasi foto kegiatan pembangunan dan kemasyarakatan</p>
            </div>
        </div>

        <!-- Form Upload Foto -->
        <form action="{{ route('admin.galeri.foto.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 p-4 rounded-2xl bg-slate-50 border border-slate-100 items-end">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilih File Foto</label>
                <input type="file" name="foto" required accept="image/*" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keterangan / Judul Foto</label>
                <input type="text" name="keterangan" placeholder="Contoh: Rapat Musyawarah Desa" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
            </div>
            <div>
                <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-upload"></i> Unggah Foto
                </button>
            </div>
        </form>

        <!-- Grid Foto -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($fotos as $f)
                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 relative group">
                    <div class="h-28 overflow-hidden">
                        <img src="{{ asset('images/' . $f->nama_file) }}" alt="{{ $f->keterangan }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-2 text-[11px] font-semibold text-slate-700 line-clamp-1">
                        {{ $f->keterangan ?: 'Foto Desa' }}
                    </div>
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <form action="{{ route('admin.galeri.foto.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-rose-600 text-white shadow hover:bg-rose-700 text-xs">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-6 text-center py-8 text-slate-400 text-xs">Belum ada foto kegiatan.</div>
            @endforelse
        </div>
        <div class="mt-4">{{ $fotos->links() }}</div>
    </div>

    <!-- Bagian 2: Galeri Video -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-video text-emerald-600"></i> Kelola Video (YouTube)
                </h3>
                <p class="text-xs text-slate-500">Tautkan link video YouTube kegiatan desa</p>
            </div>
        </div>

        <!-- Form Tambah Video -->
        <form action="{{ route('admin.galeri.video.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 p-4 rounded-2xl bg-slate-50 border border-slate-100 items-end">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Video</label>
                <input type="text" name="judul" required placeholder="Contoh: Profil Desa Wisata Kupal" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Link YouTube</label>
                <input type="url" name="link_video" required placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
            </div>
            <div>
                <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Simpan Video
                </button>
            </div>
        </form>

        <!-- List Video -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($videos as $v)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">{{ $v->judul }}</h4>
                        <a href="{{ $v->link_video }}" target="_blank" class="text-[11px] text-emerald-600 hover:underline line-clamp-1 mt-0.5">
                            {{ $v->link_video }}
                        </a>
                    </div>
                    <form action="{{ route('admin.galeri.video.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus video ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-slate-400 text-xs">Belum ada video.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
