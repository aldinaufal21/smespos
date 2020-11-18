<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->bigIncrements('keranjang_id');
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('konsumen_id')->unsigned();
            $table->bigInteger('quantity');
            $table->foreign('produk_id')->references('produk_id')->on('produks');
            $table->foreign('konsumen_id')->references('konsumen_id')->on('konsumens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjangs');
    }
}
