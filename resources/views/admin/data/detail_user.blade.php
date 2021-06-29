
@extends('layout.admin.adminMain')

@section('title','Detail User')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
    <div class="top-box-admin">
        <div class="col-md-10 offset-md-2">
            <h3 class="mb-5">Detail User</h3>
                
            <div style="height: 200px;">
                <div class="row">
                    <div class="col-sm-3 offset-1 ">
                        <img class="rounded-circle" src="{{ $user->user_info->getAvatar() }} " style="height: 200px; width: 200px" alt="">
                    </div>
                    <div class="col-sm-6  my-auto">
                        <div>
                            <H2 style="color:#11647A">{{ $user->nama }} </H2>
                        </div>
                        <div>
                            <span class="text-secondary">{{ $user->email }}</span>
                        </div>
                        <div>
                            @if ($user->user_info->user_foto_ktp==null)
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                            <span class="font-weight-light">Belum terverifikasi</span>
                        @elseif($user->user_info->user_foto_ktp!=null &&  $user->akun_verified_at==null)
                            <i class="fas fa-hourglass-half" style="color:#11647A"></i>
                            <span class="font-weight-light">Meminta verifikasi akun</span>
                        @else
                        <i class="fas fa-user-check text-success"></i>
                        <span class="font-weight-normal text-success">Akun terverifikasi</span>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="container col-md-12 mt-5">
                <div class="row">
                    <div class="col-md-5">
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Nama</h5>
                            <span class="text-capitalize">{{ $user->nama }}</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Username</h5>
                            <span class="text-capitalize">{{ $user->username }}</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Email</h5>
                            <span class="text-capitalize">{{ $user->email }}</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Nama sesuai KTP</h5>
                            @if ($user->user_info->user_nama_lengkap != null)
                                <span class="text-capitalize">{{ $user->user_info->user_nama_lengkap }}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">NIK</h5>
                            @if ($user->user_info->user_KTP != null)
                                <span class="text-capitalize">{{ $user->user_info->user_KTP }}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">No. Telp/HP</h5>
                            @if ($user->user_info->user_telp != null)
                                <span class="text-capitalize">{{ $user->user_info->user_telp }}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Alamat</h5>
                                @if ($user->user_info->user_alamat!=null)
                                <span>{{$user->user_info->user_alamat}},
                                    {{$user->user_info->user_kelurahan}},
                                    {{$user->user_info->user_kecamatan}},
                                    {{$user->user_info->user_kabupaten}},
                                    {{$user->user_info->user_provinsi}}
                                </span>
                                @else
                                    <span>-</span>
                                @endif
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Nama sesuai Rekening</h5>
                            @if ($user->user_info->user_nama_rek != null)
                                <span class="text-capitalize">{{ $user->user_info->user_nama_rek }}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">Bank</h5>
                            @if ($user->user_info->user_bank!= null)
                                <span class="text-capitalize">{{ $user->user_info->user_bank}}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">No. Telp/HP</h5>
                            @if ($user->user_info->user_rek != null)
                                <span class="text-capitalize">{{ $user->user_info->user_rek }}</span>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-md-7">
                        @if (!$myAddInfo->isEmpty())
                            @foreach ($myAddInfo as $item)
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">HP/Telp</h5>
                                @if ($item->user_telp!=null)
                                    <span>{{ $item->user_telp }}</span>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                            <div class="border-bottom mb-2">
                                <h5 style="color: #1A97BA">Alamat</h5>
                                @if ($item->user_alamat!=null)
                                <span>{{$item->user_alamat}},
                                    {{$item->user_kelurahan}},
                                    {{$item->user_kecamatan}},
                                    {{$item->user_kabupaten}},
                                    {{$item->user_provinsi}}
                                </span>
                                @else
                                    <span>-</span>
                                @endif
                                    
                            </div>
                            @endforeach                                
                        @else
                        <div class="border-bottom mb-2">
                            <h5 style="color: #1A97BA">HP/Telp</h5>
                            <span>-</span>
                        </div>
                        <div class="border-bottom mb-2">
                            <h5 style="color:#1A97BA">Alamat</h5>
                            <span>-</span>
                        </div>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection