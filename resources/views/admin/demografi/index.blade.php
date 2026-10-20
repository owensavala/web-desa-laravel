@extends('layouts.admin')

@section('title', 'Kelola Demografi - Admin Desa Kupal')
@section('header_title', 'Statistik Kependudukan & Demografi')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Perbarui Data Demografi Penduduk</h2>
            <p class="text-xs text-slate-500">Angka ini otomatis memperbarui grafik dan statistik pada halaman infografis penduduk publik.</p>
        </div>
    </div>

    <form action="{{ route('admin.demografi.update') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Total Penduduk & KK -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-users"></i> Jumlah Agregat Penduduk
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Total Penduduk (Jiwa)</label>
                    <input type="number" name="total_penduduk" value="{{ $demografi->total_penduduk }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Total KK</label>
                    <input type="number" name="total_kk" value="{{ $demografi->total_kk }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Total Laki-Laki</label>
                    <input type="number" name="total_laki" value="{{ $demografi->total_laki }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Total Perempuan</label>
                    <input type="number" name="total_perempuan" value="{{ $demografi->total_perempuan }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>
            </div>
        </div>

        <!-- Kelompok Usia -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-children"></i> Kelompok Usia Penduduk
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Anak Laki-Laki (0-14)</label>
                    <input type="number" name="umur_anak_laki" value="{{ $demografi->umur_anak_laki }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Anak Perempuan (0-14)</label>
                    <input type="number" name="umur_anak_perempuan" value="{{ $demografi->umur_anak_perempuan }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Remaja Laki-Laki (15-24)</label>
                    <input type="number" name="umur_remaja_laki" value="{{ $demografi->umur_remaja_laki }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Remaja Perempuan (15-24)</label>
                    <input type="number" name="umur_remaja_perempuan" value="{{ $demografi->umur_remaja_perempuan }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Dewasa Laki-Laki (25-59)</label>
                    <input type="number" name="umur_dewasa_laki" value="{{ $demografi->umur_dewasa_laki }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Dewasa Perempuan (25-59)</label>
                    <input type="number" name="umur_dewasa_perempuan" value="{{ $demografi->umur_dewasa_perempuan }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Lansia Laki-Laki (60+)</label>
                    <input type="number" name="umur_lansia_laki" value="{{ $demografi->umur_lansia_laki }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Lansia Perempuan (60+)</label>
                    <input type="number" name="umur_lansia_perempuan" value="{{ $demografi->umur_lansia_perempuan }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>
        </div>

        <!-- Tingkat Pendidikan -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-graduation-cap"></i> Tingkat Pendidikan Warga
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">SD / Sederajat</label>
                    <input type="number" name="pendidikan_sd" value="{{ $demografi->pendidikan_sd }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">SMP / Sederajat</label>
                    <input type="number" name="pendidikan_smp" value="{{ $demografi->pendidikan_smp }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">SMA / SMK</label>
                    <input type="number" name="pendidikan_sma" value="{{ $demografi->pendidikan_sma }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Perguruan Tinggi (Diploma/S1/S2)</label>
                    <input type="number" name="pendidikan_pt" value="{{ $demografi->pendidikan_pt }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>
        </div>

        <!-- Status & Agama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-ring"></i> Status Perkawinan
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kawin (Menikah)</label>
                        <input type="number" name="status_kawin" value="{{ $demografi->status_kawin }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Belum Kawin</label>
                        <input type="number" name="status_belum_kawin" value="{{ $demografi->status_belum_kawin }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Cerai Hidup</label>
                        <input type="number" name="status_cerai_hidup" value="{{ $demografi->status_cerai_hidup }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Cerai Mati</label>
                        <input type="number" name="status_cerai_mati" value="{{ $demografi->status_cerai_mati }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-moon"></i> Agama / Kepercayaan
                </h3>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Islam</label>
                        <input type="number" name="agama_islam" value="{{ $demografi->agama_islam }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kristen</label>
                        <input type="number" name="agama_kristen" value="{{ $demografi->agama_kristen }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Katolik</label>
                        <input type="number" name="agama_katolik" value="{{ $demografi->agama_katolik }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-7 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Pembaharuan Demografi
            </button>
        </div>
    </form>
</div>
@endsection
