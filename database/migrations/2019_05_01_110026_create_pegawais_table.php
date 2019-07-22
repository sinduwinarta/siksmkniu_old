<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->string('foto_pegawai')->nullable();
            $table->string('nama_pegawai');
            $table->string('nip')->nullable();
            $table->string('no_telp_pegawai')->nullable();
            $table->string('email_pegawai');
            $table->string('password');
            $table->morphs('jabatanable'); //polymorph inheritance
            $table->rememberToken();
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
        Schema::dropIfExists('pegawais');
    }
}
