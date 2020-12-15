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
    <div class="mt-4" style="min-height: 450px">
        {{-- <h4>Sewa</h4> --}}
        <div class="mt-5 text-center">
            <h3 class="text-uppercase" style="color:#DD16EB">anda melakukan penyewaan pada barang ini</h3>
        </div>
        <div class="row mt-3 border rounded">
            <div class="col-md-5 my-auto mt-3 mb-3">
                <div>
                    <img class="img-thumbnail border-0 d-block"  src="{{ asset('storage/'.$sewa_diterima->barang->barang_image) }}" alt="">
                </div>
            </div>
            <div class="col-md-7 my-auto mb-3">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-5">
                            <h2 class="text-primary text-capitalize">{{$sewa_diterima->barang->barang_nama}}</h2>
                        </div>
                        <div class="col-md-6 offset-1 text-right my-auto">
                            <h5 style="color:#DD16EB">{{ $sewa_diterima->pemilik->nama}} <i class="fas fa-user"></i></h5>
                        </div>
                    </div>
                    <h6 class="text-dark">Tanggal sewa : {{$sewa_diterima->sewa_tanggal_mulai}} sampai {{$sewa_diterima->sewa_tanggal_berakhir}}</h6>
                    <h6 class="text-dark">Jumlah sewa : {{$sewa_diterima->sewa_detail_jumlah}} pcs</h6>
                    <h6 class="mt-3 text-primary text-capitalize">Pemilik Barang :</h6>
                    <h5 class="text-danger text-uppercase"><strong>{{$sewa_diterima->pemilik->nama}}</strong></h5>
                    <h6 class="text-secondary"><i class="fas fa-map-marker-alt"></i> {{$sewa_diterima->pemilik->user_info->user_alamat}}, {{$sewa_diterima->pemilik->user_info->user_kelurahan}}, 
                        {{$sewa_diterima->pemilik->user_info->user_kecamatan}}, {{$sewa_diterima->pemilik->user_info->user_provinsi}}</h6>
                    <h6 class="mt-3 text-primary text-capitalize">Kode Booking :</h6>
                    <h4 class="text-danger text-uppercase"><strong>{{$sewa_diterima->sewa_kode_booking}}</strong></h4>
                    <br>
                    <h5 class="text-dark text-capitalize">langkah selanjutnya :</h5>
                    <p class="text-secondary text-justify">- Silahkan simpan/foto/cetak kode booking anda (kode booking harus ditunjukan saat anda mengambil barang).</p>
                    <p class="text-secondary text-justify">- Siapkan tanda jaminan saat anda mengambil barang, jaminan sesuai dengan yang anda pilih 
                    saat melakukan transaksi sewa (<span class="text-danger">{{$sewa_diterima->sewa_jaminan}}</span>). 
                    Pengambilan Barang (<span class="text-danger text-capitalize">{{$sewa_diterima->sewa_pengambilan}}</span>)</p>
                    <p class="text-secondary text-justify">- Setelah anda mengambil barang sewaan, silahkan lakukan konfirmasi penerimaan
                        barang pada halaman ini.
                    </p>
                    <br>
                    <div class="row mb-3 mx-auto">
                        <button type="button" data-toggle="modal" data-target="#" class="col-md-5 offset-1 btn btn-circle btn-md-sewa btn-outline-info">Cetak Kode Booking</button>
                        <div class="col-md-5">
                            <form action="{{route('konfirmasi_penerimaan_barang', ['id'=> $sewa_diterima->id])}}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <button class=" btn btn-circle btn-md-sewa btn-primary">Saya telah Menerima Barang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal konfir_penerimaan_barang --}}
{{-- <div class="modal fade" id="konfirmasiPenerimaanBarang" tabindex="-1" role="dialog" aria-labelledby="konfirmasiPenerimaanbarang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Penerimaan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_terima_sewa" name="id_konfirmasi_penerimaan" value="{{ $sewa_diterima->id }}">
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
</div> --}}
@endsection