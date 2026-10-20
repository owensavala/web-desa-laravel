<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->string('nama', 150)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('judul')->nullable();
            $table->text('subjudul')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->longText('sejarah')->nullable();
            $table->longText('sambutan_isi')->nullable();
            $table->string('sambutan_nama_pejabat')->nullable();
            $table->string('sambutan_jabatan')->nullable();
            $table->string('sambutan_foto')->nullable();
            $table->string('gambar_bagan1')->nullable();
            $table->string('gambar_bagan2')->nullable();
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_barat')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('luas_desa', 100)->nullable();
            $table->string('jumlah_penduduk', 100)->nullable();
            $table->text('gambar_peta')->nullable();
            $table->timestamps();
        });

        Schema::create('sotk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->nullable();
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->dateTime('tanggal_posting')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('apbdes_summary', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->bigInteger('total_pendapatan')->default(0);
            $table->bigInteger('total_belanja')->default(0);
            $table->bigInteger('pendapatan_pad')->default(0);
            $table->bigInteger('pendapatan_transfer')->default(0);
            $table->bigInteger('pendapatan_lain')->default(0);
            $table->timestamps();
        });

        Schema::create('apbdes_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_summary');
            $table->string('bidang');
            $table->string('kegiatan');
            $table->bigInteger('anggaran')->default(0);
            $table->timestamps();
        });

        Schema::create('demografi', function (Blueprint $table) {
            $table->id();
            $table->integer('total_penduduk')->default(0);
            $table->integer('total_kk')->default(0);
            $table->integer('total_laki')->default(0);
            $table->integer('total_perempuan')->default(0);
            $table->integer('umur_anak_laki')->default(0);
            $table->integer('umur_anak_perempuan')->default(0);
            $table->integer('umur_remaja_laki')->default(0);
            $table->integer('umur_remaja_perempuan')->default(0);
            $table->integer('umur_dewasa_laki')->default(0);
            $table->integer('umur_dewasa_perempuan')->default(0);
            $table->integer('umur_lansia_laki')->default(0);
            $table->integer('umur_lansia_perempuan')->default(0);
            $table->integer('pendidikan_sd')->default(0);
            $table->integer('pendidikan_smp')->default(0);
            $table->integer('pendidikan_sma')->default(0);
            $table->integer('pendidikan_pt')->default(0);
            $table->integer('status_cerai_hidup')->default(0);
            $table->integer('status_cerai_mati')->default(0);
            $table->integer('status_kawin')->default(0);
            $table->integer('status_belum_kawin')->default(0);
            $table->integer('agama_islam')->default(0);
            $table->integer('agama_kristen')->default(0);
            $table->integer('agama_katolik')->default(0);
            $table->integer('agama_hindu')->default(0);
            $table->integer('agama_buddha')->default(0);
            $table->integer('agama_konghucu')->default(0);
            $table->timestamps();
        });

        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->string('keterangan')->nullable();
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri_video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('link_video');
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();
        });

        Schema::create('dokumen_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->text('keterangan')->nullable();
            $table->string('kategori')->nullable();
            $table->string('nama_file');
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();
        });

        Schema::create('kritik_saran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('komentar');
            $table->timestamp('tanggal_kirim')->nullable();
            $table->enum('status', ['baru', 'dibaca'])->default('baru');
            $table->timestamps();
        });

        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('alamat')->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
        Schema::dropIfExists('kritik_saran');
        Schema::dropIfExists('dokumen_layanan');
        Schema::dropIfExists('galeri_video');
        Schema::dropIfExists('galeri_foto');
        Schema::dropIfExists('demografi');
        Schema::dropIfExists('apbdes_detail');
        Schema::dropIfExists('apbdes_summary');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('sotk');
        Schema::dropIfExists('profil_desa');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('admins');
    }
};
