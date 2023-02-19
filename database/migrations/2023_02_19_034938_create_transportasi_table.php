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
        Schema::create('transportasi', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nama')->nullable(true);
            $table->integer('harga_perorang')->nullable(true);
            $table->timestamp('tanggal_mulai')->nullable(true);
            $table->timestamp('tanggal_selesai')->nullable(true);
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
        Schema::dropIfExists('transportasi');
    }
};
