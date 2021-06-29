<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

use App\User_info;


class AuthController extends Controller
{
    public function __construct()
    {
        session(['role' => 'renter']);
    }
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|',
            'password' => 'required|string|min:6',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {
            if (Auth::user()->role == 'admin') {

                return redirect('/dashboard');
            } else {
                return redirect('/');
            }
        }
        return redirect('/login')->with(['error' => 'Email/Password salah!']);
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

        // User::create([
        //     'nama' => $request->nama,
        //     'username'=> $request->username,
        //     'email' => $request->email,
        //     'password'=> bcrypt($request->password),
        //     'role' => 'renter'
        // ]);
        // User_info::create([
        //     'user_id' => User::id()
        // ]);
        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'user';
        $user->save();
        // return $user->id;
        $user_info = new User_info;
        $user_info->user_id = $user->id;
        $user_info->save();
        return redirect('/login');
    }

    public function bantuan()
    {
        return view('bantuan');
    }
}
