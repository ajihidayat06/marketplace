<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sewa;

class SewaDiterimaController extends Controller
{
    //
    public function index($id){
        $sewa = Sewa::where('id', $id)->firstOrFail();
        return view('detail_sewa_diterima', [
            'sewa_diterima' => $sewa,
        ]);
    }

    public function konfirmasi_penerimaan_barang($id){
        $sewa = Sewa::where('id', $id)->firstOrFail();
        $sewa->konfirmasi_penerimaan_barang = true;
        $sewa->status_id = 7;
        $sewa->save();
        return redirect()->route('pengaturan');
    }
}
