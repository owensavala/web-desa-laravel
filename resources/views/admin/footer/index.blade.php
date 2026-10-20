@extends('layouts.admin')

@section('title', 'Identitas Desa & Tema Warna - Admin Desa')
@section('header_title', 'Identitas Desa, Logo & Tema Warna')

@section('content')
<div class="max-w-4xl bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
    <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Pengaturan Identitas & Tema Website</h2>
            <p class="text-xs text-slate-500">Ubah nama desa, kecamatan, kabupaten, logo resmi, dan skema tema warna website untuk klien desa yang berbeda.</p>
        </div>
    </div>

    <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- SECTION 1: Identitas Desa & Logo -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-landmark"></i> Nama & Identitas Desa
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Desa</label>
                    <input type="text" name="nama_desa" value="{{ old('nama_desa', $footer->nama_desa ?? 'DESA KUPAL') }}" required placeholder="Contoh: DESA KUPAL / DESA BUKIT SERE" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $footer->kecamatan ?? 'Kec. Bacan Selatan') }}" required placeholder="Contoh: Kec. Bacan Selatan" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kabupaten / Kota</label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten', $footer->kabupaten ?? 'Halmahera Selatan') }}" required placeholder="Contoh: Halmahera Selatan" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-900 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Upload Logo -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-center gap-6">
                <div class="shrink-0 text-center">
                    <span class="block text-[11px] font-bold text-slate-500 mb-2">Logo Saat Ini:</span>
                    @if($footer->logo_desa && file_exists(public_path('images/' . $footer->logo_desa)))
                        <div class="w-16 h-16 rounded-2xl bg-white p-2 border border-slate-200 shadow-sm flex items-center justify-center mx-auto">
                            <img src="{{ asset('images/' . $footer->logo_desa) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl mx-auto shadow-sm">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Logo Desa (PNG Transparan / JPG)</label>
                    <input type="file" name="logo_desa" accept="image/*" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                    <p class="text-[11px] text-slate-400 mt-1">Disarankan format PNG transparan dengan resolusi persegi (contoh: 200x200 px).</p>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Pilihan Tema Warna Website -->
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-palette"></i> Pilih Tema Warna Utama Website
            </h3>
            <p class="text-xs text-slate-500 mb-4">Pilih satu tema warna yang cocok dengan karakter desa (misal: Hijau untuk desa agraris/wisata, Biru untuk desa pesisir/maritim, dll.):</p>

            @php
                $selectedTheme = $footer->tema_warna ?? 'emerald';
                $themeOptions = [
                    ['id' => 'emerald', 'name' => 'Hijau Zamrud (Alami & Wisata)', 'color' => '#059669', 'bg' => '#ecfdf5', 'border' => '#059669'],
                    ['id' => 'blue', 'name' => 'Biru Bahari (Pesisir & Nelayan)', 'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#2563eb'],
                    ['id' => 'indigo', 'name' => 'Biru Navy (Formal Pemerintahan)', 'color' => '#4f46e5', 'bg' => '#eef2ff', 'border' => '#4f46e5'],
                    ['id' => 'rose', 'name' => 'Merah Marun (Tegas & Berwibawa)', 'color' => '#e11d48', 'bg' => '#fff1f2', 'border' => '#e11d48'],
                    ['id' => 'amber', 'name' => 'Oranye Emas (Hangat & Dinamis)', 'color' => '#d97706', 'bg' => '#fffbeb', 'border' => '#d97706'],
                    ['id' => 'teal', 'name' => 'Toska Modern (Sejuk & Digital)', 'color' => '#0d9488', 'bg' => '#f0fdfa', 'border' => '#0d9488'],
                    ['id' => 'violet', 'name' => 'Ungu Megah (Adat & Budaya)', 'color' => '#7c3aed', 'bg' => '#f5f3ff', 'border' => '#7c3aed'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($themeOptions as $opt)
                    <label class="cursor-pointer">
                        <input type="radio" name="tema_warna" value="{{ $opt['id'] }}" class="peer sr-only" {{ $selectedTheme === $opt['id'] ? 'checked' : '' }}>
                        <div class="p-3.5 rounded-2xl border-2 border-slate-200 peer-checked:border-slate-900 peer-checked:ring-2 peer-checked:ring-slate-900/10 peer-checked:shadow-md transition-all flex items-center gap-3 bg-white hover:border-slate-300">
                            <span class="w-7 h-7 rounded-full shrink-0 shadow-inner" style="background-color: {{ $opt['color'] }};"></span>
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">{{ $opt['name'] }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $opt['color'] }}</span>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- SECTION 3: Kontak & Alamat -->
        <div class="pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-address-book"></i> Kontak & Alamat Kantor Desa
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Kantor Desa</label>
                    <textarea name="alamat" rows="2" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">{{ $footer->alamat }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="telepon" value="{{ $footer->telepon }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Resmi Desa</label>
                        <input type="email" name="email" value="{{ $footer->email }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Link Facebook</label>
                        <input type="url" name="link_facebook" value="{{ $footer->link_facebook }}" placeholder="https://facebook.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Link Instagram</label>
                        <input type="url" name="link_instagram" value="{{ $footer->link_instagram }}" placeholder="https://instagram.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Link YouTube</label>
                        <input type="url" name="link_youtube" value="{{ $footer->link_youtube }}" placeholder="https://youtube.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Link TikTok</label>
                        <input type="url" name="link_tiktok" value="{{ $footer->link_tiktok }}" placeholder="https://tiktok.com/@..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Hak Cipta (Copyright Footer)</label>
                    <input type="text" name="copyright_text" value="{{ $footer->copyright_text }}" placeholder="Pemerintah Desa - Hak Cipta Dilindungi." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-7 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Identitas & Tema Warna
            </button>
        </div>
    </form>
</div>
@endsection
