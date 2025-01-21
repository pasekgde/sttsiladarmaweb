<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

Route::get('/cek-denda', [App\Http\Controllers\CekdendaController::class, 'index'])->name('denda.check');
Route::get('/pendataan-stt', [App\Http\Controllers\PendataanController::class, 'index'])->name('pendataan');
Route::post('/pendataan', [App\Http\Controllers\PendataanController::class, 'store'])->name('pendataan.store');
Route::get('/confirm-pendataan', [App\Http\Controllers\PendataanController::class, 'confirmpendataan'])->name('pendataan.stt');

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
Route::get('/pilihlaporan', [App\Http\Controllers\LapkegController::class, 'index'])->name('pilihlaporan');

//pilih FormLaporankegiatan
Route::get('/pililaporan/{id}', [App\Http\Livewire\Pilihevent::class, 'pilih'])->name('pilih');

//absensi
Route::get('/absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi');

//laporan absensi
Route::get('/laporan-absensi', [App\Http\Controllers\LaporanabsensiController::class, 'index'])->name('laporanabsensi');

// Route::get('/print-absensi', [App\Http\Controllers\PrintController::class, 'show'])->name('print.absensi');

//laporan fomrdenda
Route::get('/form-denda', [App\Http\Controllers\DendaCOntroller::class, 'index'])->name('formdenda');

//laporan iuran
Route::get('/iuran-wajib', [App\Http\Controllers\IuranController::class, 'index'])->name('iuranwajib');

//laporan iuran
Route::get('/penekelan', [App\Http\Controllers\PenekelanController::class, 'index'])->name('penekelan');

//TRUNCATE DATA
Route::get('/superadmin-truncatedata', [App\Http\Controllers\TruncateController::class, 'index'])->name('truncate');

//INFOSISTEM
Route::get('/superadmin-sisteminfo', [App\Http\Controllers\SisteminfoController::class, 'index'])->name('sisteminfo');

//pengurusinfo
Route::get('/superadmin-pengurusinfo', [App\Http\Controllers\PengurusController::class, 'index'])->name('pengurusinfo');

//outstt
Route::get('/outstt', [App\Http\Controllers\OutsttController::class, 'index'])->name('outstt');

//alumni
Route::get('/alumni', [App\Http\Controllers\Alumni::class, 'index'])->name('alumni');

});

