@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin Desa Kupal')
@section('header_title', 'Kelola Berita & Artikel')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Daftar Berita Desa</h2>
            <p class="text-xs text-slate-500">Kelola dan publikasikan informasi kegiatan resmi Desa Kupal</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-2 shadow-sm w-fit">
            <i class="fa-solid fa-plus"></i> Tambah Berita Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs sm:text-sm">
            <thead>
                <tr class="border-b border-slate-200 text-slate-400 uppercase text-[11px] font-bold">
                    <th class="py-3 px-3">No</th>
                    <th class="py-3 px-3">Gambar</th>
                    <th class="py-3 px-3">Judul Berita</th>
                    <th class="py-3 px-3">Tanggal Posting</th>
                    <th class="py-3 px-3 text-center">Views</th>
                    <th class="py-3 px-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($beritas as $index => $b)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3 px-3 font-semibold text-slate-500">{{ $beritas->firstItem() + $index }}</td>
                        <td class="py-3 px-3">
                            <div class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                @if($b->gambar)
                                    <img src="{{ asset('images/' . $b->gambar) }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-3 font-bold text-slate-800 max-w-xs">
                            <a href="{{ route('berita.detail', $b->slug ?? $b->id) }}" target="_blank" class="hover:text-emerald-600 line-clamp-2">
                                {{ $b->judul }}
                            </a>
                        </td>
                        <td class="py-3 px-3 text-slate-500 whitespace-nowrap">
                            {{ $b->tanggal_posting ? $b->tanggal_posting->format('d M Y, H:i') : '-' }} WIT
                        </td>
                        <td class="py-3 px-3 text-center font-bold text-slate-600">{{ $b->views }}</td>
                        <td class="py-3 px-3 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('admin.berita.edit', $b->id) }}" class="p-2 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 transition-colors">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-slate-400">Belum ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $beritas->links() }}
    </div>
</div>
@endsection
