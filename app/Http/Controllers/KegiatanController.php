<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function index(){
        $data['tittle']='Data kegiatan';
        $data['dataSql'] = Kegiatan::get();
        return view('kegiatan.data_kegiatan', $data);
    }

    public function add(Request $request){
        $data = $request->except("_tokens");

        $action = Kegiatan::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function update(Request $request){
        $dataEdit = $request->except($this->global_exceptKey);

        $action = Kegiatan::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function delete(Request $request) {
        $action = Kegiatan::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }
}
