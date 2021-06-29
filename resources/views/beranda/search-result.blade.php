@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3>Hasil Pencarian</h3>
    <p>{{ $barang->total()}} hasil pencarian untuk '{{ request()->input('search') }}'</p>
    <div style="min-height: 500px">
        <div class="row mt-4">
            {{-- @foreach ($barang as $item)
                <p>{{ $item->barang_nama }}</p>
            @endforeach --}}
            @foreach ($barang as $item)
                
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow bg-white rounded" >
                    <a href="/home/kategori/{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
                        <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase">{{ (str_word_count($item->barang_nama) > 3 ? substr($item->barang_nama,0,12)."[..]" : $item->barang_nama) }}</h5>
                            <h6 class="card-text text-primary" style="">Rp {{$item->barang_harga }},-</h6>
                            <p class="text-secondary text-uppercase"><i class="fas fa-map-marker-alt"></i> {{$item->user_kabupaten}}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $barang->appends(request()->input())->links() }}
        </div>
    </div>
        

</div>
@endsection