
@extends('layout/main')

@section('title','Profil')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            @include('layout.user.sidebar')
        </div>
        <div class="col-md-8">
            <div style="height: 200px;">
                <img class="profil_image col-sm-4 pengaturan-isi" src="{{ asset('img/utama1.jpeg') }} " alt="">
                <span class="col-sm-8 pengaturan-isi mt-5">
                    <div>
                        <H2 style="color:#DD16EB">{{ Auth::User()->nama }} </H2>
                    </div>
                    <div>
                        <span style="color: #D40887">{{ Auth::User()->email }}</span>
                    </div>
                    <div class="mt-2">
                        {{-- <a href="/pengaturan/profil/editprofil" class="tombol-konten pink">edit profil</a> --}}
                        {{-- <a href="#" class="tombol-konten utu">verifikasi akun</a> --}}
                    </div>
                </span>
            </div>
            <div class="container col-md-12 mt-3">
                <form action="{{ route('editprofil') }}" method="POST">
                    {{ csrf_field() }}
                    <div>
                        <label for="">Nama</label>
                        <span>{{ Auth::User()->nama }}</span>
                    </div>
                    <div class="form-isi row">
                        <label for="user_alamat" style="color: #DD16EB">Alamat</label>
                        <input style="border-color:#DD16EB;" name="user_alamat" class="form-control" type="text" id="user_alamat" placeholder="Masukan Alamat anda ">
                    </div>
                    <div class="form-isi row">
                        <label for="user_provinsi" style="color: #DD16EB">Provinsi</label>
                        <input style="border-color:#DD16EB;" name="user_provinsi" class="form-control" type="text" id="user_provinsi" placeholder="Pilih Provinsi ">
                    </div>
                    <div class="form-isi row">
                        <label for="user_kabupaten" style="color: #DD16EB">Kabupaten</label>
                        <input style="border-color:#DD16EB;" name="user_kabupaten" class="form-control" type="text" id="user_kabupaten" placeholder="Pilih Kabupaten ">
                    </div>
                    <div class="form-isi row">
                        <label for="user_kecamatan" style="color: #DD16EB">Kecamatan</label>
                        <input style="border-color:#DD16EB;" name="user_kecamatan" class="form-control" type="text" id="user_kecamatan" placeholder="Pilih Kecamatan ">
                    </div>
                    <div class="form-isi row">
                        <label for="user_kelurahan" style="color: #DD16EB">Kelurahan</label>
                        <input style="border-color:#DD16EB;" name="user_kelurahan" class="form-control" type="text" id="user_kelurahan" placeholder="Pilih Kelurahan ">
                    </div>
                    <div class="form-isi row ">
                        <button type="submit" class="form-control tombol-konten ungu-biru tengah">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
