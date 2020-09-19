@extends('layout/main')

@section('title','RentAll | Masuk')

@section('nav')
    @include('nav.public')
@endsection

@section('konten')
<div class="login-box">
    <div class="logo-login">
        <img src="{{ asset('img/logo1.png') }}" alt="">
    </div>
    <h3 class="mt-3">MASUK</h3>
    <hr>
    <div class="container">
    <form class="" action="{{ route('login') }}" method="POST">
            {{csrf_field()}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="form-group row">
                <label for="username">Email/Username</label>
                <input name="username" class="form-control @error('username') is-invalid @enderror" type="text" id="username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="password">Password</label>
                <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" id="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row ">
                <button type="submit" class="form-control btn btn-primary tengah">Masuk</button>
            </div>
        </form>
    </div>
    <hr>
    <div class="row">
        <p class="tengah">Belum punya akun? <a href="/daftar">Daftar</a></p>
    </div>
</div>
@endsection