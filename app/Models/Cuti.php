<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $table = "tb_cuti";
    protected $fillable = [
        'id_user',
        'tgl_awal',
        'tgl_akhir',
        'total_hari_cuti',
        'keterangan',
        'perihal',
        'signature',
        'signature_validation',
        'status',
    ];
}
