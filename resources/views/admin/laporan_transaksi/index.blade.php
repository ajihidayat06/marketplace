
@extends('layout.admin.adminMain')

@section('title','Laporan Transaksi')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-3">Laporan Transaksi</h3>

            <form action="{{ route('laporan_transaksi_admin') }}" method="get">
                <div class="input-group mb-3 col-md-5 float-right">
                    <input type="text" id="created_at" name="date" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">Filter</button>
                    </div>
                    <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                </div>
            </form>
            
            {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahstatus">Tambah Status</button> --}}
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">No.</th>
                        <th scope="col">Tgl.Transaksi</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Penyewa</th>
                        <th scope="col">Pemilik</th>
                        
                        <th scope="col">Tgl.Mulai</th>
                        <th scope="col">Tgl.Selesai</th>
                        <th scope="col">Pemasukan</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($laporan as $item)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ date('d-m-Y', strtotime($item->created_at))  }}</td>
                                <td class="text-left"> <strong>{{ $item->barang->barang_nama }}</strong> <br>
                                    <label for=""><strong>Harga: </strong>{{ $item->barang->barang_harga}}</label><br>
                                    <label for=""><strong>Jml.Sewa: </strong>{{ $item->sewa_detail_jumlah }}</label>
                                </td>
                                {{-- <td>{{ $item->barang->barang_harga}}</td>
                                <td>{{ $item->sewa_detail_jumlah }}</td> --}}
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->pemilik->nama }}</td>
                                {{-- <td>
                                    
                                    <a class="btn btn-info tombol-lihat-detail" href="{{route('detail_transaksi_diterima', ['id'=> $item->id])}}">
                                        <i class="fas fa-info-circle"> Detail</i>
                                    </a>
                                </td> --}}
                                <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_mulai))  }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_berakhir))  }}</td>
                                <td id="pemasukan">2500</td>
                                {{-- <td>{{ $jumlah }}</td> --}}
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                        {{-- <div class="row mt-5">
                            <div class="col-md-3">
                                <label for="">Total Pemasukan : </label>
                            </div>
                            <div class="col-md-5">
                                <span id="hasil"></span> rupiah
                            </div>
    
                        </div> --}}
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
            $('#exportpdf').attr('href', '/laporan_transaksi_admin/cetak_pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/laporan_transaksi_admin/cetak_pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>

    {{-- <script>
        var total = document.getElementById('pemasukan').innerHTML;
        var jumlah = {{$jumlah}};
        console.log(jumlah);
        var hasil = document.getElementById('hasil');
        hasil.innerHTML = Number(total)*jumlah;
        
    </script> --}}
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection