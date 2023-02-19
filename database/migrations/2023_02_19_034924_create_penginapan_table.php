<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penginapans', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nama')->nullable(true);
            $table->string('alamat')->nullable(true);
            $table->timestamp('tanggal_checkin')->nullable(true);
            $table->timestamp('tanggal_checkout')->nullable(true);
            $table->integer('harga_permalam')->nullable(true);
            $table->foreignUuid('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penginapan');
    }
};
