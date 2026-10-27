<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

// ================= ROUTE PUBLIK =================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('profil')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil');
    Route::get('/sotk', [ProfilController::class, 'sotk'])->name('profil.sotk');
});

Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/{slug}', [BeritaController::class, 'detail'])->name('berita.detail');
});

Route::prefix('infografis')->group(function () {
    Route::get('/penduduk', [InfografisController::class, 'penduduk'])->name('infografis.penduduk');
    Route::get('/apbd', [InfografisController::class, 'apbd'])->name('infografis.apbd');
});

Route::prefix('galeri')->group(function () {
    Route::get('/foto', [GaleriController::class, 'foto'])->name('galeri.foto');
    Route::get('/video', [GaleriController::class, 'video'])->name('galeri.video');
});

Route::prefix('layanan')->group(function () {
    Route::get('/', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/permohonan', [LayananController::class, 'storePermohonan'])->name('layanan.permohonan.store');
    Route::get('/download/{id}', [LayananController::class, 'download'])->name('layanan.download');
});

Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran.index');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');


// ================= ROUTE ADMIN =================
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // Berita
        Route::get('/berita', [AdminDashboardController::class, 'berita'])->name('berita.index');
        Route::get('/berita/create', [AdminDashboardController::class, 'beritaCreate'])->name('berita.create');
        Route::post('/berita/store', [AdminDashboardController::class, 'beritaStore'])->name('berita.store');
        Route::get('/berita/edit/{id}', [AdminDashboardController::class, 'beritaEdit'])->name('berita.edit');
        Route::post('/berita/update/{id}', [AdminDashboardController::class, 'beritaUpdate'])->name('berita.update');
        Route::delete('/berita/delete/{id}', [AdminDashboardController::class, 'beritaDestroy'])->name('berita.destroy');

        // Slider
        Route::get('/slider', [AdminDashboardController::class, 'slider'])->name('slider.index');
        Route::post('/slider/store', [AdminDashboardController::class, 'sliderStore'])->name('slider.store');
        Route::delete('/slider/delete/{id}', [AdminDashboardController::class, 'sliderDestroy'])->name('slider.destroy');

        // SOTK
        Route::get('/sotk', [AdminDashboardController::class, 'sotk'])->name('sotk.index');
        Route::post('/sotk/store', [AdminDashboardController::class, 'sotkStore'])->name('sotk.store');
        Route::delete('/sotk/delete/{id}', [AdminDashboardController::class, 'sotkDestroy'])->name('sotk.destroy');

        // Pengumuman
        Route::get('/pengumuman', [AdminDashboardController::class, 'pengumuman'])->name('pengumuman.index');
        Route::post('/pengumuman/store', [AdminDashboardController::class, 'pengumumanStore'])->name('pengumuman.store');
        Route::delete('/pengumuman/delete/{id}', [AdminDashboardController::class, 'pengumumanDestroy'])->name('pengumuman.destroy');

        // APBDes
        Route::get('/apbdes', [AdminDashboardController::class, 'apbdes'])->name('apbdes.index');
        Route::post('/apbdes/summary', [AdminDashboardController::class, 'apbdesStoreSummary'])->name('apbdes.summary.store');
        Route::post('/apbdes/detail', [AdminDashboardController::class, 'apbdesStoreDetail'])->name('apbdes.detail.store');
        Route::delete('/apbdes/detail/{id}', [AdminDashboardController::class, 'apbdesDestroyDetail'])->name('apbdes.detail.destroy');

        // Demografi
        Route::get('/demografi', [AdminDashboardController::class, 'demografi'])->name('demografi.index');
        Route::post('/demografi/update', [AdminDashboardController::class, 'demografiUpdate'])->name('demografi.update');

        // Profil
        Route::get('/profil', [AdminDashboardController::class, 'profil'])->name('profil.index');
        Route::post('/profil/update', [AdminDashboardController::class, 'profilUpdate'])->name('profil.update');

        // Galeri
        Route::get('/galeri', [AdminDashboardController::class, 'galeri'])->name('galeri.index');
        Route::post('/galeri/foto', [AdminDashboardController::class, 'fotoStore'])->name('galeri.foto.store');
        Route::delete('/galeri/foto/{id}', [AdminDashboardController::class, 'fotoDestroy'])->name('galeri.foto.destroy');
        Route::post('/galeri/video', [AdminDashboardController::class, 'videoStore'])->name('galeri.video.store');
        Route::delete('/galeri/video/{id}', [AdminDashboardController::class, 'videoDestroy'])->name('galeri.video.destroy');

        // Layanan & Permohonan Surat Online
        Route::get('/layanan', [AdminDashboardController::class, 'layanan'])->name('layanan.index');
        Route::post('/layanan/store', [AdminDashboardController::class, 'layananStore'])->name('layanan.store');
        Route::delete('/layanan/delete/{id}', [AdminDashboardController::class, 'layananDestroy'])->name('layanan.destroy');
        Route::get('/layanan/permohonan', [AdminDashboardController::class, 'permohonanIndex'])->name('layanan.permohonan.index');
        Route::post('/layanan/permohonan/{id}/status', [AdminDashboardController::class, 'permohonanUpdateStatus'])->name('layanan.permohonan.status');
        Route::delete('/layanan/permohonan/{id}', [AdminDashboardController::class, 'permohonanDestroy'])->name('layanan.permohonan.destroy');

        // Saran
        Route::get('/saran', [AdminDashboardController::class, 'saran'])->name('saran.index');
        Route::post('/saran/status/{id}', [AdminDashboardController::class, 'saranUpdateStatus'])->name('saran.status');
        Route::delete('/saran/delete/{id}', [AdminDashboardController::class, 'saranDestroy'])->name('saran.destroy');

        // Footer & Kontak
        Route::get('/footer', [AdminDashboardController::class, 'footer'])->name('footer.index');
        Route::post('/footer/update', [AdminDashboardController::class, 'footerUpdate'])->name('footer.update');

        // Admin User
        Route::get('/pengguna', [AdminDashboardController::class, 'adminList'])->name('pengguna.index');
        Route::post('/pengguna/store', [AdminDashboardController::class, 'adminStore'])->name('pengguna.store');
        Route::delete('/pengguna/delete/{id}', [AdminDashboardController::class, 'adminDestroy'])->name('pengguna.destroy');
    });
});
