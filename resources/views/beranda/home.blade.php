@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
@if (session('verifikasi'))
<div class="container">
    <div class="alert alert-danger">
        {{ session('verifikasi') }}. 
        <a href="{{ route('verifikasi_akunget')}}">Klik disini</a> untuk verifikasi akun
    </div>
</div>
@endif
@if (session('sedang_verifikasi'))
<div class="container">
    <div class="alert alert-danger">
        {{ session('sedang_verifikasi') }}. 
        {{-- <a href="{{ route('verifikasi_akunget')}}">Klik disini</a> untuk verifikasi akun --}}
    </div>
</div>
@endif

    <div class="pt-0">
        <div class="d-flex justify-content-center">
            <img class="img-fluid" src="{{ asset('img/banner.png') }}" alt="">
        </div>
    </div>
    <div class="container mt-3">
    <h3>KATEGORI</h3>
    <hr>
    <div class="col-md-12 pb-3">
        <div class="container">
            <div class="row">
                @foreach ($kategoris as $kategori)
                <div class="col-md-3">
                    <div class="card border-0">
                        <a href="/home/kategori/{{ $kategori->id }}" class="text-dark" >
                            <div  class="d-flex justify-content-center">
                                <img class="w-50" src="{{ asset('storage/'.$kategori->kateori_image) }}" alt="">
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <p class="card-text text-capitalize" style="">{{ $kategori->kategori_nama }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <h3>Produk Terbaru</h3>
    <hr>
    <div class="col-md-12 pb-3">
        <div class="container">
            <div class="row">
                @foreach ($produk as $item)
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow bg-white rounded" >
                        <a href="/home/kategori/{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
                            <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">{{ (str_word_count($item->barang_nama) > 3 ? substr($item->barang_nama,0,12)."[..]" : $item->barang_nama) }}</h5>
                                <h6 class="card-text text-primary" style="">Rp {{ $item->barang_harga }},-</h6>
                                <p class="text-secondary text-uppercase"><i class="fas fa-map-marker-alt"></i> {{$item->user->user_info->user_kabupaten}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
@endsection