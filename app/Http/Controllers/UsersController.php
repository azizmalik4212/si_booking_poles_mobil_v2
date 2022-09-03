<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $data['password'] = bcrypt($dataPost['password']);
        $checkEmail = User::where('email',$request['email'])->count();
        $cekUsername = User::where('username',$data['username'])->count();
        if ($cekUsername > 0) {
            $response = ['status' => 'gagal', 'message' => 'Username yang anda inputkan telah terdaftar'];
        } else if ($checkEmail > 0){
            $response = ['status' => 'gagal', 'message' => 'E-Mail yang anda inputkan telah terdaftar'];
        } else if (strlen($dataPost['password']) < 8){
            $response = ['status' => 'gagal', 'message' => 'Password minimal 8 digit'];
        } else {
            $action = User::create($data);
            if ($action)
                $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
            else
                $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];
        }

        return redirect()->back()->with($response)->withInput();
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

        $checkEmail = User::where('email',$request['email'])->where('id', '!=' , $request['id_edit'])->count();
        if ($checkEmail > 0) {
            $response = ['status' => 'gagal', 'message' => 'E-Mail yang Anda masukkan telah terdaftar'];
            return redirect()->back()->with($response)->withInput();
        }

        $dataEdit = $request->except($this->global_exceptKey);

        $action = User::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function updatePassword(Request $request){
        $this->middleware('auth');

        $checkPass = User::where('id', $request['id_edit'])->first();

        if (strlen($request['password']) < 8) {
            $response = ['status' => 'gagal', 'message' => 'Password minimal 8 digit'];
            return redirect()->back()->with($response)->withInput();
        }

        if (!Hash::check($request['password_lama'], $checkPass->password)) {
            $response = ['status' => 'gagal', 'message' => 'Password lama tidak valid'];
            return redirect()->back()->with($response)->withInput();
        }

        $action = User::where("id", $request['id_edit'])->update(['password' =>  bcrypt($request['password'])]);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response)->withInput();
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

        $data['minTimeBook'] = '09:00'; $data['maxTimeBook'] = '18:00';
        if (in_array(date('w'),[0,6])) {
            $data['minTimeBook'] = '10:00'; $data['maxTimeBook'] = '15:00';
        }
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
        $data['dataSql'] = DB::select("SELECT `tb_booking`.*, `users`.`nama`, `tb_layanan`.`jenis_layanan`,`tb_layanan`.`harga`,tb_pembayaran.bukti,tb_pembayaran.`status` as status_pembayaran,tgl_pembayaran,rek_transfer from `tb_booking`
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

    public function gantiPassword(){
        $data['tittle']='Ganti password';
        $data['dataUser'] = User::where('id',Auth::user()->id)->first();
        return view('frontend.profile_user.ganti_password_page', $data);
    }

    public function jadwalBooking(){
        $data['tittle']='Jadwal booking';
        $data['dataUser'] = User::where('id',Auth::user()->id)->first();
        $data['dataBooking'] = DB::select("SELECT 'BOOKED' as title, date(tgl_booking) as start,date(tgl_booking) as end
        FROM tb_booking
        INNER JOIN users ON tb_booking.id_user = users.id
        INNER JOIN tb_layanan ON tb_booking.id_layanan = tb_layanan.id WHERE status != 'REJECT'");
        return view('frontend.jadwal_booking.jadwal_booking', $data);
    }


}
