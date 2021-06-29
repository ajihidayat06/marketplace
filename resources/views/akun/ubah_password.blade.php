
@extends('layout/main')

@section('title','Pengaturan | Ubah Password')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
@if (session('success'))
    <div class=" alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif

    <h3 class="mb-3">PENGATURAN</h3>
    <div class="row">
        <div class="col-md-2">

            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-8 border-left">
            <h4 class="mb-3" style="color: #11647A">Ubah Password</h4>

            <form action="{{route('ubah_password')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="top-box">
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control">

                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="old_password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control ">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('old_password') is-invalid @enderror">

                        
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>

    
</div>
@endsection