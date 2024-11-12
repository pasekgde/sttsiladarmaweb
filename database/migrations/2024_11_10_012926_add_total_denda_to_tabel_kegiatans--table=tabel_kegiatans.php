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
        Schema::table('tabel_kegiatans', function (Blueprint $table) {
            $table->integer('total_denda')->nullable()->after('denda');
            $table->integer('total_anggota')->nullable()->after('total_denda');
            $table->integer('total_hadir')->nullable()->after('total_anggota');
            $table->integer('total_tidak_hadir')->nullable()->after('total_hadir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
