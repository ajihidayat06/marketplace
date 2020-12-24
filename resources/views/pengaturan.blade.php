
@extends('layout/main')

@section('title','Pengaturan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container" style="background-color: white">
    <h3 class="mb-3">PENGATRURAN</h3>
    <div class="row">
        <div class="col-md-2">
            {{-- <div class="container mb-2">
                <div class="row tombol-role">
                    <a class="tombol-role-isi" href="" style="margin-left: 14px" aria-pressed="true">Jadi penyewa</a>
                    <a class="tombol-role-isi" href="">Jadi vendor</a>
                </div>
            </div> --}}
            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-10 border-left" style="min-height: 500px">
            <div class="row" style="height: 200px;">
                <div class="col-md-4 mx-auto">
                    <img class="rounded-circle" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                </div>
                
                <div class="col-sm-8 pengaturan-isi mt-5">
                    <div>
                        <H2 style="color:#11647A">{{ Auth::User()->nama }} </H2>
                    </div>
                    <div>
                        <span class="text-secondary">{{ Auth::User()->email }}</span>
                    </div>
                    <div class="my-auto">
                        @if ($info->user_foto_ktp==null)
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                            <a href="/pengaturan/verifikasi_akun" class="col-md-3 btn btn-circle btn-md-sewa btn-info">verifikasi akun</a>
                        @elseif($info->user_foto_ktp!=null &&  $info->user->akun_verified_at==null)
                            <i class="fas fa-hourglass-half" style="color:#11647A"></i>
                            <span class="font-weight-light">Verifikasi akun sedang diproses</span>
                        @else
                        <i class="fas fa-user-check text-success"></i>
                        <span class="font-weight-normal text-success">Akun terverifikasi</span>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <ul class="nav nav-tabs text-center" id="myTab" role="tablist">
                    <li class="nav-item col-md-3">
                        <a class="nav-link active" id="belum-bayar-tab" data-toggle="tab" href="#belum-bayar" role="tab" aria-controls="belum-bayar" aria-selected="true">Permohonan Sewa</a>
                    </li>
                    <li class="nav-item col-md-3">
                        <a class="nav-link" id="sedang_dikonfirmasi-tab" data-toggle="tab" href="#sedang-dikonfirmasi" role="tab" aria-controls="sedang-dikonfirmasi" aria-selected="false">Sedang Dikonfirmasi</a>
                    </li>
                    <li class="nav-item col-md-3">
                        <a class="nav-link" id="sedang-menyewa-tab" data-toggle="tab" href="#sedang-menyewa" role="tab" aria-controls="sedang-menyewa" aria-selected="false">Sedang Menyewa</a>
                    </li>
                    <li class="nav-item col-md-3">
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active text-dark" id="belum-bayar" role="tabpanel" aria-labelledby="belum-bayar-tab">
                        <div class="" id="belumbayar" tabindex="-1" role="dialog" aria-labelledby="belumbayarTitle" aria-hidden="true">
                            {{-- @if ($sewa_belum_bayar->count())
                                belum ada data
                            @endif --}}
                            @if ($sewa_belum_bayar->count() >0)
                                @foreach ($sewa_belum_bayar as $item_belum_bayar)
                                <div class="col-md-12 mb-2">
                                    <div class="card">
                                        <div class="header-kartu row">
                                            <span class="col-md-5 offset-1">{{$item_belum_bayar->barang->user->nama}}</span>
                                            <span class="col-md-5 text-right text-danger">{{$item_belum_bayar->status->status_value}}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 my-auto mx-auto">
                                                <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_belum_bayar->barang->barang_image) }}" alt="">
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <h5 class="mt-3 text-primary">{{$item_belum_bayar->barang->barang_nama}}</h5>
                                                <span class="text-secondary">{{$item_belum_bayar->sewa_tanggal_mulai}} sampai {{$item_belum_bayar->sewa_tanggal_berakhir}}</span>
                                                <br>
                                                <span class="text-secondary">{{$item_belum_bayar->sewa_detail_jumlah}} pcs</span>
                                                <div class="row mt-3">
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        <h6>Rp {{$item_belum_bayar->sewa_total}},-</h6>
                                                    </div>
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        @if ($item_belum_bayar->status_id == 1)
                                                            
                                                        <span class="text-secondary text-capitalize">bayar sebelum :</span>
                                                        @else
                                                        <span class="text-secondary text-capitalize">konfirmasi sebelum :</span>
                                                        @endif
                                                        <br>
                                                        <span class="text-danger">{{$item_belum_bayar->sewa_tanggal_mulai}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    @if ($item_belum_bayar->status_id == 3)
                                                        <div class="col-md-5 offset-6">
                                                            <a href="/konfirmasi_bayar/{{$item_belum_bayar->id}}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize">konfirmasi pembayaran</a>
                                                        </div>
                                                    @else
                                                    <div class="col-md-5 offset-1">
                                                        <a href="/konfirmasi_bayar/{{$item_belum_bayar->id}}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize">konfirmasi pembayaran</a>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <a href="/pembayaran/{{$item_belum_bayar->id}}" class="btn btn-primary btn-circle btn-md-sewa text-capitalize">bayar sekarang</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach

                            @else
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="d-flex align-items-center" >
                                        
                                        <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                        
                                    </div>
                                    <br>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label for="" class="text-secondary"><h6>"Belum ada permohonan Sewa"</h6></label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade text-dark" id="sedang-dikonfirmasi" role="tabpanel" aria-labelledby="sedang-dikonfirmasi-tab">
                        <div class="" id="sedangdikonfirmasi" tabindex="-1" role="dialog" aria-labelledby="sedangdikonfirmasiTitle" aria-hidden="true">
                            @if ($sedang_dikonfirmasi->count() >0)
                                @foreach ($sedang_dikonfirmasi as $item_sedang_dikonfirmasi)
                                <div class="col-md-12 mb-2">
                                    <div class="card">
                                        <div class="header-kartu row">
                                            <span class="col-md-5 offset-1">{{$item_sedang_dikonfirmasi->barang->user->nama}}</span>
                                            <span class="col-md-5 text-right text-danger">{{$item_sedang_dikonfirmasi->status->status_value}}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 my-auto mx-auto">
                                                <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_sedang_dikonfirmasi->barang->barang_image) }}" alt="">
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                @if ($item_sedang_dikonfirmasi->status_id == 2)
                                                <h5 class="mt-3 text-primary">{{$item_sedang_dikonfirmasi->barang->barang_nama}}</h5>
                                                <span class="text-secondary">{{$item_sedang_dikonfirmasi->sewa_tanggal_mulai}} sampai {{$item_sedang_dikonfirmasi->sewa_tanggal_berakhir}}</span>
                                                <br>
                                                <span class="text-secondary">{{$item_sedang_dikonfirmasi->sewa_detail_jumlah}} pcs</span>
                                                <div class="row mt-3">
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        <h6>Rp {{$item_sedang_dikonfirmasi->sewa_total}},-</h6>
                                                    </div>
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        {{-- <span class="text-secondary text-capitalize">bayar sebelum :</span> --}}
                                                        <br>
                                                        <span class="text-danger">Sedang Dikonfirmasi oleh Admin</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    {{-- <div class="col-md-5 offset-1">
                                                        <a href="/konfirmasi_bayar/{{$item_sedang_dikonfirmasi->id}}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize">konfirmasi pembayaran</a>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <a href="/pembayaran/{{$item_sedang_dikonfirmasi->id}}" class="btn btn-primary btn-circle btn-md-sewa text-capitalize">bayar sekarang</a>
                                                    </div> --}}
                                                </div>
                                                    
                                                @else
                                                <h5 class="mt-3 text-primary">{{$item_sedang_dikonfirmasi->barang->barang_nama}}</h5>
                                                <span class="text-secondary">{{$item_sedang_dikonfirmasi->sewa_tanggal_mulai}} sampai {{$item_sedang_dikonfirmasi->sewa_tanggal_berakhir}}</span>
                                                <br>
                                                <span class="text-secondary">{{$item_sedang_dikonfirmasi->sewa_detail_jumlah}} pcs</span>
                                                <div class="row mt-3">
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        <h6>Rp {{$item_sedang_dikonfirmasi->sewa_total}},-</h6>
                                                    </div>
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        {{-- <span class="text-secondary text-capitalize">bayar sebelum :</span> --}}
                                                        <br>
                                                        <span class="text-danger">Sedang Diproses Pemilik barang</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    {{-- <div class="col-md-5 offset-1">
                                                        <a href="/konfirmasi_bayar/{{$item_sedang_dikonfirmasi->id}}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize">konfirmasi pembayaran</a>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <a href="/pembayaran/{{$item_sedang_dikonfirmasi->id}}" class="btn btn-primary btn-circle btn-md-sewa text-capitalize">bayar sekarang</a>
                                                    </div> --}}
                                                </div>
                                                    
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="d-flex justify-content-center mt-5">
                                <div class="d-flex align-items-center" >
                                    
                                    <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                    
                                </div>
                                <br>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <label for="" class="text-secondary"><h6>"Belum ada permohonan Sewa"</h6></label>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade text-dark" id="sedang-menyewa" role="tabpanel" aria-labelledby="sedang-menyewa-tab">
                        @if ($sewa_diterima->count() >0)
                            @foreach ($sewa_diterima as $item_diterima)
                            <div class="col-md-12 mb-2">
                                <div class="card">
                                    <div class="header-kartu row">
                                        <span class="col-md-5 offset-1">{{$item_diterima->barang->user->nama}}</span>
                                        <span class="col-md-5 text-right text-danger">{{$item_diterima->status->status_value}}</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 my-auto mx-auto">
                                            <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_diterima->barang->barang_image) }}" alt="">
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h5 class="mt-3 text-primary">{{$item_diterima->barang->barang_nama}}</h5>
                                            <span class="text-secondary">{{$item_diterima->sewa_tanggal_mulai}} sampai {{$item_diterima->sewa_tanggal_berakhir}}</span>
                                            <br>
                                            <span class="text-secondary">{{$item_diterima->sewa_detail_jumlah}} pcs</span>
                                            <div class="row mt-3">
                                                <div class="col-md-6 offset-5 text-right text-primary">
                                                    <h6>Rp {{$item_diterima->sewa_total}},-</h6>
                                                </div>
                                                
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-5 text-primary">
                                                    <span class="text-capitalize">kode booking</span>
                                                    <br>
                                                    <span class="text-danger text-uppercase">
                                                        <strong>{{ $item_diterima->sewa_kode_booking }}</strong>
                                                    </span>
                                                </div>
                                                @if ($item_diterima->status_id == 6)
                                                    <div class="col-md-5 offset-1">
                                                        <a href="pengaturan/detail_sewa_diterima/{{ $item_diterima->id }}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize" style="width: 100%">detail</a>
                                                    </div>
                                                    
                                                @else
                                                    <div class="col-md-5 offset-1">
                                                        <h6 class="text-uppercase text-right" style="color: #DD16EB">penyewaan anda sedang berlangsung</h6>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                            @else
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="d-flex align-items-center" >
                                        
                                        <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                        
                                    </div>
                                    <br>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label for="" class="text-secondary"><h6>"Belum ada permohonan Sewa"</h6></label>
                                </div>
                            @endif
                    </div>
                    
                    <div class="tab-pane fade text-dark" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        @if ($sewa_selesai->count() >0)
                        @foreach ($sewa_selesai as $item_selesai)
                            <div class="col-md-12 mb-2">
                                <div class="card">
                                    <div class="header-kartu row">
                                        <span class="col-md-5 offset-1">{{$item_selesai->barang->user->nama}}</span>
                                        <span class="col-md-5 text-right text-danger">{{$item_selesai->status->status_value}}</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 my-auto mx-auto">
                                            <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_selesai->barang->barang_image) }}" alt="">
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h5 class="mt-3 text-primary">{{$item_selesai->barang->barang_nama}}</h5>
                                            <span class="text-secondary">{{$item_selesai->sewa_tanggal_mulai}} sampai {{$item_selesai->sewa_tanggal_berakhir}}</span>
                                            <br>
                                            <span class="text-secondary">{{$item_selesai->sewa_detail_jumlah}} pcs</span>
                                            <div class="row mt-3">
                                                <div class="col-md-6 offset-5 text-right text-primary">
                                                    <h6>Rp {{$item_selesai->sewa_total}},-</h6>
                                                </div>
                                                
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-5 text-primary">
                                                    <span class="text-capitalize">kode booking</span>
                                                    <br>
                                                    <span class="text-danger text-uppercase">
                                                        <strong>{{ $item_selesai->sewa_kode_booking }}</strong>
                                                    </span>
                                                </div>
                                                @if ($item_selesai->status_id == 6)
                                                    <div class="col-md-5 offset-1">
                                                        {{-- <a href="pengaturan/detail_sewa_selesai/{{ $item_selesai->id }}" class="btn btn-outline-dark btn-circle btn-md-sewa text-capitalize" style="width: 100%">detail</a> --}}
                                                    </div>
                                                    
                                                @else
                                                    <div class="col-md-5 offset-1">
                                                        <h6 class="text-uppercase text-right" style="color: #DD16EB">penyewaan selesai</h6>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="d-flex justify-content-center mt-5">
                                <div class="d-flex align-items-center" >
                                    
                                    <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                    
                                </div>
                                <br>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <label for="" class="text-secondary"><h6>"Belum ada permohonan Sewa"</h6></label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection