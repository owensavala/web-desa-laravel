# Panduan Lengkap Deploy Web Desa ke Vercel

Project ini sudah dikonfigurasi penuh dengan file `vercel.json`, `api/index.php`, dan penyesuaian storage serverless agar dapat berjalan di Vercel.

---

## Langkah 1: Buat Database MySQL Cloud Online (Gratis)
Vercel tidak menyediakan database MySQL lokal, jadi kita perlu database online gratis. Pilihan terbaik & termudah:

### Opsi A: TiDB Cloud (Sangat Direkomendasikan, Cepat & Gratis)
1. Buka [https://tidbcloud.com](https://tidbcloud.com) dan daftar akun gratis (bisa login dengan akun Google/GitHub).
2. Pilih cluster **Serverless (Free)**.
3. Klik **Connect** dan catat data koneksi:
   - Host
   - Port (biasanya 4000)
   - User
   - Password
   - Database name (misal: `test` atau buat baru)
4. Buka menu Web SQL / Console di TiDB Cloud, lalu jalankan/import file migration atau export database `desa_kupal_laravel`.

---

## Langkah 2: Upload Project ke GitHub
Buka terminal PowerShell di folder `c:\xampp\htdocs\web_desa_laravel`:

1. Buat repository baru di [https://github.com/new](https://github.com/new) (misal nama repo: `web-desa-laravel`).
2. Sambungkan folder lokal ke GitHub Anda:
   ```bash
   git remote add origin https://github.com/USERNAME_ANDA/web-desa-laravel.git
   git push -u origin main
   ```

---

## Langkah 3: Import Project di Vercel
1. Buka [https://vercel.com](https://vercel.com) dan login dengan akun GitHub Anda.
2. Klik tombol **"Add New..."** > **"Project"**.
3. Pilih repository `web-desa-laravel` yang baru saja Anda push, lalu klik **"Import"**.
4. **PENTING (Environment Variables)**:
   Sebelum klik Deploy, buka bagian **Environment Variables** dan tambahkan variabel berikut:

   | Variable Key | Nilai / Value |
   | :--- | :--- |
   | `APP_NAME` | `Desa Kupal` |
   | `APP_ENV` | `production` |
   | `APP_KEY` | *(Salin dari file .env lokal Anda)* |
   | `APP_DEBUG` | `false` |
   | `APP_URL` | `https://nama-project-anda.vercel.app` |
   | `DB_CONNECTION` | `mysql` |
   | `DB_HOST` | *(Host dari TiDB Cloud / Aiven)* |
   | `DB_PORT` | `4000` *(atau port database cloud Anda)* |
   | `DB_DATABASE` | *(Nama database cloud Anda)* |
   | `DB_USERNAME` | *(Username database cloud Anda)* |
   | `DB_PASSWORD` | *(Password database cloud Anda)* |
   | `SESSION_DRIVER` | `cookie` |
   | `CACHE_STORE` | `array` |

5. Klik tombol **"Deploy"**.
6. Tunggu proses build 1–2 menit hingga selesai. Website desa Anda sudah online dan dapat diakses dari mana saja secara gratis!
