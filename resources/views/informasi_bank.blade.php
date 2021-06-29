
@extends('layout/main')

@section('title','Pengaturan | Informasi Bank')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3 class="mb-3">PENGATURAN</h3>
    <div class="row">
        <div class="col-md-2">

            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-8 border-left">
            <h4 class="mb-3" style="color: #11647A">Informasi Bank</h4>
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#editbank">Edit Informasi Bank</button>
            <div class="top-box">
                <div class="row">
                    <div class="col-md-3">
                        <p style="color: #1A97BA">No.Rekening</p>
                        <p style="color: #1A97BA">Nama Bank</p>
                    </div>
                    <div class="col-md-3">
                        @if ($info_bank->rek== null && $info_bank->user_bank == null)
                            <p>: -</p>
                            <p>: -</p>
                        @else
                            <p style="">: {{ $info_bank->user_rek }}</p>
                            <p class="text-uppercase">: {{ $info_bank->user_bank }}</p>
                        @endif
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="editbank" tabindex="-1" role="dialog" aria-labelledby="editbank" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color: #11647A">Edit Informasi Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('editbank') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-isi col-md-6">
                                    <label for="rekening" class="text-dark">No.Rekening</label>
                                    <input  name="rekening" class="form-control @error('rekening') is-invalid @enderror" type="text" id="rekening" placeholder="Masukan Nomor Rekening " value="{{ $info_bank->user_rek }}">
                                    @error('rekening')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-6">
                                    <label for="nama_bank" class="text-dark">Nama Bank</label>
                                    <input name="nama_bank" class="form-control text-uppercase @error('nama_bank') is-invalid @enderror" type="text" id="nama_bank" placeholder="Masukan Nama Bank" value="{{ $info_bank->user_bank }}">
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