<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MergeTablePengirimanWithTransaksiKonsumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pengirimans');

        DB::statement('
        ALTER TABLE transaksi_konsumens
        ADD COLUMN ekspedisi VARCHAR(255) NULL DEFAULT NULL,
        ADD COLUMN ongkir bigint(20) NULL DEFAULT NULL;
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->bigIncrements('pengiriman_id');
            $table->string('ekspedisi');
            $table->string('ongkir');
            $table->bigInteger('transaksi_konsumen_id')->unsigned();
            $table->foreign('transaksi_konsumen_id')->references('transaksi_konsumen_id')->on('transaksi_konsumens');
        });
        
        DB::statement('
        ALTER TABLE transaksi_konsumens
        DROP COLUMN ekspedisi,
        DROP COLUMN ongkir;
        ');
    }
}
