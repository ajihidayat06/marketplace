
@extends('layout/main')

@section('title','Pengaturan | Kelola Barang')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3 class="mb-3">PENGATRURAN</h3>
    <div class="row">
        <div class="col-md-2">

            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-10 border-left">
            <h4 class="mb-3">Kelola Barang</h4>

            <div class="top-box">
                @foreach ($details as $detail)
                
            <button type="button" class="btn btn-primary mt-3" id="tombol-edit-barang" data-toggle="modal" data-kategori="{{ $detail->kategori_id}}" data-target="#editbarang">
                    <i class="fas fa-edit"></i> Ubah Data Barang
                </button>
                <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#hapusbarang">
                    <i class="fas fa-trash-alt"></i> Hapus Data Barang
                </button>
                <div class=" row mt-4">
                    <div class="col-md-4">
                        <img class="img-thumbnail rounded" style="height: 250px; width: 250px;" src="{{ asset('storage/'.$detail->barang_image) }}" alt="">
                    </div>

                    <div class="col-md-6">
                        <div>
                            <strong class="text-capitalize" style="font-size: 20pt">{{ $detail->barang_nama }}</strong>
                        </div>
                        <div class="mt-3">
                            <label for="" style="color: #DD16EB"">Harga Sewa / Hari</label>
                            <div>Rp {{ $detail->barang_harga }},-</div>
                        </div>
                        <div class="mt-3">
                            <label for="" style="color: #DD16EB"">Jumlah Barang</label>
                            <div>{{ $detail->barang_jumlah }} pcs</div>
                        </div>
                        <div class="mt-3">
                            <label for="" style="color: #DD16EB"">Kategori</label>
                            <div>{{ $detail->kategori->kategori_nama }}</div>
                        </div>
                        <div class="mt-3">
                            <label for="" style="color: #DD16EB"">Status</label>
                            <div>{{ $detail->barang_status }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    <div class="mt-3">
                        <label for="" style="color: #DD16EB"">Deskripsi</label>
                        <div>{{ $detail->barang_deskripsi}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal edit --}}
    <div class="modal fade" id="editbarang" tabindex="-1" role="dialog" aria-labelledby="editbarang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang Saya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('edit_barang') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" name="id_barang" id="id_barang" value="{{ $detail->id}}">
                                <div class="form-isi col-md-12">
                                    <label for="edit_nama_barang" style="color: #DD16EB">Nama Barang</label>
                                        <input style="border-color:#DD16EB;" name="edit_nama_barang" class="form-control @error('edit_nama_barang') is-invalid @enderror" type="text" id="edit_nama_barang" value="{{ $detail->barang_nama }}">
                                    
                                    @error('edit_nama_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-isi col-md-5">
                                    <label for="edit_jumlah_barang" style="color: #DD16EB">Jumlah Barang</label>
                                    <input style="border-color:#DD16EB;" name="edit_jumlah_barang" class="form-control @error('edit_jumlah_barang') is-invalid @enderror" type="text" id="edit_jumlah_barang" value="{{ $detail->barang_jumlah }}">
                                    @error('edit_jumlah_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-7">
                                    <label for="edit_harga_barang" style="color: #DD16EB">Harga Sewa / Hari</label>
                                    <input style="border-color:#DD16EB;" name="edit_harga_barang" class="form-control @error('edit_harga_barang') is-invalid @enderror" type="text" id="edit_harga_barang" value="{{ $detail->barang_harga }}">
                                    @error('edit_harga_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="form-isi col-md-12">
                                    <label style="color:#DD16EB">Upload Gambar Barang</label><br>
                                    <span style="margin-top: 50px;">
                                    <input name="edit_gambar_barang" class="@error('edit_gambar_barang') is-invalid @enderror" type="file" id="edit_gambar_barang">
                                    @error('edit_gambar_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="form-isi col-md-12">
                                    <label for="edit_kategori_barang" style="color: #DD16EB">Kategori Barang</label>
                                    <select style="border-color:#DD16EB;" name="edit_kategori_barang" class="form-control @error('edit_kategori_barang') is-invalid @enderror" type="text" id="edit_kategori_barang">
                                    <option value="{{ $detail->kategori_id }}"> {{ $detail->kategori->kategori_nama }}</option>
                                        @foreach ($kategoris as $id => $kategori_nama)
                                            <option value="{{$id}}">{{ $kategori_nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('edit_kategori_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-12">
                                    <label for="edit_deskripsi_barang" style="color: #DD16EB">Deskripsi Barang</label>
                                    <textarea style="border-color:#DD16EB;" name="edit_deskripsi_barang" class="form-control @error('edit_deskripsi_barang') is-invalid @enderror" type="text" id="edit_deskripsi_barang">{{ $detail->barang_deskripsi }}
                                    </textarea>
                                    @error('edit_deskripsi_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>


{{-- modal hapus --}}
    <!-- Modal -->
    <div class="modal fade" id="hapusbarang" tabindex="-1" role="dialog" aria-labelledby="hapusbarang" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Barang Ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                    <form action="{{ route('hapus_barang') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_hapus_barang" name="id_hapus_barang" value="{{ $detail->id}}">
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


{{-- <script>
    const button = document.querySelector('#tombol-edit-barang');
    const inputKategori = document.querySelector('#edit_kategori_barang');
    button.onclick = (function(modal){
        console.log(modal.dataset.kategori);
        modal.onclick = function () {
            
        }
    });
</script> --}}
@endsection