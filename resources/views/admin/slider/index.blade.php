@extends('layouts.admin')

@section('title', 'Kelola Hero Slider - Admin Desa Kupal')
@section('header_title', 'Hero Slider Banner')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Form Tambah Slider -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
        <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-plus-circle text-emerald-600"></i> Tambah Banner Slider
        </h3>

        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Gambar Banner</label>
                <input type="file" name="gambar" required accept="image/*" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Landscape, Rekomendasi 1920x800)</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Utama</label>
                <input type="text" name="judul" placeholder="Contoh: KANTOR DESA KUPAL" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subjudul / Deskripsi Singkat</label>
                <textarea name="subjudul" rows="3" placeholder="Deskripsi banner..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" value="1" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-upload"></i> Unggah Slider
            </button>
        </form>
    </div>

    <!-- List Slider -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-images text-emerald-600"></i> Banner Aktif Saat Ini
        </h3>

        <div class="space-y-4">
            @forelse($sliders as $sl)
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100 gap-4">
                    <div class="w-24 h-16 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                        <img src="{{ asset('images/' . $sl->gambar) }}" alt="{{ $sl->judul }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">Urutan #{{ $sl->urutan }}</span>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 mt-1">{{ $sl->judul ?: 'Tanpa Judul' }}</h4>
                        <p class="text-[11px] text-slate-500 line-clamp-1">{{ $sl->subjudul }}</p>
                    </div>
                    <form action="{{ route('admin.slider.destroy', $sl->id) }}" method="POST" onsubmit="return confirm('Hapus slider banner ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400 text-xs">Belum ada slider banner.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
