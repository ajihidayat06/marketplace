<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//penting
// Route::get('/', function () {
//     return view('halamanUtama');
// });

// Auth::routes(['verify'=> true]);

Route::get('/login', 'AuthController@login')->middleware('guest');
Route::post('/login', 'AuthController@postlogin')->name('login');
Route::get('/logout', 'AuthController@logout');
Route::get('/register', 'AuthController@daftar')->middleware('guest');
Route::post('/daftar', 'AuthController@postdaftar')->name('daftar');


Route::get('/pengaturan', 'UserController@indexpengaturan')->middleware('auth')->name('pengaturan');

// Route::get('/pengaturan/profil', function () {
//     return view('profil');
// })->middleware('auth');

// Route::get('/pengaturan/profil/editprofil', function () {
//     return view('editProfil');
// })->middleware('auth');

// Route::post('/pengaturan/profil/editprofil', 'UserController@editprofil')->name('editprofil')->middleware('auth');


//penting
// Route::get('/home', 'NavController@index')->middleware('auth')->name('home');
Route::get('/', 'NavController@index')->name('home');

Route::prefix('home')->middleware('auth')->group(function () {
    Route::get('/kategori/{id}', 'NavController@tampilKategori');
    Route::get('/kategori/{id}/item_detail', 'NavController@barangDetail')->name('barang_detail');
});

Route::get('/search', 'NavController@search')->name('search');

Route::prefix('pengaturan')->middleware('auth')->group(function () {
    Route::get('/profil', 'UserController@indexprofil')->name('profil');
    Route::post('profil/editprofil', 'UserController@editprofil')->name('editprofil');
    Route::get('/verifikasi_akun', 'UserController@verifikasiakun')->name('verifikasi_akunget');
    Route::post('/verifikasi_akun', 'UserController@postverifikasiakun')->name('verifikasi_akun');
    Route::post('profil/editprofil1', 'UserController@kabupaten')->name('kabupaten');
    Route::post('profil/editprofil2', 'UserController@kecamatan')->name('kecamatan');
    Route::post('profil/editprofil3', 'UserController@kelurahan')->name('kelurahan');
    Route::get('/informasi_bank', 'UserController@informasibank')->name('informasi_bank');
    Route::post('/informasi_bank', 'UserController@editbank')->name('editbank');
    Route::get('vendor', 'VendorController@index')->name('vendor');
    Route::get('/kelola_barang','KelolaBarangController@index')->name('kelola_barang');
    Route::get('/detail_sewa_diterima/{id}', 'SewaDiterimaController@index');
    // Route::get('/detail_sewa_diterima/{id}/konfirmasi_penerimaan_barang', 'SewaDiterimaController@konfirmasi_penerimaan_barang');
    // Route::get('/kelola_barang/detail_barang/{id}','KelolaBarangController@detail');
});

Route::middleware(['auth','cekrole:admin'])->group(function(){
    Route::get('/dashboard','AdminController@index')->name('dashboard');
    Route::get('/data_user','AdminController@user')->name('user');
    Route::get('/verifikasi_user','AdminController@verifikasiUser')->name('verifikasi_user');
    Route::get('/kategori','KategoriController@index')->name('kategori');
    Route::get('/status','StatusController@index')->name('status');
    Route::get('/data_barang','DataBarangController@index')->name('data_barang');
    Route::get('/konfirmasi_pembayaran','KonfirmasiPembayaranController@index')->name('admin_konfirmasi_pembayaran');
    Route::get('/transaksi_diterima','TransaksiDiterimaController@index')->name('transaksi_diterima');
    Route::get('/transaksi_ditolak','TransaksiDiterimaController@index_ditolak')->name('transaksi_ditolak');
    Route::get('/laporan_transaksi_admin', 'LaporanTransaksiAdminController@index')->name('laporan_transaksi_admin');
});

Route::prefix('verifikasi_user')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::get('/detail_verifikasi_user/{id}','AdminController@detail_verifikasi_user')->name('detail_verifikasi_user');
    Route::get('/detail_verifikasi_user/{id}/tolak_verifikasi','AdminController@tolak_verifikasi')->name('tolak_verifikasi');
    Route::get('/detail_verifikasi_user/{id}/terima_verifikasi','AdminController@terima_verifikasi')->name('terima_verifikasi');
    
});

