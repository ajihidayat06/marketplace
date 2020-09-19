@extends('layout/main')

@section('title','Pengaturan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3>Pengaturan</h3>
    <div class="top-box mt-4 shadow-lg p-3 mb-5 bg-white">
        <div class="pengaturan-isi lebar-a border-right">
            <div class="menusamping border-bottom">
                <a href="#" class="tombol">Profile</a>
            </div>
            <div class="menusamping border-bottom">
                <a href="#" class="tombol">Ubah Password</a>
            </div>
            <div class="menusamping border-bottom">
                <a href="#" class="tombol">Saldo</a>
            </div>
            <div class="menusamping border-bottom">
                <a href="/logout" class="tombol">Logout</a>
            </div>
        </div>
        <div class="pengaturan-isi lebar-b">
            <div class=""> 
                <div class="container">
                        <form class="" action="">                
                            <div class="form-isi row">
                                <input class="form-control " type="text" id="username" placeholder="Cari apa ...">
                            </div>                
                            <div class="form-isi row">
                                <input class="form-control" type="password" id="password" placeholder="Semua Kategori">
                            </div>
                            <div class="form-isi row">
                                <input class="form-control" type="password" id="password" placeholder="Lokasi">
                            </div>
                            <div class="form-isi row ">
                                <button type="button" class="form-control btn btn-primary tengah">Cari</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection