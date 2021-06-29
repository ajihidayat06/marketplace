
@extends('layout.admin.adminMain')

@section('title','Dashboard')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')

    <div class="col-md-10 offset-2">
        <div class="container">

            @if (session('update'))
                <div class="alert alert-success" role="alert"> 
                    <span>{{ session('update') }}</span>
                </div>
            @endif
            <div class="mb-5">
                <h3>Pengaturan</h3>
            </div>
            <div class="">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-3 ">
                            <img class="rounded-circle d-flex justify-content-center" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                            <button class="col-md-5 offset-2 btn btn-outline-info btn-sm mt-2" data-toggle="modal" data-target="#ubahfoto">Ubah Foto</button>
                        </div>
                        <div class="col-md-8  my-auto">
                            <div>
                                <H2 style="color:#11647A">{{ Auth::User()->nama }} </H2>
                            </div>
                            <div>
                                <span class="text-secondary">{{ Auth::User()->email }}</span>
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editprofiladmin">Edit Profil</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">Nama</h5>
                                <span>{{ Auth::User()->nama }}</span>
                            </div>
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">Username</h5>
                                <span>{{ Auth::User()->username }}</span>
                            </div>
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">Email</h5>
                                <span>{{ Auth::User()->email }}</span>
                            </div>
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">HP/Telp</h5>
                                <span>{{ Auth::User()->User_info->user_telp }}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            @if (!$info->isEmpty())
                                @foreach ($info as $item)
                                {{-- <div class="border-bottom mb-2">
                                    <h5 style="color: #1A97BA">HP/Telp</h5>
                                    @if ($item->user_telp!=null)
                                        <span>{{ $item->user_telp }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div> --}}
                                <div class="border-bottom mb-2">
                                    <h5 style="color: #1A97BA">No. Rekening</h5>
                                    @if ($item->user_rek!=null)
                                        <span>{{ $item->user_rek }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                                <div class="border-bottom mb-2">
                                    <h5 style="color: #1A97BA">Nama Rekening</h5>
                                    @if ($item->user_nama_rek!=null)
                                        <span>{{ $item->user_nama_rek }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                                <div class="border-bottom mb-2">
                                    <h5 style="color: #1A97BA">Bank</h5>
                                    @if ($item->user_bank!=null)
                                        <span>{{ $item->user_bank }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                                
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                
                
            </div>

            <div class="panel mt-5" id="tampilchart">

            </div>
        </div>
    </div>

    <div class="modal fade" id="editprofiladmin" tabindex="-1" role="dialog" aria-labelledby="editprofil" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('editprofiladmin') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-isi col-md-4">
                                    <label for="telp" style="color: #11647A">Nomor HP</label>
                                    <input style="" name="Telephone" class="form-control @error('Telephone') is-invalid @enderror" type="text" id="telp" placeholder="Masukan Nomor HP Aktif ">
                                    @error('Telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-8">
                                    <label for="email" style="color: #11647A">Email</label>
                                    <input style="" name="email" class="form-control @error('email') is-invalid @enderror" type="email" id="email" placeholder="Masukan Email anda ">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-isi col-md-4">
                                    <label for="no_rekening" style="color: #11647A">No.rekening</label>
                                    <input style="" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" type="text" id="no_rekening" placeholder="Masukan Nomor Rekening ">
                                    @error('no_rekening')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-5">
                                    <label for="nama_rekening" style="color: #11647A">Nama Rekening</label>
                                    <input style="" name="nama_rekening" class="form-control @error('nama_rekening') is-invalid @enderror" type="text" id="nama_rekening" placeholder="Masukan Nama Anda sesusi Rekening">
                                    @error('nama_rekening')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-isi col-md-3">
                                    <label for="bank" style="color: #11647A">Bank</label>
                                    <input style="" name="bank" class="form-control @error('bank') is-invalid @enderror" type="text" id="bank" placeholder="Masukan Nama Bank">
                                    @error('bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--  --}}
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Profil</button>
                        </form>
                </div>
                
                
            </div>
            </div>
        </div>

        {{-- modal ubah foto --}}
        <div class="modal fade" id="ubahfoto" tabindex="-1" role="dialog" aria-labelledby="editprofil" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('ubah_foto') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{Auth::User()->id }}">
                                
                                    <div class="col-md-6 offset-3">
                                        <img class="img-thumbnail rounded" src="{{ Auth::User()->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                        <label for="" class="text-secondary">Ubah foto profil</label>
                                        <input type="file" name="user_image">
                                    </div>
                                
                                <br>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ubah Foto</button>
                            </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection

@section('script')
{{-- <script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    Highcharts.chart('tampilchart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Transaksi Bulanan'
    },
    subtitle: {
        text: 'Berdasar Kategori ('+{!!json_encode(date('d-m-Y', strtotime($start)))!!}+' sampai '+{!!json_encode(date('d-m-Y', strtotime($end)))!!}+')'
    },
    xAxis: {
        categories: {!!json_encode($kategori)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Jumlah Transaksi',
        data: {!!json_encode($barang_kt)!!}
    }, ]
});
</script> --}}
@endsection