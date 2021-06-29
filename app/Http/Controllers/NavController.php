<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Barang;
use App\Sewa;
use Illuminate\Support\Facades\DB;

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
        $barang = Barang::where('status', 1)->orderBy('created_at', 'desc')->limit(8)->get();
        return view('beranda.home', [
            'kategoris' => $kategori,
            'produk' => $barang,
        ]);
    }

    public function tampilKategori($id)
    {
        $tampilBarang = Barang::where('kategori_id', $id)->where('status', 1)->paginate(12);
        $kategori = Kategori::where('id', $id)->firstOrFail();
        // dd($tampilBarang);
        return view('beranda.barang_kategori', ['barangs' => $tampilBarang, 'kategori' => $kategori]);
    }
    public function barangDetail($id)
    {
        $item_detail = Barang::where('id', $id)->firstOrFail();
        $sewa = Sewa::where('barang_id', $id)->whereIn('status_id', [6, 7])->get();
        // dd($sewa);
        $stok = 0;
        $jml_sewa_hari_ini = 0;
        $tgl_skrg = date('d-m-Y');
        $tgl_sewa = null;
        if ($sewa->isEmpty()) {
            $stok = $item_detail->barang_jumlah;
        } else {
            foreach ($sewa as $item) {
                $tgl_sewa = date('d-m-Y', strtotime($item->sewa_tanggal_mulai));
                if ($tgl_sewa == $tgl_skrg || $item->status_id == 7) {
                    $temp = $item->sewa_detail_jumlah;
                    $jml_sewa_hari_ini = $jml_sewa_hari_ini + $temp;
                    $stok = $item->barang->barang_jumlah - $jml_sewa_hari_ini;
                } else {
                    $stok = $item->barang->barang_jumlah;
                }
            }
        }

        $jadwal = Sewa::where('barang_id', $id)->whereIn('status_id', [6, 7])->paginate(5);
        return view('beranda.item_detail', [
            'item' => $item_detail,
            'stok' => $stok,
            'jadwal' => $jadwal
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3',
        ]);

        $search = $request->search;
        // $hasil = Barang::where('barang_nama', 'like', "%$search%")->where('status', 1)->paginate(16);
        $hasil = DB::table('barangs')->join('user_infos', 'barangs.user_id', '=', 'user_infos.user_id')
            ->select('barangs.id', 'barangs.barang_nama', 'barangs.barang_harga', 'barangs.barang_image', 'user_infos.user_kabupaten', 'user_infos.user_provinsi')
            ->where('barang_nama', 'like', "%$search%")
            ->orWhere('user_kabupaten', 'like', "%$search%")
            ->orWhere('user_provinsi', 'like', "%$search%")
            ->where('status', 1)->paginate(16);
        // dd($hasil);
        return view('beranda.search-result')->with('barang', $hasil);
    }
}
