<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sewa;
use App\Status;
use App\Konfirmasi_pembayaran;
use App\Mail\KonfirmasiPembayaranDitolak;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenyewaanMasuk;

class KonfirmasiPembayaranController extends Controller
{
    //
    public function index()
    {
        $konfirmasi = Sewa::where('status_id', 2)->get();
        return view('admin.konfirmasi_pembayaran.konfirmasi_pembayaran', [
            'konfirmasi' => $konfirmasi
        ]);
    }

    public function detail($id)
    {
        $sewa_konfirmasi = Sewa::where('id', $id)->firstOrFail();
        $status = Status::all();
        return view('admin.konfirmasi_pembayaran.detail_konfirmasi_pembayaran', [
            'detail' => $sewa_konfirmasi,
            'status' => $status
        ]);
    }
    public function tolak(Request $request)
    {
        $sewa = Sewa::where('id', $request->id_detail_konfirmasi)->firstOrFail();
        $sewa->status_id = 3;
        $sewa->save();
        $status = Konfirmasi_pembayaran::where('sewa_id', $request->id_detail_konfirmasi)->firstOrFail();
        $status->konfirmasi_pembayaran_value = $request->konfirmasi_pembayaran_value;
        $status->save();
        Mail::to($sewa->user->email)->send(new KonfirmasiPembayaranDitolak($sewa));

        return redirect()->route('admin_konfirmasi_pembayaran')
            ->with('tolak_pembayaran', 'Konfirmasi pembayaran ditolak, pesan berhasil dikirim ke penyewa');
    }

    public function terima_konfirmasi($id)
    {
        $sewa = Sewa::where('id', $id)->firstOrFail();
        $sewa->status_id = 4;
        $sewa->save();
        Mail::to($sewa->pemilik->email)->send(new PenyewaanMasuk($sewa));
        return redirect()->route('admin_konfirmasi_pembayaran')
            ->with('terima_pembayaran', 'Konfirmasi pembayaran diterima, pesan berhasil dikirim ke pemilik barang');
    }
}
