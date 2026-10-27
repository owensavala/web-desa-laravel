@extends('layouts.admin')

@section('title', 'Manajemen Permohonan E-Surat Warga')
@section('header_title', 'Permohonan E-Surat Online')

@section('content')
<div class="space-y-6">

    <!-- Status Filter Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
        <a href="{{ route('admin.layanan.permohonan.index') }}" class="p-4 rounded-2xl border transition-all {{ empty($status) ? 'bg-emerald-600 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            <div class="text-xs font-bold uppercase tracking-wider">Semua Permohonan</div>
            <div class="text-2xl font-black mt-1">{{ $counts['all'] }}</div>
        </a>

        <a href="{{ route('admin.layanan.permohonan.index', ['status' => 'menunggu']) }}" class="p-4 rounded-2xl border transition-all {{ $status === 'menunggu' ? 'bg-amber-500 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            <div class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu
            </div>
            <div class="text-2xl font-black mt-1">{{ $counts['menunggu'] }}</div>
        </a>

        <a href="{{ route('admin.layanan.permohonan.index', ['status' => 'diproses']) }}" class="p-4 rounded-2xl border transition-all {{ $status === 'diproses' ? 'bg-blue-600 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            <div class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-blue-400"></span> Diproses
            </div>
            <div class="text-2xl font-black mt-1">{{ $counts['diproses'] }}</div>
        </a>

        <a href="{{ route('admin.layanan.permohonan.index', ['status' => 'selesai']) }}" class="p-4 rounded-2xl border transition-all {{ $status === 'selesai' ? 'bg-emerald-700 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            <div class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Siap / Selesai
            </div>
            <div class="text-2xl font-black mt-1">{{ $counts['selesai'] }}</div>
        </a>

        <a href="{{ route('admin.layanan.permohonan.index', ['status' => 'ditolak']) }}" class="p-4 rounded-2xl border transition-all {{ $status === 'ditolak' ? 'bg-rose-600 text-white shadow-md' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
            <div class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-400"></span> Ditolak
            </div>
            <div class="text-2xl font-black mt-1">{{ $counts['ditolak'] }}</div>
        </a>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-slate-900">Daftar Pengajuan Surat Warga</h2>
                <p class="text-xs text-slate-500">Kelola dan perbarui status permohonan surat keterangan warga desa.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-4 px-6">Kode & Tanggal</th>
                        <th class="py-4 px-6">Data Pemohon</th>
                        <th class="py-4 px-6">Surat & Keperluan</th>
                        <th class="py-4 px-6">Kontak WA</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($permohonanList as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        
                        <!-- Kode & Tanggal -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-mono font-bold text-xs px-2.5 py-1 rounded bg-slate-100 text-slate-800 border border-slate-200">
                                {{ $item->kode_tracking }}
                            </span>
                            <div class="text-xs text-slate-400 mt-1">
                                {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }} WIT
                            </div>
                        </td>

                        <!-- Pemohon -->
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $item->nama_lengkap }}</div>
                            <div class="text-xs text-slate-500 font-mono">NIK: {{ $item->nik }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">
                                {{ $item->dusun ? 'Dusun ' . $item->dusun : '' }} {{ $item->rt_rw ? '(' . $item->rt_rw . ')' : '' }}
                            </div>
                        </td>

                        <!-- Jenis Surat -->
                        <td class="py-4 px-6 max-w-xs">
                            <span class="font-semibold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded text-xs">
                                {{ $item->jenis_surat }}
                            </span>
                            <p class="text-xs text-slate-600 mt-1 line-clamp-2" title="{{ $item->keperluan }}">
                                {{ $item->keperluan }}
                            </p>
                            @if($item->catatan_petugas)
                            <div class="text-[11px] text-amber-700 bg-amber-50 p-1.5 rounded mt-1 border border-amber-200">
                                <strong>Catatan Petugas:</strong> {{ $item->catatan_petugas }}
                            </div>
                            @endif
                        </td>

                        <!-- Kontak WA -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            @php
                                $waClean = preg_replace('/[^0-9]/', '', $item->no_wa);
                                if (str_starts_with($waClean, '0')) {
                                    $waClean = '62' . substr($waClean, 1);
                                }
                            @endphp
                            <a href="https://api.whatsapp.com/send?phone={{ $waClean }}&text={{ urlencode('Halo Bapak/Ibu ' . $item->nama_lengkap . ', menindaklanjuti permohonan ' . $item->jenis_surat . ' di Kantor Desa Kupal (Kode: ' . $item->kode_tracking . ')...') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs border border-emerald-200 transition-colors">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                {{ $item->no_wa }}
                            </a>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            @if($item->status === 'menunggu')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                                </span>
                            @elseif($item->status === 'diproses')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Diproses
                                </span>
                            @elseif($item->status === 'selesai')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i class="fa-solid fa-check text-[10px]"></i> Selesai
                                </span>
                            @elseif($item->status === 'ditolak')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <i class="fa-solid fa-xmark text-[10px]"></i> Ditolak
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openModal('{{ $item->id }}', '{{ $item->kode_tracking }}', '{{ $item->status }}', '{{ addslashes($item->catatan_petugas ?? '') }}')" class="p-2 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 transition-colors" title="Ubah Status & Catatan">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                
                                <form action="{{ route('admin.layanan.permohonan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan {{ $item->kode_tracking }}?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 transition-colors" title="Hapus Permohonan">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400 text-sm">
                            Belum ada data permohonan surat warga.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100">
            {{ $permohonanList->links() }}
        </div>

    </div>

</div>

<!-- Modal Update Status -->
<div id="statusModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100">
        
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Perbarui Status Permohonan</h3>
                <span id="modalKode" class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded"></span>
            </div>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="formStatus" method="POST" action="">
            @csrf

            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Permohonan</label>
                    <select name="status" id="modalSelectStatus" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm font-semibold bg-white">
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="diproses">Sedang Diproses / Dicetak</option>
                        <option value="selesai">Selesai / Siap Diambil di Kantor</option>
                        <option value="ditolak">Ditolak / Dokumen Kurang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Petugas (Akan Tampil ke Warga)</label>
                    <textarea name="catatan_petugas" id="modalCatatan" rows="3" placeholder="Contoh: Surat sudah ditandatangani Kepala Desa, silakan datang ke kantor desa membawa fotokopi KTP/KK." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openModal(id, kode, status, catatan) {
        document.getElementById('modalKode').innerText = kode;
        document.getElementById('modalSelectStatus').value = status;
        document.getElementById('modalCatatan').value = catatan;
        document.getElementById('formStatus').action = '{{ url("admin/layanan/permohonan") }}/' + id + '/status';
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }
</script>
@endsection
