<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class pembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit','id_konfirm'];
    }

    public function index(){
        $data['tittle']='Data pembayaran';
        $data['dataBooking'] = Booking::select("tb_booking.*","users.nama", "tb_layanan.jenis_layanan")->join("users", "users.id","tb_booking.id_user")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->get();
        $data['dataSql'] = Pembayaran::select("tb_pembayaran.*", "tb_booking.no_booking","tb_booking.kendaraan","tb_layanan.jenis_layanan")->join("tb_booking", "tb_booking.id","tb_pembayaran.id_booking")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->get();
        return view('pembayaran.data_pembayaran', $data);
    }

    public function add(Request $request){
        $imageName = time() . '.' . $request->file("bukti")->extension();
        $request->file("bukti")->move(public_path('upload/bukti_bayar'), $imageName);

        $data = $request->except("_tokens");
        $data['bukti'] = $imageName;

        $action = Pembayaran::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function update(Request $request){
        $dataEdit = $request->except($this->global_exceptKey);

        if (@$dataEdit['id_booking'] != null) {
            if ($dataEdit['status'] == 'ACCEPT') {
                Booking::where("id", $dataEdit['id_booking'])->update(['status' => 'PAID']);
            } else {
                Booking::where("id", $dataEdit['id_booking'])->update(['status' => 'REJECT']);
            }
        }

        if (@$dataEdit['bukti'] == null) {
            $dataEdit = $request->except(['_tokens', '_token', 'id_edit','id_konfirm','bukti']);
        }

        $action = Pembayaran::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function delete(Request $request) {
        $action = Pembayaran::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }

    public function uploadBuktiPembayaran(Request $request){
        $data = $request->except($this->global_exceptKey);

        if ($request->file("bukti") != null) {
            $imageName = time() . '.' . $request->file("bukti")->extension();
            $request->file("bukti")->move(public_path('upload/bukti_bayar'), $imageName);
            $data['bukti'] = $imageName;
        }

        $cekData = Pembayaran::where('id_booking',$data['id_booking'])->count();
        if ($cekData > 0) {
            $action = Pembayaran::where("id_booking", $request['id_booking'])->update(['bukti' =>  $data['bukti']]);
        } else {
            $action = Pembayaran::create($data);
        }

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }
}
