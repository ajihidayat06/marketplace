{{-- @extends('layouts.app') --}}

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

    <div class="pt-0">
        {{-- <div class="top-isi">
            <img class="gambar img-fluid" src="{{ asset('img/utama1.jpeg') }} " alt="">
        </div>
        <div class="top-isi">
            <h3>CARI DISINI</h3>
            <div class=""> 
                <div class="container shadow-lg p-3 mb-5 bg-white">
                        <form class="" action="">                
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="text" id="username" placeholder="Cari apa ...">
                            </div>                
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="password" id="password" placeholder="Semua Kategori">
                            </div>
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="password" id="password" placeholder="Lokasi">
                            </div>
                            <div class="form-isi row ">
                                <button type="button" class="form-control tombol-konten ungu-biru tengah">Cari</button>
                            </div>
                            
                        </form>
                </div>
            </div>
        </div> --}}
        <div class="d-flex justify-content-center">
            <img class="img-fluid" src="{{ asset('img/banner.png') }}" alt="">
        </div>
    </div>
    <div class="container mt-3">
    <h3>KATEGORI</h3>
    <hr>
    <div class="kategori-wrapper">
        <div class="container">
            @foreach ($kategoris as $kategori)
            <div class="kategori">
                <a href="/home/kategori/{{ $kategori->id }}" class="btn btn-info">
                    {{$kategori->kategori_nama}}
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <h3>Produk Terbaru</h3>
    <hr>
    <div class="col-md-12 pb-3">
        <div class="container">
            <div class="row">
                @foreach ($produk as $item)
                <div class="col-md-3">
                    <div class="card" >
                        <a href="/home/kategori/{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
                                <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                                <div class="card-body">
                                <h5 class="card-title">{{ $item->barang_nama }}</h5>
                                <p class="card-text" style="">Rp {{ $item->barang_harga }},-</p>
                                <p>{{$item->user->user_info->user_kabupaten}}, {{$item->user->user_info->user_provinsi}}</p>
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
