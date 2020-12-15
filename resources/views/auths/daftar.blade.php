@extends('layout/main')

@section('title','RentAll | Daftar')

@section('nav')
    @include('nav.public')
@endsection

@section('konten')
<div class="login-box">
    <div class="logo-login">
        <img src="{{ asset('img/logo1.png') }}" alt="">
    </div>
    <h3 class="mt-3">DAFTAR</h3>
    <hr>
    <div class="container">
        <form class="" action="{{ route('daftar') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="nama">Nama Lengkap</label>
                <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text" id="nama">
                @error('nama')
                    <span class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="username">Username</label>
                <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" id="username">
                @error('username')
                    <span class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="email">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="email">
                @error('email')
                    <span class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group row">
                <label for="password">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="password">
                @error('password')
                    <span class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="konfirmpassword">Konfirmasi Password</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" id="konfirmpassword">
                @error('password_confirmation')
                    <span class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="row ">
                <button type="submit" class="form-control btn btn-primary tengah">Daftar</button>
            </div>
        </form>
    </div>
    <hr>
    <div class="row">
        <p class="tengah">Punya akun? <a href="/masuk">Masuk</a></p>

    </div>
</div>
@endsection