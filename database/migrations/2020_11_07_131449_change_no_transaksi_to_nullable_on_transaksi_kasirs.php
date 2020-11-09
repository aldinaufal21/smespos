<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNoTransaksiToNullableOnTransaksiKasirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE transaksi_kasirs MODIFY `no_transaksi` VARCHAR(100) NULL;");
        DB::statement("ALTER TABLE transaksi_kasirs MODIFY `no_kartu` VARCHAR(100) NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("ALTER TABLE transaksi_kasirs MODIFY `no_transaksi` VARCHAR(255)");
      DB::statement("ALTER TABLE transaksi_kasirs MODIFY `no_kartu` VARCHAR(255)");
    }
}
