
@extends('layout.admin.adminMain')

@section('title','Data user terhapus')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            @if (session('hapus'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('hapus') }}. 
                    {{-- <a href="{{ route('verifikasi_akunget')}}">Klik disini</a> untuk verifikasi akun --}}
                </div>
            </div>
            @endif
            <h3 class="mb-3">Data User Terhapus</h3>
            
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
                        @foreach ($user as $data)
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
                                {{-- <a href="{{route('detail_user', ['id' => $data->id])}}" class="btn btn-info">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a> --}}
                                <a href="{{route('kembalikan', ['id' => $data->id])}}" class="btn btn-success">
                                    <i class="fas fa-undo-alt"></i> Restore
                                </a>
                                {{-- <button href="#" class="btn btn-danger btn-md tombol-hapus" data-toggle="modal" data-target="#hapususer" data-id="{{ $data->id }}">
                                    <i class="fas fa-trash"> Hapus</i>
                                </button> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    
{{-- modal hapus --}}
    <!-- Modal -->
    {{-- <div class="modal fade" id="hapususer" tabindex="-1" role="dialog" aria-labelledby="hapususerTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                    <form action="{{ route('hapus_user') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_user_hapus" name="id_user_hapus" value="">
                            Yakin ingin menghapus ini?
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Hapus</button>
                    </form>
                    </div>
            </div>
        </div>
        </div> --}}

        {{-- script hapus --}}
    <script>
        const tombol = document.querySelectorAll('.tombol-hapus');
        const inputIdHapus = document.querySelector('#id_user_hapus');
        
        tombol.forEach(function(modal){
            modal.onclick = function (){
                console.log(modal.dataset.id);
                inputIdHapus.value = modal.dataset.id;
            }
        });
    </script>
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection