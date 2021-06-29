
@extends('layout.admin.adminMain')

@section('title','Data Barang')

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
            @if (session('tolak_hapus'))
            <div class="container">
                <div class="alert alert-warning">
                    {{ session('tolak_hapus') }}. 
                    {{-- <a href="{{ route('verifikasi_akunget')}}">Klik disini</a> untuk verifikasi akun --}}
                </div>
            </div>
            @endif

            <h3 class="mb-5">Daftar Barang</h3>
            {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahstatus">Tambah Status</button> --}}
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Gambar Barang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($barang as $no => $barangs)
                            <tr>
                                <th scope="row">{{$barang->firstItem()+$no}}</th>
                                <td class="text-capitalize">{{ $barangs->barang_nama }}</td>
                                <td>{{ $barangs->kategori->kategori_nama }}</td>
                                <td class="text-capitalize">{{ $barangs->user->nama}}</td>
                                <td>{{ $barangs->barang_harga}}</td>
                                <td>{{ $barangs->barang_jumlah }}</td>
                                <td><img class="img-thumbnail rounded" style="width: 100px; height:100px" src="{{ asset('storage/'.$barangs->barang_image) }}" alt=""></td>
                                <td>
                                    
                                    <a href="{{ route('info_barang', ['id' => $barangs->id]) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i> Detail</a>
                                    <button href="#" class="btn btn-danger tombol-hapus-databarang" data-toggle="modal" data-target="#hapusdatabarang" data-id="{{ $barangs->id }}">
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
                
        </div>
    </div>

    {{-- modal hapus --}}
    <!-- Modal -->
    <div class="modal fade" id="hapusdatabarang" tabindex="-1" role="dialog" aria-labelledby="hapusdatabarangTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <form action="{{ route('hapus_data_barang') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_databarang_hapus" name="id_databarang_hapus" value="">
                        Yakin ingin menghapus ini?
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Hapus</button>
                </form>
                </div>
        </div>
    </div>
    </div>


    {{-- script hapus --}}
    <script>
        const tombol = document.querySelectorAll('.tombol-hapus-databarang');
        const inputIdHapus = document.querySelector('#id_databarang_hapus');
        tombol.forEach(function(modal){
            modal.onclick = function (){
                console.log(modal.dataset.id);
                inputIdHapus.value = modal.dataset.id;
            }
        });
    </script>
@endsection

@section('footer')
<div class="col-md-10 offset-2">
    <div class="d-flex justify-content">
        {{$barang->links()}}
    </div>
</div>
    @include('layout.admin.adminfooter')
@endsection