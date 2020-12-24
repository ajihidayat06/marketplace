<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_info;
use App\Barang;
use App\Sewa;
use App\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        $permintaan = DB::table('user_infos')->join('users', 'user_infos.user_id', '=', 'users.id')->whereNotNull('user_foto_ktp')->whereNull('akun_verified_at')->get();
        $barang = Barang::all();
        $transaksi_konfirm = Sewa::where('status_id', 2)->get();
        $transaksi_diterima = Sewa::where('status_id', 6)->get();
        $transaksi_ditolak = Sewa::where('status_id', 5)->get();
        $count = Sewa::where('status_id', 8)->count();

        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $laporan = Sewa::where('status_id', 8)->whereBetween('created_at', [$start, $end])->get();

        // $jml_kategori = Kategori::all()->count();

        $barang_kategori = DB::table('sewas')->join('barangs', 'sewas.barang_id', '=', 'barangs.id')->where('status_id', 8)->get();
        // $barang_kt = $barang_kategori->where('kategori_id', 1)->count();
        // dd($barang_kt);

        $data_kategori = Kategori::all();
        $kategori = [];
        $count_transaksi = [];
        foreach ($data_kategori as $dk) {
            $kategori[] = $dk->kategori_nama;
            $count_transaksi[] = $barang_kategori->where('kategori_id', $dk->id)->count();
        }
        // dd($count_transaksi);

        return view('admin.dashboard', [
            'user' => $user,
            'permintaan' => $permintaan,
            'barang' => $barang,
            'transaksi_konfirm' => $transaksi_konfirm,
            'transaksi_diterima' => $transaksi_diterima,
            'transaksi_ditolak' => $transaksi_ditolak,
            'laporan' => $count,
            'start' => $start,
            'end' => $end,
            'kategori' => $kategori,
            'barang_kt' => $count_transaksi,
        ]);
    }

    public function user()
    {
        $user = User::where('role', 'user')->get();
        return view('admin.data.user', ['datas' => $user]);
    }

    public function verifikasiUser()
    {
        $user_info = DB::table('user_infos')->join('users', 'user_infos.user_id', '=', 'users.id')->whereNotNull('user_foto_ktp')->whereNull('akun_verified_at')->get();
        //$user_info = User_info::whereNotNull('user_foto_ktp')->get();
        //$userTerverifikasi = User::select('id')->whereNotNull('akun_verified_at')->get();
        //return $userTerverifikasi;
        //return $user_info;
        return view('admin.data.verifikasi_user', ['infos' => $user_info]);
    }

    public function detail_verifikasi_user($id)
    {
        $user_info = User_info::where('user_id', $id)->get();
        return view('admin.data.detail_verifikasi_user', ['infos' => $user_info]);
    }

    public function tolak_verifikasi($id)
    {
        $user_info = User_info::where('id', $id)->first();
        $user_info->user_foto_ktp = null;
        $user_info->save();
        // return $user_info;
        return redirect()->route('verifikasi_user');
    }

    public function terima_verifikasi($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $userData = User_info::where('id', $id)->first();
        $userWantToUpdate = User::find($userData->user_id);
        $userWantToUpdate->akun_verified_at = $date;
        $userWantToUpdate->save();
        return redirect()->route('verifikasi_user');
    }
}
