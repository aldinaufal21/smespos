<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRelationBetweenCabangAndIdKonsumen extends Migration
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
            ADD COLUMN cabang_id BIGINT(20) UNSIGNED NULL DEFAULT NULL,
            ADD CONSTRAINT fk_cabang_id FOREIGN KEY (cabang_id) REFERENCES cabangs(cabang_id);
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
            DROP FOREIGN KEY fk_cabang_id,
            DROP COLUMN cabang_id;
        ');
    }
}
