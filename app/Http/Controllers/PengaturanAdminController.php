<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_info;
use Illuminate\Support\Facades\Auth;

class PengaturanAdminController extends Controller
{
    //
    public function index()
    {
        $myAddInfo = User_info::where('user_id', Auth::id())->get();
        return view('admin.pengaturan', [
            'info' => $myAddInfo,
        ]);
    }

    public function editadmin(Request $request)
    {
        $this->validate($request, [
            'Telephone' => 'required|digits_between:11,13',
            'email' => 'required|',
            'no_rekening' => 'required|digits:12|unique:App\User_info,user_rek',
            'nama_rekening' => 'required|',
            'bank' => 'required|string'
        ]);

        $admin = User_info::where('user_id', Auth::id())->first();
        $admin->user_telp = $request->Telephone;
        $admin->user_rek = $request->no_rekening;
        $admin->user_bank = $request->bank;
        $admin->user_nama_rek = $request->nama_rekening;
        $admin->save();
        return back()->with('update', 'data updated successfully');
    }
}
