@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Desa Kupal')
@section('header_title', 'Perbarui Berita')

@section('content')
<div class="max-w-4xl bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Edit Berita</h2>
            <p class="text-xs text-slate-500">Perbarui informasi artikel berita</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="judul" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Berita</label>
            <input 
                type="text" 
                name="judul" 
                id="judul" 
                value="{{ old('judul', $berita->judul) }}" 
                required 
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
        </div>

        <div>
            <label for="gambar" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Sampul Saat Ini</label>
            @if($berita->gambar)
                <div class="w-32 h-24 rounded-xl overflow-hidden bg-slate-100 mb-3 border border-slate-200">
                    <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                </div>
            @endif
            <input 
                type="file" 
                name="gambar" 
                id="gambar" 
                accept="image/*"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>

        <div>
            <label for="isi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Narasi Berita</label>
            <textarea 
                name="isi" 
                id="isi" 
                rows="10" 
                required 
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >{{ old('isi', $berita->isi) }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.berita.index') }}" class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
