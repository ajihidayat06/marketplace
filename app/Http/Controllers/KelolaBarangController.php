<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kategori;
use App\Barang;
use App\Sewa;

class KelolaBarangController extends Controller
{
    //
    public function index()
    {
        $kategori = Kategori::pluck('kategori_nama', 'id');
        $barang = Barang::where('user_id', Auth::id())->where('status', 1)->paginate(8);
        return view('kelolabarang', [
            'kategoris' => $kategori,
            'barang' => $barang,
        ]);
    }

    public function tambah_barang(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required|string',
            'jumlah_barang' => 'required|numeric',
            'harga_barang' => 'required|integer',
            'gambar_barang' => 'required|mimes:jpeg,jpg,png',
            'kategori_barang' => 'required',
            'deskripsi_barang' => "required|string",
        ]);

        $tambah_barang = new Barang;
        $file = $request->file('gambar_barang')->store('barang', 'public');

        $tambah_barang->barang_nama = $request->nama_barang;
        $tambah_barang->barang_jumlah = $request->jumlah_barang;
        $tambah_barang->barang_harga = $request->harga_barang;
        $tambah_barang->barang_image = $file;
        $tambah_barang->kategori_id = $request->kategori_barang;
        $tambah_barang->barang_deskripsi = $request->deskripsi_barang;
        $tambah_barang->user_id = Auth::id();
        $tambah_barang->status = 1;
        $tambah_barang->save();
        return redirect()->route('kelola_barang');
    }

    public function detail($id)
    {
        $barang = Barang::where('id', $id)->get();
        $kategori = Kategori::pluck('kategori_nama', 'id');
        return view('vendor.barang.detail_barang', [
            'details' => $barang,
            'kategoris' => $kategori
        ]);
    }

    public function edit(Request $request)
    {
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
        return redirect()->back()->with('edit', 'Data has been changed successfully');
    }

    public function hapus(Request $request)
    {
        $barang = Barang::where('id', $request->id_hapus_barang)->firstOrFail();
        $cari = Sewa::where('barang_id', $barang->id)->whereIn('status_id', [1, 2, 3, 4, 6, 7])->get();

        // return $cari->count();
        if ($cari->count() != 0) {
            return redirect()->route('kelola_barang')->with('tolak_hapus', 'Tidak bisa hapus saat ini karena ada transaksi pada barang ini');
        } else {
            $barang->status = false;
            $barang->save();
            return redirect()->route('kelola_barang')->with('hapus', 'Data deleted successfully');
        }
    }

    public function ubah_foto(Request $request)
    {
        $this->validate($request, [
            'barang_image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $barang = Barang::where('id', $request->barang_id)->firstOrFail();
        $file = $request->file('barang_image')->store('barang', 'public');
        $barang->barang_image = $file;
        $barang->save();
        return back()->with('ubah_foto', 'image updated successfully');
    }
}
