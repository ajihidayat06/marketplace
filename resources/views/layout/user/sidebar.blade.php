<div class="col-md-12">
    <img class="col-md-12 rounded-circle" src="{{ Auth::User()->user_info->getAvatar() }} " alt="">
</div>
<div class="container row mb-2 mx-auto">
    <div class="mx-auto ">
        Sebagai {{session('role')}}
    </div>
    <div class="mx-auto ">
        
        @if (session('role')=='renter')
            <a class="btn btn-outline-info btn-sm" href="{{ route('vendor') }}">Jadi vendor</a>
        @else
            <a class="btn btn-outline-info btn-sm" href="{{ route('pengaturan') }}">Jadi renter</a>
        @endif
    </div>
</div> 

<div class="p-1 bg-secondary text-white rounded" style="font-size: 8pt">
    <span >AKUN</span>
</div>

<div class="menusamping border-bottom">
    <a href="/pengaturan/profil" class="tombol-side">Profile</a>
</div>
<div class="menusamping border-bottom">
    <a href="{{ route('ubah_password')}}" class="tombol-side">Ubah Password</a>
</div>
<div class="menusamping border-bottom">
    <a href="/pengaturan/informasi_bank" class="tombol-side">Informasi Bank</a>
</div>

@if (session('role')=='vendor')
<div class="p-1 bg-secondary text-white rounded" style="font-size: 8pt">
    <span>VENDOR</span>
</div>
<div class="menusamping border-bottom">
    <a href="/pengaturan/kelola_barang" class="tombol-side">Kelola Barang</a>
</div>
@endif
<div class="menusamping mt-4">
    <a href="/logout" class="tombol-side">Logout</a>
</div>