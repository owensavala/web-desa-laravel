# Website Resmi Desa Kupal (Versi Laravel 11)

Portal Sistem Informasi Desa & Pelayanan Administrasi Masyarakat modern berbasis **Laravel 11**, **Tailwind CSS**, dan **Chart.js**.

---

## 🚀 Fitur Unggulan

### 1. Halaman Publik (Frontend Modern)
- **Beranda Interaktif**:
  - Hero slider carousel responsif dengan judul & deskripsi kegiatan desa
  - Sambutan resmi Kepala Desa Kupal
  - Statistik ringkas demografi & anggaran
  - Running Ticker pengumuman resmi bergerak di bagian atas halaman
  - Berita terkini dengan counter pembaca (*views counter*)
  - Banner Layanan Mandiri unduh formulir
- **Profil Desa**:
  - Visi & Misi pembangunan desa
  - Sejarah berdirinya Desa Kupal & Kesultanan Bacan
  - Letak geografis, batas administratif (Utara, Selatan, Barat, Timur), dan peta Google Maps interaktif
- **Pemerintahan & SOTK**:
  - Struktur Organisasi dan Tata Kerja aparatur desa lengkap dengan foto resmi dan bagan hierarki
- **Berita & Artikel**:
  - Fitur pencarian berita (*live search*)
  - Filter berita populer
  - Detail artikel lengkap dengan tombol bagikan ke WhatsApp dan Facebook
- **Infografis & Transparansi Publik**:
  - **Demografi Kependudukan**: Visualisasi grafik interaktif Chart.js (Gender, Kelompok Usia, Tingkat Pendidikan, Status Perkawinan, Agama)
  - **Transparansi APBDes**: Pilihan tahun anggaran, visualisasi donut chart sumber pendapatan (PAD, Dana Desa Transfer, dll.), serta tabel rincian kegiatan belanja
- **Galeri Dokumentasi**:
  - Galeri foto kegiatan dengan fitur pratinjau *lightbox modal*
  - Galeri video kegiatan desa terintegrasi pemutar YouTube responsif
- **Layanan Mandiri Warga**:
  - Download blanko berkas resmi (SKTM, Domisili, SKU, Pengantar KTP, dll.) lengkap dengan filter kategori
- **Kotak Aspirasi (Kritik & Saran)**:
  - Form kirim aspirasi aman terlindungi CSRF token
  - Daftar aspirasi masyarakat terbaru

---

### 2. Panel Administrator Modern (Backend)
- **Autentikasi Aman**: Login berbasis session guard admin dan password hash `bcrypt`
- **Dashboard Statistik**: Indikator total berita, data penduduk, dokumen layanan, dan notifikasi pesan saran masuk
- **Manajemen CRUD Lengkap**:
  - Kelola Berita & Artikel (Upload gambar sampul, editor narasi)
  - Kelola Banner Hero Slider (Urutan tampil & gambar)
  - Kelola Pengumuman Ticker (Tanggal tayang & status aktif/non-aktif)
  - Kelola Aparatur Desa (Nama, jabatan, foto resmi, urutan)
  - Kelola APBDes (Summary anggaran tahunan & rincian kegiatan)
  - Kelola Demografi (Update agregat penduduk, usia, pendidikan, status, agama)
  - Kelola Profil Desa & Sambutan Kepala Desa
  - Kelola Galeri Foto & Video
  - Kelola Dokumen Layanan Surat
  - Kelola Kritik & Saran (Tandai dibaca / hapus)
  - Pengaturan Footer & Kontak Resmi Desa
  - Manajemen Pengguna Akun Administrator

---

## 🔑 Akun Login Administrator

Akses URL Login Admin:
- Melalui browser: **`http://localhost:8000/admin/login`** atau **`http://localhost/web_desa_laravel/public/admin/login`**

| Akun | Username | Password Default | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin Utama** | `admin` | `admin123` | Administrator Penuh |
| **Admin Kedua** | `sattar` | `sattar123` | Administrator |

*(Password dapat diubah kapan saja atau ditambahkan akun baru melalui menu Kelola Administrator).*

---

## 🛠️ Cara Menjalankan Project

1. Pastikan Apache & MySQL di **XAMPP** dalam status **Running**.
2. Buka terminal di folder project ini:
   ```bash
   cd c:\xampp\htdocs\web_desa_laravel
   ```
3. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```
4. Buka di browser:
   - Web Publik: **`http://localhost:8000`**
   - Panel Admin: **`http://localhost:8000/admin/login`**

Atau bisa langsung diakses melalui Apache XAMPP tanpa `artisan serve`:
- **`http://localhost/web_desa_laravel/public/`**
