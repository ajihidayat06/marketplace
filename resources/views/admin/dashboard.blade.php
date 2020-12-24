
@extends('layout.admin.adminMain')

@section('title','Dashboard')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')

    <div class="col-md-10 offset-2">
        <div class="container">
            <div class="row">

                <div class="card-deck">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="p-2 text-right border-bottom">Data User</div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <div class="">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div >
                                        <span>Total : <strong>{{$user->count()}}</strong></span>
                                    </div>
                                    <div>
                                        <span>Terverifikasi : <strong>{{$user->whereNotNull('akun_verified_at')->count()}}</strong> </span>
                                    </div>
                                    <div>
                                        <span>Permintaan Verifikasi : <strong>{{$permintaan->count()}}</strong></span>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                

                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="p-2 text-right border-bottom">Data Barang</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div >
                                        <span>Total : <strong>{{$barang->count()}}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="p-2 text-right border-bottom">Transaksi</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="">
                                        <i class="fas fa-money-bill-wave fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div >
                                        <span>Konfirmasi Pembayaran : <strong>{{$transaksi_konfirm->count()}}</strong></span>
                                    </div>
                                    <div >
                                        <span>Diterima : <strong>{{$transaksi_diterima->count()}}</strong></span>
                                    </div>
                                    <div >
                                        <span>Ditolak : <strong>{{$transaksi_ditolak->count()}}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="p-2 text-right border-bottom">Laporan Transaksi</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="">
                                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div >
                                        <span>Jumlah Transaksi : <strong>{{$laporan}}</strong></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

            <div class="panel mt-5" id="tampilchart">

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    Highcharts.chart('tampilchart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Transaksi Bulanan'
    },
    subtitle: {
        text: 'Berdasar Kategori ('+{!!json_encode(date('d-m-Y', strtotime($start)))!!}+' sampai '+{!!json_encode(date('d-m-Y', strtotime($end)))!!}+')'
    },
    xAxis: {
        categories: {!!json_encode($kategori)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Jumlah Transaksi',
        data: {!!json_encode($barang_kt)!!}
    }, ]
});
</script>
@endsection