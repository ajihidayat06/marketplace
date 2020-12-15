<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('barang_nama');
            $table->longText('barang_deskripsi');
            $table->double('barang_harga');
            $table->integer('barang_jumlah');
            $table->string('barang_image');
            $table->string('barang_status')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('kategori_id')->constrained();
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
        Schema::dropIfExists('barangs');
    }
}
