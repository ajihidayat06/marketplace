
@extends('layout/main')

@section('title','Pengaturan | Kelola Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3 class="mb-3">PENGATRURAN</h3>
    <div class="row">
        <div class="col-md-2">

            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-10 border-left">
            @if (session('hapus'))
                <div class="alert alert-success" role="alert">
                    {{session('hapus')}}
                </div>
            @endif

            @if (session('tolak_hapus'))
                <div class="alert alert-warning" role="alert">
                    {{session('tolak_hapus')}}
                </div>
            @endif

            <h4 class="mb-3" style="color: #11647A">Kelola Barang</h4>

            <div class="top-box">
                {{-- <div class="row">
                    <div class="col-md-3">
                        <p class="text-dark" >No.Rekening</p>
                        <p class="text-dark" >Nama Bank</p>
                    </div>
                    <div class="col-md-3">
                        <p style="">{{ $info_bank->user_rek }}</p>
                        <p style="">{{ $info_bank->user_bank }}</p>
                    </div>
                </div> --}}
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambahbarang">
                    <i class="fas fa-plus"></i> Tambah Barang Saya
                </button>

                <div class="row mt-4">
                    @foreach ($barang as $item)
                        
                    <div class="col-md-3 mb-3">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="{{ asset('storage/'.$item->barang_image) }}" alt="Card image cap" style="height: 180px">
                            <div class="card-body">
                            <h5 class="card-title">{{ $item->barang_nama }}</h5>
                            <p class="card-text">Rp {{ $item->barang_harga }},-</p>
                            <a href="kelola_barang/detail_barang/{{ $item->id }}" class="btn btn-info d-flex justify-content-center">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahbarang" tabindex="-1" role="dialog" aria-labelledby="tambahbarang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #11647A">Tambah Barang Saya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('tambah_barang') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-isi col-md-12">
                                    <label for="nama_barang" class="text-dark" >Nama Barang</label>
                                    <input  name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" type="text" id="nama_barang" placeholder="Masukan Nama Barang">
                                    @error('nama_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-isi col-md-5">
                                    <label for="jumlah_barang" class="text-dark" >Jumlah Barang</label>
                                    <input  name="jumlah_barang" class="form-control @error('jumlah_barang') is-invalid @enderror" type="text" id="jumlah_barang" placeholder="Jumlah Barang">
                                    @error('jumlah_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-7">
                                    <label for="harga_barang" class="text-dark" >Harga Sewa / Hari</label>
                                    <input  name="harga_barang" class="form-control @error('harga_barang') is-invalid @enderror" type="text" id="harga_barang" placeholder="Masukan Harga Sewa">
                                    @error('harga_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-isi col-md-12">
                                    <label class="text-dark">Upload Gambar Barang</label><br>
                                    <span style="margin-top: 50px;">
                                    <input name="gambar_barang" class="@error('gambar_barang') is-invalid @enderror" type="file" id="gambar_barang">
                                    @error('gambar_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-isi col-md-12">
                                    <label for="kategori_barang" class="text-dark" >Kategori Barang</label>
                                    <select  name="kategori_barang" class="form-control @error('kategori_barang') is-invalid @enderror" type="text" id="kategori_barang">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $id => $kategori_nama)
                                            <option value="{{$id}}">{{ $kategori_nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-12">
                                    <label for="deskripsi_barang" class="text-dark" >Deskripsi Barang</label>
                                    <textarea  name="deskripsi_barang" class="form-control @error('deskripsi_barang') is-invalid @enderror" type="text" id="deskripsi_barang" placeholder="Deskripsikan sedetail mungkin"></textarea>
                                    @error('deskripsi_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection