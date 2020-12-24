<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Barang;


class NavController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ["except" => ["index"]]);
    }

    public function index()
    {
        $kategori = Kategori::all();
        $barang = Barang::orderBy('created_at', 'desc')->get();
        return view('beranda.home', [
            'kategoris' => $kategori,
            'produk' => $barang,
        ]);
    }

    public function tampilKategori($id)
    {
        $tampilBarang = Barang::where('kategori_id', $id)->get();
        return view('beranda.barang_kategori', ['barangs' => $tampilBarang]);
    }
    public function barangDetail($id)
    {
        $item_detail = Barang::where('id', $id)->get();
        return view('beranda.item_detail', ['items' => $item_detail]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3',
        ]);

        $search = $request->search;
        $hasil = Barang::where('barang_nama', 'like', "%$search%")->paginate(10);
        return view('beranda.search-result')->with('barang', $hasil);
    }
}
