<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
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

    public function resetPasswordAction(Request $request){
        $dataEdit = $request->except($this->global_exceptKey);
        $dataEdit['password'] = bcrypt($request['password']);

        $action = User::where("id", $request['id_edit'])->update($dataEdit);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil diubah'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal diubah'];

        return redirect()->back()->with($response);
    }

    public function addRegister(Request $request){
        $dataPost = $request->input();
        $data = $request->except(['_tokens','konfirm_pass']);
        $checkUsername = User::where('username',$data['username'])->count();
        $checkEmail = User::where('email',$data['email'])->count();
        $data['password'] = bcrypt($dataPost['password']);

        if ($checkUsername > 0) {
            $response = ['status' => 'gagal', 'message' => 'Username yang Anda masukkan telah terdaftar'];
            return redirect()->back()->with($response)->withInput();
        }

        if ($checkEmail > 0) {
            $response = ['status' => 'gagal', 'message' => 'E-Mail yang Anda masukkan telah terdaftar'];
            return redirect()->back()->with($response)->withInput();
        }

        if (strlen($request['password']) < 8) {
            $response = ['status' => 'gagal', 'message' => 'Password minimal 8 digit'];
            return redirect()->back()->with($response)->withInput();
        }

        if ($request['konfirm_pass'] != $request['password']) {
            $response = ['status' => 'gagal', 'message' => 'Konfirmasi password tidak valid'];
            return redirect()->back()->with($response)->withInput();
        }




        $action = User::create($data);
        if ($action)
            $response = ['status' => 'sukses', 'message' => 'Data berhasil ditambahkan'];
        else
            $response = ['status' => 'gagal', 'message' => 'Data gagal ditambahkan'];

        return redirect()->back()->with($response)->withInput();
    }

    public function validateEmail(Request $request){
        $check = User::where('email',$request['email']);

        if (@$check->count() > 0) {
            $details['email'] = $request['email'];
            $details['type_message'] = 'RESET_PASSORD';
            $details['id_user_parse'] = @$check->first()->id ?? 0;
            $emailJob = new SendQueueEmail($details);
            dispatch($emailJob);

            $response = ['status' => 'sukses', 'message' => 'Link pergantian password telah dikirimkan ke E-mail Anda '.$request['email']];
        } else {
            $response = ['status' => 'gagal', 'message' => 'Email yang Anda masukkan tidak terdaftar'];
        }

        return redirect()->back()->with($response);

    }

    public function resetPassword(Request $request){
        $data['id_user'] = $request['id'];
        return view('auth.passwords.reset', $data);
    }

}
