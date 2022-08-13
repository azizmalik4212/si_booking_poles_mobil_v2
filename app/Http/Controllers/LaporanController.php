<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Booking;
use App\Models\Cuti;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function laporanDataUser(){
        $data['tittle']='Laporan data user';
        $data['dataSql'] = User::get();
        return view('laporan.laporan_user', $data);
    }

    public function laporanDataKegiatan(){
        $data['tittle']='Laporan data kegiatan';
        $data['dataSql'] = User::get();
        return view('laporan.laporan_kegiatan', $data);
    }

    public function laporanDataBooking(){
        $data['tittle']='Laporan data booking';
        $data['dataSql'] = Booking::get();
        return view('laporan.laporan_booking', $data);
    }
}
