<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKasirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kasirs', function (Blueprint $table) {
            $table->bigIncrements('transaksi_kasir_id');
            $table->dateTime('tanggal_transaksi', 0);
            $table->bigInteger('kasir_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();
        });

        Schema::table('transaksi_kasirs', function (Blueprint $table) {
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
        Schema::dropIfExists('transaksi_kasirs');
    }
}
