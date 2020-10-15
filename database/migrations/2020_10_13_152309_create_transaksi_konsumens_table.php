<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_konsumens', function (Blueprint $table) {
            $table->bigIncrements('transaksi_konsumen_id');
            $table->bigInteger('jumlah');
            $table->dateTime('tanggal_transaksi', 0);
            $table->bigInteger('konsumen_id')->unsigned();
        });

        Schema::table('transaksi_konsumens', function (Blueprint $table) {
            $table->foreign('konsumen_id')->references('konsumen_id')->on('konsumens');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_konsumens');
    }
}
