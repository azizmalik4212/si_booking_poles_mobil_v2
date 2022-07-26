<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function index(){
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
        $dataEdit = $request->except($this->global_exceptKey);

        $action = User::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function deleteUser(Request $request) {
        $action = User::where("id", $request['id_delete'])->delete();

        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil dihapus'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal dihapus'];

        return redirect()->back()->with($response);
    }
}
