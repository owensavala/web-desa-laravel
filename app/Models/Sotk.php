<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sotk extends Model
{
    protected $table = 'sotk';
    protected $fillable = ['nama', 'jabatan', 'foto', 'urutan'];
}
