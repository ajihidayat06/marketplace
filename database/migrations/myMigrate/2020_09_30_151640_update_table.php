<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table){
            $table->timestamp('akun_verified_at')->nullable();
            $table->string('role');
        });
        Schema::table('user_infos', function (Blueprint $table){
            $table->string('user_nama_rek')->nullable();
            $table->string('user_nama_lengkap')->nullable();
            $table->dropColumn('akun_verified_at');
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
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('akun_verified_at');
            $table->dropColumn('role');
        });
        Schema::table('user_infos', function (Blueprint $table){
            $table->dropColumn('user_nama_rek');
            $table->dropColumn('user_nama_lengkap');
            $table->timestamp('akun_verified_at')->nullable();
        });
    }
}
