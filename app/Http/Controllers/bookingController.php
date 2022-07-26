<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit','id_konfirm'];
    }

    public function index(Request $request){
        $data['tittle']='Data booking';
        $data['dataUser'] = User::where('role','user')->get();
        $data['dataLayanan'] = Layanan::get();
        $data['getLastId']=@Booking::orderBy('id', 'DESC')->get()->first()->id ?? 0;
        $data['no_booking']='BOOK_'.$this->leadingZero($data['getLastId'] + 1);
        $data['status'] = @$request['status'];
        $data['tgl_awal'] = @$request['tgl_awal'];
        $data['tgl_akhir'] = @$request['tgl_akhir'];

        if ($request['tgl_awal'] != null && $request['tgl_akhir'] != null) {
            if (@$request['status'] == 'ALL') {
                $data['dataSql'] = Booking::select("tb_booking.*","users.nama", "tb_layanan.jenis_layanan")->join("users", "users.id","tb_booking.id_user")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->whereDate('tb_booking.tgl_booking','>=',$request['tgl_awal'])->whereDate('tb_booking.tgl_booking','<=',$request['tgl_akhir'])->get();
            } else {
                $data['dataSql'] = Booking::select("tb_booking.*","users.nama", "tb_layanan.jenis_layanan")->join("users", "users.id","tb_booking.id_user")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->where('tb_booking.status',$request['status'])->whereDate('tb_booking.tgl_booking','>=',$request['tgl_awal'])->whereDate('tb_booking.tgl_booking','<=',$request['tgl_akhir'])->get();
            }
        } else {
            $data['dataSql'] = Booking::select("tb_booking.*","users.nama", "tb_layanan.jenis_layanan")->join("users", "users.id","tb_booking.id_user")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->get();
        }


        return view('booking.data_booking', $data);
    }

    public function listBooking(){
        $data['tittle']='Data List Booking';

        $data['dataBooking'] = DB::select("SELECT CONCAT(no_booking,' - ',nama) as title, tgl_booking as start,tgl_booking as end
        FROM tb_booking
        INNER JOIN users ON tb_booking.id_user = users.id
        WHERE status != 'REJECT'");
        return view('booking.data_list_booking', $data);
    }


    public function add(Request $request){
        $data = $request->except("_tokens");
        $cekData = Booking::whereDate('tgl_booking',$data['tgl_booking'])->whereNotIn('status',['REJECT'])->count();
        if ($cekData > 0) {
            $response = ['status' => 'gagal', 'message' => 'Sudah terdapat data booking pada tanggal yang sama, mohon melakukan booking pada tanggal yang berbeda'];
        } else {
            $data['tgl_booking'] = date('Y-m-d H:i:s',strtotime($data['tgl_booking'].' '.$data['jam_booking']));
            $action = Booking::create($data);
            if ($action)
                $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
            else
                $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];
        }

        if (@$action) {
            if (Auth::user()->role == 'user')
                return redirect('/user/pembayaran/');
            else
                return redirect()->back()->with($response)->withInput();
        } else {
            return redirect()->back()->with($response)->withInput();
        }
    }

    public function update(Request $request){
        $dataEdit = $request->except(array_merge($this->global_exceptKey,['jam_booking']));
        $dataEdit['tgl_booking'] = date('Y-m-d H:i:s',strtotime($request['tgl_booking'].' '.$request['jam_booking']));

        $cekData = Booking::whereDate('tgl_booking',$request['tgl_booking'])->whereNotIn('status',['REJECT'])->whereNotIn('id',[$request['id_edit']])->count();
        if ($cekData > 0) {
            $response = ['status' => 'gagal', 'message' => 'Sudah terdapat data booking pada tanggal yang sama, mohon melakukan booking pada tanggal yang berbeda'];
        } else {
            $action = Booking::where("id", $request['id_edit'])->update($dataEdit);
            if ($action)
                $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
            else
                $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];
        }


        if (@$action) {
            if (Auth::user()->role == 'user')
                return redirect('/user/list-booking-user/')->with($response);
            else
                return redirect()->back()->with($response);
        } else {
            return redirect()->back()->with($response);
        }
    }

    public function delete(Request $request) {
        $action = Booking::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }

    private function leadingZero($no){
        $no_of_digit = 3;
        $number = $no ?? 0;
        $length = strlen((string)$number);
        for($i = $length;$i<$no_of_digit;$i++)
        {
            $number = '0'.$number;
        }

        return $number;
    }


}
