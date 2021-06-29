@extends('layout/main')

@section('title','Marketplace penyewaan Barang')

@section('datepicker')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection


@section('nav')
    @include('nav.user')
@endsection

@section('konten')
<div class="container">
    {{-- <div class="top-box">
        <div class="top-isi">
            <img class="gambar img-fluid" src="{{ asset('img/utama1.jpeg') }} " alt="">
        </div>
        <div class="top-isi">
            <h3>CARI DISINI</h3>
            <div class=""> 
                <div class="container shadow-lg p-3 mb-5 bg-white">
                        <form class="" action="">                
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="text" id="username" placeholder="Cari apa ...">
                            </div>                
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="password" id="password" placeholder="Semua Kategori">
                            </div>
                            <div class="form-isi row">
                                <input style="border-color:#DD16EB;" class="form-control" type="password" id="password" placeholder="Lokasi">
                            </div>
                            <div class="form-isi row ">
                                <button type="button" class="form-control tombol-konten ungu-biru tengah">Cari</button>
                            </div>
                            
                        </form>
                </div>
            </div>
        </div>
    </div>
    <h3>KATEGORI</h3>
    <hr>
    <div class="kategori-wrapper">
        <div class="container">
            @foreach ($kategoris as $kategori)
            <div class="kategori">
                <a href="/home/kategori/{{ $kategori->id }}" class="btn btn-info">
                    {{$kategori->kategori_nama}}
                </a>
            </div>
            @endforeach
        </div>
    </div> --}}
    <div class="row mt-4">
        
        <div class="col-md-8">
            <img class="gambar_detail img-thumbnail rounded mx-auto d-block" src="{{ asset('storage/'.$item->barang_image) }}" alt="">
            <div class="mt-4">
                <h6 class="text-capitalize" style="color: #1FB7E0">
                    {{$item->kategori->kategori_nama}}
                </h6>
                <h3 class="text-uppercase mt-3" style="color: #11647A">
                    {{$item->barang_nama}}
                </h3>
                <h6 class="text-capitalize mt-3" style="color: #1FB7E0">
                    <i class="fas fa-map-marker-alt"></i> {{ $item->user->user_info->user_kabupaten }}, {{ $item->user->user_info->user_provinsi }}
                </h6>
            </div>

            <div class="mt-3">
                <ul class="nav nav-tabs text-center" id="myTab" role="tablist">
                    <li class="nav-item col-md-6">
                        <a class="nav-link active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi</a>
                    </li>
                    <li class="nav-item col-md-6">
                        <a class="nav-link" id="jadwal-tab" data-toggle="tab" href="#jadwal" role="tab" aria-controls="jadwal" aria-selected="false">Jadwal Penyewaan</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active text-dark" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                        <div class="" id="deskripsi" tabindex="-1" role="dialog" aria-labelledby="deskripsiTitle" aria-hidden="true">
                            <h6>
                                <strong>Deskripsi</strong>
                            </h6>
                            <p class="text-uppercase">{{$item->barang_deskripsi}}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade text-dark" id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab">
                        <div class="" id="jadwal" tabindex="-1" role="dialog" aria-labelledby="jadwalTitle" aria-hidden="true">
                            <h6 class="mb-3">
                                <strong>Jadwal Penyewaan Terkonfirmasi pada Barang Ini </strong>
                            </h6>
                            @if ($jadwal->count()>0)
                            <table class="table table-hover">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Tgl.Transaksi</th>
                                    <th scope="col">Tgl.Mulai Sewa</th>
                                    <th scope="col">Tgl.Selesai Sewa</th>
                                    <th scope="col">Jumlah Sewa</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $no => $jadwals)
                                        <tr>
                                            <th scope="row" class="text-center">{{$jadwal->firstItem()+$no}}</th>
                                            <td class="text-center">{{ date('d-F-Y', strtotime($jadwals->created_at))  }}</td>
                                            <td class="text-center"> <strong>{{ date('d-F-Y', strtotime($jadwals->sewa_tanggal_mulai))}}</strong></td>
                                            <td class="text-center"> <strong>{{ date('d-F-Y', strtotime($jadwals->sewa_tanggal_berakhir))}}</strong></td>
                                            <td class="text-center">{{$jadwals->sewa_detail_jumlah}} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-5">
                                {{$jadwal->links()}}
                            </div>
                            @else
                            <div style="min-height: 200px">
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="d-flex align-items-center" >
                                        
                                        <i class="fas fa-search-minus fa-5x" style="opacity: 0.5"></i>
                                        
                                    </div>
                                    <br>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label for="" class="text-secondary"><h6>"Tidak ada jadwal penyewaan"</h6></label>
                                </div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <form action="/sewa" method="POST">
                {{ csrf_field() }}
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h3 class="card-title text-capitalize" style="color: #11647A ">Rp {{$item->barang_harga}},-/ hari</h3>
                        <hr style="color:rgb(196, 187, 187)">
                        <h5>Pemilik / Vendor</h5>
                        <h6 class="card-subtitle mb-2 mt-1" style="color: #1FB7E0">
                            <strong class="text-capitalize">{{$item->user->nama}}</strong>
                        </h6>
                        <div class="mt-3">
                            @if ($item->user_id != Auth::id())
                                

                            <a href="https://wa.me/{{$item->user->user_info->user_telp}}?text=Apakah {{$item->barang_nama}} ini tersedia untuk disewa?" class="tombol-konten hijau btn-circle btn-md-sewa col-md-6 ">
                                <i class="fab fa-whatsapp"></i> Chat Pemilik
                            </a>
                            
                            <p class="text-secondary">Silahkan hubungi pemilik untuk mengetahui ketersediaan barang</p>
                            @endif
                        </div>
                        @if ($item->user_id != Auth::id())
                        <hr style="color: rgb(196, 187, 187)">
                        <h5 class="mt-3">Jumlah</h5>
                        <div class="row">
                            
                            <button type="button" class="btn btn-success btn-circle btn-sm" style="margin-left: 15px" id="kurang_jumlah">
                                <i class="fas fa-minus"></i>
                            </button>
                                <input class="col-md-3 border-top-0 border-left-0 border-right-0" readonly name="sewa_banyak_jumlah" id="sewa_banyak_jumlah" type="text" value="1" style="margin: 0 5px; border-color: grey; text-align: center;">
                            <button type="button" class="btn btn-success btn-circle btn-sm" style="" id="tambah_jumlah">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="card-text mt-1 text-secondary">Jumlah Barang: {{$item->barang_jumlah}} </div>
                        <div class="card-text mt-1 text-secondary">Stok Barang Hari ini: {{$stok}} </div>
                        <div class="mt-3">
                            <label for="mulai_sewa">
                                <h6>Tanggal Mulai Sewa</h6>
                            </label>
                            <input class="form-control" type="date" id="mulai_sewa" name="mulai_sewa" min="@php echo date('Y-m-d', strtotime('+1 days')) @endphp" value="@php echo date('Y-m-d', strtotime('+1 days')) @endphp">
                        </div>
                        <div class="mt-2">
                            <label for="selesai_sewa">
                                <h6>Tanggal Selesai Sewa</h6>
                            </label>
                            <input class="form-control" type="date" id="mulai_sewa" name="selesai_sewa" min="@php echo date('Y-m-d', strtotime('+1 days')) @endphp" value="@php echo date('Y-m-d', strtotime('+1 days')) @endphp">
                        </div>
                            
                        @else
                        <hr style="color: rgb(196, 187, 187)">
                        <h5 class="mt-3">Stok</h5>
                        <p class="card-text mt-1 text-secondary">Jumlah Barang: {{$item->barang_jumlah}} </p>
                        @endif

                        {{-- <div class="mt-3">
                            <label for="daterange">
                                <h6>Tanggal Sewa</h6>
                            </label>
                            <input class="form-control" type="text" name="daterange" id="daterange" value="" />
                            <p class="text-secondary">Klik satu kali pada tanggal awal mulai sewa lalu klik satu kali lagi pada tanggal akhir sewa</p>
                        </div> --}}

                        <input type="hidden" name="sewa_id_barang" id="sewa_id_barang" value="{{ $item->id }}">

                        <div class="col-md-12 mt-2">
                            @if ($item->user_id != Auth::id())
                            <button type="submit" class="btn btn-circle btn-primary btn-md-sewa">
                                <i class="fas fa-shopping-cart"></i> Sewa
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script>
    var tambah = document.getElementById('tambah_jumlah');
    var kurang = document.getElementById('kurang_jumlah');
    var hasil = document.getElementById('sewa_banyak_jumlah');
    var valueHasil = hasil.value;
    var batas = {{ $item->barang_jumlah }};
    //var no = hasil.value;
    /*
    tambah.onclick = function(){
        hasil.value = no++;
        console.log(no);
    }
    kurang.onclick = function(){
        hasil.value = no--;
        console.log(no);
    }
    */
    console.log(tambah.id);
    console.log(kurang.id);
    tambah.addEventListener('click', ubahNilai);
    kurang.addEventListener('click', ubahNilai);

    function ubahNilai(event) {
        if (event.target.id === "tambah_jumlah") {
            console.log('tambah');
            if (parseFloat(valueHasil) < batas) {
                valueHasil = parseFloat(valueHasil) + 1;
            } else {
                valueHasil = batas;
            }
            
            
            
        } else {
            console.log('kurang');
            if (valueHasil > 1) {
                valueHasil = parseFloat(valueHasil) - 1;
            } else {
                valueHasil = 1;
            }
        }
        hasil.value = valueHasil;
    }
</script>
@endsection