ini detail ditolak
@extends('layout.admin.adminMain')

@section('title','Detail Transaksi Ditolak')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail Transaksi Ditolak</h3>
                
                
                <div class="row">
                    <div class="col-md-3 offset-1 font-weight-bold">
                        <div class="mb-4">
                            <span>Nama Penyewa</span>
                        </div>
                        <div class="mb-4">
                            <span>Barang</span>
                        </div>
                        <div class="mb-4">
                            <span>Pemilik barang</span>
                        </div>
                        <div class="mb-4">
                            <span>Harga Sewa</span>
                        </div>
                        <div class="mb-4">
                            <span>Jumlah Sewa</span>
                        </div>
                        <div class="mb-4"">
                            <span>Lama Sewa</span>
                        </div>
                        <div class="mb-4">
                            <span>Jumlah Transfer</span>
                        </div>
                        <div class="mb-4"">
                            <span>Nomor Rekening</span>
                        </div>
                        <div class="mb-4"">
                            <span>Atas Nama (Rekening)</span>
                        </div>

                    </div>
                    <div class="col-md-6 ">
                        <div class="mb-4">
                            <span>{{ $detail->user->nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->barang->barang_nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->barang->user->nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->barang->barang_harga }} rupiah</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->sewa_detail_jumlah }} Pcs</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->sewa_lama_hari }} Hari</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->konfirmasi_pembayaran->konfirmasi_pembayaran_jumlah }} rupiah</span>
                        </div>
                        {{-- <div class="mb-4">
                            <span>{{ $detail->user->user_info->user_rek }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->user->user_info->user_nama_rek }}</span>
                        </div> --}}
                    </div>
                </div>
                
                <div class="col-md-10 offset-1 mt-3">
                    <span class="text-danger font-weight-bold text-capitalize">*note :</span>
                    <p class="text-secondary" style="font-size: 16pt">Silahkan lakukan transfer pengembalian kepada penyewa barang 
                        <span class="text-danger font-weight-bold text-capitalize">
                        ({{$detail->user->nama}})</span> sebesar <span class="text-danger font-weight-bold text-capitalize" id="total"></span> rupiah.</p>
                </div>
        </div>
    </div>

    <script>
        var total = {{$detail->konfirmasi_pembayaran->konfirmasi_pembayaran_jumlah}};
        var transfer = document.getElementById('total'); 
        transfer.innerHTML = total - 2500;
 console.log(transfer);
    </script>

@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection