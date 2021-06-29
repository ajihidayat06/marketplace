
@extends('layout.admin.adminMain')

@section('title','Permintaan Verifikasi')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            @if (session('berhasil_tolak'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('berhasil_tolak') }}. 
                    
                </div>
            </div>
            @endif
            @if (session('berhasil_terima'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('berhasil_terima') }}. 
                    
                </div>
            </div>
            @endif

            <h3 class="mb-5">Permintaan Verifikasi User</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col-md-1">No.</th>
                        <th scope="col-md-4">Nama Lengkap</th>
                        <th scope="col-md-2">User_id</th>
                        <th scope="colmd-2">Email</th>
                        <th scope="col-md-3">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($infos as $info)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $info->user_nama_lengkap }}</td>
                                <td>{{ $info->user_id }}</td>
                                <td>{{ $info->email }}</td>
                                <td>
                                    <a href="verifikasi_user/detail_verifikasi_user/{{$info->id}}" class="btn btn-info">
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