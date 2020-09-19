<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {
            return redirect('/pengaturan');
        }
        return redirect('/masuk')->with(['error' => 'Email/Password salah!']);;
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //fungsi daftar
    public function daftar()
    {
        return view('auths.daftar');
    }

    public function postdaftar(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'], //TAMBAHKAN VALIDASI USERNAME
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        return "berhasil daftar";
    }
}
