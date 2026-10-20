@extends('layouts.admin')

@section('title', 'Kelola Aparatur SOTK - Admin Desa Kupal')
@section('header_title', 'Aparatur Desa (SOTK)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Form Tambah Aparatur -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
        <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-user-plus text-emerald-600"></i> Tambah Perangkat Desa
        </h3>

        <form action="{{ route('admin.sotk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" required placeholder="Contoh: Sanusi La Riaga" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jabatan</label>
                <input type="text" name="jabatan" required placeholder="Contoh: Kepala Desa Kupal" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Resmi</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Pas foto/portrait)</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" value="1" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Simpan Data Aparatur
            </button>
        </form>
    </div>

    <!-- List Aparatur -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-sitemap text-emerald-600"></i> Struktur Aparatur Terdaftar
        </h3>

        <div class="space-y-4">
            @forelse($aparatur as $item)
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100 gap-4">
                    <div class="w-16 h-20 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                        @if($item->foto)
                            <img src="{{ asset('images/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">Urutan #{{ $item->urutan }}</span>
                        <h4 class="text-sm font-bold text-slate-900 mt-1">{{ $item->nama }}</h4>
                        <p class="text-xs text-emerald-600 font-semibold">{{ $item->jabatan }}</p>
                    </div>
                    <form action="{{ route('admin.sotk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data aparatur ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400 text-xs">Belum ada aparatur terdaftar.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
