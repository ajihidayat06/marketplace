
@extends('layout/main')

@section('title','Pengaturan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')

<div class="container">
    <h3>PENGATRURAN</h3>
    <div class="row">
        <div class="col-md-2">
            
                @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-8 border-left">
            <h4 style="color:#1A97BA">VERIFIKASI AKUN</h4>
            <form action="{{route('verifikasi_akun')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-isi col-md-5">
                        <label for="telp" class="text-info">Nomor HP/WA</label>
                        <input style="" name="Telephone" class="form-control @error('Telephone') is-invalid @enderror" type="text" id="telp" value="{{ old('Telephone') }}" placeholder="Masukan Nomor HP Aktif ">
                        
                        <div class="text-secondary"><span class="text-danger">Catatan: </span>Masukan dengan format +62 (ex: 628212222xxxx)</div>
                        @error('Telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-isi col-md-7">
                        <label for="user_alamat" class="text-info">Alamat</label>
                        <input style="" name="user_alamat" class="form-control @error('user_alamat') is-invalid @enderror" type="text" id="user_alamat" value="{{ old('user_alamat') }}" placeholder="Masukan Alamat anda ">
                        @error('user_alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-isi col-md-6">
                        <label for="user_provinsi" class="text-info">Provinsi</label>
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
                        <label for="user_kabupaten" class="text-info">Kabupaten</label>
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
                        <label for="user_kecamatan" class="text-info">Kecamatan</label>
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
                        <label for="user_kelurahan" class="text-info">Kelurahan</label>
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

                <div class="form-isi row">
                    <label for="user_nama_rek" class="text-info">Nama pada Buku Rekening</label>
                    <input  name="user_nama_rek" class="form-control text-uppercase @error('user_nama_rek') is-invalid @enderror" type="text" id="user_nama_rek" value="{{ old('user_nama_rek') }}" placeholder="Masukan nama sesuai rekening ">
                    @error('user_nama_rek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_rek" class="text-info">Nomor Rekening</label>
                    <input  name="user_rek" class="form-control @error('user_rek') is-invalid @enderror" type="text" id="user_rek" value="{{ old('user_rek') }}" placeholder="Masukan nomor rekening anda ">
                    @error('user_rek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_bank" class="text-info" >Nama Bank</label>
                    <input  name="user_bank" class="form-control text-uppercase @error('user_bank') is-invalid @enderror" type="text" id="user_bank" value="{{ old('user_bank') }}" placeholder="Masukan nama bank rekening anda ">
                    @error('user_bank')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_nama_ktp" class="text-info">Nama Sesuai KTP</label>
                    <input  name="user_nama_ktp" class="form-control text-uppercase @error('user_nama_ktp') is-invalid @enderror" type="text" id="user_nama_ktp" value="{{ old('user_nama_ktp') }}" placeholder="Masukan nama lengkap sesuai KTP ">
                    @error('user_nama_ktp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi row">
                    <label for="user_KTP" class="text-info">NIK </label>
                    <input  name="user_KTP" class="form-control @error('user_KTP') is-invalid @enderror" type="text" id="user_KTP" value="{{ old('user_KTP') }}" placeholder="Masukan NIK anda ">
                    @error('user_KTP')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-isi">
                    <label style="color:#11647A">Foto KTP Anda</label><br>
                    <span style="margin-top: 50px;">
                    <input name="user_foto_ktp" class="@error('user_foto_ktp') is-invalid @enderror" type="file" id="user_foto_ktp">
                    <div class="text-secondary"><span class="text-danger">Catatan: </span>file foto menggunakan format jpg atau png</div>
                    @error('user_foto_ktp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </span>
                </div>
                <button type="submit" class="btn btn-primary rounded">Simpan Data</button>
            </form>
                
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