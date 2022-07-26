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

    public function laporanDataKegiatanPegawai(){
        $data['tittle']='Laporan kegiatan pegawai';
        $data['dataSql'] = Kegiatan::select("tb_kegiatan.*", "users.name as nama_pegawai", "tb_jenis_kegiatan.nama_kegiatan")->join("tb_kegiatan", "tb_jenis_kegiatan.id", "tb_kegiatan.id_kegiatan")->join("users", "tb_kegiatan.id_user", "users.id")->orderBy('id', 'DESC')->get();
        return view('laporan.laporan_kegiatan_pegawai', $data);
    }

    public function laporanDataAbsensi(){
        $data['tittle']='Laporan data absensi pegawai';
        $data['dataSql'] = Absensi::select("tb_absensi.*", "users.name")->join("users", "tb_absensi.id_user", "users.id")->orderBy('tanggal', 'DESC')->get();
        return view('laporan.laporan_absensi', $data);
    }

    public function laporanDataCuti(){
        $data['tittle']='Laporan data cuti pegawai';
        $data['dataSql'] = Cuti::select("tb_cuti.*", "users.name as nama_pegawai",DB::raw('(SELECT SUM(total_hari_cuti) FROM tb_cuti WHERE id_user=users.id and YEAR(tgl_awal)='.date('Y').') as tot_cuti'))->join("users", "tb_cuti.id_user", "users.id")->get();
        return view('laporan.laporan_cuti', $data);
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
