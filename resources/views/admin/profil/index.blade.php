@extends('layouts.admin')

@section('title', 'Kelola Profil & Sambutan - Admin Desa Kupal')
@section('header_title', 'Profil Desa & Sambutan Kepala Desa')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Perbarui Profil & Data Pokok Desa</h2>
            <p class="text-xs text-slate-500">Kelola visi, misi, sejarah, sambutan kepala desa, dan batas wilayah</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Sambutan Kades -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-tie"></i> Sambutan Kepala Desa
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Kepala Desa</label>
                    <input type="text" name="sambutan_nama_pejabat" value="{{ $profil->sambutan_nama_pejabat }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jabatan & Periode</label>
                    <input type="text" name="sambutan_jabatan" value="{{ $profil->sambutan_jabatan }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-slate-600 mb-1">Foto Kepala Desa</label>
                @if($profil->sambutan_foto)
                    <div class="w-20 h-28 rounded-xl overflow-hidden mb-2 border border-slate-200">
                        <img src="{{ asset('images/' . $profil->sambutan_foto) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="sambutan_foto" accept="image/*" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Naskah Sambutan Kepala Desa</label>
                <textarea name="sambutan_isi" rows="6" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">{{ $profil->sambutan_isi }}</textarea>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-compass"></i> Visi & Misi Pembangunan
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Visi Desa</label>
                    <textarea name="visi" rows="3" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">{{ $profil->visi }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Misi Desa (Pisahkan tiap poin dengan baris baru / Enter)</label>
                    <textarea name="misi" rows="6" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">{{ $profil->misi }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sejarah -->
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-landmark-dome"></i> Sejarah Desa Kupal
            </h3>
            <textarea name="sejarah" rows="6" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">{{ $profil->sejarah }}</textarea>
        </div>

        <!-- Batas Wilayah & Peta -->
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot"></i> Batas Wilayah & Peta
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Batas Utara</label>
                    <input type="text" name="batas_utara" value="{{ $profil->batas_utara }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Batas Selatan</label>
                    <input type="text" name="batas_selatan" value="{{ $profil->batas_selatan }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Batas Barat</label>
                    <input type="text" name="batas_barat" value="{{ $profil->batas_barat }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Batas Timur</label>
                    <input type="text" name="batas_timur" value="{{ $profil->batas_timur }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Luas Desa</label>
                    <input type="text" name="luas_desa" value="{{ $profil->luas_desa }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Link Embed Google Maps</label>
                    <input type="text" name="gambar_peta" value="{{ $profil->gambar_peta }}" placeholder="https://www.google.com/maps/embed?..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-7 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Profil Desa
            </button>
        </div>
    </form>
</div>
@endsection
