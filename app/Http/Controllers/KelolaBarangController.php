<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kategori;
use App\Barang;

class KelolaBarangController extends Controller
{
    //
    public function index(){
        $kategori = Kategori::pluck('kategori_nama','id');
        $barang = Barang::where('user_id', Auth::id())->get();
        return view('kelolabarang',[
            'kategoris' => $kategori,
            'barang' => $barang,
        ]);
    }

    public function tambah_barang(Request $request){
        $this->validate($request, [
            'nama_barang' => 'required|string',
            'jumlah_barang' => 'required|numeric',
            'harga_barang' => 'required|integer',
            'gambar_barang' => 'required|mimes:jpeg,jpg,png',
            'kategori_barang' => 'required',
            'deskripsi_barang' => "required|string",
        ]);

        $tambah_barang = new Barang;
        $file = $request->file('gambar_barang')->store('barang','public');

        $tambah_barang->barang_nama = $request->nama_barang;
        $tambah_barang->barang_jumlah = $request->jumlah_barang;
        $tambah_barang->barang_harga = $request->harga_barang;
        $tambah_barang->barang_image = $file;
        $tambah_barang->kategori_id = $request->kategori_barang;
        $tambah_barang->barang_deskripsi = $request->deskripsi_barang;
        $tambah_barang->user_id = Auth::id();
        $tambah_barang->save();
        return redirect()->route('kelola_barang');
    }

    public function detail($id){
        $barang = Barang::where('id', $id)->get();
        $kategori = Kategori::pluck('kategori_nama','id');
        return view('vendor.barang.detail_barang', [
            'details' => $barang,
            'kategoris'=> $kategori
        ]);
    }

    public function edit(Request $request){
        $this->validate($request, [
            'edit_nama_barang' => 'required|string',
            'edit_jumlah_barang' => 'required|numeric',
            'edit_harga_barang' => 'required|integer',
            'edit_kategori_barang' => 'required',
            'edit_deskripsi_barang' => "required|string",
        ]);
        
        $updatebrg = Barang::where('id', $request->id_barang)->firstOrFail();
        $updatebrg->barang_nama = $request->edit_nama_barang;
        $updatebrg->barang_jumlah = $request->edit_jumlah_barang;
        $updatebrg->barang_harga = $request->edit_harga_barang;
        $updatebrg->kategori_id = $request->edit_kategori_barang;
        $updatebrg->barang_deskripsi = $request->edit_deskripsi_barang;
        $updatebrg->save();
        return redirect()->back();
    }

    public function hapus(Request $request){
        Barang::where('id', $request->id_hapus_barang)->delete();
        return redirect()->route('kelola_barang');
    }
}
