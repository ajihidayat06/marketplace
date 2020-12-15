
@extends('layout.admin.adminMain')

@section('title','Data user')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Data User</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->email }}</td>
                            @if ($data->akun_verified_at==null)
                                <td class="text-danger">belum terverifikasi</td>
                            @else
                                <td class="text-success">terverifikasi</td>
                            @endif
                            <td>
                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-info-circle"> Detail</i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="fas fa-trash"> Hapus</i>
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