<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User_info;
use App\Sewa;
use App\User;
use App\Barang;
use App\Mail\PenyewaanDiterima;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenyewaanDitolak;

class VendorController extends Controller
{
    //
    public function index()
    {
        session(['role' => 'vendor']);
        $inforek = User_info::where('user_id', Auth::id())->first();
        // $barang = Barang::select('id')->where('user_id', Auth::id())->get();
        // $sewa = Sewa::where('barang_id', $barang)->get();
        // return $sewa;

        // $barang_user = Sewa::addSelect(['barang_user' => Barang::select('id')
        //     ->where('user_id', Auth::id())
        // ])->get(); 


        // dd($barang_user);

        // return $barang_user;

        // $barang = Barang::select('id')->where('user_id', Auth::id())->get();
        // $barang_user = DB::table('sewas')->where('barang_id', $barang)->get();

        // $user = Sewa::where(
        //     'status_id', 4)->where('barang_id', function ($query){
        //             $query = Barang::where('user_id',Auth::id());
        //     })->get();

        // $sewa = Sewa::where('status_id', 4)->get();


        // $barang = Barang::where('user_id', 9)->get();
        // $barang_id = $barang->id;

        // $barang_sewa = Sewa::where('status_id',4)->where('barang_id', $barang_id)->get();

        $barang_pemilik = Sewa::where('pemilik_id', Auth::id())->whereIn('status_id', [4, 6])->get();
        $sedang_sewa = Sewa::where('pemilik_id', Auth::id())->where('status_id', 7)->get();
        $riwayat = Sewa::where('pemilik_id', Auth::id())->where('status_id', 8)->get();
        return view('vendor.pengaturan', [
            'info' => $inforek,
            'permintaan_sewa' => $barang_pemilik,
            'sedang_disewa' => $sedang_sewa,
            'riwayats' => $riwayat
        ]);
    }

    public function tolak(Request $request)
    {
        $tolak = Sewa::where('id', $request->id_tolak_sewa)->firstOrFail();
        // dd($request->id_tolak_sewa);
        $tolak->status_id = 5;
        $tolak->save();

        Mail::to($tolak->user->email)->send(new PenyewaanDitolak($tolak, $request->pesan_tolak));
        return back();
        // nanti bikin tabel pesan trus diisi,
        // trus statusnya ganti permintaan sewa ditolak pemilik
    }

    public function terima(Request $request)
    {
        $this->validate($request, [
            'kode_booking' => 'required',
        ]);
        // dd($request->id_terima_sewa);

        $sewa = Sewa::where('id', $request->id_terima_sewa)->firstOrFail();
        $sewa->sewa_kode_booking = $request->kode_booking;
        $sewa->status_id = 6;
        $sewa->save();

        Mail::to($sewa->user->email)->send(new PenyewaanDiterima($sewa));
        return back();
        // nanti isi kode buking tabel seewa
        // trus ganti status
    }

    public function konfirmasi_pengembalian($id)
    {
        $sewa = Sewa::where('id', $id)->firstOrFail();
        $sewa->konfirmasi_pengembalian_barang = true;
        $sewa->status_id = 8;
        $sewa->save();
        return back();
    }
}
