
@extends('layout.admin.adminMain')

@section('title','Konfirmasi Pembayaran')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            @if (session('tolak_pembayaran'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('tolak_pembayaran') }}. 
                    
                </div>
            </div>
            @endif
            @if (session('terima_pembayaran'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('terima_pembayaran') }}. 
                    
                </div>
            </div>
            @endif

            <h3 class="mb-5">Konfirmasi Pembayaran Penyewaan</h3>
            {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahstatus">Tambah Status</button> --}}
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">No.</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">jumlah Transfer</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($konfirmasi as $item)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td class="text-uppercase">{{ $item->barang->barang_nama }}</td>
                                <td>{{ $item->barang->barang_harga}}</td>
                                <td>{{ $item->sewa_detail_jumlah }}</td>
                                <td>{{ $item->konfirmasi_pembayaran->konfirmasi_pembayaran_jumlah }}</td>
                                <td>
                                    <a class="btn btn-info tombol-lihat-detail" href="/konfirmasi_pembayaran/detail/{{ $item->id }}">
                                        <i class="fas fa-info-circle"> Detail</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
        </div>
    </div>
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection