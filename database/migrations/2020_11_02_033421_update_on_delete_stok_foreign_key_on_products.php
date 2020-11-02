<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOnDeleteStokForeignKeyOnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stoks', function (Blueprint $table) {
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
        Schema::table('stoks', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->foreign('produk_id')
                ->references('produk_id')
                ->on('produks');
        });
    }
}
