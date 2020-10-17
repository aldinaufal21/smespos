<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableForMultipleShippingAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_pengiriman', function (Blueprint $table) {
            $table->bigIncrements('alamat_pengiriman_id');
            $table->string('alamat');
            $table->bigInteger('konsumen_id')->unsigned();
            $table->foreign('konsumen_id')->references('konsumen_id')->on('konsumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_pengiriman');
    }
}
