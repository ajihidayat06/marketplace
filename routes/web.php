<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('halamanUtama');
});

Route::get('/masuk', 'AuthController@login');
Route::post('/login', 'AuthController@postlogin')->name('login');
Route::get('/logout', 'AuthController@logout');
Route::get('/daftar', 'AuthController@daftar');
Route::post('/daftar', 'AuthController@postdaftar')->name('daftar');


Route::get('/kelola', function () {
    return view('kelolaBarang');
});

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->middleware('auth');
