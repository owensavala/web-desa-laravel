<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Resmi ' . ($globalFooter->nama_desa ?? 'Desa Kupal') . ' - ' . ($globalFooter->kabupaten ?? 'Halmahera Selatan'))</title>
    
    <!-- SEO & Social Media Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Website Resmi Pemerintah ' . ($globalFooter->nama_desa ?? 'Desa Kupal') . ', ' . ($globalFooter->kecamatan ?? 'Kecamatan Bacan Selatan') . ', ' . ($globalFooter->kabupaten ?? 'Halmahera Selatan') . '. Layanan mandiri permohonan surat online, berita, transparansi APBDes, dan informasi kependudukan.')">
    <meta property="og:title" content="@yield('title', 'Website Resmi ' . ($globalFooter->nama_desa ?? 'Desa Kupal'))">
    <meta property="og:description" content="@yield('meta_description', 'Portal informasi dan pelayanan publik digital Pemerintah ' . ($globalFooter->nama_desa ?? 'Desa Kupal'))">
    <meta property="og:image" content="@yield('meta_image', asset('images/' . ($globalFooter->logo_desa ?? 'logo.png')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="{{ $c['600'] ?? '#059669' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    
    @php
        $themeColor = $globalFooter->tema_warna ?? 'emerald';
        $themePalettes = [
            'emerald' => [ // Hijau Zamrud (Default)
                '50' => '#ecfdf5', '100' => '#d1fae5', '200' => '#a7f3d0', '300' => '#6ee7b7',
                '400' => '#34d399', '500' => '#10b981', '600' => '#059669', '700' => '#047857',
                '800' => '#065f46', '900' => '#064e3b', '950' => '#022c22'
            ],
            'blue' => [ // Biru Bahari / Pesisir
                '50' => '#eff6ff', '100' => '#dbeafe', '200' => '#bfdbfe', '300' => '#93c5fd',
                '400' => '#60a5fa', '500' => '#3b82f6', '600' => '#2563eb', '700' => '#1d4ed8',
                '800' => '#1e40af', '900' => '#1e3a8a', '950' => '#172554'
            ],
            'indigo' => [ // Biru Formal / Navy
                '50' => '#eef2ff', '100' => '#e0e7ff', '200' => '#c7d2fe', '300' => '#a5b4fc',
                '400' => '#818cf8', '500' => '#6366f1', '600' => '#4f46e5', '700' => '#4338ca',
                '800' => '#3730a3', '900' => '#312e81', '950' => '#1e1b4b'
            ],
            'rose' => [ // Merah Marun / Elegan
                '50' => '#fff1f2', '100' => '#ffe4e6', '200' => '#fecdd3', '300' => '#fda4af',
                '400' => '#fb7185', '500' => '#f43f5e', '600' => '#e11d48', '700' => '#be123c',
                '800' => '#9f1239', '900' => '#881337', '950' => '#4c0519'
            ],
            'amber' => [ // Oranye Emas / Hangat
                '50' => '#fffbeb', '100' => '#fef3c7', '200' => '#fde68a', '300' => '#fcd34d',
                '400' => '#fbbf24', '500' => '#f59e0b', '600' => '#d97706', '700' => '#b45309',
                '800' => '#92400e', '900' => '#78350f', '950' => '#451a03'
            ],
            'teal' => [ // Toska Modern
                '50' => '#f0fdfa', '100' => '#ccfbf1', '200' => '#99f6e4', '300' => '#5eead4',
                '400' => '#2dd4bf', '500' => '#14b8a6', '600' => '#0d9488', '700' => '#0f766e',
                '800' => '#115e59', '900' => '#134e4a', '950' => '#042f2e'
            ],
            'violet' => [ // Ungu Megah
                '50' => '#f5f3ff', '100' => '#ede9fe', '200' => '#ddd6fe', '300' => '#c4b5fd',
                '400' => '#a78bfa', '500' => '#8b5cf6', '600' => '#7c3aed', '700' => '#6d28d9',
                '800' => '#5b21b6', '900' => '#4c1d95', '950' => '#2e1065'
            ],
        ];
        $c = $themePalettes[$themeColor] ?? $themePalettes['emerald'];
    @endphp

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-emerald-50: {{ $c['50'] }};
            --color-emerald-100: {{ $c['100'] }};
            --color-emerald-200: {{ $c['200'] }};
            --color-emerald-300: {{ $c['300'] }};
            --color-emerald-400: {{ $c['400'] }};
            --color-emerald-500: {{ $c['500'] }};
            --color-emerald-600: {{ $c['600'] }};
            --color-emerald-700: {{ $c['700'] }};
            --color-emerald-800: {{ $c['800'] }};
            --color-emerald-900: {{ $c['900'] }};
            --color-emerald-950: {{ $c['950'] }};
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; transition: font-size 0.2s ease; }
        .hero-gradient { background: linear-gradient(135deg, {{ $c['900'] }} 0%, {{ $c['700'] }} 100%); }
        html.font-lg { font-size: 18px; }
        html.font-xl { font-size: 20px; }
        html.high-contrast { filter: contrast(125%) saturate(110%); }
        html.high-contrast body { background-color: #f8fafc; color: #020617; }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee { display: inline-block; white-space: nowrap; animation: marquee 28s linear infinite; }
        .animate-marquee:hover { animation-play-state: paused; }
    </style>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: 'var(--color-emerald-50)',
                            100: 'var(--color-emerald-100)',
                            200: 'var(--color-emerald-200)',
                            300: 'var(--color-emerald-300)',
                            400: 'var(--color-emerald-400)',
                            500: 'var(--color-emerald-500)',
                            600: 'var(--color-emerald-600)',
                            700: 'var(--color-emerald-700)',
                            800: 'var(--color-emerald-800)',
                            900: 'var(--color-emerald-900)',
                            950: 'var(--color-emerald-950)',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome & Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js for Infographics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Top Utility & Accessibility Bar -->
    <div class="bg-slate-900 text-slate-300 text-[11px] py-1.5 px-4 border-b border-slate-800">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5 font-medium text-slate-300">
                    <i class="fa-regular fa-calendar text-emerald-400"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
                <span class="hidden sm:inline-block text-slate-600">•</span>
                <span class="hidden sm:flex items-center gap-1.5 text-slate-400">
                    <i class="fa-solid fa-clock text-emerald-400"></i> Pelayanan: Sen - Jum (08:00 - 15:30 WIT)
                </span>
            </div>

            <!-- Accessibility Controls & Hotline -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1 bg-slate-800 px-2 py-0.5 rounded-lg border border-slate-700/60">
                    <span class="text-slate-400 mr-1 text-[10px] hidden md:inline">Aksesibilitas:</span>
                    <button onclick="changeFontSize('normal')" title="Ukuran Font Normal" class="px-1.5 py-0.2 hover:text-emerald-400 font-bold transition-colors">A</button>
                    <button onclick="changeFontSize('lg')" title="Perbesar Tulisan" class="px-1.5 py-0.2 hover:text-emerald-400 font-bold text-xs transition-colors">A+</button>
                    <button onclick="changeFontSize('xl')" title="Tulisan Ekstra Besar" class="px-1.5 py-0.2 hover:text-emerald-400 font-black text-sm transition-colors">A++</button>
                    <span class="text-slate-600">|</span>
                    <button onclick="toggleContrast()" title="Mode Kontras Tinggi" class="px-1 hover:text-amber-400 transition-colors">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                    </button>
                </div>

                @if($globalFooter?->telepon)
                <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $globalFooter->telepon) }}" target="_blank" class="hidden md:flex items-center gap-1.5 text-emerald-400 hover:text-emerald-300 font-semibold transition-colors">
                    <i class="fa-brands fa-whatsapp text-xs"></i> Hotline: {{ $globalFooter->telepon }}
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Top Announcement Bar (Running Ticker) -->
    @php
        $announcements = \App\Models\Pengumuman::where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', now()->toDateString())
            ->whereDate('tanggal_selesai', '>=', now()->toDateString())
            ->get();
    @endphp

    @if($announcements->count() > 0)
    <div class="bg-emerald-950 text-emerald-200 text-xs py-2 px-4 shadow-sm border-b border-emerald-900/60 flex items-center">
        <div class="container mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 font-semibold shrink-0 bg-emerald-800/80 px-2.5 py-0.5 rounded-full text-white text-[11px]">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                <i class="fa-solid fa-bullhorn text-amber-300"></i> PENGUMUMAN
            </div>
            <div class="overflow-hidden whitespace-nowrap w-full">
                <div class="inline-block animate-marquee pl-4 hover:pause">
                    @foreach($announcements as $ann)
                        <span class="mr-12 font-medium">
                            <i class="fa-solid fa-circle-dot text-[8px] text-emerald-400 mr-2"></i>
                            {{ $ann->judul }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="hidden md:flex items-center gap-3 shrink-0 text-emerald-300">
                <span class="text-[11px]"><i class="fa-regular fa-clock mr-1"></i> {{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm transition-all duration-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if($globalFooter?->logo_desa && file_exists(public_path('images/' . $globalFooter->logo_desa)))
                        <div class="w-12 h-12 rounded-xl bg-white p-1 shadow-md border border-slate-100 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform">
                            <img src="{{ asset('images/' . $globalFooter->logo_desa) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-emerald-600 to-emerald-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-landmark text-2xl"></i>
                        </div>
                    @endif
                    <div>
                        <span class="text-xl font-bold tracking-tight text-slate-900 block leading-tight group-hover:text-emerald-700 transition-colors uppercase">
                            {{ $globalFooter->nama_desa ?? 'DESA KUPAL' }}
                        </span>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-widest block">
                            {{ $globalFooter->kecamatan ?? 'Kec. Bacan Selatan' }} • {{ $globalFooter->kabupaten ?? 'Halsel' }}
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Beranda
                    </a>

                    <!-- Dropdown Profil -->
                    <div class="relative group">
                        <button class="px-3.5 py-2 text-sm font-semibold rounded-lg flex items-center gap-1.5 transition-all {{ request()->routeIs('profil*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                            Profil Desa <i class="fa-solid fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                            <a href="{{ route('profil') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-circle-info text-emerald-600 w-5"></i> Visi, Misi & Sejarah
                            </a>
                            <a href="{{ route('profil.sotk') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-sitemap text-emerald-600 w-5"></i> Struktur Organisasi (SOTK)
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('berita.index') }}" class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('berita*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Berita Desa
                    </a>

                    <!-- Dropdown Infografis -->
                    <div class="relative group">
                        <button class="px-3.5 py-2 text-sm font-semibold rounded-lg flex items-center gap-1.5 transition-all {{ request()->routeIs('infografis*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                            Transparansi <i class="fa-solid fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                            <a href="{{ route('infografis.penduduk') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-users text-emerald-600 w-5"></i> Demografi Penduduk
                            </a>
                            <a href="{{ route('infografis.apbd') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-chart-pie text-emerald-600 w-5"></i> Transparansi APBDes
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown Galeri -->
                    <div class="relative group">
                        <button class="px-3.5 py-2 text-sm font-semibold rounded-lg flex items-center gap-1.5 transition-all {{ request()->routeIs('galeri*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                            Galeri <i class="fa-solid fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                            <a href="{{ route('galeri.foto') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-images text-emerald-600 w-5"></i> Galeri Foto
                            </a>
                            <a href="{{ route('galeri.video') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-700 text-slate-700">
                                <i class="fa-solid fa-video text-emerald-600 w-5"></i> Galeri Video
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('layanan.index') }}" class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('layanan*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Layanan Mandiri
                    </a>

                    <a href="{{ route('kritik-saran.index') }}" class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('kritik-saran*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Kritik & Saran
                    </a>
                </nav>

                <!-- Right Action Button -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-700 hover:text-emerald-700 bg-slate-100 hover:bg-emerald-50 rounded-xl transition-all border border-slate-200">
                        <i class="fa-solid fa-lock"></i> Portal Admin
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center">
                    <button id="mobile-menu-btn" class="p-2.5 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Beranda</a>
            <a href="{{ route('profil') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Profil Desa</a>
            <a href="{{ route('profil.sotk') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Struktur Organisasi (SOTK)</a>
            <a href="{{ route('berita.index') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Berita Desa</a>
            <a href="{{ route('infografis.penduduk') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Demografi Penduduk</a>
            <a href="{{ route('infografis.apbd') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Transparansi APBDes</a>
            <a href="{{ route('galeri.foto') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Galeri Foto</a>
            <a href="{{ route('galeri.video') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Galeri Video</a>
            <a href="{{ route('layanan.index') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Layanan Mandiri</a>
            <a href="{{ route('kritik-saran.index') }}" class="block px-3 py-2 text-base font-semibold rounded-lg text-slate-800 hover:bg-emerald-50">Kritik & Saran</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ route('admin.login') }}" class="block w-full text-center py-2.5 px-4 rounded-xl bg-emerald-600 text-white font-bold text-sm">
                    <i class="fa-solid fa-lock mr-2"></i> Masuk Panel Admin
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @if(session('success'))
        <div class="container mx-auto px-4 mt-6">
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                <div>
                    <span class="font-bold">Berhasil!</span> {{ session('success') }}
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="container mx-auto px-4 mt-6">
            <div class="bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-xl"></i>
                <div>
                    <span class="font-bold">Terjadi Kendala:</span> {{ session('error') }}
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 mt-20 border-t border-slate-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- Col 1: Identitas Desa -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        @if($globalFooter?->logo_desa && file_exists(public_path('images/' . $globalFooter->logo_desa)))
                            <div class="w-12 h-12 rounded-xl bg-white p-1 shadow-lg flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/' . $globalFooter->logo_desa) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-xl bg-emerald-600 flex items-center justify-center text-white shadow-lg">
                                <i class="fa-solid fa-landmark text-2xl"></i>
                            </div>
                        @endif
                        <div>
                            <span class="text-xl font-bold text-white block uppercase">{{ $globalFooter->nama_desa ?? 'DESA KUPAL' }}</span>
                            <span class="text-xs font-semibold text-emerald-400 uppercase tracking-widest block">{{ $globalFooter->kecamatan ?? 'Kec. Bacan Selatan' }}</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Website Resmi Pemerintah {{ $globalFooter->nama_desa ?? 'Desa Kupal' }} sebagai sarana keterbukaan informasi publik, pelayanan prima, dan publikasi potensi desa.
                    </p>
                    <div class="flex items-center gap-3">
                        @if($globalFooter?->link_facebook)
                        <a href="{{ $globalFooter->link_facebook }}" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition-all">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        @endif
                        @if($globalFooter?->link_instagram)
                        <a href="{{ $globalFooter->link_instagram }}" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        @endif
                        @if($globalFooter?->link_youtube)
                        <a href="{{ $globalFooter->link_youtube }}" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition-all">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        @endif
                        @if($globalFooter?->link_tiktok)
                        <a href="{{ $globalFooter->link_tiktok }}" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition-all">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-white font-bold text-base mb-5 border-l-4 border-emerald-500 pl-3">Jelajahi Portal</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('profil') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Profil & Sejarah Desa</a></li>
                        <li><a href="{{ route('profil.sotk') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Struktur Perangkat Desa</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Berita & Kegiatan Terkini</a></li>
                        <li><a href="{{ route('infografis.apbd') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Transparansi APBDes</a></li>
                        <li><a href="{{ route('layanan.index') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Download Surat & Formulir</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kontak & Jam Operasional -->
                <div>
                    <h3 class="text-white font-bold text-base mb-5 border-l-4 border-emerald-500 pl-3">Kontak Desa</h3>
                    <ul class="space-y-3.5 text-sm text-slate-400">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-emerald-400 mt-1 shrink-0"></i>
                            <span>{{ $globalFooter->alamat ?? 'Jl. Desa Kupal, Kec. Bacan Selatan, Kab. Halmahera Selatan' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-emerald-400 shrink-0"></i>
                            <span>{{ $globalFooter->telepon ?? '0852-1840-3628' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-emerald-400 shrink-0"></i>
                            <span>{{ $globalFooter->email ?? 'desakupal@gmail.go.id' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-emerald-400 shrink-0"></i>
                            <span>Senin - Jumat: 08:00 - 15:30 WIT</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Peta Lokasi -->
                <div>
                    <h3 class="text-white font-bold text-base mb-5 border-l-4 border-emerald-500 pl-3">Lokasi Kantor Desa</h3>
                    <div class="rounded-2xl overflow-hidden border border-slate-800 shadow-md h-44 w-full bg-slate-800">
                        @php
                            $mapUrl = $globalProfil->gambar_peta ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1393.6099631158868!2d127.4771603029561!3d-0.6672357875266723!2m3!1f90!2f0!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x2d633928247195d7%3A0x50371dc95a3280e8!2sKnt%2C%20Desa%20Kupal!5e1!3m2!1sid!2sid!4v1755110';
                            if (str_contains($mapUrl, 'src="')) {
                                preg_match('/src="([^"]+)"/', $mapUrl, $matches);
                                $mapUrl = $matches[1] ?? $mapUrl;
                            }
                        @endphp
                        <iframe 
                            src="{{ $mapUrl }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-slate-800/80 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} {{ $globalFooter->copyright_text ?? 'Pemerintah Desa Kupal - Halmahera Selatan. Hak Cipta Dilindungi.' }}</p>
                <div class="flex items-center gap-4">
                    <span class="text-emerald-400 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved"></i> Sistem Informasi Desa Laravel 11
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Citizen Action Hub & WhatsApp Widget -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3" id="citizen-floating-hub">
        
        <!-- Back To Top Button -->
        <button id="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white text-slate-700 shadow-lg border border-slate-200 flex items-center justify-center hover:bg-emerald-50 hover:text-emerald-700 transition-all opacity-0 pointer-events-none translate-y-3" title="Kembali ke Atas">
            <i class="fa-solid fa-arrow-up text-sm"></i>
        </button>

        <!-- Popup Menu Box -->
        <div id="hub-menu-popup" class="hidden w-80 sm:w-96 bg-white rounded-3xl shadow-2xl border border-slate-200/90 overflow-hidden transform transition-all duration-200 mb-2">
            
            <!-- Popup Header -->
            <div class="bg-gradient-to-r from-emerald-800 to-teal-700 p-5 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-lg">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm leading-tight">Pusat Layanan Warga</h4>
                            <span class="text-[11px] text-emerald-200">{{ $globalFooter->nama_desa ?? 'Pemerintah Desa Kupal' }}</span>
                        </div>
                    </div>
                    <button onclick="toggleCitizenHub()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Popup Menu Items -->
            <div class="p-4 space-y-2.5 max-h-[420px] overflow-y-auto text-xs">
                
                <!-- Chat WhatsApp -->
                @php
                    $waClean = preg_replace('/[^0-9]/', '', $globalFooter->telepon ?? '085218403628');
                    if (str_starts_with($waClean, '0')) {
                        $waClean = '62' . substr($waClean, 1);
                    }
                @endphp
                <a href="https://api.whatsapp.com/send?phone={{ $waClean }}&text={{ urlencode('Halo Admin Pemerintah ' . ($globalFooter->nama_desa ?? 'Desa Kupal') . ', saya warga ingin bertanya perihal layanan...') }}" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl bg-emerald-50/80 hover:bg-emerald-100/80 border border-emerald-200/80 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition-transform">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <span class="font-bold text-slate-800 block text-xs">Chat WhatsApp Petugas</span>
                        <span class="text-slate-500 text-[11px]">Respon cepat pada jam pelayanan kantor</span>
                    </div>
                </a>

                <!-- Permohonan E-Surat Online -->
                <a href="{{ route('layanan.index') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-slate-50 border border-slate-100 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <div>
                        <span class="font-bold text-slate-800 block text-xs">Pengajuan Surat Online</span>
                        <span class="text-slate-500 text-[11px]">Buat surat keterangan & lacak status berkas</span>
                    </div>
                </a>

                <!-- Kritik & Pengaduan -->
                <a href="{{ route('kritik-saran.index') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-slate-50 border border-slate-100 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div>
                        <span class="font-bold text-slate-800 block text-xs">Aspirasi & Pengaduan Warga</span>
                        <span class="text-slate-500 text-[11px]">Sampaikan saran langsung ke pemerintah desa</span>
                    </div>
                </a>

                <!-- Hotline Panggilan Darurat -->
                <div class="pt-2 border-t border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-rose-600 block mb-2 px-1">
                        <i class="fa-solid fa-phone-volume mr-1"></i> Kontak Darurat 24 Jam:
                    </span>
                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $globalFooter->kontak_darurat_puskesmas ?? '119') }}" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-800 font-bold flex items-center gap-1.5 transition-colors">
                            <i class="fa-solid fa-truck-medical text-rose-600"></i> Puskesmas / 119
                        </a>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $globalFooter->kontak_darurat_polsek ?? '110') }}" class="p-2 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-800 font-bold flex items-center gap-1.5 transition-colors">
                            <i class="fa-solid fa-shield text-blue-600"></i> Polsek / 110
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <!-- Main Floating Hub Trigger Button -->
        <button onclick="toggleCitizenHub()" class="relative flex items-center gap-3 px-4 py-3 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white shadow-xl shadow-emerald-700/30 font-bold text-xs transition-all hover:scale-105 group border-2 border-white">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-400"></span>
            </span>
            <i class="fa-solid fa-comments text-base"></i>
            <span class="hidden sm:inline-block">Layanan Warga</span>
        </button>

    </div>

    <!-- Scripts: Accessibility, Floating Hub & Back To Top -->
    <script>
        // Mobile Drawer Menu
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn?.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Floating Hub Toggle
        function toggleCitizenHub() {
            const popup = document.getElementById('hub-menu-popup');
            popup?.classList.toggle('hidden');
        }

        // Accessibility: Font Resizer
        function changeFontSize(size) {
            const html = document.documentElement;
            html.classList.remove('font-lg', 'font-xl');
            if (size === 'lg') html.classList.add('font-lg');
            if (size === 'xl') html.classList.add('font-xl');
            localStorage.setItem('desa_font_size', size);
        }

        // Accessibility: Contrast Toggle
        function toggleContrast() {
            const html = document.documentElement;
            html.classList.toggle('high-contrast');
            localStorage.setItem('desa_contrast', html.classList.contains('high-contrast') ? 'high' : 'normal');
        }

        // Restore user accessibility settings
        document.addEventListener('DOMContentLoaded', () => {
            const savedSize = localStorage.getItem('desa_font_size');
            if (savedSize) changeFontSize(savedSize);

            const savedContrast = localStorage.getItem('desa_contrast');
            if (savedContrast === 'high') {
                document.documentElement.classList.add('high-contrast');
            }

            // Back to Top button scroll handler
            const btt = document.getElementById('back-to-top');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 350) {
                    btt?.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-3');
                    btt?.classList.add('opacity-100', 'translate-y-0');
                } else {
                    btt?.classList.add('opacity-0', 'pointer-events-none', 'translate-y-3');
                    btt?.classList.remove('opacity-100', 'translate-y-0');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