Route::prefix('kategori')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::post('/tambah_kategori','KategoriController@tambah_kategori')->name('tambah_kategori');
    Route::post('/edit','KategoriController@edit_kategori')->name('edit_kategori');
    Route::post('/hapus_kategori','KategoriController@hapus')->name('hapus_kategori');
    // Route::get('/detail_verifikasi_user/{id}/tolak_verifikasi','AdminController@tolak_verifikasi')->name('tolak_verifikasi');
    // Route::get('/detail_verifikasi_user/{id}/terima_verifikasi','AdminController@terima_verifikasi')->name('terima_verifikasi');
});

Route::prefix('status')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::post('/tambah_status','StatusController@tambah_status')->name('tambah_status');
    Route::post('/edit_status','StatusController@edit_status')->name('edit_status');
    Route::post('/hapus_status','StatusController@hapus_status')->name('hapus_status');
});

Route::prefix('status')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::post('/hapus_data_barang','DataBarangController@hapus_data_barang')->name('hapus_data_barang');
});

Route::prefix('konfirmasi_pembayaran')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::get('/detail/{id}','KonfirmasiPembayaranController@detail')->name('detail_konfirmasi_pembayaran');
    Route::post('/detail/tolak_konfirmasi','KonfirmasiPembayaranController@tolak')->name('tolak_konfirmasi_pembayaran');
    Route::get('/detail/{id}/terima_konfirmasi','KonfirmasiPembayaranController@terima_konfirmasi')->name('terima_konfirmasi_pembayaran');
});

Route::prefix('pengaturan/kelola_barang')->middleware(['auth'])->group(function () {
    Route::post('/tambah_barang','KelolaBarangController@tambah_barang')->name('tambah_barang');
    Route::get('/detail_barang/{id}','KelolaBarangController@detail');
    Route::post('/detail_barang/edit_barang','KelolaBarangController@edit')->name('edit_barang');
    Route::post('/detail_barang/hapus_barang','KelolaBarangController@hapus')->name('hapus_barang');
});

Route::post('/sewa', 'SewaController@indexsewa')->middleware(['auth','VerifikasiAkun:']);
Route::post('/sewa/bayar', 'SewaController@bayarsewa')->middleware('auth')->name('bayar');
Route::get('/pembayaran/{id}', 'SewaController@pembayaran')->middleware('auth')->name('pembayaran');
Route::get('/konfirmasi_bayar/{id}', 'SewaController@konfirmasi_bayar')->middleware('auth')->name('konfirmasi_bayar');
Route::post('/konfirmasi_bayar', 'SewaController@konfirmasi_pembayaran')->middleware('auth')->name('konfirmasi_pembayaran');

Route::prefix('pengaturan/vendor')->middleware('auth')->group(function () {
    Route::post('tolak_permintaan_sewa', 'VendorController@tolak')->name('tolak_permintaan_sewa');
    Route::post('terima_permintaan_sewa', 'VendorController@terima')->name('terima_permintaan_sewa');
    Route::put('konfirmasi_pengembalian_barang/{id}', 'VendorController@konfirmasi_pengembalian')->name('konfirmasi_pengembalian_barang');
});
Route::prefix('pengaturan/detail_sewa_diterima/{id}')->middleware('auth')->group(function () {
    Route::put('/konfirmasi_penerimaan_barang', 'SewaDiterimaController@konfirmasi_penerimaan_barang')->name('konfirmasi_penerimaan_barang');
});

Route::prefix('transaksi_diterima')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::get('detail_transaksi_diterima/{id}','TransaksiDiterimaController@detail')->name('detail_transaksi_diterima');
});
Route::prefix('transaksi_ditolak')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::get('detail_transaksi_ditolak/{id}','TransaksiDiterimaController@detail_tolak')->name('detail_transaksi_ditolak');
});

Route::prefix('laporan_transaksi_admin')->middleware(['auth','cekrole:admin'])->group(function () {
    Route::get('/cetak_pdf/{daterange}', 'LaporanTransaksiAdminController@cetak')->name('catak_laporan');
});