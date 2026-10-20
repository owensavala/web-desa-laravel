@extends('layouts.app')

@section('title', 'Transparansi APBDes - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Transparansi Anggaran</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Infografis APBDes (Anggaran Pendapatan & Belanja Desa)</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Laporan transparansi pendapatan, belanja, dan pembiayaan pembangunan demi akuntabilitas publik Pemerintah Desa Kupal.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Tahun Dropdown -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-10 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="font-extrabold text-slate-900 text-lg">Pilih Tahun Anggaran</h3>
                <p class="text-xs text-slate-500">Melihat data transparansi anggaran APBDes per tahun</p>
            </div>
            <form action="{{ route('infografis.apbd') }}" method="GET" class="flex items-center gap-2">
                <select name="tahun" onchange="this.form.submit()" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach($years as $yr)
                        <option value="{{ $yr }}" {{ ($summary?->tahun == $yr) ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($summary)
            <!-- Key Figures Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                <!-- Total Pendapatan -->
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-8 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-200">Total Pendapatan</span>
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-arrow-down-left"></i>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold mb-1">
                        Rp {{ number_format($summary->total_pendapatan, 0, ',', '.') }}
                    </div>
                    <span class="text-xs text-emerald-100">Sumber: PAD, Transfer DD, dll.</span>
                </div>

                <!-- Total Belanja -->
                <div class="bg-gradient-to-br from-amber-600 to-amber-800 rounded-3xl p-8 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-200">Total Belanja</span>
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold mb-1">
                        Rp {{ number_format($summary->total_belanja, 0, ',', '.') }}
                    </div>
                    <span class="text-xs text-amber-100">Pembangunan & Operasional Desa</span>
                </div>

                <!-- Surplus / Defisit -->
                @php
                    $selisih = $summary->total_pendapatan - $summary->total_belanja;
                @endphp
                <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Surplus / Defisit</span>
                        <div class="w-10 h-10 rounded-xl {{ $selisih >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} flex items-center justify-center text-lg">
                            <i class="fa-solid {{ $selisih >= 0 ? 'fa-scale-balanced' : 'fa-triangle-exclamation' }}"></i>
                        </div>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold {{ $selisih >= 0 ? 'text-emerald-600' : 'text-rose-600' }} mb-1">
                        Rp {{ number_format($selisih, 0, ',', '.') }}
                    </div>
                    <span class="text-xs text-slate-400">{{ $selisih >= 0 ? 'Surplus Anggaran' : 'Defisit Anggaran' }}</span>
                </div>

            </div>

            <!-- Breakdown Charts & Details -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
                
                <!-- Chart Sumber Pendapatan -->
                <div class="lg:col-span-5 bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-chart-pie text-emerald-600"></i> Sumber Pendapatan Desa
                    </h3>
                    <div class="h-64 flex items-center justify-center mb-6">
                        <canvas id="pendapatanChart"></canvas>
                    </div>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between p-3 rounded-xl bg-slate-50">
                            <span class="text-slate-600">Pendapatan Asli Desa (PAD)</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($summary->pendapatan_pad ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between p-3 rounded-xl bg-slate-50">
                            <span class="text-slate-600">Pendapatan Transfer (Dana Desa)</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($summary->pendapatan_transfer ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between p-3 rounded-xl bg-slate-50">
                            <span class="text-slate-600">Pendapatan Lain-lain</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($summary->pendapatan_lain ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Rincian Belanja per Bidang & Kegiatan -->
                <div class="lg:col-span-7 bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-emerald-600"></i> Rincian Realisasi Kegiatan Belanja
                    </h3>
                    
                    @if(count($details) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs sm:text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200 text-slate-400 uppercase text-[11px] font-bold">
                                        <th class="py-3 px-2">Bidang</th>
                                        <th class="py-3 px-2">Kegiatan</th>
                                        <th class="py-3 px-2 text-right">Anggaran</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($details as $item)
                                        <tr class="hover:bg-slate-50/80 transition-colors">
                                            <td class="py-3 px-2 font-semibold text-emerald-700">{{ $item->bidang }}</td>
                                            <td class="py-3 px-2 text-slate-700">{{ $item->kegiatan }}</td>
                                            <td class="py-3 px-2 text-right font-bold text-slate-900">
                                                Rp {{ number_format($item->anggaran, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 text-slate-400">
                            Belum ada rincian kegiatan belanja untuk tahun ini.
                        </div>
                    @endif
                </div>

            </div>

        @else
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 text-slate-500">
                Data APBDes belum tersedia.
            </div>
        @endif

    </div>
</section>
@endsection

@push('scripts')
@if($summary)
<script>
    new Chart(document.getElementById('pendapatanChart'), {
        type: 'doughnut',
        data: {
            labels: ['PAD', 'Transfer (Dana Desa)', 'Lain-lain'],
            datasets: [{
                data: [
                    {{ $summary->pendapatan_pad ?? 0 }},
                    {{ $summary->pendapatan_transfer ?? 0 }},
                    {{ $summary->pendapatan_lain ?? 0 }}
                ],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endif
@endpush
