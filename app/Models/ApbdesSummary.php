<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdesSummary extends Model
{
    protected $table = 'apbdes_summary';
    protected $fillable = [
        'tahun', 'total_pendapatan', 'total_belanja',
        'pendapatan_pad', 'pendapatan_transfer', 'pendapatan_lain'
    ];

    public function details()
    {
        return $this->hasMany(ApbdesDetail::class, 'id_summary', 'id');
    }
}
