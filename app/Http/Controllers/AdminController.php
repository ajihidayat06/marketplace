<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_info;
use App\Barang;
use App\Biaya_layanan;
use App\Sewa;
use App\Kategori;
use App\Mail\TerimaVerifikasi;
use App\Mail\VerifikasiAkunDitolak;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    //
    public function index()
    {
        $biaya_layanan = Biaya_layanan::where('id', 1)->firstOrFail();
        $user = User::where('role', 'user')->get();
        $permintaan = DB::table('user_infos')->join('users', 'user_infos.user_id', '=', 'users.id')->whereNotNull('user_foto_ktp')->whereNull('akun_verified_at')->get();
        $barang = Barang::all();
        $transaksi_konfirm = Sewa::where('status_id', 2)->get();
        $transaksi_diterima = Sewa::whereIn('status_id', [6, 7])->get();
        $transaksi_ditolak = Sewa::where('status_id', 5)->get();
        $count = Sewa::where('status_id', 8)->count();
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $laporan = Sewa::where('status_id', 8)->whereBetween('created_at', [$start, $end])->get();
        $barang_kategori = DB::table('sewas')->join('barangs', 'sewas.barang_id', '=', 'barangs.id')->where('status_id', 8)->whereBetween('sewas.created_at', [$start, $end])->get();
        $data_kategori = Kategori::all();
        $kategori = [];
        $count_transaksi = [];
        foreach ($data_kategori as $dk) {
            $kategori[] = $dk->kategori_nama;
            $count_transaksi[] = $barang_kategori->where('kategori_id', $dk->id)->count();
        }
        return view('admin.dashboard', [
            'biaya_layanan' => $biaya_layanan,
            'user' => $user,
            'permintaan' => $permintaan,
            'barang' => $barang,
            'transaksi_konfirm' => $transaksi_konfirm,
            'transaksi_diterima' => $transaksi_diterima,
            'transaksi_ditolak' => $transaksi_ditolak,
            'laporan' => $count,
            'transaksi_bulan_ini' => $laporan,
            'start' => $start,
            'end' => $end,
            'kategori' => $kategori,
            'barang_kt' => $count_transaksi,
        ]);
    }

    public function ubah_biaya(Request $request)
    {
        $ubah = Biaya_layanan::where('id', $request->id_biaya)->firstOrFail();
        $this->validate($request, [
            'biaya_layanan' => 'required|integer'
        ]);

        $ubah->biaya = $request->biaya_layanan;
        $ubah->save();
        return redirect()->route('dashboard')->with('success', "Berhasil mengubah biaya layanan.");
    }

    public function user()
    {
        $user = User::where('role', 'user')->paginate(5);
        return view('admin.data.user', ['datas' => $user]);
    }

    public function detail_user($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.data.detail_user', compact('user'));
    }

    public function hapus(Request $request)
    {
        $user = User::where('id', $request->id_user_hapus)->firstOrFail();
        $cari = Sewa::where('user_id', $user->id)->orWhere('pemilik_id', $user->id)->whereIn('status_id', [1, 2, 3, 4, 6, 7])->get();
        // dd($user);
        if ($cari->count() != 0) {
            return redirect()->route('user')->with('tolak_hapus', 'Tidak bisa hapus saat ini karena ada transaksi pada barang ini');
        } else {
            $user->delete();
            return back()->with('hapus', 'Data berhasil dihapus.');
        }
    }

    public function user_terhapus()
    {
        $user = User::onlyTrashed()->get();
        return view('admin.data.user_terhapus', compact('user'));
    }

    public function kembalikan($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();
        return redirect()->route('user')->with('restore', 'Data berhasil dikembalikan.');
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
        $user_info->user_KTP = null;
        $user_info->user_rek = null;
        $user_info->save();
        // return $user_info;
        $tolak_verifikasi = User::find($user_info->user_id);
        Mail::to($tolak_verifikasi->email)->send(new VerifikasiAkunDitolak($tolak_verifikasi));
        return redirect()->route('verifikasi_user')->with('berhasil_tolak', 'Berhasil menolak verifikasi akun');
    }

    public function terima_verifikasi($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $userData = User_info::where('id', $id)->first();
        $userWantToUpdate = User::find($userData->user_id);
        $userWantToUpdate->akun_verified_at = $date;
        $userWantToUpdate->save();
        Mail::to($userWantToUpdate->email)->send(new TerimaVerifikasi($userWantToUpdate));
        return redirect()->route('verifikasi_user')->with('berhasil_terima', 'Berhasil memverifikasi akun');
    }
}
