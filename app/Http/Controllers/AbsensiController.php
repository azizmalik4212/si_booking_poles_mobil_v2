<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function index(){
        $data['tittle']='Data absensi';
        $data['jabatan']=Auth::user()->jabatan;
        if ($data['jabatan']=='admin') {
            $data['dataSql'] = absensi::select("tb_absensi.*", "users.name")->join("users", "tb_absensi.id_user", "users.id")->orderBy('tanggal', 'DESC')->get();
            $data['absenToday'] = 0;
        }else {
            $data['dataSql'] = absensi::select("tb_absensi.*",  "users.name")->join("users", "tb_absensi.id_user", "users.id")->where('users.id',Auth::user()->id)->orderBy('tanggal', 'DESC')->get();
            $data['absenToday'] = absensi::where('tanggal',date('Y-m-d'))->where('id_user',Auth::user()->id)->count();
        }
        return view('absensi.data_absensi', $data);
    }

    public function add(Request $request){

        $data = $request->input();

        $currentdateTime = date('Y-m-d H:i:s');
        if ($data['type_absen']=='ABSEN_MASUK') {

            $action = absensi::insert(
                array(
                    'id_user' => $data['id_user'],
                    'tanggal' => date('Y-m-d'),
                    'absen_masuk' => date('H:i:s'),
                    'bukti'=> $data['bukti'],
                    'created_at' => $currentdateTime,
                    'lama_keterlambatan' => $this->keterlambatanCount($currentdateTime),
                )
            );
        } else {
            $jamPulang =  date('H:i:s');
            if ($jamPulang>'17:00:00')
                $jamPulang = date('H:i:s',strtotime('17:00:00'));

            $currentdateTime = date('Y-m-d '.$jamPulang);
            $action =  absensi::where('id', $data['id_absen'])
            ->update([
                'absen_pulang' => $jamPulang,
                'bukti_pulang' => $data['bukti'],
                'lama_lembur'=>$this->kecepatanCount($currentdateTime)
            ]);

        }

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

    public function keterlambatanCount($dateNow){
        $result=0;
        $to_time = strtotime($dateNow);
        $from_time = strtotime(date('Y-m-d')." 07:00:00");
        $miniutes=round(abs($to_time - $from_time) / 60,2);
        if ($miniutes>0)
            $result=$miniutes;

        return $result;
    }

    public function kecepatanCount($dateNow){
        $result=0;
        $from_time = strtotime($dateNow);
        $to_time = strtotime(date('Y-m-d')." 17:00:00");
        $miniutes=round(abs($to_time - $from_time) / 60,2);

        if ($to_time>=$from_time)
            $result=$miniutes;

        return $result;
    }
}
