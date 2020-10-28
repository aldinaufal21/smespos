<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTableForProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('stok');
        });

        Schema::create('stoks', function (Blueprint $table) {
            $table->bigIncrements('stok_id');
            $table->integer('stok');
            $table->dateTime('tanggal_input', 0);
            $table->bigInteger('produk_id')->unsigned();
            $table->foreign('produk_id')
                  ->references('produk_id')
                  ->on('produks');  
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
            $table->bigInteger('stok');
        });

        Schema::dropIfExists('stoks');
    }
}
