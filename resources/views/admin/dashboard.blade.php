
@extends('layout.admin.adminMain')

@section('title','Dashboard')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')

    <div class="col-md-10 offset-2">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif
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
                                    <div >
                                        <span>Transaksi Bulan Ini : <strong>{{$transaksi_bulan_ini->count()}}</strong></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>

            <div class="mt-3">
                <h5 class="text-secondary">Biaya Layanan / Transaksi :</h5>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>Rp {{number_format($biaya_layanan->biaya, 2,",",".")}}</h2>
                        </div>
                        <div class="col-md-1">
                            <a href="" data-toggle="modal" data-target="#UbahBiaya"><i class="far fa-edit"></i> Ubah</a> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel mt-5" id="tampilchart">

            </div>
        </div>
    </div>

    <div class="modal fade" id="UbahBiaya" tabindex="-1" role="dialog" aria-labelledby="UbahBiaya" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #11647A">Ubah Biaya Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ubah_biaya_layanan') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_biaya" id="id_biaya" value="{{ $biaya_layanan->id }}">
                        <div class="mb-3">
                            <label for="biaya" class="text-secondary">Biaya Layanan</label>
                            <input type="text" name="biaya_layanan" id="biaya" class="form-control @error('biaya_layanan') is-invalid @enderror" value="{{ $biaya_layanan->biaya }}">
                            @error('biaya_layanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
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