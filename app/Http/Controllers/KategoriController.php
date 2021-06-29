<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    //
    public function index()
    {
        $Kategoris = Kategori::all();
        //return $Kategoris;
        return view('admin.kategori', compact('Kategoris'));
    }

    public function tambah_kategori(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string',
            // 'status_kategori' => 'required|string',
            'gambar_kategori' => 'required|mimes:jpg,jpeg,png'
        ]);

        $kategori = new Kategori;
        $file = $request->file('gambar_kategori')->store('kategori', 'public');
        $kategori->kategori_nama = $request->nama_kategori;
        $kategori->status = 1;
        $kategori->kateori_image = $file;
        $kategori->save();
        return redirect()->route('kategori')->with('tambah', 'Berhasil menambahkan Kategori.');
    }

    public function edit_kategori(Request $request)
    {
        $this->validate($request, [
            'edit_nama_kategori' => 'required|string',
            // 'edit_status_kategori' => 'required|string',
            'edit_gambar_kategori' => 'mimes:jpg,jpeg,png'
        ]);

        $kategori = Kategori::where('id', $request->id_kategori)->firstOrFail();
        $kategori->kategori_nama = $request->edit_nama_kategori;
        $kategori->status = $request->edit_status_kategori;
        if ($request->hasFile('edit_gambar_kategori')) {
            $file = $request->file('edit_gambar_kategori')->store('kategori', 'public');
            $kategori->kateori_image = $file;
        }
        $kategori->save();
        return redirect()->route('kategori')->with('edit', 'Berhasil mengubah data.');
    }

    public function hapus(Request $request)
    {
        Kategori::where('id', $request->id_kategori_hapus)->delete();
        return redirect()->route('kategori');
    }
}
