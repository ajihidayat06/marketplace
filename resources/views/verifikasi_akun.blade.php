
@extends('layout/main')

@section('title','Pengaturan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3>PENGATRURAN</h3>
    <div class="row">
        <div class="col-md-2">
            
                @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-8 border-left">
            <h4 style="color:#650AF6">VERIFIKASI AKUN</h4>
            <form action="{{route('verifikasi_akun')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-isi row">
                    <label for="user_nama_rek" style="color: #DD16EB">Masukan Nama pada Buku Rekening</label>
                    <input  name="user_nama_rek" class="form-control @error('user_nama_rek') is-invalid @enderror" type="text" id="user_nama_rek" placeholder="Masukan Nama Pemilik Rekening ">
                    @error('user_nama_rek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_rek" style="color: #DD16EB">Masukan Nomor Rekening</label>
                    <input  name="user_rek" class="form-control @error('user_rek') is-invalid @enderror" type="text" id="user_rek" placeholder="Masukan Nomor Rekening Anda ">
                    @error('user_rek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_bank" style="color:#DD16EB">Masukan Nama Bank</label>
                    <input  name="user_bank" class="form-control @error('user_bank') is-invalid @enderror" type="text" id="user_bank" placeholder="Masukan Nama Bank Rekening Anda ">
                    @error('user_bank')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_nama_ktp" style="color: #DD16EB">Masukan Nama Sesuai KTP</label>
                    <input  name="user_nama_ktp" class="form-control @error('user_nama_ktp') is-invalid @enderror" type="text" id="user_nama_ktp" placeholder="Masukan Nama Lengkap Sesuai KTP ">
                    @error('user_nama_ktp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_KTP" style="color: #DD16EB">Masukan NIK </label>
                    <input  name="user_KTP" class="form-control @error('user_KTP') is-invalid @enderror" type="text" id="user_KTP" placeholder="Masukan NIK Anda ">
                    @error('user_KTP')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi">
                    <label style="color:#DD16EB">Upload Foto KTP Anda</label><br>
                    <span style="margin-top: 50px;">
                    <input name="user_foto_ktp" class="@error('user_foto_ktp') is-invalid @enderror" type="file" id="user_foto_ktp">
                    @error('user_foto_ktp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </span>
                </div>
                <button type="submit" class="tombol-konten biru">Simpan Data</button>
            </form>
                
            </div>
    </div>
</div>
@endsection