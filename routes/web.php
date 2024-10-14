<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['web','auth']], function() {
//Data Master
Route::get('/datauser', [App\Http\Controllers\DatauserController::class, 'index'])->name('datauser');
Route::get('/createdatauser', [App\Http\Controllers\DatauserController::class, 'create'])->name('createdatauser');
Route::post('/adddatauser', [App\Http\Controllers\DatauserController::class, 'store'])->name('adddatauser');
Route::get('/editdatauser/{id}', [App\Http\Controllers\DatauserController::class, 'edit']);
Route::put('/updatedatauser/{id}', [App\Http\Controllers\DatauserController::class, 'update']);
Route::get('/destroydatauser/{id}', [App\Http\Controllers\DatauserController::class, 'destroy']);

//Data Anggota
Route::get('/dataanggota', [App\Http\Controllers\AnggotaController::class, 'index'])->name('dataanggota');
Route::get('/createanggota', [App\Http\Controllers\AnggotaController::class, 'create'])->name('createanggota');
Route::post('/addanggota', [App\Http\Controllers\AnggotaController::class, 'store'])->name('addanggota');
Route::get('/editanggota/{idanggota}', [App\Http\Controllers\AnggotaController::class, 'edit']);
Route::put('/updatedatanggota/{idanggota}', [App\Http\Controllers\AnggotaController::class, 'update']);
Route::get('/destraoyatanggota/{idanggota}', [App\Http\Controllers\AnggotaController::class, 'destroy']);

//Data Kas Masuk
Route::get('/datakasmasuk', [App\Http\Controllers\KasinController::class, 'index'])->name('kasmasuk');
Route::get('/createkasmasuk', [App\Http\Controllers\KasinController::class, 'create'])->name('createkasmasuk');
Route::post('/addkasmasuk', [App\Http\Controllers\KasinController::class, 'store'])->name('addkasmasuk');
Route::get('/kodekas', [App\Http\Controllers\KasinController::class, 'kodeKasin'])->name('kodeKasin');
Route::get('/editkas/{id}', [App\Http\Controllers\KasinController::class, 'edit']);
Route::put('/updatekas/{id}', [App\Http\Controllers\KasinController::class, 'update']);
Route::get('/destroykas/{id}', [App\Http\Controllers\KasinController::class, 'destroy']);

//Data Kas Keluar
Route::get('/datakaskeluar', [App\Http\Controllers\KasoutController::class, 'index'])->name('kaskeluar');

//Data laporan Kas
Route::get('/laporankas', [App\Http\Controllers\LkasController::class, 'index'])->name('lkas');

//Data Kegiatan
Route::get('/kegiatan', [App\Http\Controllers\KegiatanController::class, 'index'])->name('kegiatan');

//Data Formkegiatan
Route::get('/events', [App\Http\Controllers\FormController::class, 'index'])->name('form');

//pilih Formkegiatan
Route::get('/pilihevent', [App\Http\Controllers\PilihkegiatanController::class, 'index'])->name('pilihevent');

//pilih Formkegiatan
Route::get('/pilihevent/{id}', [App\Http\Livewire\Pilihkegiatan::class, 'pilih'])->name('pilih');

//Laporan Kegiatan
Route::get('/laporankegiatan', [App\Http\Controllers\LevenController::class, 'index'])->name('levent');

//pilih Formkegiatan
Route::get('/pilihlaporan', [App\Http\Controllers\LkegController::class, 'index'])->name('pilihlaporan');

//pilih FormLaporankegiatan
Route::get('/pililaporan/{id}', [App\Http\Livewire\Pilihevent::class, 'pilih'])->name('pilih');

});

