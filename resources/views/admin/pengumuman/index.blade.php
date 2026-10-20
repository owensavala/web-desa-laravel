@extends('layouts.admin')

@section('title', 'Pengumuman Berjalan - Admin Desa Kupal')
@section('header_title', 'Pengumuman & Ticker Bar')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Form Tambah Pengumuman -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
        <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-bullhorn text-emerald-600"></i> Buat Pengumuman Baru
        </h3>

        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Pengumuman</label>
                <textarea name="judul" rows="3" required placeholder="Contoh: Jadwal Posyandu Balita dilaksanakan pada tanggal..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    <option value="aktif">Aktif (Tampil di Ticker)</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Simpan Pengumuman
            </button>
        </form>
    </div>

    <!-- List Pengumuman -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-list-check text-emerald-600"></i> Riwayat Pengumuman
        </h3>

        <div class="space-y-4">
            @forelse($pengumumans as $p)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $p->status === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                                {{ strtoupper($p->status) }}
                            </span>
                            <span class="text-[11px] text-slate-400">
                                {{ $p->tanggal_mulai->format('d M') }} s/d {{ $p->tanggal_selesai->format('d M Y') }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed">{{ $p->judul }}</p>
                    </div>
                    <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors shrink-0">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400 text-xs">Belum ada pengumuman.</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
