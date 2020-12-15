<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_info;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }

    public function user(){
        $user = User::where('role', 'user')->get();
        return view('admin.data.user', ['datas'=>$user]);
    }

    public function verifikasiUser(){
        $user_info = DB::table('user_infos')->join('users','user_infos.user_id', '=', 'users.id')->whereNotNull('user_foto_ktp')->whereNull('akun_verified_at')->get();
        //$user_info = User_info::whereNotNull('user_foto_ktp')->get();
        //$userTerverifikasi = User::select('id')->whereNotNull('akun_verified_at')->get();
        //return $userTerverifikasi;
        //return $user_info;
        return view('admin.data.verifikasi_user',['infos'=>$user_info]);

    }

    public function detail_verifikasi_user($id){
        $user_info = User_info::where('user_id', $id)->get();
        return view('admin.data.detail_verifikasi_user',['infos'=>$user_info]);
    }

    public function tolak_verifikasi($id){
        $user_info = User_info::where('id', $id)->first();
        $user_info->user_foto_ktp=null;
        $user_info->save();
        // return $user_info;
        return redirect()->route('verifikasi_user');
    }

    public function terima_verifikasi($id){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $userData = User_info::where('id', $id)->first();
        $userWantToUpdate = User::find($userData->user_id);
        $userWantToUpdate->akun_verified_at = $date;
        $userWantToUpdate->save();
        return redirect()->route('verifikasi_user');
    }
}

