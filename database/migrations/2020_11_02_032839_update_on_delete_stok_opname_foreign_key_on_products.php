<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOnDeleteStokOpnameForeignKeyOnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stok_opnames', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->foreign('produk_id')
                ->references('produk_id')
                ->on('produks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stok_opnames', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->foreign('produk_id')
                ->references('produk_id')
                ->on('produks');
        });
    }
}
