<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Makassar");
        $this->global_exceptKey = ['_tokens', '_token', 'id_edit'];
    }

    public function register(){
        $data['tittle']='Data register';
        $data['sqlUser'] = User::get();
        return view('register.register', $data);
    }

    public function addRegister(Request $request){
        $dataPost = $request->input();
        $data = $request->except("_tokens");
        //$data['password'] = bcrypt($dataPost['password']);

        $action = User::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response);
    }

}
