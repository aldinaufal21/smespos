<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiKasirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_kasirs', function (Blueprint $table) {
            $table->bigIncrements('sesi_kasir_id');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai')->nullable();
            $table->bigInteger('kasir_id')->unsigned();
        });

        Schema::table('sesi_kasirs', function (Blueprint $table) {
            $table->foreign('kasir_id')->references('kasir_id')->on('kasirs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesi_kasirs');
    }
}
