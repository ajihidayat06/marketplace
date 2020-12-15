@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    {{-- <div class="top-box">
        <div class="top-isi">
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
        </div>
    </div>
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
    </div> --}}
    
    <div class="row mt-4">
        @foreach ($barangs as $item)
            
        <div class="col-md-3 mb-3">
            <div class="card" >
                <a href="{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
                        <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                        <div class="card-body">
                        <h5 class="card-title">{{ $item->barang_nama }}</h5>
                        <p class="card-text" style="">Rp {{ $item->barang_harga }},-</p>
                        <p>{{$item->user->user_info->user_kabupaten}}, {{$item->user->user_info->user_provinsi}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
        
        @endforeach

</div>
@endsection