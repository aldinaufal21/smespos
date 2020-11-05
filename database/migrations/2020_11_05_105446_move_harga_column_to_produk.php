<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveHargaColumnToProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->bigInteger('harga');
        });

        Schema::table('stok_opnames', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('harga');
        });

        Schema::table('stok_opnames', function (Blueprint $table) {
            $table->bigInteger('harga');
        });
    }
}
