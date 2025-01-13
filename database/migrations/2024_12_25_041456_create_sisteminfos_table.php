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
        Schema::create('sisteminfo', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sistem');
            $table->string('subjudul');
            $table->string('logo');
            $table->string('deskripsi1');
            $table->string('deskripsi2');
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
        Schema::dropIfExists('sisteminfos');
    }
};
