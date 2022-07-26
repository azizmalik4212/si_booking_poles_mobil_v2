<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Booking;
use App\Models\Cuti;
use App\Models\KegiatanPegawai;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set("Asia/Makassar");
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['tittle']='Dashboard';
        $data['countUsers'] = User::where('role','user')->count();
        $data['countPesanan'] = Booking::where('status','WAITING')->count();
        $data['countPesananDone'] = Booking::where('status','COMPLETED')->count();
        $data['countPembayaranPending'] = Pembayaran::where('status','WAITING')->count();
        // $data['countCuti'] = Cuti::count();
        // $data['countKegiatan'] = KegiatanPegawai::count();
        // $data['jabatan'] = Auth::user()->jabatan;
        // if ($data['jabatan']=='admin') {
        //     $data['absensiData'] = Absensi::select("tb_absensi.*", "users.name")->join("users", "tb_absensi.id_user", "users.id")->whereDate('tanggal',date('Y-m-d'))->orderBy('tanggal', 'DESC')->get();
        // }else {
        //     $data['absensiData'] = Absensi::select("tb_absensi.*",  "users.name")->join("users", "tb_absensi.id_user", "users.id")->where('users.id',Auth::user()->id)->orderBy('tanggal', 'DESC')->get();
        // }
        return view('home', $data);
    }

    public function landingPage(){
        $data['tittle']='Landing Page';
        return view('frontend.home', $data);
    }
}
