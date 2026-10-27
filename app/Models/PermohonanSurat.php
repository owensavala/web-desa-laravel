<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surats';

    protected $fillable = [
        'kode_tracking',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'dusun',
        'rt_rw',
        'no_wa',
        'jenis_surat',
        'keperluan',
        'catatan_pemohon',
        'lampiran_ktp',
        'lampiran_kk',
        'lampiran_berkas',
        'status',
        'catatan_petugas',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_selesai' => 'datetime',
    ];
}
