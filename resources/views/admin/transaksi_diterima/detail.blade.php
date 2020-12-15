
@extends('layout.admin.adminMain')

@section('title','Detail Transaksi Diterima')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail Transaksi</h3>
                
                
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
                        {{-- <div class="mb-4"">
                            <span>Bukti Transfer</span>
                        </div> --}}
                        <div class="mb-4"">
                            <span>Nomor Rekening</span>
                        </div>
                        <div class="mb-4"">
                            <span>Atas Nama (Rekening)</span>
                        </div>

                    </div>
                    <div class="col-md-6 my-auto">
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
                        {{-- <div class="mb-4" >
                            <span><img src="{{ asset('storage/'.$detail->konfirmasi_pembayaran->konfirmasi_pembayaran_foto)}}" style="height: 350px; width:100%" alt=""></span>
                        </div> --}}
                        <div class="mb-4">
                            <span>{{ $detail->pemilik->user_info->user_rek }}</span>
                        </div>
                        <div class="mb-4">
                            <span>{{ $detail->pemilik->user_info->user_nama_rek }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-10 offset-1 mt-3">
                    {{-- <button class="btn btn-danger tombol-tolak-konfirmasi" data-toggle="modal" data-target="#tolakkonfirmasi" data-id="{{ $detail->id }}" data-status="{{ $detail->konfirmasi_pembayaran_value }}">
                        <i class="fas fa-info-circle"> Tolak Konfirmasi</i>
                    </button>
                    <a href="/konfirmasi_pembayaran/detail/{{$detail->id}}/terima_konfirmasi" class="btn btn-success">
                        <i class="far fa-check-circle"></i> Konfirmasi
                    </a> --}}
                    <span class="text-danger font-weight-bold text-capitalize">*note :</span>
                    <p class="text-secondary" style="font-size: 16pt">Silahkan lakukan transfer pembayaran kepada pemilik barang 
                        <span class="text-danger font-weight-bold text-capitalize">
                        ({{$detail->pemilik->nama}})</span> sebesar <span class="text-danger font-weight-bold text-capitalize" id="total"></span> rupiah.</p>
                </div>
        </div>
    </div>

    {{-- modal tolak konfirmasi --}}
    {{-- <div class="modal fade" id="tolakkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="tolak-konfirmasi" aria-hidden="true">
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
                                    <label for="status_sewa" style="color: #DD16EB">Status Sewa</label>
                                    <select style="border-color:#DD16EB;" name="status_sewa" class="form-control @error('status_sewa') is-invalid @enderror" type="text" id="status_sewa">
                                        <option value="{{ $detail->status_id }}"> {{ $detail->status->status_value }}</option>
                                        @foreach ($status as $value)
                                            <option value="{{$value->id}}">{{ $value->status_value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_sewa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-10">
                                    <label for="edit_nama_kategori" style="color: #DD16EB">Pesan</label>
                                    <textarea style="border-color:#DD16EB;" name="konfirmasi_pembayaran_value" class="form-control @error('edit_status_value') is-invalid @enderror" id="konfirmasi_pembayaran_value"  cols="10" rows="5" value=""></textarea>
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
    </div> --}}
    

    {{-- <script>
        const button = document.querySelectorAll('.tombol-tolak-konfirmasi');
        const inputId = document.querySelector('#id_detail_konfirmasi');
        const inputStatus = document.querySelector('#konfirmasi_pembayaran_value');
        button.forEach(function(modal){
            modal.onclick = function () {
                inputId.value = modal.dataset.id;
                inputStatus.value = modal.dataset.status;
            }
        });
    </script> --}}

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