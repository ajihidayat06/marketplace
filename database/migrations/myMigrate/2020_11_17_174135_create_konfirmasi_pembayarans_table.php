<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirmasiPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfirmasi_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('konfirmasi_pembayaran_nama');
            $table->double('konfirmasi_pembayaran_jumlah');
            $table->string('konfirmasi_pembayaran_foto');
            $table->string('konfirmasi_pembayaran_value');
            $table->foreignId('sewa_id')->constrained();
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
        Schema::dropIfExists('konfirmasi_pembayarans');
    }
}
