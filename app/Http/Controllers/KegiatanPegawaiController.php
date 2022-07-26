<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanPegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit','id_konfirm'];
    }

    public function index(){
        $data['idUser']=Auth::user()->id;
        $data['jabatan']=Auth::user()->jabatan;
        $data['tittle']='Data Report Kegiatan';
        $data['jenisKegiatan'] = Kegiatan::get();

        if ($data['jabatan']=='pegawai') {
            $data['dataSql'] = kegiatan::select("tb_kegiatan.*", "users.name as nama_pegawai", "tb_jenis_kegiatan.nama_kegiatan")->join("tb_kegiatan", "tb_jenis_kegiatan.id", "tb_kegiatan.id_kegiatan")->join("users", "tb_kegiatan.id_user", "users.id")->where('users.id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        } else {
            $data['dataSql'] = kegiatan::select("tb_kegiatan.*", "users.name as nama_pegawai", "tb_jenis_kegiatan.nama_kegiatan")->join("tb_kegiatan", "tb_jenis_kegiatan.id", "tb_kegiatan.id_kegiatan")->join("users", "tb_kegiatan.id_user", "users.id")->orderBy('id', 'DESC')->get();
        }

        return view('kegiatan_pegawai.kegiatan_pegawai', $data);

    }

    public function add(Request $request){
        $data = $request->except("_tokens");

        $imageName = time() . '.' . $request->file("bukti")->extension();
        $request->file("bukti")->move(public_path('upload/report_kegiatan'), $imageName);

        $data = $request->except("_tokens");
        $data['bukti'] = $imageName;
        $action = KegiatanPegawai::create($data);

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function update(Request $request){
        $dataEdit = $request->except($this->global_exceptKey);

        $action = KegiatanPegawai::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function delete(Request $request) {
        $action = KegiatanPegawai::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }

    public function konfirm(Request $request) {
        $dataKonfirm = $request->except($this->global_exceptKey);
        $action = KegiatanPegawai::where("id", $request['id_konfirm'])->update($dataKonfirm);

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dikonfirmasi'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dikonfirmasi'];

        return redirect()->back()->with($response);
    }
}
