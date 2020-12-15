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
        <h4>Pembayaran</h4>
        <div class="mt-5 text-center">
            <h3 class="text-uppercase" style="color:#DD16EB">silahkan lakukan pembayaran</h3>
            <p class="text-capitalize" style="font-size: 18pt">melalui tranfer bank BNI ke nomor rekening berikut :</p>
            <h4 class="mt-3 text-primary">{{$info_admin->user_info->user_rek}}</h4>
            <h5 class="text-capitalize mt-3">atas nama: {{$info_admin->user_info->user_nama_rek}}</h5>
            <div class="mt-5">
                <h4 class="text-capitalize" style="color: #DD16EB">
                    Besar tagihan
                </h4>
                <h5 class="mt-3">
                <strong>Rp {{$tagihan}},-</strong>
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection