<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenLayanan extends Model
{
    protected $table = 'dokumen_layanan';
    protected $fillable = ['nama_dokumen', 'keterangan', 'kategori', 'nama_file', 'tanggal_upload'];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];
}
