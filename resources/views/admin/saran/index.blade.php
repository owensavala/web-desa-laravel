@extends('layouts.admin')

@section('title', 'Kritik & Saran Masuk - Admin Desa Kupal')
@section('header_title', 'Kotak Kritik, Saran & Pengaduan Warga')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Daftar Aspirasi & Saran Masuk</h2>
            <p class="text-xs text-slate-500">Tinjau aspirasi dari warga untuk perbaikan tata kelola dan pelayanan desa</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($sarans as $s)
            <div class="p-5 rounded-2xl {{ $s->status === 'baru' ? 'bg-amber-50/70 border border-amber-200' : 'bg-slate-50 border border-slate-100' }} flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div class="space-y-2 flex-grow">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-circle-user text-emerald-600"></i> {{ $s->nama }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $s->status === 'baru' ? 'bg-amber-200 text-amber-900' : 'bg-slate-200 text-slate-700' }}">
                            {{ strtoupper($s->status) }}
                        </span>
                        <span class="text-xs text-slate-400">
                            {{ $s->tanggal_kirim ? $s->tanggal_kirim->format('d M Y, H:i') : '-' }} WIT
                        </span>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-light">
                        {{ $s->komentar }}
                    </p>
                </div>

                <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0">
                    <form action="{{ route('admin.saran.status', $s->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-colors {{ $s->status === 'baru' ? 'bg-emerald-600 hover:bg-emerald-700 text-white' : 'bg-slate-200 hover:bg-slate-300 text-slate-700' }}">
                            <i class="fa-solid {{ $s->status === 'baru' ? 'fa-check' : 'fa-envelope' }} mr-1"></i>
                            {{ $s->status === 'baru' ? 'Tandai Dibaca' : 'Tandai Baru' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.saran.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-400 hover:text-rose-600">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-16 text-slate-400 text-xs">
                Belum ada kritik dan saran yang masuk.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $sarans->links() }}
    </div>
</div>
@endsection
