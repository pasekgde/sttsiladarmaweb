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
        Schema::create('pendataan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tglLahir');
            $table->integer('umur');
            $table->string('pekerjaan');
            $table->string('tempek');
            $table->string('status');
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
        Schema::dropIfExists('pendataans');
    }
};
