<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "tb_booking";
    protected $fillable = [
        'no_booking',
        'tgl_booking',
        'kendaraan',
        'deskripsi',
        'alamat',
        'status',
        'id_user',
        'id_layanan',
    ];
}
