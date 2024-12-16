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
        Schema::create('bayariuran', function (Blueprint $table) {
            $table->increments('idbayariuran');
            $table->string('idanggota');
            $table->string('idiuran');
            $table->integer('jumlahbayar');
            $table->string('tanggalbayar');
            $table->enum('statusbayar', ['Terbayar', 'Belum Bayar'])->default('Belum Bayar');
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
        Schema::dropIfExists('bayariurans');
    }
};
