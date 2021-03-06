
@extends('layout/main')

@section('title','Pengaturan | informasi Bank')

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
            <h4 class="mb-3">Informasi Bank</h4>

            <div class="top-box">
                <div class="row">
                    <div class="col-md-3">
                        <p style="color: #DD16EB">No.Rekening</p>
                        <p style="color: #DD16EB">Nama Bank</p>
                    </div>
                    <div class="col-md-3">
                        <p style="">{{ $info_bank->user_rek }}</p>
                        <p style="">{{ $info_bank->user_bank }}</p>
                    </div>
                </div>
                <button type="button" class="btn pink mt-3" data-toggle="modal" data-target="#editbank">Edit Informasi Bank</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editbank" tabindex="-1" role="dialog" aria-labelledby="editbank" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Informasi Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('editbank') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-isi col-md-6">
                                    <label for="rekening" style="color: #DD16EB">No.Rekening</label>
                                    <input style="border-color:#DD16EB;" name="rekening" class="form-control @error('rekening') is-invalid @enderror" type="text" id="rekening" placeholder="Masukan Nomor Rekening ">
                                    @error('rekening')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-6">
                                    <label for="nama_bank" style="color: #DD16EB">Nama Bank</label>
                                    <input style="border-color:#DD16EB;" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" type="text" id="nama_bank" placeholder="Masukan Nama Bank">
                                    @error('nama_bank')
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
@endsection