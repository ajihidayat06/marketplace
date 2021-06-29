@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('datepicker')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection


@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <div class="mt-4" style="min-height: 450px">
        <h4>Konfirmasi Pembayaran</h4>
        <div class="mt-5 text-center">
            <h3 class="text-uppercase" style="color:#1A97BA">silahkan lakukan konfimasi pembayaran untuk pesanan anda</h3>
        </div>
        <div class="row mt-3 border rounded">
            <div class="col-md-4 my-auto mt-3 mb-3">
                <div>
                    <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$data_sewa_barang->barang->barang_image) }}" alt="">
                </div>
                <div class="mt-3 text-center">
                    <h5 class="text-primary text-uppercase">{{$data_sewa_barang->barang->barang_nama}}</h5>
                    <h6 class="text-dark">{{date('d-m-Y', strtotime($data_sewa_barang->sewa_tanggal_mulai))}} sampai {{date('d-m-y', strtotime($data_sewa_barang->sewa_tanggal_berakhir))}}</h6>
                    <h6 class="text-dark">{{$data_sewa_barang->sewa_detail_jumlah}} pcs</h6>
                </div>
            </div>
            <div class="col-md-8 my-auto mt-3 mb-3">
                <form action="{{ route('konfirmasi_pembayaran') }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$data_sewa_barang->id}}">
                    <div>
                        <h4 class="text-uppercase">{{$data_sewa_barang->barang->barang_nama}}</h4> 
                    </div>
                    <div class="mt-3 row">
                        <label class="col-md-3 my-auto" for="">Nama</label>
                        <input type="text" class="form-control text-capitalize col-md-7 @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="masukan nama sesuai nama pada rekening anda">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3 row">
                        <label class="col-md-3 my-auto" for="">Jumlah Tranfer</label>
                        <input type="text" readonly class="form-control text-capitalize col-md-7 @error('jml_transfer') is-invalid @enderror" name="jml_transfer" id="jml_transfer" value="{{ $data_sewa_barang->sewa_total}}">
                        @error('jml_transfer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3 row">
                        <label class="col-md-3 my-auto" for="">Bukti Transfer</label>
                        <input type="file" class=" text-capitalize col-md-7 @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer" id="bukti_transfer">
                        @error('bukti_transfer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-5 row">
                        <button type="submit" class=" col-md-6 mx-auto btn btn-outline-success btn-circle btn-md-sewa text-capitalize">konfirmasi sekarang</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection