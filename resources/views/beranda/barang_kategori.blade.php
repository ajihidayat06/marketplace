@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    @if ($barangs->count() > 0)
    <h3>Kategori {{$kategori->kategori_nama}}</h3>

    <div class="col-md-12 pb-3 mt-4" style="min-height: 500px">
        <div class="container">
            <div class="row">
                @foreach ($barangs as $item)
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow bg-white rounded" >
                        <a href="/home/kategori/{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
                            <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">{{ (str_word_count($item->barang_nama) > 3 ? substr($item->barang_nama,0,12)."[..]" : $item->barang_nama) }}</h5>
                                <h6 class="card-text text-primary" style="">Rp {{ $item->barang_harga }},-</h6>
                                <p class="text-secondary text-uppercase"><i class="fas fa-map-marker-alt"></i> {{$item->user->user_info->user_kabupaten}}</p>
                                {{-- <p>{{$item->user->user_info->user_kabupaten}}</p> --}}
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            

            <div class="d-flex justify-content-center mt-5">
                {{$barangs->links()}}
            </div>
        </div>
    </div>
    
    @else
    <div style="min-height: 500px">
        <div class="d-flex justify-content-center mt-5">
            <div class="d-flex align-items-center" >
                
                <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                
            </div>
            <br>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <label for="" class="text-secondary"><h5>"Belum ada barang pada kategori ini"</h5></label>
        </div>
        </div>
    @endif

</div>
@endsection