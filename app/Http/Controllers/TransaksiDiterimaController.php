<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sewa;

class TransaksiDiterimaController extends Controller
{
    //
    public function index(){
        $transaksi = Sewa::where('status_id', 6)->get();
        return view('admin.transaksi_diterima.index',[
            'transaksi' => $transaksi,
        ]);
    }

    public function detail($id){
        $transaksi = Sewa::where('id', $id)->firstOrFail();

        return view('admin.transaksi_diterima.detail',[
            'detail' => $transaksi,
        ]);
    }


    public function index_ditolak(){
        $transaksi = Sewa::where('status_id', 5)->get();
        return view('admin.transaksi_ditolak.index',[
            'transaksi' => $transaksi,
        ]);
    }

    public function detail_tolak($id){
        $transaksi = Sewa::where('id', $id)->firstOrFail();

        return view('admin.transaksi_ditolak.detail',[
            'detail' => $transaksi,
        ]);
    }
}
