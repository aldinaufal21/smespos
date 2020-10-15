<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigIncrements('karyawanid');
            $table->bigInteger('umkm_id')->unsigned();
            $table->string('nama');
            $table->string('alamat');
            $table->string('foto');
            $table->dateTime('tanggal_bergabung', 0);
        });

        Schema::table('karyawans', function (Blueprint $table) {
            $table->foreign('umkm_id')->references('umkm_id')->on('umkms');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
