{{-- @extends('layouts.app') --}}

@extends('layout/main')

@section('title','Marketplace penyewaan Barang | Bantuan')

@section('nav')
    @include('nav.user')
@endsection

@section('konten')
@if (session('verifikasi'))
<div class="container">
    <div class="alert alert-danger">
        {{ session('verifikasi') }}. 
        {{-- <a href="{{ route('verifikasi_akunget')}}">Klik disini</a> untuk verifikasi akun --}}
    </div>
</div>
@endif


    <div class="pt-0">
        <div class="d-flex justify-content-center">
            <img class="mt-3" src="{{ asset('img/logo1.png') }}" alt="">
            <br>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <h2 class="text-uppercase"  style="color: #1A97BA">marketplace penyewaan barang</h2>
        </div>
        <hr>
    </div>
    <div class="container mt-3">
        <h4 style="color: #11647A">Apa itu Marketplace Penyewaan Barang (RentALL)?</h4>
        <div class="container">
            <p class="text-justify" style="font-size: 14pt">"RentALL atau Marketplace Penyewaan Barang adalah sebuah aplikasi berbasis web untuk meminjam atau menyewakan suatu barang.
                Pada aplikasi ini setiap pengguna dapat mencari informasi mengenai sebuah barang yang ingin disewa sekaligus
                dapat menyewakan barang miliknya kepada orang lain."
            </p>
        </div>

        <h4 style="color: #11647A">Siapa yang dapat menyewa melalui aplikasi ini?</h4>
        <div class="container">
            <p class="text-justify" style="font-size: 14pt">"Semua orang dapat menyewa barang melalui aplikasi ini setelah membuat akun."
            </p>
        </div>

        <h4 style="color: #11647A">Siapa yang dapat menyewakan barang melalui aplikasi ini?</h4>
        <div class="container">
            <p class="text-justify" style="font-size: 14pt">"Semua orang dapat menyewakan barang miliknya melalui aplikasi ini setelah membuat akun."
            </p>
        </div>

        <h4 style="color: #11647A">Bagaimana cara menyewa barang pada aplikasi ini?</h4>
        <div class="container">
            {{-- <p class="text-justify" style="font-size: 14pt">"Semua orang dapat menyewakan barang miliknya melalui aplikasi ini setelah membuat akun."
            </p> --}}
            <ul>
                <li>"Buat akun terlebih dahulu dengan memilih menu 'Register'."</li>
                <li>"Verifikasi email melalui link yang dikirimkan ke email."</li>
                <li>"Verifikasi akun terlebih dahulu dengang memasukan beberapa data pada menu 'Pengaturan'."</li>
                <li>"Setelah akun terverifikasi, maka pemilik akun sudah bisa melakukan penyewaan melalui aplikasi ini."</li>
                <li>"Cari barang yang ingin disewa."</li>
                <li>"Tanyakan ketersediaan barang pada pemilik barang melalui 'Chat Whatsapp' yang ada pada saat memilih barang."</li>
                <li>"Masukan data yang diperlukan seperti tanggal sewa, jaminan sewa, metode pengambilan barang, dll."</li>
                <li>"Setelah melakukan sewa maka penyewa harus melakukan pembayaran sebelumwaktu yang ditentukan."</li>
                <li>"Semua progres transaksi penyewaan barang dapat dilihat melalui menu 'Pengaturan'."</li>
            </ul>
        </div>

        <h4 style="color: #11647A">Bagaimana cara menyewakan barang yang dimiliki pada aplikasi ini?</h4>
        <div class="container">
            {{-- <p class="text-justify" style="font-size: 14pt">"Semua orang dapat menyewakan barang miliknya melalui aplikasi ini setelah membuat akun."
            </p> --}}
            <ul>
                <li>"Setiap akun yang sudah terverifikasi dapat melakukan penyewaan dan menyewakan barang."</li>
                <li>"Untuk menambahkan barang pada sistem ada pada menu 'Pengaturan'. Lalu ubah peran dari penyewa (renter) menjadi pemilik (vendor)."</li>
                <li>"Pada menu pengaturan pemilik (vendor), pilih menu 'Kelola Barang' untuk menambahkan dan mengelola barang."</li>
                <li>"Semua progres pada barang yang disewakan dapat dilihat melalui menu 'Pengaturan pemilik (vendor)'."</li>
            </ul>
        </div>
    </div>
@endsection
