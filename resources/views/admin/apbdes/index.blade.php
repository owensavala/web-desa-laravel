@extends('layouts.admin')

@section('title', 'Kelola Transparansi APBDes - Admin Desa Kupal')
@section('header_title', 'Kelola APBDes & Realisasi Anggaran')

@section('content')
<div class="space-y-8">
    
    <!-- Form Summary APBDes -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-file-invoice-dollar text-emerald-600"></i> Input / Perbarui Summary Anggaran Tahunan
        </h3>

        <form action="{{ route('admin.apbdes.summary.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Anggaran</label>
                <input type="number" name="tahun" value="{{ date('Y') }}" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Total Pendapatan (Rp)</label>
                <input type="number" name="total_pendapatan" required placeholder="Contoh: 100000000" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Total Belanja (Rp)</label>
                <input type="number" name="total_belanja" required placeholder="Contoh: 98000000" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pendapatan Asli Desa (PAD)</label>
                <input type="number" name="pendapatan_pad" placeholder="0" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pendapatan Transfer / Dana Desa</label>
                <input type="number" name="pendapatan_transfer" placeholder="0" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pendapatan Lain-lain</label>
                <input type="number" name="pendapatan_lain" placeholder="0" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div class="sm:col-span-2 lg:col-span-3 pt-2">
                <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Summary APBDes
                </button>
            </div>
        </form>
    </div>

    <!-- Rincian Kegiatan & Data APBDes yang Ada -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Form Tambah Rincian Detail -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
            <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-emerald-600"></i> Tambah Rincian Kegiatan
            </h3>

            <form action="{{ route('admin.apbdes.detail.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilih Tahun APBDes</label>
                    <select name="id_summary" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                        @foreach($summaries as $s)
                            <option value="{{ $s->id }}">Tahun {{ $s->tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Bidang Anggaran</label>
                    <input type="text" name="bidang" required placeholder="Contoh: Pelaksanaan Pembangunan Desa" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kegiatan</label>
                    <input type="text" name="kegiatan" required placeholder="Contoh: Pembangunan Jalan Tani" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jumlah Anggaran (Rp)</label>
                    <input type="number" name="anggaran" required placeholder="50000000" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Kegiatan
                </button>
            </form>
        </div>

        <!-- Tabel Rekap APBDes -->
        <div class="lg:col-span-7 space-y-6">
            @foreach($summaries as $sum)
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <span class="font-extrabold text-slate-900 text-base">APBDes Tahun {{ $sum->tahun }}</span>
                        <div class="text-xs">
                            <span class="text-emerald-700 font-bold">Rp {{ number_format($sum->total_pendapatan) }}</span> /
                            <span class="text-amber-700 font-bold">Rp {{ number_format($sum->total_belanja) }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 font-bold uppercase text-[10px] border-b border-slate-100">
                                    <th class="py-2 px-1">Bidang</th>
                                    <th class="py-2 px-1">Kegiatan</th>
                                    <th class="py-2 px-1 text-right">Anggaran</th>
                                    <th class="py-2 px-1 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($sum->details as $det)
                                    <tr>
                                        <td class="py-2.5 px-1 font-semibold text-emerald-800">{{ $det->bidang }}</td>
                                        <td class="py-2.5 px-1 text-slate-700">{{ $det->kegiatan }}</td>
                                        <td class="py-2.5 px-1 text-right font-bold text-slate-900">
                                            Rp {{ number_format($det->anggaran) }}
                                        </td>
                                        <td class="py-2.5 px-1 text-right">
                                            <form action="{{ route('admin.apbdes.detail.destroy', $det->id) }}" method="POST" onsubmit="return confirm('Hapus rincian kegiatan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-400 hover:text-rose-600">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 text-center text-slate-400">Belum ada rincian kegiatan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>
@endsection
