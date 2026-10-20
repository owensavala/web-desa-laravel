<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Desa Kupal</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Gradient Accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-white rounded-3xl p-8 sm:p-10 shadow-2xl relative z-10 border border-slate-100">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg shadow-emerald-500/30">
                <i class="fa-solid fa-landmark"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900">Portal Administrator</h2>
            <p class="text-xs text-slate-500 mt-1 font-semibold">Pemerintah Desa Kupal, Kec. Bacan Selatan</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs">
            <i class="fa-solid fa-triangle-exclamation mr-1.5"></i>
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs">
            <i class="fa-solid fa-circle-check mr-1.5"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username</label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus
                        placeholder="Masukkan username admin"
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        placeholder="••••••••"
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="rounded text-emerald-600 focus:ring-emerald-500">
                    <span>Ingat Sesi Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <a href="{{ route('home') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 transition-colors inline-flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama
            </a>
        </div>

    </div>

</body>
</html>
