
@extends('layout.admin.adminMain')

@section('title','Kategori')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Daftar Kategori</h3>
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahkategori">Tambah Kategori</button>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col-md-1">No.</th>
                        <th scope="col-md-4">Nama Kategori</th>
                        <th scope="col-md-2">Status</th>
                        <th scope="col-md-2">Gambar / Icon</th>
                        <th scope="col-md-3">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($Kategoris as $kategori)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $kategori->kategori_nama }}</td>
                                @if ($kategori->status==0)
                                    <td>Tidak Aktif</td>
                                @else
                                    <td>Aktif</td>
                                @endif
                                <td>
                                    <img class="" src="{{ asset('storage/'.$kategori->kateori_image) }}" alt="Card image cap" style="height: 180px; width: 180px">
                                </td>
                                <td>
                                    <button class="btn btn-info tombol-edit" data-toggle="modal" data-target="#editkategori" data-id="{{ $kategori->id }}" data-status="{{$kategori->kategori_status}}" data-kategori="{{ $kategori->kategori_nama }}">
                                        <i class="fas fa-info-circle"> Edit</i>
                                    </button>
                                <button href="#" class="btn btn-danger tombol-hapus" data-toggle="modal" data-target="#hapuskategori" data-id="{{ $kategori->id }}">
                                        <i class="far fa-trash-alt"> Hapus</i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
        </div>
    </div>

    <div class="modal fade" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="tambahkategori" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('tambah_kategori') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-1">
                                <div class="form-isi col-md-10">
                                    <label for="nama_kategori" style="color: #DD16EB">Nama Kategori</label>
                                    <input style="border-color:#DD16EB;" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" type="text" id="nama_kategori" placeholder="Masukan Nama Kategori">
                                    @error('nama_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="status_kategori" style="color: #DD16EB">Status Kategori</label>
                                    {{-- <input style="border-color:#DD16EB;" name="status_kategori" class="form-control @error('status_kategori') is-invalid @enderror" type="text" id="status_kategori" placeholder="Status Kategori"> --}}
                                    <select style="border-color:#DD16EB;" class="form-control @error('status_kategori') is-invalid @enderror" name="status_kategori" id="status_kategori">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    @error('status_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="gambar_kategori" style="color: #DD16EB">gambar / Icon Kategori</label>
                                    <input name="gambar_kategori" class="@error('gambar_kategori') is-invalid @enderror" type="file" id="gambar_kategori">
                                        @error('gambar_kategori')
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

    {{-- modal edit --}}
    <div class="modal fade" id="editkategori" tabindex="-1" role="dialog" aria-labelledby="editkategori" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('edit_kategori') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-1">
                                <input type="hidden" id="id_kategori" name="id_kategori" value="">
                                <div class="form-isi col-md-10">
                                    <label for="edit_nama_kategori" style="color: #DD16EB">Nama Kategori</label>
                                    <input style="border-color:#DD16EB;" name="edit_nama_kategori" class="form-control @error('edit_nama_kategori') is-invalid @enderror" type="text" id="edit_nama_kategori">
                                    @error('edit_nama_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="edit_status_kategori" style="color: #DD16EB">Status Kategori</label>
                                    {{-- <input style="border-color:#DD16EB;" name="status_kategori" class="form-control @error('status_kategori') is-invalid @enderror" type="text" id="status_kategori" placeholder="Status Kategori"> --}}
                                    <select style="border-color:#DD16EB;" class="form-control @error('edit_status_kategori') is-invalid @enderror" name="edit_status_kategori" id="edit_status_kategori"> -- status --
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    @error('edit_status_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="edit_gambar_kategori" style="color: #DD16EB">Gambar / Icon Kategori</label>
                                    <input name="edit_gambar_kategori" class="@error('edit_gambar_kategori') is-invalid @enderror" type="file" id="edit_gambar_kategori">
                                        @error('edit_gambar_kategori')
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

    {{-- modal hapus --}}
    <!-- Modal -->
    <div class="modal fade" id="hapuskategori" tabindex="-1" role="dialog" aria-labelledby="hapuskategoriTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <form action="{{ route('hapus_kategori') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_kategori_hapus" name="id_kategori_hapus" value="">
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

    <script>
        const button = document.querySelectorAll('.tombol-edit');
        const inputId = document.querySelector('#id_kategori');
        const inputNama = document.querySelector('#edit_nama_kategori');
        const inputStatus = document.querySelector('#edit_status_kategori');
        button.forEach(function(modal){
            modal.onclick = function () {
                inputId.value = modal.dataset.id;
                console.log(modal.dataset.kategori);
                inputNama.value = modal.dataset.kategori;
                console.log(modal.dataset.status);
                if (modal.dataset.status == 1){
                    inputStatus.selectedIndex = 0;
                } else{
                    inputStatus.selectedIndex = 1;
                }
            }
        });
        /*
        button.addEventListener('click', () => {
            console.log('terpencet');
        });
        */
    </script>

    {{-- script hapus --}}
    <script>
        const tombol = document.querySelectorAll('.tombol-hapus');
        const inputIdHapus = document.querySelector('#id_kategori_hapus');
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