<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();
            $table->double('sewa_total');
            $table->dateTime('sewa_tanggal_mulai');
            $table->dateTime('sewa_tanggal_berakhir');
            $table->string('sewa_kode_booking');
            $table->boolean('konfirmasi_penerimaan_barang');
            $table->boolean('konfirmasi_pengembalian_barang');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('status_id')->constrained();
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
        Schema::dropIfExists('sewas');
    }
}
