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
        Schema::create('out_stt', function (Blueprint $table) {
            $table->id();
            $table->string('idanggota');
            $table->string('nama');
            $table->date('tgllahir');
            $table->string('pekerjaan');
            $table->string('tempek');
            $table->string('status');
            $table->string('alasankeluar');
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
        Schema::dropIfExists('out_stts');
    }
};
