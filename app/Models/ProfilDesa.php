<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';
    protected $fillable = [
        'visi', 'misi', 'sejarah', 'sambutan_isi', 'sambutan_nama_pejabat',
        'sambutan_jabatan', 'sambutan_foto', 'gambar_bagan1', 'gambar_bagan2',
        'batas_utara', 'batas_selatan', 'batas_barat', 'batas_timur',
        'luas_desa', 'jumlah_penduduk', 'gambar_peta'
    ];
}
