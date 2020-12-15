<div class="container row mb-2">
    <div class=" ">
        Sebagai {{session('role')}}
    </div>
    <div class=" ">
        @if (session('role')=='renter')
            <a class="tombol-role-isi pink" href="{{ route('vendor') }}">Jadi vendor</a>
        @else
            <a class="tombol-role-isi pink" href="{{ route('pengaturan') }}">Jadi renter</a>
        @endif
    </div>
</div> 

<div class="menusamping border-bottom">
    <a href="/pengaturan/profil" class="tombol-side">Profile</a>
</div>
<div class="menusamping border-bottom">
    <a href="#" class="tombol-side">Ubah Password</a>
</div>
<div class="menusamping border-bottom">
    <a href="/pengaturan/informasi_bank" class="tombol-side">Informasi Bank</a>
</div>

@if (session('role')=='vendor')
<div class="menusamping border-bottom">
    <a href="/pengaturan/kelola_barang" class="tombol-side">Kelola Barang</a>
</div>
@endif
<div class="menusamping mt-4">
    <a href="/logout" class="tombol-side">Logout</a>
</div>