<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $table = 'footer_settings';
    protected $fillable = [
        'nama_desa', 'kecamatan', 'kabupaten', 'logo_desa', 'tema_warna',
        'alamat', 'telepon', 'email',
        'kontak_darurat_polsek', 'kontak_darurat_puskesmas', 'kontak_darurat_babinsa',
        'link_facebook', 'link_instagram', 'link_tiktok', 'link_youtube',
        'copyright_text'
    ];
}
