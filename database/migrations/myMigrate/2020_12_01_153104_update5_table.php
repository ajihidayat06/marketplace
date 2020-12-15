<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update5Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('konfirmasi_pembayarans', function(Blueprint $table){
            $table->foreignId('sewa_id')->nullable()->onDelete('cascade')->change();
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
        Schema::table('konfirmasi_pembayarans', function(Blueprint $table){
            $table->foreignId('sewa_id')->nullale('false')->onDelete('restrict')->change();
        });
    }
}
