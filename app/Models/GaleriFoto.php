<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';
    protected $fillable = ['nama_file', 'keterangan', 'tanggal_upload'];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];
}
