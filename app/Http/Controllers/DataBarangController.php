<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Sewa;


class DataBarangController extends Controller
{
    //
    public function index()
    {
        $barang = Barang::where('status', 1)->paginate(5);

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

    public function detail($id)
    {
        $barang = Barang::where('id', $id)->firstOrFail();
        return view('admin.detail_barang', [
            'detail' => $barang
        ]);
    }

    public function hapus_data_barang(Request $request)
    {
        $barang = Barang::where('id', $request->id_databarang_hapus)->firstOrFail();
        $cari = Sewa::where('barang_id', $barang->id)->whereIn('status_id', [1, 2, 3, 4, 6, 7])->get();

        // return $cari->count();
        if ($cari->count() != 0) {
            return redirect()->route('data_barang')->with('tolak_hapus', 'Tidak bisa hapus saat ini karena ada transaksi pada barang ini');
        } else {
            $barang->status = false;
            $barang->save();
            return redirect()->route('data_barang')->with('hapus', 'Data deleted successfully');
        }
    }
}
