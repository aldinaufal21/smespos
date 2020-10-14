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
            $table->timestamps('tanggal_transaksi');
            $table->integer('kasir_id')->unsigned();
            $table->integer('produk_id')->unsigned();
        });

        Schema::table('transaksi_kasirs', function (Blueprint $table) {
            $table->foreign('kasir_id')->references('kasir_id')->on('kasirs');    
            $table->foreign('produk_id')->references('produk_id')->on('produks');    
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
