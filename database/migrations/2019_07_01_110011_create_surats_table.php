<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->string('no_surat');
            $table->string('perihal_surat');
            $table->date('tanggal_surat');
            $table->string('status_surat')->default('baru');

            //foreign key dari staf
            $table->integer('id_admin')->unsigned()->index()->nullable();
            $table->foreign('id_admin')->references('id_admin')->on('admins');

            //foreign key dari sektor
            $table->integer('id_sektor')->unsigned()->index()->nullable();
            $table->foreign('id_sektor')->references('id_sektor')->on('sektors');

            //foreign key dari instansi
            $table->integer('id_instansi')->unsigned()->index()->nullable();
            $table->foreign('id_instansi')->references('id_instansi')->on('instansis');

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
        Schema::dropIfExists('surats');
    }
}
