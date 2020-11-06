<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaOnTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_kasir_details', function (Blueprint $table) {
            $table->bigInteger('harga');
        });

        Schema::table('transaksi_konsumen_details', function (Blueprint $table) {
            $table->bigInteger('harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_kasir_details', function (Blueprint $table) {
            $table->dropColumn('harga');
        });

        Schema::table('transaksi_konsumen_details', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }
}
