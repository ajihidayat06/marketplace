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
    <div class="mt-4">
        <h4>Barang Yang Disewa</h4>
        @foreach ($barang as $item)
        <div class="row">
        <div class="col-md-7 mt-3">
            <form action="{{ route('bayar')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <img class="gambar_sewaa img-thumbnail rounded d-block col-md-2" src="{{ asset('storage/'.$item->barang_image) }}" alt="">
                    {{-- <div class="container">
                        <div class="mt-4">
                            <h6 class="text-capitalize" style="color: #0C65F0">
                                {{$item->kategori->kategori_nama}}
                            </h6>
                            <h3 class="text-capitalize mt-3" style="color: #DD16EB ">
                                {{$item->barang_nama}}
                            </h3>
                            <h6 class="text-capitalize mt-3" style="color: #0C65F0">
                                <i class="fas fa-map-marker-alt"></i> {{ $item->user->user_info->user_kabupaten }}, {{ $item->user->user_info->user_provinsi }}
                            </h6>
                        </div>
                        <hr>
                        <br>
                    </div> --}}
                    <div class="col-md-10">
                        <input type="hidden" name="sewa_pemilik_barang_id" value="{{$item->user_id}}">
                        <input type="hidden" name="sewa_barang_id" value="{{$item->id}}">
                        <h5>{{$item->barang_nama}}</h5>
                        <h6>Rp {{$item->barang_harga}},- / Hari</h6>
                        <div><strong style="color: #0C65F0">{{$item->user->nama}}</strong></div>
                        <div class="text-secondary">{{$item->user->user_info->user_alamat}}, {{$item->user->user_info->user_kelurahan}}, {{$item->user->user_info->user_kecamatan}}, {{$item->user->user_info->user_kabupaten}}, {{$item->user->user_info->user_provinsi}}</div> 
                        <div class="mt-2">
                            <strong class="">Jumlah Sewa :</strong>
                            <input class="border-0" type="text" name="detail_jumlah" readonly value="{{$detail_jumlah}}">
                        </div>
                        {{-- <div class="mt-2">
                            <strong class="">Tanggal Sewa :</strong>
                            <input class="border-0" type="text" name="detail_tanggal" readonly value="{{$detail_tanggal}}">
                        </div> --}}
                        <div class="mt-2">
                            <strong class="">Tanggal Sewa :</strong>
                            <input class="col-md-3 border-0" style="text-align: center" type="text" name="detail_tanggal_mulai" readonly value="{{$sewa_awal}}">-
                            <input class="col-md-3 border-0" style="text-align: center" type="text" name="detail_tanggal_selesai" readonly value="{{$sewa_akhir}}">
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Informasi Penyewa dan Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="sewa_nama_penyewa_id" value="{{ Auth::User()->id}}">
                        <div>
                            <label class="col-md-2" for=""><strong>Nama :</strong></label>
                            <span class="col-md-10">{{Auth::User()->nama}}</span>
                        </div>
                        <div>
                            <label class="col-md-2" for=""><strong>Alamat :</strong></label>
                            <span class="col-md-10">{{Auth::User()->user_info->user_alamat}}, {{Auth::User()->user_info->user_kelurahan}},
                                {{Auth::User()->user_info->user_kecamatan}}, {{Auth::User()->user_info->user_kabupaten}}, {{Auth::User()->user_info->user_provinsi}}
                            </span>
                        </div>
                        <div class="mt-2">
                            <label class="col-md-3" for=""><strong>Pembayaran :</strong></label>
                            <div class="container">
                                <select style="border-color:#DD16EB;" name="sewa_pembayaran" class="col-md-4 form-control" type="text" id="">
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="col-md-5" for=""><strong>Pengambilan Barang :</strong></label>
                            <div class="container">
                                <select style="border-color:#DD16EB;" name="sewa_pengambilan" class="col-md-6 form-control" type="text" id="">
                                    <option value="ambil langsung">Ambil Langsung (ke Pemilik)</option>
                                    <option value="COD">COD</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="col-md-5" for=""><strong>Jaminan Sewa :</strong></label>
                            <div class="container">
                                <select style="border-color:#DD16EB;" name="sewa_jaminan" class="col-md-6 form-control" type="text" id="">
                                    <option value="KTP">Kartu Tanda Penduduk (KTP)</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Ringkasan Sewa</h5>
                    </div>
                    <div class="card-body">
                        <div class="font-weight-light">
                            <label class="col-md-6" for="">Harga Sewa/Unit</label>
                            <span class="col-md-2 offset-1">Rp {{$item->barang_harga}}</span>
                        </div>
                        <div class="font-weight-light">
                            <label class="col-md-6" for="">Banyak Sewa (Unit)</label>
                            <span class="col-md-2 offset-1">{{$detail_jumlah}}</span>
                        </div>
                        <div class="font-weight-light">
                            <label class="col-md-6" for="">Lama Sewa (Hari)</label>
                            <input class="col-md-2 offset-1 border-0" style="color: grey" type="text" name="sewa_lama_hari" readonly id="lama_sewa" value="{{$jumlah_hari}}">
                        </div>
                        <div class="font-weight-light">
                            <label class="col-md-4" for="">Biaya Layanan</label>
                            <span class="col-md-4 offset-3" style="color: grey"> Rp
                            <input class="border-0 biaya_layanan" style="color: grey; width: 75px" type="text" name="sewa_biaya_layanan" readonly id="biaya_layanan" value="2500">
                        </div>
                        
                        <hr style="border-top: 1px solid black">
                        <div class="font-weight-bold">
                            <label class="col-md-4" for="">Total Harga</label>
                            <span class="col-md-4 offset-3" style="color: #DD16EB"> Rp 
                                <input class=" border-0" style="color: #DD16EB; width: 75px" type="text" name="sewa_total_harga" readonly id="total_harga" value="">
                            </span>
                        </div>
                        <hr style="border-top: 1px solid black">
                        <div>
                            <button type="submit" class="btn btn-success btn-circle btn-md-sewa">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
        
    </div>
</div>

{{-- <script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script> --}}

<script>
    var harga = {{ $item->barang_harga }};
    var jumlah = {{$detail_jumlah}};
    var lama_sewa = {{$jumlah_hari}};
    var biaya_layanan = $(".biaya_layanan").val();
    var total_harga = document.getElementById('total_harga');

        
        total_harga.value = harga*jumlah*lama_sewa+ Number(biaya_layanan);
    // function total(){
    // }
</script>
@endforeach
@endsection