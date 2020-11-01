<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOnKasirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kasirs', function (Blueprint $table) {
            $table->enum('status_kasir', [
                'buka',
                'tutup',
            ])->default('tutup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kasirs', function (Blueprint $table) {
            $table->dropColumn('status_kasir');
        });
    }
}
