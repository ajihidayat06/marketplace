@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3>Hasil Pencarian</h3>
    <p>{{ $barang->total()}} hasil pencarian untuk '{{ request()->input('search') }}'</p>
    <div class="row mt-4">
        {{-- @foreach ($barang as $item)
            <p>{{ $item->barang_nama }}</p>
        @endforeach --}}
        @foreach ($barang as $item)
            
        <div class="col-md-3 mb-3">
            <div class="card" >
                <a href="home/kategori/{{ $item->id }}/item_detail" class="" style="color: black;text-decoration: none;">
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

        {{ $barang->appends(request()->input())->links() }}
    </div>
        

</div>
@endsection