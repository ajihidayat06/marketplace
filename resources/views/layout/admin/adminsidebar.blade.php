
<div class="col-md-2 sidenav">
    
        <img class="logo" src="{{ asset('img/logo2.png') }}" alt="" style="width: 62.5px; height: 60px; margin : 10px 0 10px 66px;">
    
    <div class="menusamping border-bottom">
        <a href="{{ route('dashboard') }}" class="tombol-sideadmin" >Dasboard</a>
    </div>
    <div class="menusamping border-bottom">
        <button class="dropdown-btn">User
            <i class="fa fa-caret-down" style="float: right"></i>
        </button>
        <div class="menusamping dropdown-container">
            <a href="{{ route('user') }}" class="tombol-sideadmin">Data User</a>
            <a href="{{ route('verifikasi_user') }}" class="tombol-sideadmin">Permintaan Verifikasi    </a>
        </div>
    </div>
    <div class="menusamping border-bottom">
        <a href="{{ route('kategori') }}" class="tombol-sideadmin">Kategori</a>
    </div>
    <div class="menusamping border-bottom">
        <a href="{{ route('data_barang') }}" class="tombol-sideadmin">Data Barang</a>
    </div>
    <div class="menusamping border-bottom">
        <a href="{{ route('status') }}" class="tombol-sideadmin">Status</a>
    </div>

    <div class="menusamping border-bottom">
        <button class="dropdown-btn">Transaksi
            <i class="fa fa-caret-down" style="float: right"></i>
        </button>
        <div class="menusamping dropdown-container">
            <a href="{{ route('admin_konfirmasi_pembayaran')}}" class="tombol-sideadmin">Konfirmasi Pembayaran</a>
            {{-- <a href="{{ route('verifikasi_user') }}" class="tombol-sideadmin">Permintaan Verifikasi    </a> --}}
            <a href="{{ route('transaksi_diterima')}}" class="tombol-sideadmin">Transaksi Diterima</a>
            <a href="{{ route('transaksi_ditolak')}}" class="tombol-sideadmin">Transaksi Ditolak</a>
        </div>
    </div>
    <div class="menusamping border-bottom">
        <a href="{{ route('laporan_transaksi_admin') }}" class="tombol-sideadmin">Laporan Transaksi</a>
    </div>
    {{-- <div class="menusamping border-bottom">
        <a href="{{ route('admin_konfirmasi_pembayaran')}}" class="tombol-sideadmin">Konfirmasi Pembayaran</a>
    </div> --}}
    {{-- <div class="menusamping mt-4">
        <a href="/logout" class="tombol-side">Logout</a>
    </div> --}}
</div>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "inline-block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "inline-block";
        }
        });
    }
    </script>


