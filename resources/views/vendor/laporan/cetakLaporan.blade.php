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

    .invoice-box table{
        width: 100%;
        border-collapse: collapse;
        vertical-align: top;
    }
    .invoice-box table, th, td{
        padding: 3px;
        border: 1px solid black;
        line-height: normal;
        text-align: left;

    }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h4 class="title">Laporan transaksi penyewaan marketplace penyewaan barang (rentall) 
            periode {{ date('d-m-Y', strtotime($date[0])) }} - {{ date('d-m-Y', strtotime($date[1])) }}
        </h4>
        <table>
            <tr style="font-weight: bold">
                <td >No.</td>
                <td >Tgl.Transaksi</td>
                <td >Barang</td>
                <td >Penyewa</td>
                <td >Pemilik</td>
                <td >Tgl.Mulai</td>
                <td >Tgl.Selesai</td>
                <td >Pemsukan</td>
            </tr>
            @forelse ($sewa as $item)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{ date('d-m-Y', strtotime($item->created_at))  }}</td>
                <td > <strong>{{ $item->barang->barang_nama }}</strong> <br>
                    <label for=""><strong>Harga: </strong>{{ $item->sewa_harga}}</label><br>
                    <label for=""><strong>Jml.Sewa: </strong>{{ $item->sewa_detail_jumlah }}</label>
                </td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->pemilik->nama }}</td>
                <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_mulai))  }}</td>
                <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_berakhir))  }}</td>
                <td id="pemasukan">{{ $item->sewa_harga * $item->sewa_detail_jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center">Tidak ada data</td>
            </tr>
            @endforelse
        </table>
    </div>
</body>
</html>