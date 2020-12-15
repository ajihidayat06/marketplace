<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScemaForMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('akun_verified_at')->nullable();
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_infos', function(Blueprint $table){
            $table->id();
            $table->string('user_telp')->nullable();
            $table->string('user_bank')->nullable();
            $table->string('user_rek')->unique()->nullable();
            $table->string('user_KTP')->unique()->nullable();
            $table->string('user_foto_ktp')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_alamat')->nullable();
            $table->string('user_provinsi')->nullable();
            $table->string('user_kabupaten')->nullable();
            $table->string('user_kecamatan')->nullable();
            $table->string('user_kelurahan')->nullable();
            $table->string('user_nama_rek')->nullable();
            $table->string('user_nama_lengkap')->nullable();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('kategoris', function(Blueprint $table){
            $table->id();
            $table->string('kategori_nama');
            $table->string('kateori_image');
            $table->boolean('status')->nullable();
            $table->timestamps();
        });

        Schema::create('barangs', function(Blueprint $table){
            $table->id();
            $table->string('barang_nama');
            $table->longText('barang_deskripsi');
            $table->double('barang_harga');
            $table->integer('barang_jumlah');
            $table->string('barang_image');
            $table->boolean('status')->nullable();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('statuses', function(Blueprint $table){
            $table->id();
            $table->string('status_value');
            $table->timestamps();
        });

        Schema::create('sewas', function(Blueprint $table){
            $table->id();
            $table->double('sewa_total');
            $table->dateTime('sewa_tanggal_mulai');
            $table->dateTime('sewa_tanggal_berakhir');
            $table->string('sewa_kode_booking');
            $table->boolean('konfirmasi_penerimaan_barang');
            $table->boolean('konfirmasi_pengembalian_barang');
            $table->integer('sewa_detail_jumlah');
            $table->string('sewa_pembayaran');
            $table->string('sewa_pengambilan');
            $table->string('sewa_jaminan');
            $table->integer('sewa_lama_hari');

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('pemilik_id')->nullable()->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('barang_id')->nullable()->references('id')->on('barangs')->nullOnDelete()->onUpdate('cascade');
            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('konfirmasi_pembayarans', function(Blueprint $table){
            $table->id();
            $table->string('konfirmasi_pembayaran_nama');
            $table->double('konfirmasi_pembayaran_jumlah');
            $table->string('konfirmasi_pembayaran_foto');
            $table->string('konfirmasi_pembayaran_value');

            $table->foreignId('sewa_id')->references('id')->on('sewas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_infos');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('barangs');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('sewas');
        Schema::dropIfExists('konfirmasi_pembayarans');
    }
}
