<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNomorResiToTransaksiKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            ALTER TABLE transaksi_konsumens
            ADD COLUMN no_resi VARCHAR(255) NULL DEFAULT NULL;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
            ALTER TABLE transaksi_konsumens
            DROP COLUMN no_resi;
        ');
    }
}
