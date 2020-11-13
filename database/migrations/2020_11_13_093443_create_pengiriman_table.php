<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->bigIncrements('pengiriman_id');
            $table->string('ekspedisi');
            $table->string('ongkir');
            $table->bigInteger('transaksi_konsumen_id')->unsigned();
            $table->foreign('transaksi_konsumen_id')->references('transaksi_konsumen_id')->on('transaksi_konsumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengirimans');
    }
}
