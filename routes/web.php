<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Sewa;
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

// Route::get('/login', 'AuthController@login')->middleware('guest');
// Route::post('/login', 'AuthController@postlogin')->name('login');
Route::get('/logout', 'AuthController@logout');
Route::get('/bantuan', 'AuthController@bantuan');
// Route::get('/register', 'AuthController@daftar')->middleware('guest');
// Route::post('/daftar', 'AuthController@postdaftar')->name('daftar');


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


// Auth::routes();
// Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NavController@index');

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
    Route::post('profil/ubah_foto', 'UserController@ubah_foto')->name('ubah_foto');
    Route::get('/informasi_bank', 'UserController@informasibank')->name('informasi_bank');
    Route::get('/ubah_password', 'UserController@ubah_password')->name('ubah_password');
    Route::patch('/ubah_password', 'UserController@update')->name('ubah_password');
    Route::post('/informasi_bank', 'UserController@editbank')->name('editbank');
    Route::get('vendor', 'VendorController@index')->name('vendor');
    Route::get('/kelola_barang', 'KelolaBarangController@index')->name('kelola_barang');
    Route::get('/laporan', 'LaporanController@index')->name('laporan');

    Route::get('/detail_sewa_diterima/{id}', 'SewaDiterimaController@index');

    // Route::get('/detail_sewa_diterima/{id}/konfirmasi_penerimaan_barang', 'SewaDiterimaController@konfirmasi_penerimaan_barang');
    // Route::get('/kelola_barang/detail_barang/{id}','KelolaBarangController@detail');
});

Route::middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::post('/ubah_biaya_layanan', "AdminController@ubah_biaya")->name('ubah_biaya_layanan');
    Route::get('/pengaturan_admin', 'PengaturanAdminController@index')->name('pengaturan_admin');
    Route::post('/pengaturan_admin', 'PengaturanAdminController@editadmin')->name('editprofiladmin');
    Route::get('/data_user', 'AdminController@user')->name('user');
    Route::get('/verifikasi_user', 'AdminController@verifikasiUser')->name('verifikasi_user');
    Route::get('/kategori', 'KategoriController@index')->name('kategori');
    Route::get('/status', 'StatusController@index')->name('status');
    Route::get('/data_barang', 'DataBarangController@index')->name('data_barang');
    Route::get('/konfirmasi_pembayaran', 'KonfirmasiPembayaranController@index')->name('admin_konfirmasi_pembayaran');
    Route::get('/transaksi_diterima', 'TransaksiDiterimaController@index')->name('transaksi_diterima');
    Route::get('/transaksi_ditolak', 'TransaksiDiterimaController@index_ditolak')->name('transaksi_ditolak');
    Route::get('/laporan_transaksi_admin', 'LaporanTransaksiAdminController@index')->name('laporan_transaksi_admin');
});

Route::prefix('data_user')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('/detail_user/{id}', 'AdminController@detail_user')->name('detail_user');
    Route::post('/hapus', 'AdminController@hapus')->name('hapus_user');
    Route::get('/user_terhapus', 'AdminController@user_terhapus')->name('user_terhapus');
    Route::get('/kembalikan/{id}', 'AdminController@kembalikan')->name('kembalikan');
});

Route::prefix('verifikasi_user')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('/detail_verifikasi_user/{id}', 'AdminController@detail_verifikasi_user')->name('detail_verifikasi_user');
    Route::get('/detail_verifikasi_user/{id}/tolak_verifikasi', 'AdminController@tolak_verifikasi')->name('tolak_verifikasi');
    Route::get('/detail_verifikasi_user/{id}/terima_verifikasi', 'AdminController@terima_verifikasi')->name('terima_verifikasi');
});

Route::prefix('kategori')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::post('/tambah_kategori', 'KategoriController@tambah_kategori')->name('tambah_kategori');
    Route::post('/edit', 'KategoriController@edit_kategori')->name('edit_kategori');
    Route::post('/hapus_kategori', 'KategoriController@hapus')->name('hapus_kategori');
    // Route::get('/detail_verifikasi_user/{id}/tolak_verifikasi','AdminController@tolak_verifikasi')->name('tolak_verifikasi');
    // Route::get('/detail_verifikasi_user/{id}/terima_verifikasi','AdminController@terima_verifikasi')->name('terima_verifikasi');
});

Route::prefix('status')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::post('/tambah_status', 'StatusController@tambah_status')->name('tambah_status');
    Route::post('/edit_status', 'StatusController@edit_status')->name('edit_status');
    Route::post('/hapus_status', 'StatusController@hapus_status')->name('hapus_status');
});

