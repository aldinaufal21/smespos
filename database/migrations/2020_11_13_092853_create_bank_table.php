<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('bank_id');
            $table->string('nama_bank');
            $table->string('rekening');
            $table->string('atas_nama');
            $table->bigInteger('umkm_id')->unsigned();
            $table->foreign('umkm_id')->references('umkm_id')->on('umkms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
