<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit','id_konfirm'];
    }

    public function index(){
        $data['tittle']='Data cuti';
        $data['jabatan']=Auth::user()->jabatan;
        $data['dataSql'] = cuti::select("tb_cuti.*", "users.name as nama_pegawai",DB::raw('(SELECT SUM(total_hari_cuti) FROM tb_cuti WHERE id_user=users.id and YEAR(tgl_awal)='.date('Y').') as tot_cuti'))->join("users", "tb_cuti.id_user", "users.id")->get();
        return view('cuti.data_cuti', $data);
    }

    public function add(Request $request){
        $data = $request->except($this->global_exceptKey);
        $startDate = strtotime($data['tgl_awal']);
        $endDate = strtotime($data['tgl_akhir']);
        $datediff = $endDate - $startDate;
        $datediffResult = round($datediff / (60 * 60 * 24));
        $data['total_hari_cuti'] = $datediffResult;
        $data['status'] = 'W';

        $action = Cuti::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function update(Request $request){
        $dataEdit = $request->except($this->global_exceptKey);

        $action = Cuti::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function delete(Request $request) {
        $action = Cuti::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }

    public function konfirm(Request $request) {
        $dataKonfirm = $request->except($this->global_exceptKey);
        $action = Cuti::where("id", $request['id_konfirm'])->update($dataKonfirm);

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dikonfirmasi'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dikonfirmasi'];

        return redirect()->back()->with($response);
    }
}
