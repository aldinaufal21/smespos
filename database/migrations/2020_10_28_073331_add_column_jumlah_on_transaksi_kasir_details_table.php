<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJumlahOnTransaksiKasirDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_kasir_details', function (Blueprint $table) {
            $table->integer('jumlah');
        });

        Schema::table('transaksi_konsumens', function (Blueprint $table) {
            $table->dropColumn('jumlah');
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
            $table->dropColumn('jumlah');
        });

        Schema::table('transaksi_konsumens', function (Blueprint $table) {
            $table->bigInteger('jumlah');
        });
    }
}
