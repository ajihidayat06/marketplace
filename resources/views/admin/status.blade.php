
@extends('layout.admin.adminMain')

@section('title','Status')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Daftar Status</h3>
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahstatus">Tambah Status</button>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Status Value</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($status as $statuss)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $statuss->status_value }}</td>
                                <td>
                                    <button class="btn btn-info tombol-edit" data-toggle="modal" data-target="#editstatus" data-id="{{ $statuss->id }}" data-status="{{$statuss->status_value}}">
                                        <i class="fas fa-info-circle"> Edit</i>
                                    </button>
                                <button href="#" class="btn btn-danger tombol-hapus" data-toggle="modal" data-target="#hapusstatus" data-id="{{ $statuss->id }}">
                                        <i class="far fa-trash-alt"> Hapus</i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
        </div>
    </div>

    <div class="modal fade" id="tambahstatus" tabindex="-1" role="dialog" aria-labelledby="tambahstatus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('tambah_status') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="mb-1">
                                <div class="form-isi col-md-10">
                                    <label for="status_value" style="color: #DD16EB">Status Value</label>
                                    <textarea style="border-color:#DD16EB;" name="status_value" class="form-control @error('status_value') is-invalid @enderror" id="status_value"  cols="10" rows="5" placeholder="Masukan isi status"></textarea>
                                    @error('status_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                {{-- <div class="form-isi col-md-10">
                                    <label for="status_kategori" style="color: #DD16EB">Status Kategori</label> --}}
                                    {{-- <input style="border-color:#DD16EB;" name="status_kategori" class="form-control @error('status_kategori') is-invalid @enderror" type="text" id="status_kategori" placeholder="Status Kategori">
                                    <select style="border-color:#DD16EB;" class="form-control @error('status_kategori') is-invalid @enderror" name="status_kategori" id="status_kategori">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    @error('status_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
                
                
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="editstatus" tabindex="-1" role="dialog" aria-labelledby="editstatus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('edit_status') }}" method="POST">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
                
                
            </div>
        </div>
    </div>

    {{-- modal hapus --}}
    <!-- Modal -->
    <div class="modal fade" id="hapusstatus" tabindex="-1" role="dialog" aria-labelledby="hapusstatusTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <form action="{{ route('hapus_status') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_status_hapus" name="id_status_hapus" value="">
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
        const inputId = document.querySelector('#id_status');
        const inputStatus = document.querySelector('#edit_status_value');
        button.forEach(function(modal){
            modal.onclick = function () {
                inputId.value = modal.dataset.id;
                inputStatus.value = modal.dataset.status;
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
        const inputIdHapus = document.querySelector('#id_status_hapus');
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