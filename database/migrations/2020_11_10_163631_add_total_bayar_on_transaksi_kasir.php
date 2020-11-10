<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalBayarOnTransaksiKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('transaksi_kasirs', function (Blueprint $table) {
        $table->bigInteger('total_harga');
        $table->bigInteger('total_bayar');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('transaksi_kasirs', function (Blueprint $table) {
        $table->dropColumn('total_harga');
        $table->dropColumn('total_bayar');
      });
    }
}
