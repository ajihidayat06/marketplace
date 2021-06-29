<?php

namespace App\Http\Controllers;

use App\Mail\KonfirmasiPenerimaanBarang;
use Illuminate\Http\Request;
use App\Sewa;
use App\User;
use Illuminate\Support\Facades\Mail;
use PDF;

class SewaDiterimaController extends Controller
{
    //
    public function index($id)
    {
        $sewa = Sewa::where('id', $id)->firstOrFail();
        $tglSkrg = date('d-m-Y');
        return view('detail_sewa_diterima', [
            'sewa_diterima' => $sewa,
            'tgl_skrg' => $tglSkrg,
        ]);
    }

    public function konfirmasi_penerimaan_barang($id)
    {
        $sewa = Sewa::where('id', $id)->firstOrFail();
        $sewa->konfirmasi_penerimaan_barang = true;
        $sewa->status_id = 7;
        $sewa->save();

        $admin = User::where('role', 'admin')->firstOrFail();
        Mail::to($admin->email)->send(new KonfirmasiPenerimaanBarang($sewa));
        return redirect()->route('pengaturan');
    }

    public function cetak($id)
    {
        $cetak = Sewa::where('id', $id)->firstOrFail();
        $pdf = PDF::loadView('cetak_kode_booking', compact('cetak'));
        return $pdf->stream();
    }
}
