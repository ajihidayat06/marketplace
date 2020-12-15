
@extends('layout.admin.adminMain')

@section('title','Transaksi Diterima')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Transaksi Diterima</h3>
            {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahstatus">Tambah Status</button> --}}
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">No.</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($transaksi as $item)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $item->barang->barang_nama }}</td>
                                <td>{{ $item->barang->barang_harga}}</td>
                                <td>{{ $item->sewa_detail_jumlah }}</td>
                                <td>{{ $item->pemilik->nama }}</td>
                                <td>
                                    {{-- <form action="{{ route('detail_transaksi_diterima', ['id', $item->id])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info tombol-lihat-detail" href="{{ route('detail_transaksi_diterima', ['id', $item->id])}}">
                                            <i class="fas fa-info-circle"> Detail</i>
                                        </button>
                                    </form> --}}
                                    <a class="btn btn-info tombol-lihat-detail" href="{{route('detail_transaksi_diterima', ['id'=> $item->id])}}">
                                        <i class="fas fa-info-circle"> Detail</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
        </div>
    </div>

    

    {{-- modal edit --}}
    {{-- <div class="modal fade" id="detailbarang" tabindex="-1" role="dialog" aria-labelledby="detailbarang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @foreach ($barang as $barangs)
                <div class="modal-body">
                <form action="#" method="POST">
                            {{ csrf_field() }}
                            <div class="mb-1">
                                <input type="hidden" id="id_status" name="id_status" value="">
                                <div class="form-isi col-md-10">
                                    <label for="edit_nama_kategori" style="color: #DD16EB">Status Value</label>
                                    <textarea style="border-color:#DD16EB;" name="edit_status_value" class="form-control @error('edit_status_value') is-invalid @enderror" id="edit_status_value"  cols="10" rows="5" value=""></textarea>
                                    @error('edit_status_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <div class="mb-1">
                            <input type="hidden" id="id_status" name="id_status" value="">
                            <div class="form-isi col-md-10">
                                <div>
                                    <label class="col-md-5" for="edit_nama_kategori" style="color: #DD16EB">Nama Barang</label>
                                    <span class="col-md-5"><strong>{{ $barangs->barang_nama}}</strong></span>
                                </div>
                                <div>
                                    <label class="col-md-5" for="edit_nama_kategori" style="color: #DD16EB">Harga Sewa</label>
                                    <span class="col-md-5"><strong>Rp {{ $barangs->barang_harga}}</strong></span>
                                </div>
                                <div>
                                    <label class="col-md-5" for="edit_nama_kategori" style="color: #DD16EB">Jumlah Barang</label>
                                    <span class="col-md-5"><strong>{{$barangs->barang_jumlah}} pcs</strong></span>
                                </div>
                                <div>
                                    <label class="col-md-12" for="edit_nama_kategori" style="color: #DD16EB">Gambar</label>
                                    <span class="col-md-12"><img class="img-thumbnail rounded" style="max-height: 200px" src="{{ asset('storage/'.$barangs->barang_image) }}" alt=""></span>
                                </div>
                                <div>
                                    <label class="col-md-12" for="edit_nama_kategori" style="color: #DD16EB">Deskripsi</label>
                                    <span class="col-md-12">{{$barangs->barang_deskripsi}}</span>
                                </div>
                                <textarea style="border-color:#DD16EB;" name="edit_status_value" class="form-control @error('edit_status_value') is-invalid @enderror" id="edit_status_value"  cols="10" rows="5" value=""></textarea>
                                @error('edit_status_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                @endforeach
                
            </div>
        </div>
    </div> --}}

    {{-- modal hapus --}}
    <!-- Modal -->
    {{-- <div class="modal fade" id="hapusdatabarang" tabindex="-1" role="dialog" aria-labelledby="hapusdatabarangTitle" aria-hidden="true">
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
    </div> --}}

    {{-- <script>
        const button = document.querySelectorAll('.tombol-edit');
        const inputId = document.querySelector('#id_status');
        const inputStatus = document.querySelector('#edit_status_value');
        button.forEach(function(modal){
            modal.onclick = function () {
                inputId.value = modal.dataset.id;
                inputStatus.value = modal.dataset.status;
            }
        });
    </script> --}}

    {{-- script hapus --}}
    {{-- <script>
        const tombol = document.querySelectorAll('.tombol-hapus-databarang');
        const inputIdHapus = document.querySelector('#id_databarang_hapus');
        tombol.forEach(function(modal){
            modal.onclick = function (){
                console.log(modal.dataset.id);
                inputIdHapus.value = modal.dataset.id;
            }
        });
    </script> --}}
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection