<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_telp');
            $table->string('user_bank')->nullable();
            $table->string('user_rek')->unique()->nullable();
            $table->string('user_KTP')->unique()->nullable();
            $table->string('user_foto_ktp')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_alamat');
            $table->string('user_provinsi')->nullable();
            $table->string('user_kabupaten')->nullable();
            $table->string('user_kecamatan')->nullable();
            $table->string('user_kelurahan')->nullable();
            $table->timestamp('akun_verified_at')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('user_infos');
    }
}
