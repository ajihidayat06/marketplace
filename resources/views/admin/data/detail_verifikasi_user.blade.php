
@extends('layout.admin.adminMain')

@section('title','Permintaan Verifikasi')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail Permintaan Verifikasi User</h3>
                {{-- <table class="table table-hover">
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
                            <td>{{ $info->user->email }}</td>
                            <td>
                            <a href="verifikasi_user/detail_verifikasi_user/{{$info->id}}" class="btn btn-info">
                                    <i class="fas fa-info-circle"> Detail</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                @foreach ($infos as $info)
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-4">
                            <span>Nama Lengkap</span>
                        </div>
                        <div class="mb-4">
                            <span>Nama pada Rekening</span>
                        </div>
                        <div class="mb-4">
                            <span>Nomor Rekening</span>
                        </div>
                        <div class="mb-4">
                            <span>NIK</span>
                        </div>
                        <div class="mb-4" style="height: 282px">
                            <span>Foto KTP</span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-4">
                            <span>{{ $info->user_nama_lengkap }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $info->user_nama_rek }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $info->user_rek }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $info->user_KTP }}</span>
                        </div>
                        <div class="mb-4">
                        <span><img src="{{ asset('storage/'.$info->user_foto_ktp) }}" alt="" style="width: 500px"></span>
                        </div>
                    </div>
                </div>
                @endforeach
                <div style="margin-left: 20px">
                    <a href="/verifikasi_user/detail_verifikasi_user/{{$info->id}}/tolak_verifikasi" class="btn btn-danger">
                        <i class="far fa-times-circle"></i> Tolak Verifikasi
                    </a>
                    <a href="/verifikasi_user/detail_verifikasi_user/{{$info->id}}/terima_verifikasi" class="btn btn-success">
                        <i class="far fa-check-circle"></i> Verifikasi
                    </a>
                </div>
        </div>
    </div>
    

@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection