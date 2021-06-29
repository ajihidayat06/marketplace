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
    <h2 style="text-transform:capitalize;">penyewaan baru masuk</h2>
    <p>Penyewaan baru masuk dari
        <strong style="text-transform:uppercase;">{{$sewa->user->nama}}</strong>
        untuk barang anda <strong style="text-transform:uppercase;">{{$sewa->barang->barang_nama}}</strong>
    </p>
    <p>Silahkan login dan cek detail penyewaan masuk.</p>
</div>

</body>
</html>




