<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenggunaController;
use App\Models\DataRuangan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('login', [AuthController::class, 'login_view'])->name('login_view');

Route::get('login', [PenggunaController::class, 'login'])->name('login');
Route::resource('pengguna', PenggunaController::class);
Route::resource('ruangan', DataRuanganController::class);

// Pasien 
Route::resource('pasiens', PasienController::class);
Route::get('pasien-pindah', [PasienController::class, 'daftar_pindah'])->name('daftar_pasien_pindah');
Route::get('pasien-keluar', [PasienController::class, 'daftar_keluar'])->name('daftar_pasien_keluar');
Route::post('pasien-pindah/{id}', [PasienController::class, 'pasien_pindah'])->name('pasien_pindah');
Route::post('pasien-keluar/{id}', [PasienController::class, 'pasien_keluar'])->name('pasien_keluar');


// Laporan
Route::get('laporan/shri', 'Laporan@rekapitulasiSHRI')->name('laporan_shri');
Route::get('laporan/ris', 'Laporan@rekapitulasiIndikatorRI')->name('laporan_ris');
Route::get('laporan/penyakit', 'Laporan@rekapitulasiLaporanPenyakit')->name('laporan_penyakit');
