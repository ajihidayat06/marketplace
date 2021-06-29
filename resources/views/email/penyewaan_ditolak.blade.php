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
    <h2 style="text-transform:capitalize;">Penyewaan ditolak</h2>
    <p>Penyewaan barang 
        <strong style="text-transform:uppercase;">{{$sewa->barang->barang_nama}}</strong> atas nama 
        <strong style="text-transform:uppercase;">{{$sewa->user->nama}}</strong>
        ditolak oleh pemilik barang (<strong style="text-transform:uppercase;">{{$sewa->pemilik->nama}}</strong>)
        karena <strong>{{$pesan}}</strong>.
    </p>
    <p>Silahkan login untuk melakukan pesanan lain.</p>
</div>

</body>
</html>



