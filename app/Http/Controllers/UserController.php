<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
//use App\User;
use Illuminate\Support\Facades\Auth;
use App\User_info;
use App\wilayah_provinsi;
use App\wilayah_kabupaten;
use App\wilayah_kecamatan;
use App\wilayah_kelurahan;
use App\Sewa;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('verifikasi');
    }
    */
    public function indexpengaturan()
    {
        session(['role' => 'renter']);
        // return DB::table('user_infos')->join('users','user_infos.user_id', '=', 'users.id');
        $inforek = User_info::where('user_id', Auth::id())->firstOrFail();
        // $sewa_belum_bayar = Sewa::where([
        //     ['user_id', Auth::id()],
        //     ['status_id',1],
        // ])->get();
        $sewa_belum_bayar = Sewa::where(
            'user_id',
            Auth::id()
        )->whereIn('status_id', [1, 3])->get();
        $sewa_sedang_dikonfirmasi = Sewa::where('user_id', Auth::id())->whereIn('status_id', [2, 4])->get();
        $sewa_diterima = Sewa::where('user_id', Auth::id())->whereIn('status_id', [6, 7])->get();
        $sewa_selesai = Sewa::where('user_id', Auth::id())->where('status_id', 8)->get();
        return view('pengaturan', [
            'info' => $inforek,
            'sewa_belum_bayar' => $sewa_belum_bayar,
            'sedang_dikonfirmasi' => $sewa_sedang_dikonfirmasi,
            'sewa_diterima' => $sewa_diterima,
            'sewa_selesai' => $sewa_selesai
        ]);
    }

    public function indexprofil()
    {
        //return Route::currentRouteName();
        //session(['role' => 'renter']);
        //return session('role');
        $myAddInfo = User_info::where('user_id', Auth::id())->get();
        $provinsi = wilayah_provinsi::pluck('nama', 'id');
        return view('profil', [
            'provinsi' => $provinsi,
            'myAddInfo' => $myAddInfo
        ]);
    }

    public function editprofil(Request  $request)
    {
        $userinfo = User_info::where('user_id', Auth::id())->first();
        //validasi
        $this->validate($request, [
            'Telephone' => 'required|digits_between:11,13',
            'user_alamat' => 'required|string',
            'user_provinsi' => 'required',
            'user_kabupaten' => 'required',
            'user_kecamatan' => 'required',
            'user_kelurahan' => 'required',
        ]);
        $provinsi = wilayah_provinsi::where('id', $request->user_provinsi)->first();
        $nama_provinsi = $provinsi->nama;
        $kabupaten = wilayah_kabupaten::where('id', $request->user_kabupaten)->first();
        $nama_kabupaten = $kabupaten->nama;
        $kecamatan = wilayah_kecamatan::where('id', $request->user_kecamatan)->first();
        $nama_kecamatan = $kecamatan->nama;
        $kelurahan = wilayah_kelurahan::where('id', $request->user_kelurahan)->first();
        $nama_kelurahan = $kelurahan->nama;

        if ($userinfo != null) {
            # code...
            $userinfo->user_telp = $request->Telephone;
            $userinfo->user_alamat = $request->user_alamat;
            $userinfo->user_provinsi = $nama_provinsi;
            $userinfo->user_kabupaten = $nama_kabupaten;
            $userinfo->user_kecamatan = $nama_kecamatan;
            $userinfo->user_kelurahan = $nama_kelurahan;
            $userinfo->save();
            return redirect()->route('profil');
        } else {
            $idku = Auth::id();
            $user_info = new User_info;
            $user_info->user_telp = $request->Telephone;
            $user_info->user_alamat = $request->user_alamat;
            $user_info->user_provinsi = $request->user_provinsi;
            $user_info->user_kabupaten = $request->user_kabupaten;
            $user_info->user_kecamatan = $request->user_kecamatan;
            $user_info->user_kelurahan = $request->user_kelurahan;
            $user_info->user_id = $idku;
            $user_info->save();
            return redirect()->route('profil');
        }
    }

    public function verifikasiakun()
    {
        $provinsi = wilayah_provinsi::pluck('nama', 'id');
        return view('verifikasi_akun', [
            'provinsi' => $provinsi,
        ]);
    }

    public function postverifikasiakun(Request $request)
    {
        $userinfo = User_info::where('user_id', Auth::id())->first();
        //validasi
        $this->validate($request, [
            'Telephone' => 'required|digits_between:11,13',
            'user_alamat' => 'required|string',
            'user_provinsi' => 'required',
            'user_kabupaten' => 'required',
            'user_kecamatan' => 'required',
            'user_kelurahan' => 'required',
            'user_rek' => 'required|digits:12|unique:App\User_info,user_rek',
            'user_bank' => 'required|string',
            'user_KTP' => 'required|digits:16|unique:App\User_info,user_KTP',
            'user_foto_ktp' => 'required|mimes:jpeg,png',
        ]);

        $provinsi = wilayah_provinsi::where('id', $request->user_provinsi)->first();
        $nama_provinsi = $provinsi->nama;
        $kabupaten = wilayah_kabupaten::where('id', $request->user_kabupaten)->first();
        $nama_kabupaten = $kabupaten->nama;
        $kecamatan = wilayah_kecamatan::where('id', $request->user_kecamatan)->first();
        $nama_kecamatan = $kecamatan->nama;
        $kelurahan = wilayah_kelurahan::where('id', $request->user_kelurahan)->first();
        $nama_kelurahan = $kelurahan->nama;

        if ($userinfo != null) {
            # code...
            $file = $request->file('user_foto_ktp')->store('fotoktp', 'public');
            $userinfo->user_telp = $request->Telephone;
            $userinfo->user_alamat = $request->user_alamat;
            $userinfo->user_provinsi = $nama_provinsi;
            $userinfo->user_kabupaten = $nama_kabupaten;
            $userinfo->user_kecamatan = $nama_kecamatan;
            $userinfo->user_kelurahan = $nama_kelurahan;
            $userinfo->user_rek = $request->user_rek;
            $userinfo->user_bank = $request->user_bank;
            $userinfo->user_KTP = $request->user_KTP;
            $userinfo->user_nama_rek = $request->user_nama_rek;
            $userinfo->user_nama_lengkap = $request->user_nama_ktp;
            $userinfo->user_foto_ktp = $file;
            $userinfo->save();
            return redirect('/pengaturan');
        }
    }

    public function kabupaten(Request $request)
    {
        $kabupaten = wilayah_kabupaten::where('provinsi_id', $request->get('id'))->pluck('nama', 'id');
        return response()->json($kabupaten);
    }

    public function kecamatan(Request $request)
    {
        $kecamatan = wilayah_kecamatan::where('kabupaten_id', $request->get('id'))->pluck('nama', 'id');
        //return 'a';
        return response()->json($kecamatan);
    }

    public function kelurahan(Request $request)
    {
        $kelurahan = wilayah_kelurahan::where('kecamatan_id', $request->get('id'))->pluck('nama', 'id');
        //return 'a';
        return response()->json($kelurahan);
    }

    public function informasibank()
    {
        $bank =  User_info::where('user_id', Auth::id())->first();
        return view('informasi_bank', ['info_bank' => $bank]);
    }

    public function editbank(Request  $request)
    {
        $bank = User_info::where('user_id', Auth::id())->first();
        //validasi
        $this->validate($request, [
            'rekening' => 'required|digits:12',
            'nama_bank' => 'required|string',
        ]);

        $bank->user_rek = $request->rekening;
        $bank->user_bank = $request->nama_bank;
        $bank->save();
        return redirect()->route('informasi_bank');
    }

    public function ubah_password()
    {
        return view('akun.ubah_password');
    }

    public function update()
    {
        request()->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $curentpassword = auth()->user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password, $curentpassword)) {
            auth()->user()->update([
                'password' => Hash::make(request('password')),
            ]);
            return back()->with('success', "You are changed your password");
        } else {
            return back()->withErrors(['old_password' => 'Make sure you fill your current password']);
        }
    }

    public function ubah_foto(Request $request)
    {
        $id = User_info::where('user_id', $request->user_id)->firstOrFail();
        $file_name = $request->file('user_image')->getClientOriginalName();
        $file = $request->file('user_image')->storeAs('avatar', $file_name, 'public');

        $id->user_image = $file;
        $id->save();
        return back();
    }
}
