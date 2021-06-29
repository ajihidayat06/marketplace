
@extends('layout/main')

@section('title','Pengaturan | Laporan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3 class="mb-3">PENGATURAN</h3>
    <div class="row">
        <div class="col-md-2">

            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-10 border-left">
            <h4 class="mb-3" style="color: #11647A">Laporan Penyewaan</h4>

            {{-- @if ($laporan->count() < 1)
            <div class="d-flex justify-content-center mt-5">
                <div class="d-flex align-items-center" >
                    
                    <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                    
                </div>
                <br>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <label for="" class="text-secondary"><h6>"Belum ada Laporan Sewa"</h6></label>
            </div>
            @else --}}
                
            <div class="top-box">
                <form action="{{ route('laporan') }}" method="get">
                    <div class="input-group mb-3 col-md-6 float-right">
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
                            @if ($laporan->count() > 0)
                            @foreach ($laporan as $no => $item)
                                <tr class="text-center">
                                    {{-- <th scope="row">{{$laporan->firstItem()+$no}}</th> --}}
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at))  }}</td>
                                    <td class="text-left"> <strong>{{ $item->barang->barang_nama }}</strong> <br>
                                        <label for=""><strong>Harga: </strong>{{ $item->sewa_harga}}</label><br>
                                        <label for=""><strong>Jml.Sewa: </strong>{{ $item->sewa_detail_jumlah }}</label>
                                    </td>
                                    
                                    <td>{{ $item->user->nama }}</td>
                                    <td>{{ $item->pemilik->nama }}</td>
                                    
                                    <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_mulai))  }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->sewa_tanggal_berakhir))  }}</td>
                                    <td id="pemasukan">{{ $item->sewa_harga * $item->sewa_detail_jumlah }}</td>
                                    
                                </tr>
                                @endforeach

                            @else
                            <tr>
                                <td colspan="8">
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="d-flex align-items-center" >
                                            
                                            <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                            
                                        </div>
                                        <br>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <label for="" class="text-secondary"><h6>"Belum ada Laporan Sewa"</h6></label>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-end mt-5">
                        {{$laporan->links()}}
                    </div> --}}
            </div>
        </div>
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
            $('#exportpdf').attr('href', '/pengaturan/laporan/cetak_pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/pengaturan/laporan/cetak_pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
@endsection