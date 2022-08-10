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
        if (Auth::user()->role == 'user') {
            return $this->landingPage();
        }
        $data['tittle']='Dashboard';
        $data['countUsers'] = User::where('role','user')->count();
        $data['countPesanan'] = Booking::where('status','WAITING')->count();
        $data['countPesananDone'] = Booking::where('status','COMPLETED')->count();
        $data['countPembayaranPending'] = Pembayaran::where('status','WAITING')->count();
        return view('home', $data);
    }

    public function landingPage(){
        $data['tittle']='Landing Page';
        return view('frontend.home', $data);
    }


}
