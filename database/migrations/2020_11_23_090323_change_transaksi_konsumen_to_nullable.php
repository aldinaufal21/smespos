<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTransaksiKonsumenToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE transaksi_konsumens MODIFY catatan_order VARCHAR(255);');
        // Schema::table('transaksi_konsumens', function (Blueprint $table) {
        //     $table->string('catatan_order')->nullable()->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE transaksi_konsumens MODIFY catatan_order VARCHAR(255) NOT NULL;');
    }
}
