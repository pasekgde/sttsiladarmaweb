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
        Schema::create('tabel_kegiatans', function (Blueprint $table) {
            $table->increments('idkegiatan');
            $table->date('tanggal_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('jenis_kegiatan');
            $table->string('denda');
            $table->string('keterangan');
            $table->string('user');
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
        Schema::dropIfExists('tabel_kegiatans');
    }
};
