
@extends('layout/main')

@section('title','Pengaturan')

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
        <div class="col-md-8 border-left">
            <h4 class="mb-3" style="color:#11647A">Profil</h4>
            <div style="height: 200px;">
                <div class="row">
                    <div class="col-sm-4 ">
                        <img class="rounded-circle" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                        <button class="col-md-5 offset-3 btn btn-outline-info btn-sm mt-2" data-toggle="modal" data-target="#ubahfoto">Ubah Foto</button>
                    </div>
                    <div class="col-sm-8  my-auto">
                        <div>
                            <H2 style="color:#11647A">{{ Auth::User()->nama }} </H2>
                        </div>
                        <div>
                            <span class="text-secondary">{{ Auth::User()->email }}</span>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editprofil">Edit Profil</button>
                            {{-- <a href="#" class="tombol-konten utu">verifikasi akun</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container col-md-12 mt-5">
                <div class="row">
                    <div class="col-md-5">
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Nama</h5>
                            <span>{{ Auth::User()->nama }}</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Username</h5>
                            <span>{{ Auth::User()->username }}</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Email</h5>
                            <span>{{ Auth::User()->email }}</span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        @if (!$myAddInfo->isEmpty())
                            @foreach ($myAddInfo as $item)
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">HP/Telp</h5>
                                @if ($item->user_telp!=null)
                                    <span>{{ $item->user_telp }}</span>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">Alamat</h5>
                                @if ($item->user_alamat!=null)
                                <span>{{$item->user_alamat}},
                                    {{$item->user_kelurahan}},
                                    {{$item->user_kecamatan}},
                                    {{$item->user_kabupaten}},
                                    {{$item->user_provinsi}}
                                </span>
                                @else
                                    <span>-</span>
                                @endif
                                    
                            </div>
                            @endforeach                                
                        @else
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">HP/Telp</h5>
                            <span>-</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color:#1A97BA">Alamat</h5>
                            <span>-</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="editprofil" tabindex="-1" role="dialog" aria-labelledby="editprofil" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('editprofil') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-isi col-md-4">
                                    <label for="telp" style="color: #11647A">Nomor HP</label>
                                    <input style="" name="Telephone" class="form-control @error('Telephone') is-invalid @enderror" type="text" id="telp" placeholder="Masukan Nomor HP Aktif ">
                                    @error('Telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-8">
                                    <label for="user_alamat" style="color: #11647A">Alamat</label>
                                    <input style="" name="user_alamat" class="form-control @error('user_alamat') is-invalid @enderror" type="text" id="user_alamat" placeholder="Masukan Alamat anda ">
                                    @error('user_alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-isi col-md-6">
                                    <label for="user_provinsi" style="color: #11647A">Provinsi</label>
                                    {{-- <input style="border-color:#11647A;" name="user_provinsi" class="form-control @error('user_provinsi') is-invalid @enderror" type="text" id="user_provinsi" placeholder="Pilih Provinsi "> --}}
                                    <select name="user_provinsi" id="provinsi" class="form-control @error('user_provinsi') is-invalid @enderror">
                                        <option value="">== Pilih Provinsi ==</option>
                                        @foreach ($provinsi as $id => $nama)
                                            <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_provinsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-6">
                                    <label for="user_kabupaten" style="color: #11647A">Kabupaten</label>
                                    {{-- <input style="border-color:#11647A;" name="user_kabupaten" class="form-control @error('user_kabupaten') is-invalid @enderror" type="text" id="user_kabupaten" placeholder="Pilih Kabupaten ">
                                    --}}
                                    <select name="user_kabupaten" id="kabupaten" class="form-control @error('user_kabupaten') is-invalid @enderror">
                                        <option value="">== Pilih Kabupaten ==</option>
                                        
                                    </select>
                                    @error('user_kabupaten') 
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-6">
                                    <label for="user_kecamatan" style="color: #11647A">Kecamatan</label>
                                    {{-- <input style="border-color:#11647A;" name="user_kecamatan" class="form-control @error('user_kecamatan') is-invalid @enderror" type="text" id="user_kecamatan" placeholder="Pilih Kecamatan "> --}}
                                    <select name="user_kecamatan" id="kecamatan" class="form-control @error('user_kecamatan') is-invalid @enderror">
                                        <option value="">== Pilih kecamatan ==</option>
                                        
                                    </select>
                                    @error('user_kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-6">
                                    <label for="user_kelurahan" style="color: #11647A">Kelurahan</label>
                                    {{-- <input style="border-color:#11647A;" name="user_kelurahan" class="form-control @error('user_kelurahan') is-invalid @enderror" type="text" id="user_kelurahan" placeholder="Pilih Kelurahan "> --}}
                                    <select name="user_kelurahan" id="kelurahan" class="form-control @error('user_kelurahan') is-invalid @enderror">
                                        <option value="">== Pilih Kelurahan ==</option>
                                        
                                    </select>
                                    @error('user_kelurahan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Profil</button>
                        </form>
                </div>
                
                
            </div>
            </div>
        </div>

{{-- modal ubah foto --}}
        <div class="modal fade" id="ubahfoto" tabindex="-1" role="dialog" aria-labelledby="editprofil" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('ubah_foto') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{Auth::User()->id }}">
                                
                                    <div class="col-md-6 offset-3">
                                        <img class="img-thumbnail rounded" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                        <label for="" class="text-secondary">Ubah foto profil</label>
                                        <input type="file" name="user_image">
                                    </div>
                                
                                <br>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ubah Foto</button>
                            </form>
                    </div>
                    
                    
                </div>
                </div>
            </div>
</div>

<script>
    $(function () {
        $('#provinsi').click('change', function () {
            axios.post('{{ route('kabupaten') }}', {id: $(this).val()})
                .then(function (response) {
                    $('#kabupaten').empty();
    
                    $.each(response.data, function (id, name) {
                        $('#kabupaten').append(new Option(name, id))
                    })
                    
                });
        });
    });

    $(function () {
        $('#kabupaten').click('change', function () {
            //console.log($(this).val());
            
            axios.post('{{ route('kecamatan') }}', {id: $(this).val()})
                .then(function (response) {
                    $('#kecamatan').empty();
    
                    $.each(response.data, function (id, name) {
                        $('#kecamatan').append(new Option(name, id))
                    })
                    
                });
        });
    });


    $(function () {
        $('#kecamatan').click('change', function () {
            axios.post('{{ route('kelurahan') }}', {id: $(this).val()})
                .then(function (response) {
                    $('#kelurahan').empty();
    
                    $.each(response.data, function (id, name) {
                        $('#kelurahan').append(new Option(name, id))
                    })
                });
        });
    });

</script>

@endsection