<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    protected $table = 'kritik_saran';
    protected $fillable = ['nama', 'komentar', 'tanggal_kirim', 'status'];

    protected $casts = [
        'tanggal_kirim' => 'datetime',
    ];
}
