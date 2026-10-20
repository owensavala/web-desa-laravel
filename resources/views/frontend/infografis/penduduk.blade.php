@extends('layouts.app')

@section('title', 'Infografis Kependudukan - Desa Kupal')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-emerald-900 to-teal-800 text-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-emerald-300 font-bold text-xs uppercase tracking-widest block mb-2">Transparansi Data</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold">Infografis Demografi Penduduk</h1>
        <p class="text-emerald-100 text-sm sm:text-base mt-2 max-w-2xl">Statistik data kependudukan Desa Kupal berdasarkan jenis kelamin, kelompok usia, pendidikan, dan status perkawinan.</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Key Numbers -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_penduduk ?? 0) }}</span>
                    <span class="text-xs text-slate-500 font-semibold block">Total Penduduk</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-house-chimney-user"></i>
                </div>
                <div>
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_kk ?? 0) }}</span>
                    <span class="text-xs text-slate-500 font-semibold block">Kepala Keluarga (KK)</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-mars"></i>
                </div>
                <div>
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_laki ?? 0) }}</span>
                    <span class="text-xs text-slate-500 font-semibold block">Laki-Laki</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-venus"></i>
                </div>
                <div>
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($demografi->total_perempuan ?? 0) }}</span>
                    <span class="text-xs text-slate-500 font-semibold block">Perempuan</span>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            
            <!-- Gender Chart -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-venus-mars text-emerald-600"></i> Proporsi Jenis Kelamin
                </h3>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>

            <!-- Age Groups Chart -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-children text-emerald-600"></i> Kelompok Usia Penduduk
                </h3>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>

            <!-- Education Chart -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-emerald-600"></i> Tingkat Pendidikan
                </h3>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="educationChart"></canvas>
                </div>
            </div>

            <!-- Religion & Marital Status -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-ring text-emerald-600"></i> Status Perkawinan & Agama
                </h3>
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-700">Kawin (Menikah)</span>
                        <span class="font-bold text-slate-900">{{ $demografi->status_kawin ?? 0 }} Jiwa</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-700">Belum Kawin</span>
                        <span class="font-bold text-slate-900">{{ $demografi->status_belum_kawin ?? 0 }} Jiwa</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-700">Cerai Hidup / Mati</span>
                        <span class="font-bold text-slate-900">{{ ($demografi->status_cerai_hidup ?? 0) + ($demografi->status_cerai_mati ?? 0) }} Jiwa</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-between text-emerald-950">
                        <span class="text-sm font-semibold">Agama Terbanyak (Islam)</span>
                        <span class="font-bold text-emerald-800">{{ $demografi->agama_islam ?? 0 }} Jiwa</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    // 1. Gender Chart
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-Laki', 'Perempuan'],
            datasets: [{
                data: [{{ $demografi->total_laki ?? 90 }}, {{ $demografi->total_perempuan ?? 80 }}],
                backgroundColor: ['#3b82f6', '#ec4899'],
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

    // 2. Age Groups Chart
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ['Anak (0-14)', 'Remaja (15-24)', 'Dewasa (25-59)', 'Lansia (60+)'],
            datasets: [
                {
                    label: 'Laki-Laki',
                    data: [
                        {{ $demografi->umur_anak_laki ?? 20 }},
                        {{ $demografi->umur_remaja_laki ?? 30 }},
                        {{ $demografi->umur_dewasa_laki ?? 29 }},
                        {{ $demografi->umur_lansia_laki ?? 11 }}
                    ],
                    backgroundColor: '#059669'
                },
                {
                    label: 'Perempuan',
                    data: [
                        {{ $demografi->umur_anak_perempuan ?? 16 }},
                        {{ $demografi->umur_remaja_perempuan ?? 25 }},
                        {{ $demografi->umur_dewasa_perempuan ?? 24 }},
                        {{ $demografi->umur_lansia_perempuan ?? 15 }}
                    ],
                    backgroundColor: '#10b981'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // 3. Education Chart
    new Chart(document.getElementById('educationChart'), {
        type: 'bar',
        data: {
            labels: ['SD / Sederajat', 'SMP / Sederajat', 'SMA / SMK', 'Perguruan Tinggi'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [
                    {{ $demografi->pendidikan_sd ?? 120 }},
                    {{ $demografi->pendidikan_smp ?? 60 }},
                    {{ $demografi->pendidikan_sma ?? 50 }},
                    {{ $demografi->pendidikan_pt ?? 15 }}
                ],
                backgroundColor: '#3b82f6',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
