<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DesaKupalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin
        DB::table('admins')->insertOrIgnore([
            [
                'id_admin' => 1,
                'username' => 'admin',
                'password' => Hash::make('admin123'), // password default baru yang aman
                'nama' => 'Administrator Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 2,
                'username' => 'sattar',
                'password' => Hash::make('sattar123'),
                'nama' => 'Sattar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Sliders
        DB::table('sliders')->insertOrIgnore([
            [
                'id' => 1,
                'gambar' => '1755536129_kantor desa.jpg',
                'judul' => 'KANTOR DESA KUPAL',
                'subjudul' => 'Pusat Pelayanan dan Pemerintahan Desa Kupal yang Modern & Transparan',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'gambar' => '1755552368_slide2.jpg',
                'judul' => 'KEGIATAN & KEBERSAMAAN DESA',
                'subjudul' => 'Mewujudkan masyarakat yang rukun, berdaya, dan sejahtera bersama',
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. Profil Desa
        DB::table('profil_desa')->insertOrIgnore([
            [
                'id' => 1,
                'visi' => '“Desa Kupal sebagai Desa Wisata yang mampu mengelolah potensi Desa dan pembangunan berkelanjutan untuk mewujudkan masyarakat yang sejahtera”',
                'misi' => "Mewujudkan tata kelola pemerintahan yang baik\nMengembangkan kegiatan keagamaan\nMeningkatkan kualitas pendidikan dan sumber daya manusia\nMengembangkan teknologi informasi\nPembangunan infrastruktur, sarana dan prasarana\nMengembangkan seluruh usaha potensi desa\nMeningkatkan kualitas dan membangun kesadaran kesehatan masyarakat\nMeningkatkan perekonomian dan kesejahteraan masyarakat\nMembangun kerjasama dan kemitraan strategis",
                'sejarah' => "Cikal bakal hikayat dan sejarah tentang penamaan suatu daerah baik dari pedesaan hingga perkotaan adalah rintisan panjang yang menjadi cerita yang tak akan pernah putus dari dahulu sampai sekarang itu sebabnya, di setiap cerita dan hikayat satu daerah maupun wilayah banyak melahirkan pertanyaan tentang para pelaku sejarah.\n\nTentang Historinya, Penamaan Kupal merupakan penamaan yang tak terlepas sejarahnya dengan kesultanan Bacan, hal tersebut dikarenakan Kupal sendiri mempunyai sejarah panjang yang berhubungan langsung dengan Sultan atau Raja Bacan yang memimpin Kesultanan Bacan pada masa itu.",
                'sambutan_isi' => "Assalamu Alaikum Warohmatullahi Wabarakatuh,\n\nWebsite ini hadir sebagai wujud transformasi desa Kupal menjadi desa yang mampu memanfaatkan teknologi informasi dan komunikasi, terintegrasi kedalam sistem online. Keterbukaan informasi publik, pelayanan publik dan kegiatan perekonomian di desa, guna mewujudkan desa Kupal sebagai desa wisata yang berkelanjutan, adaptasi dan mitigasi terhadap perubahan iklim serta menjadi desa yang mandiri.\n\nTerima kasih kepada semua pihak yang telah banyak memberi dukungan dan kontribusi baik berupa tenaga, pikiran dan semangat.",
                'sambutan_nama_pejabat' => 'Sanusi La Riaga',
                'sambutan_jabatan' => 'Kepala Desa Kupal',
                'sambutan_foto' => '1755536047_sambutan_kepala desa.png',
                'gambar_bagan1' => '1755552248_bagan1_bagan 2.jpg',
                'gambar_bagan2' => '1755552248_bagan2_bagan 1.png',
                'batas_utara' => 'Desa Tembal',
                'batas_selatan' => 'Desa Gandasuli',
                'batas_barat' => 'Pantai Kupal',
                'batas_timur' => 'Pegunungan Bacan',
                'luas_desa' => '708 Ha',
                'jumlah_penduduk' => '170 Jiwa',
                'gambar_peta' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1393.6099631158868!2d127.4771603029561!3d-0.6672357875266723!2m3!1f90!2f0!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x2d633928247195d7%3A0x50371dc95a3280e8!2sKnt%2C%20Desa%20Kupal!5e1!3m2!1sid!2sid!4v1755110',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 4. SOTK
        DB::table('sotk')->insertOrIgnore([
            [
                'id' => 1,
                'nama' => 'Sanusi La Riaga',
                'jabatan' => 'Kepala Desa Kupal',
                'foto' => '1755537036_kepala desa.png',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'M. Iqbal, S.Sos',
                'jabatan' => 'Sekretaris Desa',
                'foto' => '1755537079_logo.png',
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Sasmita, S.E',
                'jabatan' => 'Kaur Keuangan / Bendahara',
                'foto' => '1755537099_logo.png',
                'urutan' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. Berita
        DB::table('berita')->insertOrIgnore([
            [
                'id' => 1,
                'judul' => 'Pawai Obor Menyambut Ramadhan di Desa Kupal',
                'slug' => 'pawai-obor-menyambut-ramadhan-di-desa-kupal',
                'isi' => "Informasi terbaru mengenai program pemberdayaan masyarakat desa dan kegiatan pawai obor pemuda serta warga menyambut bulan suci Ramadhan dengan antusiasme yang tinggi di sepanjang jalan utama Desa Kupal.",
                'gambar' => '1755549031_slide3.jpeg',
                'tanggal_posting' => '2025-08-17 05:34:00',
                'views' => 124,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'judul' => 'Pemdes Kupal Halsel Salur Honor Perangkat Desa BPD dan Stimulan Tahun Anggaran 2025',
                'slug' => 'pemdes-kupal-halsel-salur-honor-perangkat-desa-bpd-dan-stimulan-2025',
                'isi' => "Pemerintah Desa (Pemdes) Kupal Kecamatan Bacan Selatan Kabupaten Halmahera Selatan menyalurkan honor bagi seluruh perangkat Desa, dan BPD pada Sabtu 3 Mei 2025 di Kantor Desa Kupal.\n\nPenyaluran hak-hak penerima ini, bersumber dari 40 persen Dana Desa (DD) pencairan tahap pertama tahun 2025 yang langsung diserahkan oleh bendahara Desa Kupal Sasmita ke penerima.\n\nSelain perangkat desa dan BPD, Pemdes Kupal juga menyalurkan Bantuan Langsung Tunai (BLT) serta Stimulan sebesar Rp 50 juta ke Masjid Nurul Iman Desa Kupal.\n\nKepala Desa Kupal Sanusi La Riaga mengatakan, penyaluran honor perangkat Desa, BLT, dan stimulan bakal disusul dengan pekerjaan fisik yang telah direncanakan.\n\n\"Kita bagi dulu honor atau gaji perangkat desa dan lain-lain. Insha Allah setelah ini kita kerjakan pekerjaan fisik Desa sesuai yang telah di tetapkan,\" kata Kades Sanusi.\n\nDia berharap honor dan gaji yang telah dibagikan, perangkat desa dan lainnya yang masuk dalam komponen pengurus desa dapat meningkatkan efisiensi kerja.",
                'gambar' => '1755442575_3.webp',
                'tanggal_posting' => '2025-08-19 23:56:00',
                'views' => 380,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'judul' => 'Pemdes Kupal Halmahera Selatan Serahkan Alat Prasarana Penunjang Olahraga ke Pemuda Desa',
                'slug' => 'pemdes-kupal-serahkan-alat-prasarana-olahraga-pemuda',
                'isi' => "Kepala Desa (Kades) Kupal Kecamatan Bacan Selatan Kabupaten Halmahera Selatan Sanusi La Riaga menyerahkan alat dan prasarana olahraga kepada Pemuda Desa di Kantor Desa Kupal.\n\nDua mesin potong rumput dan penunjang olahraga lainnya diserahkan Kades Sanusi sebagai bentuk dukungan terhadap pemuda desa di bidang olahraga khususnya sepak bola.\n\nAlat dan prasarana yang diserahkan, bersumber dari anggaran Pemuda Desa tahap I dengan nilai Rp 10 juta lebih, 40 persen dari Rp 25 juta yang dianggarkan untuk Pemuda di tahun 2025.\n\nKepala Desa Sanusi La Riaga mengatakan, anggaran tersebut direalisasikan dari Dana Desa (DD) berdasarkan proposal yang diajukan pihak Pemuda Desa agar lapangan sepak bola terawat dengan optimal.",
                'gambar' => '1755444854_4.webp',
                'tanggal_posting' => '2025-05-14 17:30:00',
                'views' => 245,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 6. Pengumuman
        DB::table('pengumuman')->insertOrIgnore([
            [
                'id' => 1,
                'judul' => 'Jadwal Posyandu Balita dan Lansia Bulan Ini dilaksanakan di Balai Desa Kupal.',
                'tanggal_mulai' => '2026-10-01',
                'tanggal_selesai' => '2026-10-31',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'judul' => 'Kerja bakti gotong royong kebersihan lingkungan dan masjid Desa Kupal setiap hari Minggu.',
                'tanggal_mulai' => '2026-10-01',
                'tanggal_selesai' => '2026-11-30',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 7. APBDes Summary & Detail
        DB::table('apbdes_summary')->insertOrIgnore([
            [
                'id' => 1,
                'tahun' => 2025,
                'total_pendapatan' => 100000000,
                'total_belanja' => 101000000,
                'pendapatan_pad' => 10000000,
                'pendapatan_transfer' => 85000000,
                'pendapatan_lain' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'tahun' => 2024,
                'total_pendapatan' => 35000000,
                'total_belanja' => 15000000,
                'pendapatan_pad' => 10000000,
                'pendapatan_transfer' => 20000000,
                'pendapatan_lain' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('apbdes_detail')->insertOrIgnore([
            [
                'id' => 12,
                'id_summary' => 1,
                'bidang' => 'Pelaksanaan Pembangunan Desa',
                'kegiatan' => 'Pembangunan Jalan Usaha Tani',
                'anggaran' => 50000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'id_summary' => 1,
                'bidang' => 'Pelaksanaan Pembangunan Desa',
                'kegiatan' => 'Pembangunan Drainase Lingkungan',
                'anggaran' => 20000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'id_summary' => 1,
                'bidang' => 'Penyelenggaraan Pemerintahan Desa',
                'kegiatan' => 'Operasional Kantor Desa & BPD',
                'anggaran' => 26000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'id_summary' => 1,
                'bidang' => 'Pembinaan Kemasyarakatan',
                'kegiatan' => 'Pengadaan Tempat Sampah Umum',
                'anggaran' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 8. Demografi
        DB::table('demografi')->insertOrIgnore([
            [
                'id' => 1,
                'total_penduduk' => 170,
                'total_kk' => 67,
                'total_laki' => 90,
                'total_perempuan' => 80,
                'umur_anak_laki' => 20,
                'umur_anak_perempuan' => 16,
                'umur_remaja_laki' => 30,
                'umur_remaja_perempuan' => 25,
                'umur_dewasa_laki' => 29,
                'umur_dewasa_perempuan' => 24,
                'umur_lansia_laki' => 11,
                'umur_lansia_perempuan' => 15,
                'pendidikan_sd' => 120,
                'pendidikan_smp' => 60,
                'pendidikan_sma' => 50,
                'pendidikan_pt' => 15,
                'status_cerai_hidup' => 2,
                'status_cerai_mati' => 4,
                'status_kawin' => 85,
                'status_belum_kawin' => 79,
                'agama_islam' => 165,
                'agama_kristen' => 3,
                'agama_katolik' => 2,
                'agama_hindu' => 0,
                'agama_buddha' => 0,
                'agama_konghucu' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 9. Galeri Foto & Video
        DB::table('galeri_foto')->insertOrIgnore([
            ['id' => 4, 'nama_file' => '1755506685_pengukuran2.jpg', 'keterangan' => 'Pengukuran Batas & Pemetaan Wilayah Desa', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_file' => '1755506723_pengukuran3.jpg', 'keterangan' => 'Survei Lapangan Pembangunan Desa', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nama_file' => '1755506730_pengukuran1.jpg', 'keterangan' => 'Peninjauan Lokasi Drainase', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nama_file' => '1755506746_Perunahan APBDES 2024.jpg', 'keterangan' => 'Musyawarah Perubahan APBDes', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nama_file' => '1755506753_Penyususnan (RKPDes).jpg', 'keterangan' => 'Penyusunan Dokumen RKPDes', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('galeri_video')->insertOrIgnore([
            [
                'id' => 1,
                'judul' => 'Profil Singkat & Potensi Wisata Desa Kupal',
                'link_video' => 'https://www.youtube.com/watch?v=pX__5nwtzlk',
                'tanggal_upload' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 10. Dokumen Layanan
        DB::table('dokumen_layanan')->insertOrIgnore([
            ['id' => 1, 'nama_dokumen' => 'Surat Keterangan Tidak Mampu (SKTM)', 'keterangan' => 'Surat pengantar untuk keperluan beasiswa sekolah, kuliah, atau keringanan biaya kesehatan', 'kategori' => 'Ekonomi & Sosial', 'nama_file' => '1755539135_Surat Permintaan Data Siswa MI.pdf', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_dokumen' => 'Surat Keterangan Domisili', 'keterangan' => 'Keterangan tempat tinggal resmi bagi warga yang berdomisili di Desa Kupal', 'kategori' => 'Kependudukan', 'nama_file' => '1755540341_1755539135_Surat_Permintaan_Data_Siswa_MI.pdf', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_dokumen' => 'Surat Keterangan Usaha (SKU)', 'keterangan' => 'Surat keterangan kepemilikan usaha UMKM warga untuk pengajuan kredit atau izin usaha', 'kategori' => 'Ekonomi & Sosial', 'nama_file' => '1755540442_1755539135_Surat_Permintaan_Data_Siswa_MI.pdf', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_dokumen' => 'Surat Keterangan Belum Menikah', 'keterangan' => 'Persyaratan pengurusan berkas pernikahan atau pendaftaran pekerjaan', 'kategori' => 'Kependudukan', 'nama_file' => '1755540418_1755539135_Surat_Permintaan_Data_Siswa_MI.pdf', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_dokumen' => 'Surat Pengantar Pembuatan KTP', 'keterangan' => 'Formulir pengantar untuk perekaman atau pencetakan KTP-el di Dukcapil', 'kategori' => 'Kependudukan', 'nama_file' => '1755553288_kupon_bajar_pandu.docx', 'tanggal_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 11. Kritik & Saran
        DB::table('kritik_saran')->insertOrIgnore([
            [
                'id' => 1,
                'nama' => 'Warga Kupal',
                'komentar' => 'Mohon penambahan penerangan lampu jalan di sekitar dermaga dan tempat pembuangan sampah terpadu.',
                'tanggal_kirim' => now(),
                'status' => 'dibaca',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 12. Footer Settings
        DB::table('footer_settings')->insertOrIgnore([
            [
                'id' => 1,
                'alamat' => 'Jl. Desa Kupal, Kec. Bacan Selatan, Kabupaten Halmahera Selatan, Maluku Utara',
                'telepon' => '0852-1840-3628',
                'email' => 'desakupal@gmail.go.id',
                'link_facebook' => 'https://facebook.com',
                'link_instagram' => 'https://instagram.com',
                'link_tiktok' => 'https://tiktok.com',
                'link_youtube' => 'https://youtube.com',
                'copyright_text' => 'Pemerintah Desa Kupal - Halmahera Selatan. Hak Cipta Dilindungi.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
