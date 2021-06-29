
@extends('layout.admin.adminMain')

@section('title','Detail Barang')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail Barang</h3>
                
            <div style="min-height: 200px;">
            
                <div class=" row mt-4">
                    <div class="col-md-5">
                        <img class="img-thumbnail rounded"  src="{{ asset('storage/'.$detail->barang_image) }}" alt="">
                    </div>

                    <div class="col-md-7">
                        <div>
                            <strong class="text-capitalize" style="font-size: 20pt">{{ $detail->barang_nama }}</strong>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Harga Sewa / Hari</h5></label>
                                    <div class="text-secondary">Rp {{ $detail->barang_harga }},-</div>
                                </div>
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Jumlah Barang</h5></label>
                                    <div class="text-secondary">{{ $detail->barang_jumlah }} pcs</div>
                                </div>
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Nama Pemilik</h5></label>
                                    <div class="text-secondary text-capitalize">{{ $detail->user->nama }}</div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Kategori</h5></label>
                                    <div class="text-secondary">{{ $detail->kategori->kategori_nama }}</div>
                                </div>
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Status</h5></label>
                                    @if ($detail->status == 1)
                                        <div class="text-secondary">Tersedia</div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label for="" style="color: #11647A""><h5>Alamat</h5></label>
                                    <div class="text-secondary  text-capitalize">
                                        <span>{{$detail->user->user_info->user_alamat}},
                                            {{$detail->user->user_info->user_kelurahan}},
                                            {{$detail->user->user_info->user_kecamatan}},
                                            {{$detail->user->user_info->user_kabupaten}},
                                            {{$detail->user->user_info->user_provinsi}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="" style="color: #11647A""><h5>Deskripsi</h5></label>
                            <div class="text-uppercase text-secondary">{{ $detail->barang_deskripsi}}</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection