<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;


class DataBarangController extends Controller
{
    //
    public function index(){
        $barang = Barang::all();

        // try {
        //     $barang = Barang::all();
        // } catch (\Throwable $th) {
        //     return 'aw';
        // }
        // return 'aww';
        // exit;
        return view('admin.data_barang', [
            'barang' => $barang
        ]);
    }

    public function hapus_data_barang(Request $request){
        return $request;
    }
}
