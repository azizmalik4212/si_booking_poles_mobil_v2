<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "tb_pembayaran";
    protected $fillable = [
        'tgl_pembayaran',
        'bukti',
        'rek_transfer',
        'id_booking',
        'status',
    ];
}
