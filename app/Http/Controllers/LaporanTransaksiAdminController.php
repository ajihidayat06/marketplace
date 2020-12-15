<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sewa;
use Carbon\Carbon;
use PDF;

class LaporanTransaksiAdminController extends Controller
{
    //
    public function index(){
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }


        $laporan = Sewa::where('status_id', 8)->whereBetween('created_at', [$start, $end])->get();
        $count = Sewa::where('status_id', 8)->count();
        return view('admin.laporan_transaksi.index', [
            'laporan' => $laporan,
            'jumlah' => $count
        ]);
    }

    public function cetak($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        // $orders = Order::with(['customer.district'])->whereBetween('created_at', [$start, $end])->get();
        $sewa = Sewa::where('status_id', 8)->whereBetween('created_at', [$start, $end])->get();

        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = PDF::loadView('admin.laporan_transaksi.cetak_laporan', compact('sewa', 'date'));
        //GENERATE PDF-NYA
        return $pdf->stream();
    }
}
