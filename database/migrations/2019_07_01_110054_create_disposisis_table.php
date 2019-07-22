<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->increments('id_disposisi');
            $table->string('pesan_disposisi');
            $table->string('status_disposisi')->default('sedang');
            //foreign key dari pimpinan
            $table->integer('id_pimpinan')->unsigned()->index()->nullable();
            $table->foreign('id_pimpinan')->references('id_pimpinan')->on('pimpinans');

            //foreign key dari staf
            $table->integer('id_staf')->unsigned()->index()->nullable();
            $table->foreign('id_staf')->references('id_staf')->on('stafs');

            //foreign key dari surat
            $table->integer('id_surat')->unsigned()->index()->nullable();
            $table->foreign('id_surat')->references('id_surat')->on('surats');

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
        Schema::dropIfExists('disposisis');
    }
}
