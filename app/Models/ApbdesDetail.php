<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdesDetail extends Model
{
    protected $table = 'apbdes_detail';
    protected $fillable = ['id_summary', 'bidang', 'kegiatan', 'anggaran'];

    public function summary()
    {
        return $this->belongsTo(ApbdesSummary::class, 'id_summary', 'id');
    }
}
