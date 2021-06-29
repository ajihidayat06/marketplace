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
    <h2 style="text-transform:capitalize;">Penyewaan diterima</h2>
    <p>Penyewaan atas nama 
        <strong style="text-transform:uppercase;">{{$sewa->user->nama}}</strong>
        diterima oleh pemilik barang (<strong style="text-transform:uppercase;">{{$sewa->pemilik->nama}}</strong>)
    </p>
    <p>Silahkan login untuk cetak kode booking dan melakukan langkah selanjutnya.</p>
</div>

</body>
</html>



