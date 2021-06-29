
@extends('layout.admin.adminMain')

@section('title','Detail Konfirmasi Pembayaran ')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail Konfirmasi Pembayaran</h3>
                
                
                <div class="row">
                    <div class="col-md-3 offset-1 ">
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
                            <span>Tanggal Sewa</span>
                        </div>
                        <div class="mb-4"">
                            <span>Lama Sewa</span>
                        </div>
                        <div class="mb-4"">
                            <span>Nama (pengirim)</span>
                        </div>
                        <div class="mb-4">
                            <span>Jumlah Transfer</span>
                        </div>
                        <div class="mb-4"">
                            <span>Bukti Transfer</span>
                        </div>

                    </div>
                    <div class="col-md-6 my-auto">
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->user->nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->barang->barang_nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->barang->user->nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->barang->barang_harga }} rupiah</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->sewa_detail_jumlah }} Pcs</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ date('d-m-Y', strtotime($detail->sewa_tanggal_mulai)) }} Sampai {{ date('d-m-Y', strtotime($detail->sewa_tanggal_berakhir)) }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->sewa_lama_hari }} Hari</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->konfirmasi_pembayaran->konfirmasi_pembayaran_nama }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-capitalize">{{ $detail->konfirmasi_pembayaran->konfirmasi_pembayaran_jumlah }} rupiah</span>
                        </div>
                        <div class="mb-4" >
                            <span><img src="{{ asset('storage/'.$detail->konfirmasi_pembayaran->konfirmasi_pembayaran_foto)}}" style="height: 350px; width:100%" alt=""></span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <button class="btn btn-danger tombol-tolak-konfirmasi" data-toggle="modal" data-target="#tolakkonfirmasi" data-id="{{ $detail->id }}" data-status="{{ $detail->konfirmasi_pembayaran_value }}">
                        <i class="fas fa-info-circle"> Tolak Konfirmasi</i>
                    </button>
                    <a href="/konfirmasi_pembayaran/detail/{{$detail->id}}/terima_konfirmasi" class="btn btn-success">
                        <i class="far fa-check-circle"></i> Konfirmasi
                    </a>
                </div>
        </div>
    </div>

    {{-- modal tolak konfirmasi --}}
    <div class="modal fade" id="tolakkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="tolak-konfirmasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tolak Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('tolak_konfirmasi_pembayaran')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="mb-1">
                                <input type="hidden" id="id_detail_konfirmasi" name="id_detail_konfirmasi" value="">
                                <div class="form-isi col-md-10">
                                    @error('status_sewa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="edit_nama_kategori" style="color: #1A97BA">Pesan</label>
                                    <textarea style="border-color:#1A97BA;" name="konfirmasi_pembayaran_value" class="form-control @error('edit_status_value') is-invalid @enderror" id="konfirmasi_pembayaran_value"  cols="10" rows="5" value=""></textarea>
                                    @error('konfirmasi_pembayaran_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary col-md-2" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary col-md-2">Ya</button>
                        </form>
                </div>
                
                
            </div>
        </div>
    </div>
    

    <script>
        const button = document.querySelectorAll('.tombol-tolak-konfirmasi');
        const inputId = document.querySelector('#id_detail_konfirmasi');
        const inputStatus = document.querySelector('#konfirmasi_pembayaran_value');
        button.forEach(function(modal){
            modal.onclick = function () {
                inputId.value = modal.dataset.id;
                inputStatus.value = modal.dataset.status;
            }
        });
    </script>

@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection