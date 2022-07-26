<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPegawai extends Model
{
    use HasFactory;

    protected $table = "tb_kegiatan";
    protected $fillable = [
        'id_user',
        'id_kegiatan',
        'tanggal',
        'bukti',
        'bonus',
        'keterangan',
        'status',
    ];
}
