<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetodePembayaranOnTransaksiKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_kasirs', function (Blueprint $table) {
          $table->enum('metode_bayar', [
              'cash',
              'qris',
              'debit'
          ]);
          $table->string('no_transaksi')->default('');
          $table->string('no_kartu')->default('');
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
        $table->dropColumn('metode_bayar');
        $table->dropColumn('no_transaksi');
        $table->dropColumn('no_kartu');
      });
    }
}
