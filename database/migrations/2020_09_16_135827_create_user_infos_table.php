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
            $table->string('user_nama_lengkap');
            $table->string('user_email');
            $table->string('user_telp');
            $table->string('user_bank');
            $table->string('user_rek');
            $table->string('user_KTP');
            $table->string('user_foto_ktp');
            $table->string('user_image');
            $table->string('user_alamat');
            $table->string('user_provinsi');
            $table->string('user_kabupaten');
            $table->string('user_kecamatan');
            $table->string('user_kelurahan');
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
