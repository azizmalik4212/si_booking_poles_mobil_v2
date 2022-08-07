<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function index(){
        $this->middleware('auth');
        $data['tittle']='Data users';
        $data['sqlUser'] = User::get();
        return view('users.data_user', $data);
    }

    public function register(){
        $data['tittle']='Data register';
        $data['sqlUser'] = User::get();
        return view('register.register', $data);
    }

    public function addUser(Request $request){
        $this->middleware('auth');
        $dataPost = $request->input();
        $data = $request->except("_tokens");
        // $data['password'] = bcrypt($dataPost['password']);

        $action = User::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function addRegister(Request $request){
        $dataPost = $request->input();
        $data = $request->except("_tokens");
        $data['password'] = bcrypt($dataPost['password']);

        $action = User::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

    public function updateUser(Request $request){
        $this->middleware('auth');
        $dataEdit = $request->except($this->global_exceptKey);

        $action = User::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function deleteUser(Request $request) {
        $this->middleware('auth');
        $action = User::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }

    public function orderPage(){
        $this->middleware('auth');
        $data['dataUser'] = Auth::user();
        $data['dataLayanan'] = Layanan::get();
        $data['getLastId']=@Booking::orderBy('id', 'DESC')->get()->first()->id ?? 0;
        $data['no_booking']='BOOK_'.$this->leadingZero($data['getLastId'] + 1);
        return view('frontend.booking_user.booking_page',$data);
    }

    public function listOrderPage(){
        $this->middleware('auth');
        $data['dataUser'] = Auth::user();
        $data['dataLayanan'] = Layanan::get();
        $data['dataSql'] = Booking::select("tb_booking.*","users.nama", "tb_layanan.jenis_layanan")->join("users", "users.id","tb_booking.id_user")->join("tb_layanan", "tb_booking.id_layanan", "tb_layanan.id")->where('id_user',Auth::user()->id)->get();
        return view('frontend.booking_user.list_booking_user',$data);
    }

    public function pembayaranPage(){
        $this->middleware('auth');
        $data['dataUser'] = Auth::user();
        $data['dataSql'] = DB::select("SELECT `tb_booking`.*, `users`.`nama`, `tb_layanan`.`jenis_layanan`,`tb_layanan`.`harga`,tb_pembayaran.bukti,tgl_pembayaran from `tb_booking`
        inner join `users` on `users`.`id` = `tb_booking`.`id_user`
        inner join `tb_layanan` on `tb_booking`.`id_layanan` = `tb_layanan`.`id`
        left join tb_pembayaran ON tb_booking.id = tb_pembayaran.id_booking
        where `id_user` = ".@$data['dataUser']->id ?? 0 );

        return view('frontend.pembayaran_user.pembayaran_user',$data);
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

    public function profileUser(){
        $data['tittle']='Profile user';
        $data['dataUser'] = User::where('id',Auth::user()->id)->first();
        return view('frontend.profile_user.profile_user_page', $data);
    }
}
