<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolas', function (Blueprint $table) {
            $table->bigIncrements('pengelola_id');
            $table->string('nama_pengelola');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('login_terakhir', 0);
            $table->foreign('user_id')->references('id')->on('users');  
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengelolas');
    }
}
