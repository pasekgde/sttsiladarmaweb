<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Sisteminfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mengambil data dari model Sisteminfo
    $sisteminfo = Sisteminfo::first(); // Ambil data pertama dari tabel sisteminfo

    // Membagikan data ke semua view, termasuk master.blade.php
    View::share('data', $sisteminfo); // Menggunakan View::share untuk membagikan data ke semua view
    }
}
