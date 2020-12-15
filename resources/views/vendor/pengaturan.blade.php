
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
            {{-- <div class="container mb-2">
                <div class="row tombol-role">
                    <a class="tombol-role-isi" href="" style="margin-left: 14px" aria-pressed="true">Jadi penyewa</a>
                    <a class="tombol-role-isi" href="">Jadi vendor</a>
                </div>
            </div> --}}
            @include('layout.user.sidebar')
            
        </div>
        <div class="col-md-10 border-left">
            <div style="height: 200px;">
                <img class="profil_image col-sm-4 pengaturan-isi" src="{{ asset('img/utama1.jpeg') }} " alt="">
                <span class="col-sm-8 pengaturan-isi mt-5">
                    <div>
                        <H2 style="color:#DD16EB">{{ Auth::User()->nama }} </H2>
                    </div>
                    <div>
                        <span style="color: #D40887">{{ Auth::User()->email }}</span>
                    </div>
                    <div class="mt-2">
                        @if ($info->user_foto_ktp==null)
                            <i class="fas fa-exclamation-triangle" style="color: #D40887"></i>
                            <a href="/pengaturan/verifikasi_akun" class="tombol-konten utu">verifikasi akun</a>
                        @elseif($info->user_foto_ktp!=null &&  $info->user->akun_verified_at==null)
                            <i class="fas fa-hourglass-half" style="color:#DD16EB"></i>
                            <span class="font-weight-light">Verifikasi akun sedang diproses</span>
                        @else
                        <i class="fas fa-user-check" style="color:#DD16EB"></i>
                        <span class="font-weight-light">Akun terverifikasi</span>
                        @endif
                        
                    </div>
                </span>
            </div>
            <div class="mt-3">
                <ul class="nav nav-tabs text-center" id="myTab" role="tablist">
                    <li class="nav-item col-md-4">
                        <a class="nav-link active" id="belum-bayar-tab" data-toggle="tab" href="#belum-bayar" role="tab" aria-controls="belum-bayar" aria-selected="true">Permintaan Sewa</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link" id="sedang-menyewa-tab" data-toggle="tab" href="#sedang-menyewa" role="tab" aria-controls="sedang-menyewa" aria-selected="false">Sedang Disewa</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Penyewaan</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active text-dark" id="belum-bayar" role="tabpanel" aria-labelledby="belum-bayar-tab">
                        <div class="" id="belumbayar" tabindex="-1" role="dialog" aria-labelledby="belumbayarTitle" aria-hidden="true">
                            @foreach ($permintaan_sewa as $item_permintaan_sewa)
                            @if ($item_permintaan_sewa->status_id == 4)
                            <div class="col-md-12 mb-2">
                                <div class="card">
                                    <div class="header-kartu row">
                                        <span class="col-md-5 offset-1">Penyewa : {{$item_permintaan_sewa->user->nama}}</span>
                                        <span class="col-md-5 text-right text-danger">Konfirmasi Penyewaan</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 my-auto mx-auto">
                                            <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_permintaan_sewa->barang->barang_image) }}" alt="">
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h5 class="mt-3 text-primary">{{$item_permintaan_sewa->barang->barang_nama}}</h5>
                                            <span class="text-secondary">{{$item_permintaan_sewa->sewa_tanggal_mulai}} sampai {{$item_permintaan_sewa->sewa_tanggal_berakhir}}</span>
                                            <br>
                                            <span class="text-secondary">Sewa : {{$item_permintaan_sewa->sewa_detail_jumlah}} pcs</span>
                                            <div class="row mt-3">
                                                <div class="col-md-6 offset-5 text-right text-primary">
                                                    <h6>Rp {{$item_permintaan_sewa->sewa_total}},-</h6>
                                                </div>
                                            </div>
                                            <span class="text-secondary text-capitalize">Konfirmasi sebelum :</span>
                                            <br>
                                            <span class="text-danger">{{$item_permintaan_sewa->sewa_tanggal_mulai}}</span>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-5 offset-1">
                                                    {{-- <a href="#" class="btn btn-outline-danger btn-circle btn-md-sewa text-capitalize">Tolak Sewa</a> --}}
                                                    <button type="button" class="btn btn-outline-danger btn-circle btn-md-sewa text-capitalize" data-toggle="modal" data-target="#tolakpermintaansewa">
                                                        Tolak Sewa
                                                    </button>
                                                </div>
                                                <div class="col-md-5">
                                                    <button type="button" class="btn btn-success btn-circle btn-md-sewa text-capitalize" data-toggle="modal" data-target="#terimapermintaansewa">
                                                        Terima Sewa
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            {{-- modal tolak --}}
                            <div class="modal fade" id="tolakpermintaansewa" tabindex="-1" role="dialog" aria-labelledby="tolakpermintaansewa" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Tolak Sewa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('tolak_permintaan_sewa')}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="id_tolak_sewa" name="id_tolak_sewa" value="{{ $item_permintaan_sewa->id }}">
                                                Yakin ingin menilak sewa ini?
                                                <div class="col-md-10 mt-3">
                                                    <label for="pesan_tolak">Pesan</label>
                                                    <textarea class="form-control" name="pesan_tolak" id="pesan_tolak" cols="30" rows="5" placeholder="Tulis pesan/alasan anda menolak sewa ini"></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Tolak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- modal terima --}}
                            <div class="modal fade" id="terimapermintaansewa" tabindex="-1" role="dialog" aria-labelledby="terimapermintaansewa" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Terima Sewa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('terima_permintaan_sewa') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="id_terima_sewa" name="id_terima_sewa" value="{{ $item_permintaan_sewa->id }}">
                                                Silahkan tulis kode booking untuk dikirim ke calon penyewa
                                                <div class="col-md-10 mt-3">
                                                    <label for="kode_booking">Kode Booking</label>
                                                    <input class="form-control text-uppercase" type="text" name="kode_booking" id="kode_booking">
                                                </div>
                                                <div class="col-md-10 mt-3">
                                                    <span class="text-danger" style="font-size: 10pt">*Note : </span>
                                                    <span class="text-secondary" style="font-size: 10pt">Kode booking digunakan untuk dicocokan dengan calon penyewa, untuk memastikan bahwa anda bertemu dengan calon penyewa yang benar</span>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-12 mb-2">
                                <div class="card">
                                    <div class="header-kartu row">
                                        <span class="col-md-5 offset-1">Penyewa : {{$item_permintaan_sewa->user->nama}}</span>
                                        <span class="col-md-5 text-right text-danger">Menunggu tanggal sewa</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 my-auto mx-auto">
                                            <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_permintaan_sewa->barang->barang_image) }}" alt="">
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h5 class="mt-3 text-primary">{{$item_permintaan_sewa->barang->barang_nama}}</h5>
                                            <span class="text-secondary">{{$item_permintaan_sewa->sewa_tanggal_mulai}} sampai {{$item_permintaan_sewa->sewa_tanggal_berakhir}}</span>
                                            <br>
                                            <span class="text-secondary">Sewa : {{$item_permintaan_sewa->sewa_detail_jumlah}} pcs</span>
                                            <div class="row mt-3">
                                                <div class="col-md-6 offset-5 text-right text-primary">
                                                    <h6>Rp {{$item_permintaan_sewa->sewa_total}},-</h6>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <span class="text-secondary text-capitalize">Kode Booking:</span>
                                                <br>
                                                <span class="text-danger text-uppercase">
                                                    <strong>{{$item_permintaan_sewa->sewa_kode_booking}}</strong>
                                                </span>
                                            </div>
                                            {{-- <div class="row mt-3 mb-3">
                                                <div class="col-md-5 offset-1">
                                                    <button type="button" class="btn btn-outline-danger btn-circle btn-md-sewa text-capitalize" data-toggle="modal" data-target="#tolakpermintaansewa">
                                                        Tolak Sewa
                                                    </button>
                                                </div>
                                                <div class="col-md-5">
                                                    <button type="button" class="btn btn-success btn-circle btn-md-sewa text-capitalize" data-toggle="modal" data-target="#terimapermintaansewa">
                                                        Terima Sewa
                                                    </button>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endif
                            
                            @endforeach

                        </div>
                    </div>
                    <div class="tab-pane fade text-dark" id="sedang-menyewa" role="tabpanel" aria-labelledby="sedang-menyewa-tab">
                        @foreach ($sedang_disewa as $item)
                            <div class="col-md-12 mb-2">
                                <div class="card">
                                    <div class="header-kartu row">
                                        <span class="col-md-5 offset-1">Penyewa : {{$item->user->nama}}</span>
                                        <span class="col-md-5 text-right text-danger">Sedang Disewa</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 my-auto mx-auto">
                                            <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item->barang->barang_image) }}" alt="">
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h5 class="mt-3 text-primary">{{$item->barang->barang_nama}}</h5>
                                            <span class="text-secondary">{{$item->sewa_tanggal_mulai}} sampai {{$item->sewa_tanggal_berakhir}}</span>
                                            <br>
                                            <span class="text-secondary">{{$item->sewa_detail_jumlah}} pcs</span>
                                            <div class="row mt-3">
                                                <div class="col-md-6 offset-5 text-right text-primary">
                                                    <h6>Rp {{$item->sewa_total}},-</h6>
                                                </div>
                                                
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-5 text-primary">
                                                    <span class="text-capitalize">kode booking</span>
                                                    <br>
                                                    <span class="text-danger text-uppercase">
                                                        <strong>{{ $item->sewa_kode_booking }}</strong>
                                                    </span>
                                                </div>
                                                
                                                    <div class="col-md-5 offset-1">
                                                        <h6 class="text-uppercase text-right" style="color: #DD16EB">barang anda sedang disewa</h6>
                                                        <div class="text-capitalize text-right font-weight-bold text-dark">
                                                            <span>oleh :</span>
                                                        </div>
                                                        <div class="text-capitalize text-right">
                                                            <span>{{$item->user->nama}}</span>
                                                        </div>
                                                        <div class="text-capitalize text-right text-secondary">
                                                            <span>{{$item->user->user_info->user_alamat}}, {{$item->user->user_info->user_kelurahan}}, 
                                                                {{$item->user->user_info->user_kecamatan}}, {{$item->user->user_info->user_kabupaten}},
                                                                {{$item->user->user_info->user_provinsi}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="mt-3">
                                                <span class="text-capitalize text-danger">*note:</span>
                                                <p class="">- Silahkan lakukan <span class="text-danger text-capitalize">konfirmasi pengembalian barang</span> jika anda 
                                                sudah menerima barang anda kembali dari penyewa.
                                                </p>
                                            </div>
                                            <div class="mb-3">
                                                <form action="{{route('konfirmasi_pengembalian_barang', ['id' => $item->id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="col-md-10 offset-1 btn btn-circle btn-md-sewa btn-outline-primary">Konfirmasi pengembalian Barang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                    </div>

                    <div class="tab-pane fade text-dark" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        @foreach ($riwayats as $riwayat)
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="header-kartu row">
                                    <span class="col-md-5 offset-1">Penyewa : {{$riwayat->user->nama}}</span>
                                    <span class="col-md-5 text-right text-danger">{{$riwayat->status->status_value}}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 my-auto mx-auto">
                                        <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$riwayat->barang->barang_image) }}" alt="">
                                    </div>
                                    <div class="col-md-9 mt-2">
                                        <h5 class="mt-3 text-primary">{{$riwayat->barang->barang_nama}}</h5>
                                        <span class="text-secondary">{{$riwayat->sewa_tanggal_mulai}} sampai {{$riwayat->sewa_tanggal_berakhir}}</span>
                                        <br>
                                        <span class="text-secondary">{{$riwayat->sewa_detail_jumlah}} pcs</span>
                                        <div class="row mt-3">
                                            <div class="col-md-6 offset-5 text-right text-primary">
                                                <h6>Rp {{$riwayat->sewa_total}},-</h6>
                                            </div>
                                            
                                        </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-md-5 text-primary">
                                                <span class="text-capitalize">kode booking</span>
                                                <br>
                                                <span class="text-danger text-uppercase">
                                                    <strong>{{ $riwayat->sewa_kode_booking }}</strong>
                                                </span>
                                            </div>
                                            
                                                <div class="col-md-5 offset-1">
                                                    <h6 class="text-uppercase text-right" style="color: #DD16EB">{{$riwayat->status->status_value}}</h6>
                                                    <div class="text-capitalize text-right font-weight-bold text-dark">
                                                        <span>oleh :</span>
                                                    </div>
                                                    <div class="text-capitalize text-right">
                                                        <span>{{$riwayat->user->nama}}</span>
                                                    </div>
                                                    <div class="text-capitalize text-right text-secondary">
                                                        <span>{{$riwayat->user->user_info->user_alamat}}, {{$riwayat->user->user_info->user_kelurahan}}, 
                                                            {{$riwayat->user->user_info->user_kecamatan}}, {{$riwayat->user->user_info->user_kabupaten}},
                                                            {{$riwayat->user->user_info->user_provinsi}}
                                                        </span>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        {{-- <div class="mt-3">
                                            <span class="text-capitalize text-danger">*note:</span>
                                            <p class="">- Silahkan lakukan <span class="text-danger text-capitalize">konfirmasi pengembalian barang</span> jika anda 
                                            sudah menerima barang anda kembali dari penyewa.
                                            </p>
                                        </div> --}}
                                        {{-- <div class="mb-3">
                                            <form action="{{route('konfirmasi_pengembalian_barang', ['id' => $riwayat->id])}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="col-md-10 offset-1 btn btn-circle btn-md-sewa btn-outline-primary">Konfirmasi pengembalian Barang</button>
                                            </form>
                                        </div> --}}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection