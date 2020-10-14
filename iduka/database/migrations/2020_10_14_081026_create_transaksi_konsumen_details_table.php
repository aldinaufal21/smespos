<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKonsumenDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_konsumen_details', function (Blueprint $table) {
            $table->bigIncrements('transaksi_konsumen_detail_id');
            $table->integer('produk_id')->unsigned();
            $table->integer('transaksi_konsumen_id')->unsigned();
            $table->bigInteger('jumlah');
        });

        Schema::table('transaksi_konsumen_details', function (Blueprint $table) {
            $table->foreign('produk_id')->references('produk_id')->on('produks');
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
        Schema::dropIfExists('transaksi_konsumen_details');
    }
}
