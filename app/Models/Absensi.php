<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "tb_absensi";
    protected $fillable = [
        'id_user',
        'tanggal',
        'absen_masuk',
        'absen_pulang',
        'bukti',
        'bukti_pulang',
        'lama_keterlambatan',
        'lama_lembur',
        'tipe_absen',
        'keterangan',
    ];
}
