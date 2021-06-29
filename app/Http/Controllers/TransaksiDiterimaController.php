<?php

namespace App\Http\Controllers;

use App\Biaya_layanan;
use Illuminate\Http\Request;

use App\Sewa;

class TransaksiDiterimaController extends Controller
{
    //
    public function index()
    {
        $transaksi = Sewa::whereIn('status_id', [6, 7])->get();
        return view('admin.transaksi_diterima.index', [
            'transaksi' => $transaksi,
        ]);
    }

    public function detail($id)
    {
        $transaksi = Sewa::where('id', $id)->firstOrFail();
        $biaya_layanan = Biaya_layanan::where('id', 1)->firstOrFail();

        return view('admin.transaksi_diterima.detail', [
            'detail' => $transaksi,
            'biaya_layanan' => $biaya_layanan,
        ]);
    }


    public function index_ditolak()
    {
        $transaksi = Sewa::where('status_id', 5)->get();
        return view('admin.transaksi_ditolak.index', [
            'transaksi' => $transaksi,
        ]);
    }

    public function detail_tolak($id)
    {
        $transaksi = Sewa::where('id', $id)->firstOrFail();

        return view('admin.transaksi_ditolak.detail', [
            'detail' => $transaksi,
        ]);
    }
}
