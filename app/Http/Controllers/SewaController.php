<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Biaya_layanan;
use App\Sewa;
use App\User;
use App\Konfirmasi_pembayaran;
use App\Mail\KonfirmasiPembayaran;
use Illuminate\Support\Facades\Mail;

class SewaController extends Controller
{
    //
    public function indexsewa(Request $request)
    {
        // dd($request);
        $biaya_layanan = Biaya_layanan::where('id', 1)->firstOrFail();
        $barang = Barang::where('id', $request->sewa_id_barang)->get();
        $detail_jumlah = $request->sewa_banyak_jumlah;
        $detail_tanggal = $request->daterange;
        // dd($barang, $detail_jumlah);

        $sewa_awal = $request->mulai_sewa;
        $sewa_akhir = $request->selesai_sewa;

        $jumlah_hari = ((abs(strtotime($sewa_akhir) - strtotime($sewa_awal))) / (24 * 60 * 60) + 1);
        return view('beranda.sewa', [
            'biaya_layanan' => $biaya_layanan,
            'barang' => $barang,
            'detail_jumlah' => $detail_jumlah,
            // 'detail_tanggal'=> $detail_tanggal,
            'sewa_awal' => $sewa_awal,
            'sewa_akhir' => $sewa_akhir,
            'jumlah_hari' => $jumlah_hari
        ]);
    }

    public function bayarsewa(Request $request)
    {
        $this->validate($request, [
            'detail_jumlah' => 'required|',
            'detail_tanggal_mulai' => 'required|date',
            'detail_tanggal_selesai' => 'required|date',
            'sewa_pembayaran' => 'required|string',
            'sewa_pengambilan' => 'required|string',
            'sewa_jaminan' => 'required|string',
            'sewa_lama_hari' => 'required|integer',
            'sewa_total_harga' => 'required'
        ]);

        $sewa = new Sewa;
        $sewa->sewa_tanggal_mulai = $request->detail_tanggal_mulai;
        $sewa->sewa_tanggal_berakhir = $request->detail_tanggal_selesai;
        $sewa->sewa_tanggal_mulai = $request->detail_tanggal_mulai;
        $sewa->sewa_total = $request->sewa_total_harga;
        $sewa->sewa_harga = $request->sewa_harga;
        $sewa->sewa_biaya_layanan = $request->sewa_biaya_layanan;
        $sewa->user_id = $request->sewa_nama_penyewa_id;

        $sewa->pemilik_id = $request->sewa_pemilik_barang_id;
        $sewa->barang_id = $request->sewa_barang_id;
        $sewa->sewa_pembayaran = $request->sewa_pembayaran;
        $sewa->sewa_pengambilan = $request->sewa_pengambilan;
        $sewa->sewa_jaminan = $request->sewa_jaminan;
        $sewa->sewa_lama_hari = $request->sewa_lama_hari;
        $sewa->sewa_detail_jumlah = $request->detail_jumlah;
        $sewa->sewa_kode_booking = '';
        $sewa->status_id = 1;
        $sewa->konfirmasi_penerimaan_barang = 0;
        $sewa->konfirmasi_pengembalian_barang = 0;
        $sewa->save();
        $info_admin = user::where('role', 'admin')->first();
        return view('langsung_bayar', [
            'tagihan' => $sewa->sewa_total,
            'info_admin' => $info_admin
        ]);
        return $request;
    }

    public function pembayaran($id)
    {
        $info_admin = user::where('role', 'admin')->first();
        $sewa = Sewa::where('id', $id)->firstOrFail();
        return view('pembayaran', [
            'bayar' => $sewa,
            'info_admin' => $info_admin
        ]);
    }
    public function konfirmasi_bayar($id)
    {
        $data_sewa_barang = Sewa::where('id', $id)->firstOrFail();
        $batas_bayar = date('d-m-Y');
        // if ($batas_bayar==$data_sewa_barang->sewa_tanggal_mulai && $data_sewa_barang->status_id==1){
        //     $data_sewa_barang->status_id = 2;
        //     $data_sewa_barang->save();
        // }
        return view('konfirmasi_bayar', [
            'data_sewa_barang' => $data_sewa_barang
        ]);
    }

    public function konfirmasi_pembayaran(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'jml_transfer' => 'required|numeric',
            'bukti_transfer' => 'required|mimes:jpeg,png'
        ]);
        $sewa = Sewa::where('id', $request->id)->first();

        $konfirmasi = new Konfirmasi_pembayaran;
        $file = $request->file('bukti_transfer')->store('buktiTransfer', 'public');
        $konfirmasi->konfirmasi_pembayaran_nama = $request->nama;
        $konfirmasi->konfirmasi_pembayaran_jumlah = $request->jml_transfer;
        $konfirmasi->konfirmasi_pembayaran_foto = $file;
        $konfirmasi->konfirmasi_pembayaran_value = '';
        $konfirmasi->sewa_id = $request->id;
        $sewa->status_id = 2;
        $konfirmasi->save();
        $sewa->save();

        $user_sewa = User::where('id', $sewa->user_id)->firstOrFail();
        $admin = User::where('role', 'admin')->firstOrFail();
        Mail::to($admin->email)->send(new KonfirmasiPembayaran($user_sewa));
        return redirect()->route('pengaturan');
    }
}
