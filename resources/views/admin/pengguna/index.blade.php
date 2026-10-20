@extends('layouts.admin')

@section('title', 'Kelola Admin - Admin Desa Kupal')
@section('header_title', 'Manajemen Akun Administrator')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Form Tambah Admin -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm h-fit">
        <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-user-plus text-emerald-600"></i> Tambah Akun Admin Baru
        </h3>

        <form action="{{ route('admin.pengguna.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Contoh: Muhammad Syafi'i" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username Login</label>
                <input type="text" name="username" required placeholder="Contoh: adminkupal" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password Baru</label>
                <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-check"></i> Daftarkan Admin
            </button>
        </form>
    </div>

    <!-- List Admin -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-users-gear text-emerald-600"></i> Daftar Akun Administrator
        </h3>

        <div class="space-y-4">
            @foreach($admins as $adm)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr($adm->username, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900">{{ $adm->nama ?: $adm->username }}</h4>
                            <span class="text-xs text-slate-500 font-mono">@ {{ $adm->username }}</span>
                        </div>
                    </div>
                    @if(Auth::guard('admin')->user()->id_admin !== $adm->id_admin)
                        <form action="{{ route('admin.pengguna.destroy', $adm->id_admin) }}" method="POST" onsubmit="return confirm('Hapus akun admin ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    @else
                        <span class="text-[11px] font-bold text-emerald-600 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                            Sedang Digunakan
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