Route::prefix('data_barang')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('detail_barang/{id}', 'DataBarangController@detail')->name('info_barang');
    Route::post('/hapus_data_barang', 'DataBarangController@hapus_data_barang')->name('hapus_data_barang');
});

Route::prefix('konfirmasi_pembayaran')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('/detail/{id}', 'KonfirmasiPembayaranController@detail')->name('detail_konfirmasi_pembayaran');
    Route::post('/detail/tolak_konfirmasi', 'KonfirmasiPembayaranController@tolak')->name('tolak_konfirmasi_pembayaran');
    Route::get('/detail/{id}/terima_konfirmasi', 'KonfirmasiPembayaranController@terima_konfirmasi')->name('terima_konfirmasi_pembayaran');
});

Route::prefix('pengaturan/kelola_barang')->middleware(['auth', 'VerifikasiAkun:'])->group(function () {
    Route::post('/tambah_barang', 'KelolaBarangController@tambah_barang')->name('tambah_barang');
    Route::get('/detail_barang/{id}', 'KelolaBarangController@detail');
    Route::post('/detail_barang/edit_barang', 'KelolaBarangController@edit')->name('edit_barang');
    Route::post('/detail_barang/hapus_barang', 'KelolaBarangController@hapus')->name('hapus_barang');
    Route::post('/detail_barang/ubah_foto_barang', 'KelolaBarangController@ubah_foto')->name('ubah_foto_barang');
});

Route::post('/sewa', 'SewaController@indexsewa')->middleware(['auth', 'VerifikasiAkun:']);
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
    Route::get('/cetak_kode_booking', 'SewaDiterimaController@cetak')->name('cetak_kode_booking');
});

Route::prefix('transaksi_diterima')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('detail_transaksi_diterima/{id}', 'TransaksiDiterimaController@detail')->name('detail_transaksi_diterima');
});
Route::prefix('transaksi_ditolak')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('detail_transaksi_ditolak/{id}', 'TransaksiDiterimaController@detail_tolak')->name('detail_transaksi_ditolak');
});

Route::prefix('laporan_transaksi_admin')->middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('/cetak_pdf/{daterange}', 'LaporanTransaksiAdminController@cetak')->name('cetak_laporan');
});

Route::prefix('pengaturan/laporan')->middleware(['auth'])->group(function () {
    Route::get('/cetak_pdf/{daterange}', 'LaporanController@cetak')->name('cetak_laporan_vendor');
});
Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/daftar-mahasiswa', function () {
    $sewa = Sewa::where('status_id', 1)->get();
    foreach ($sewa as $item) {
        $batas = $item->created_at;
        $batas_akhir = strtotime($batas . "+2 hours");
        date_default_timezone_set('Asia/Jakarta');
        $sekarang = strtotime("now");


        if (($sekarang > $batas_akhir) && ($item->status_id == 1)) {
            $item->status_id = 9;
            $item->save();
        }
        echo date('Y-m-d-H-i', strtotime($batas)) . "<br>";
        echo date('Y-m-d-H-i', strtotime($batas_akhir)) . "<br>";
        echo date('Y-m-d-H-i', strtotime($sekarang)) . "<br>";
        echo $item->status_id;
    }
});

Route::get('/mulai', function () {
    $mulai_sewa = Sewa::where('status_id', 6)->get();

    foreach ($mulai_sewa as $item) {
        $tgl_mulai = $item->sewa_tanggal_mulai;
        $awal = strtotime($tgl_mulai . "+10 hours");
        date_default_timezone_set('Asia/Jakarta');
        $sekarang = strtotime("now");

        if (($sekarang > $awal) && ($item->status_id == 6)) {
            $item->status_id = 7;
            $item->save();
        }
        echo date('Y-m-d-H', strtotime($awal)) . "<br>";
        echo date('Y-m-d-H', strtotime($sekarang)) . "<br>";
        echo $item->status_id . "<br>";
    }
});

// Route::get('/selesai', function () {
//     $selesai_sewa = Sewa::where('status_id', 7)->get();

//     foreach ($selesai_sewa as $item) {
//         $tgl_selesai = $item->sewa_tanggal_berakhir;
//         $akhir = strtotime($tgl_selesai . "+34 hours");
//         date_default_timezone_set('Asia/Jakarta');
//         $sekarang = strtotime("now");

//         if (($sekarang > $akhir) && ($item->status_id == 7)) {
//             $item->status_id = 8;
//             $item->save();
//         }
//         echo date('F j, Y, g:i a', strtotime($akhir)) . "<br>";
//         echo date('F j, Y, g:i a', strtotime($sekarang)) . "<br>";
//         echo $item->status_id . "<br>";
//     }
// });
