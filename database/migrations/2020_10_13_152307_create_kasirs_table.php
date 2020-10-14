<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasirs', function (Blueprint $table) {
            $table->bigIncrements('kasir_id');
            $table->string('nama_kasir');
            $table->bigInteger('cabang_id')->unsigned();
        });

        Schema::table('kasirs', function (Blueprint $table) {
            $table->foreign('cabang_id')->references('cabang_id')->on('cabangs');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasirs');
    }
}
