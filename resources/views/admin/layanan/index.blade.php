@extends('layouts.admin')

@section('title', 'Kelola Dokumen Layanan - Admin Desa Kupal')
@section('header_title', 'Dokumen Layanan & Formulir Surat')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Form Tambah Dokumen -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
        <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-file-circle-plus text-emerald-600"></i> Unggah Dokumen Baru
        </h3>

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Dokumen / Formulir</label>
                <input type="text" name="nama_dokumen" required placeholder="Contoh: Formulir Surat Keterangan Usaha (SKU)" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Layanan</label>
                <input type="text" name="kategori" required placeholder="Contoh: Kependudukan / Ekonomi & Sosial / Perizinan" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">File Dokumen (PDF, DOCX, XLS)</label>
                <input type="file" name="file_dokumen" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keterangan / Persyaratan Singkat</label>
                <textarea name="keterangan" rows="3" placeholder="Persyaratan yang perlu dibawa..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs"></textarea>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-upload"></i> Unggah Dokumen Layanan
            </button>
        </form>
    </div>

    <!-- List Dokumen -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-file-lines text-emerald-600"></i> Dokumen Siap Unduh
        </h3>

        <div class="space-y-4">
            @forelse($dokumens as $doc)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-200">
                                {{ $doc->kategori }}
                            </span>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 mt-1">{{ $doc->nama_dokumen }}</h4>
                            <span class="text-[11px] text-slate-400">
                                {{ $doc->tanggal_upload ? $doc->tanggal_upload->format('d M Y') : date('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('layanan.download', $doc->id) }}" class="p-2 text-slate-400 hover:text-emerald-600" title="Unduh File">
                            <i class="fa-solid fa-download"></i>
                        </a>
                        <form action="{{ route('admin.layanan.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400 text-xs">Belum ada dokumen layanan.</div>
            @endforelse
        </div>

        <div class="mt-4">{{ $dokumens->links() }}</div>
    </div>

</div>
@endsection
