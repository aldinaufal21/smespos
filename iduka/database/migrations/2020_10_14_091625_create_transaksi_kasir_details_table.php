<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKasirDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kasir_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('produk_id')->unsigned();
            $table->integer('transaksi_kasir_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('transaksi_kasir_details', function (Blueprint $table) {
            $table->foreign('produk_id')->references('produk_id')->on('produks');
            $table->foreign('transaksi_kasir_id')->references('transaksi_kasir_id')->on('transaksi_kasirs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_kasir_details');
    }
}
