
@extends('layout/main')

@section('title','Pengaturan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    <h3 class="mb-3">PENGATURAN</h3>
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
            <div class="row">
                <div class="col-md-4">
                    <img class="rounded-circle" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                </div>
                <div class="col-sm-8 pengaturan-isi mt-5">
                    <div>
                        <H2 style="color:#11647A" class="text-uppercase">{{ Auth::User()->nama }} </H2>
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
                    <li class="nav-item col-md-4">
                        <a class="nav-link active" id="permintaan-sewa-tab" data-toggle="tab" href="#permintaan-sewa" role="tab" aria-controls="permintaan-sewa" aria-selected="true">Permintaan Sewa</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link" id="sedang-disewa-tab" data-toggle="tab" href="#sedang-disewa" role="tab" aria-controls="sedang-disewa" aria-selected="false">Sedang Disewa</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Penyewaan</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active text-dark" id="permintaan-sewa" role="tabpanel" aria-labelledby="permintaan-sewa-tab">
                        <div class="" id="belumbayar" tabindex="-1" role="dialog" aria-labelledby="belumbayarTitle" aria-hidden="true">
                            @if ($permintaan_sewa->count() > 0)
                                
                                @foreach ($permintaan_sewa as $item_permintaan_sewa)
                                @if ($item_permintaan_sewa->status_id == 4)
                                <div class="col-md-12 mb-2">
                                    <div class="card">
                                        <div class="header-kartu row">
                                            <span class="col-md-5 offset-1 text-capitalize">Penyewa : {{$item_permintaan_sewa->user->nama}}</span>
                                            <span class="col-md-5 text-right text-danger">Konfirmasi Penyewaan</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 my-auto mx-auto">
                                                <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$item_permintaan_sewa->barang->barang_image) }}" alt="">
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <h5 class="mt-3 text-primary text-uppercase">{{$item_permintaan_sewa->barang->barang_nama}}</h5>
                                                <span class="text-secondary">{{date('d-m-Y', strtotime($item_permintaan_sewa->sewa_tanggal_mulai))}} sampai {{date('d-m-Y', strtotime($item_permintaan_sewa->sewa_tanggal_berakhir))}}</span>
                                                <br>
                                                <span class="text-secondary">Lama Sewa : {{$item_permintaan_sewa->sewa_lama_hari}} hari</span>
                                                <br>
                                                <span class="text-secondary">Sewa : {{$item_permintaan_sewa->sewa_detail_jumlah}} pcs</span>
                                                <div class="row mt-3">
                                                    <div class="col-md-5">
                                                        <span>Jaminan : <span class="text-primary">{{$item_permintaan_sewa->sewa_jaminan}}</span></span>
                                                        <br>
                                                        <span>Pengambilan : <span class="text-primary text-capitalize">{{$item_permintaan_sewa->sewa_pengambilan}}</span></span>
                                                    </div>
                                                    <div class="col-md-6 text-right text-primary">
                                                        <h6>Rp {{$item_permintaan_sewa->sewa_total}},-</h6>
                                                        <span class="text-secondary text-capitalize">Konfirmasi sebelum :</span>
                                                        <br>
                                                        <span class="text-danger">{{date('d-m-Y H:i:s', strtotime($item_permintaan_sewa->sewa_tanggal_mulai))}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-5 offset-1">
                                                        
                                                        <button class="btn btn-outline-danger btn-circle btn-md-sewa text-capitalize tombol-tolak" data-toggle="modal" data-target="#tolakpermintaansewa" data-id="{{ $item_permintaan_sewa->id }}">
                                                            Tolak Sewa
                                                        </button>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <button class="btn btn-success btn-circle btn-md-sewa text-capitalize tombol-terima" data-toggle="modal" data-target="#terimapermintaansewa" data-id="{{ $item_permintaan_sewa->id }}">
                                                            Terima Sewa
                                                        </button>
                                                        {{-- <button class="btn btn-info tombol-edit" data-toggle="modal" data-target="#editkategori" data-id="{{ $kategori->id }}" data-status="{{$kategori->status}}" data-kategori="{{ $kategori->kategori_nama }}">
                                                            <i class="fas fa-info-circle"></i> Edit
                                                        </button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
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
                                                    <input type="hidden" id="id_tolak_sewa" name="id_tolak_sewa" value="">
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
                                                    <input type="hidden" id="id_terima_sewa" name="id_terima_sewa" value="">
                                                    Silahkan tulis kode booking untuk dikirim ke calon penyewa
                                                    <div class="col-md-10 mt-3">
                                                        <label for="kode_booking">Kode Booking</label>
                                                        <input class="form-control text-uppercase @error ('kode_booking') is-invalid @enderror" type="text" name="kode_booking" id="kode_booking">
                                                        @error('kode_booking')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
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
                                                <h5 class="mt-3 text-primary text-capitalize">{{$item_permintaan_sewa->barang->barang_nama}}</h5>
                                                <span class="text-secondary">{{date('d-m-Y', strtotime($item_permintaan_sewa->sewa_tanggal_mulai))}} sampai {{date('d-m-Y', strtotime($item_permintaan_sewa->sewa_tanggal_berakhir))}}</span>
                                                <br>
                                                <span class="text-secondary">Lama Sewa : {{$item_permintaan_sewa->sewa_lama_hari}} hari</span>
                                                <br>
                                                <span class="text-secondary">Sewa : {{$item_permintaan_sewa->sewa_detail_jumlah}} pcs</span>
                                                <div class="row mt-3">
                                                    <div class="col-md-6 offset-5 text-right text-primary">
                                                        <h6>Rp {{$item_permintaan_sewa->sewa_total}},-</h6>
                                                        <span class="text-secondary">Jaminan: <span class="text-primary">{{$item_permintaan_sewa->sewa_jaminan}}</span></span>
                                                        <br>
                                                        <span class="text-secondary">Pengambilan barang: <span class="text-primary text-capitalize">{{$item_permintaan_sewa->sewa_pengambilan}}</span></span>
                                                
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="text-secondary text-capitalize">Kode Booking:</span>
                                                    <br>
                                                    <span class="text-danger text-uppercase">
                                                        <strong>{{$item_permintaan_sewa->sewa_kode_booking}}</strong>
                                                    </span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endif
                                
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="d-flex align-items-center" >
                                        
                                        <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                        
                                    </div>
                                    <br>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label for="" class="text-secondary"><h6>"Belum ada permintaan Sewa"</h6></label>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- scrip terima --}}
                    <script>
                        const tombol = document.querySelectorAll('.tombol-terima');
                        const inputId = document.querySelector('#id_terima_sewa');

                        tombol.forEach(function(modal){
                            modal.onclick = function () {
                                inputId.value = modal.dataset.id;
                                console.log(modal.dataset.kategori);
                            }
                        });
                    </script>

                    {{-- scrip tolak --}}
                    <script>
                        const tombolTolak = document.querySelectorAll('.tombol-tolak');
                        const inputTolakId = document.querySelector('#id_tolak_sewa');

                        tombolTolak.forEach(function(modal){
                            modal.onclick = function () {
                                inputTolakId.value = modal.dataset.id;
                                console.log(modal.dataset.kategori);
                            }
                        });
                    </script>

                    <div class="tab-pane fade text-dark" id="sedang-disewa" role="tabpanel" aria-labelledby="sedang-disewa-tab">
                        @if ($sedang_disewa->count() > 0)
                            
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
                                            <span class="text-secondary">{{date('d-m-Y', strtotime($item->sewa_tanggal_mulai))}} sampai {{date('d-m-Y', strtotime($item->sewa_tanggal_berakhir))}}</span>
                                            <br>
                                            <span class="text-secondary">Lama Sewa : {{$item->sewa_lama_hari}} hari</span>
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
                                                        <h6 class="text-uppercase text-right" style="color: #11647A">barang anda sedang disewa</h6>
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
                        @else
                            <div class="d-flex justify-content-center mt-5">
                                <div class="d-flex align-items-center" >
                                    
                                    <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                    
                                </div>
                                <br>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <label for="" class="text-secondary"><h6>"Belum ada permintaan Sewa"</h6></label>
                            </div>
                        @endif
                    </div>

                    <div class="tab-pane fade text-dark" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        @if ($riwayats->count() >0)
                            
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
                                        <span class="text-secondary">{{date('d-m-Y', strtotime($riwayat->sewa_tanggal_mulai))}} sampai {{date('d-m-Y', strtotime($riwayat->sewa_tanggal_berakhir))}}</span>
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
                                                    <h6 class="text-uppercase text-right" style="color: #11647A">{{$riwayat->status->status_value}}</h6>
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
                                <label for="" class="text-secondary"><h6>"Belum ada permintaan Sewa"</h6></label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection