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
        Schema::table('iuran', function (Blueprint $table) {
            $table->integer('total_iuran')->nullable()->after('jumlah');
            $table->integer('total_anggota')->nullable()->after('total_iuran');
            $table->integer('total_yangsudahbayar')->nullable()->after('total_anggota');
            $table->integer('total_yangbelumbayar')->nullable()->after('total_yangsudahbayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iuran', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
