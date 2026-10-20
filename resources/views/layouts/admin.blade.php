<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Desa Kupal')</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        primary: {
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col shrink-0 border-r border-slate-800 transition-all duration-300">
        <!-- Logo -->
        <div class="h-20 flex items-center px-6 gap-3 border-b border-slate-800">
            <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center text-white font-bold shadow-md">
                <i class="fa-solid fa-landmark"></i>
            </div>
            <div>
                <span class="text-white font-bold text-base block leading-tight">Admin Desa</span>
                <span class="text-emerald-400 text-[11px] font-semibold uppercase tracking-wider block">Desa Kupal</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-grow p-4 space-y-1 overflow-y-auto text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/30' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-gauge w-5 text-center"></i> Dashboard
            </a>

            <div class="pt-4 pb-1 px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Konten Publik</div>

            <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.berita*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-newspaper w-5 text-center"></i> Kelola Berita
            </a>

            <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.pengumuman*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-bullhorn w-5 text-center"></i> Pengumuman Ticker
            </a>

            <a href="{{ route('admin.slider.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.slider*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-images w-5 text-center"></i> Hero Slider Banner
            </a>

            <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.galeri*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-photo-film w-5 text-center"></i> Galeri Foto & Video
            </a>

            <div class="pt-4 pb-1 px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Pemerintahan & Data</div>

            <a href="{{ route('admin.profil.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.profil*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-circle-info w-5 text-center"></i> Profil & Sambutan
            </a>

            <a href="{{ route('admin.sotk.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.sotk*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-sitemap w-5 text-center"></i> Aparatur Desa (SOTK)
            </a>

            <a href="{{ route('admin.demografi.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.demografi*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-users w-5 text-center"></i> Data Demografi
            </a>

            <a href="{{ route('admin.apbdes.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.apbdes*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i> Transparansi APBDes
            </a>

            <div class="pt-4 pb-1 px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Layanan & Partisipasi</div>

            <a href="{{ route('admin.layanan.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.layanan*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-file-arrow-down w-5 text-center"></i> Dokumen Layanan
            </a>

            <a href="{{ route('admin.saran.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.saran*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-envelope-open-text w-5 text-center"></i> Kritik & Saran
            </a>

            <div class="pt-4 pb-1 px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500">Sistem</div>

            <a href="{{ route('admin.footer.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.footer*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-palette w-5 text-center"></i> Identitas & Tema Warna
            </a>

            <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.pengguna*') ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <i class="fa-solid fa-user-shield w-5 text-center"></i> Kelola Administrator
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-800 flex items-center justify-between text-xs">
            <a href="{{ route('home') }}" target="_blank" class="text-slate-400 hover:text-emerald-400 flex items-center gap-1.5 font-bold">
                <i class="fa-solid fa-globe"></i> Lihat Web Publik
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col h-full overflow-hidden">
        
        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 sm:px-8 flex items-center justify-between shrink-0 shadow-sm">
            <h1 class="text-xl font-extrabold text-slate-900">
                @yield('header_title', 'Dashboard')
            </h1>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->username ?? 'A', 0, 1)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="text-xs font-bold text-slate-800 block">{{ Auth::guard('admin')->user()->nama ?? Auth::guard('admin')->user()->username }}</span>
                        <span class="text-[10px] text-emerald-600 font-semibold block">Administrator</span>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Keluar / Logout">
                        <i class="fa-solid fa-power-off text-base"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Body Scrollable Content -->
        <main class="flex-grow overflow-y-auto p-6 sm:p-8 bg-slate-50">
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-lg"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
