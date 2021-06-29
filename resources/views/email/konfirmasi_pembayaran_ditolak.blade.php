<!DOCTYPE html>
<html>
<head>
<style>
.center {
    margin: auto;
    width: 60%;
    border: 1px solid ;
    padding: 10px;
    height: 400px;
    background-color: #fff;
}
</style>
</head>
<body style="background-color: rgb(222, 228, 230)">

<h2 style="text-align: center">MARKETPLACE PENYEWAAN BARANG</h2>

<div class="center">
    <h2 style="text-transform:capitalize;">Konfirmasi Pembayaran</h2>
    <p>Konfirmasi pembayaran atas nama 
        <strong style="text-transform:uppercase;">{{$sewa->user->nama}} ditolak </strong>
        oleh admin karena (<strong style="text-transform:uppercase;">{{$sewa->konfirmasi_pembayaran->konfirmasi_pembayaran_value}}</strong>)
    </p>
    <p>Silahkan login untuk melakukan konfirmasi pembayaran ulang sebelum batas waktu.</p>
</div>

</body>
</html>
