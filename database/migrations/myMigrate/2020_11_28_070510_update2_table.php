<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sewas', function(Blueprint $table){
            $table->integer('sewa_detail_jumlah');
            $table->string('sewa_pembayaran');
            $table->string('sewa_pengambilan');
            $table->string('sewa_jaminan');
            $table->integer('sewa_lama_hari');
        });

        Schema::table('kategoris',function(Blueprint $table){
            $table->string('kategori_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('sewas', function(Blueprint $table){
            $table->dropColumn('sewa_detail_jumlah');
            $table->dropColumn('sewa_pembayaran');
            $table->dropColumn('sewa_pengambilan');
            $table->dropColumn('sewa_jaminan');
            $table->dropColumn('sewa_lama_hari');
        });
        Schema::table('kategoris',function(Blueprint $table){
            $table->dropColumn('kategori_img');
        });
    }
}
