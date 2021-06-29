<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableSewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sewas', function (Blueprint $table) {
            $table->double('sewa_harga')->nullable();
            $table->double('sewa_biaya_layanan')->nullable();
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
        Schema::table('sewas', function (Blueprint $table) {
            $table->dropColumn('sewa_harga');
            $table->dropColumn('sewa_biaya_layanan');
        });
    }
}
