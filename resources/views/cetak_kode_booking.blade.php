<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}"> --}}
    <title>Laporan Transaksi</title>
    <style>
        .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    .title{
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 30px;
    }

    </style>
</head>
<body>
    <div class="invoice-box">
        <h4 class="title">Kode Booking penyewaan marketplace penyewaan barang (rentall) 
        </h4>
        <table style='width:100%; font-size:8pt; border-collapse: collapse;'>
            <td width='60%'  style='padding-right:80px; vertical-align:top'>
            <span style='font-size:16pt; text-transform: uppercase'><b>{{$cetak->barang->barang_nama}}</b></span><br>
            <span>Tanggal sewa : {{date('d-m-Y', strtotime($cetak->sewa_tanggal_mulai))}} sampai {{date('d-m-Y', strtotime($cetak->sewa_tanggal_berakhir))}}<br>
            </span>
            <span> Jumlah sewa : {{$cetak->sewa_detail_jumlah}} pcs</span>
            <br>
            <span> Lama sewa : {{$cetak->sewa_lama_hari}} hari</span>
            <br>
            </td>
            <td style='vertical-align:top' width='40%'>
            <b><span style='font-size:16pt'>Kode Booking</span></b>
            <br>
            <strong style="color: red; text-transform: uppercase; font-size: 12pt">{{$cetak->sewa_kode_booking}}</strong>
            <br>
            <span>Pemilik barang : <strong style="color: red; text-transform: capitalize;">{{$cetak->pemilik->nama}}</strong></span>
            <br>
            <span>Alamat : {{$cetak->pemilik->user_info->user_alamat}}, {{$cetak->pemilik->user_info->user_kelurahan}}, 
            {{$cetak->pemilik->user_info->user_kecamatan}}, {{$cetak->pemilik->user_info->user_provinsi}} </span>
            </td>
        </table>
            <h5 style="color: black; text-transform: uppercase">langkah selanjutnya :</h5>
            <p class="text-secondary text-justify">- Silahkan simpan/foto/cetak kode booking anda (kode booking harus ditunjukan saat anda mengambil barang).</p>
            <p class="text-secondary text-justify">- Siapkan tanda jaminan saat anda mengambil barang, jaminan sesuai dengan yang anda pilih 
            saat melakukan transaksi sewa (<span style="color: red; text-transform: uppercase">{{$cetak->sewa_jaminan}}</span>). 
            Pengambilan Barang (<span style="color: red; text-transform: capitalize">{{$cetak->sewa_pengambilan}}</span>)</p>
            <p class="text-secondary text-justify">- Setelah anda mengambil barang sewaan, silahkan lakukan konfirmasi penerimaan
                barang pada Marketplace Penyewaan Barang.
            </p>
    </div>
</body>
</html>