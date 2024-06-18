<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\Laporan;
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
})->middleware('auth');

// Route::group(['middleware' => ['login', 'admin', 'kepala', ]])

Route::get('login', [AuthController::class, 'login_view'])->name('login_view');
Route::post('login', [AuthController::class, 'login_post'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('login', [PenggunaController::class, 'login'])->name('login');
Route::resource('pengguna', PenggunaController::class)->middleware(['role:ADMIN,KEPALA']);
Route::resource('ruangan', DataRuanganController::class)->middleware(['role:ADMIN,KEPALA']);

// Pasien 
Route::resource('pasiens', PasienController::class)->middleware('role:ADMIN,KEPALA,PERAWAT');
Route::get('pasien-pindah', [PasienController::class, 'daftar_pindah'])->name('daftar_pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::get('pasien-keluar', [PasienController::class, 'daftar_keluar'])->name('daftar_pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::post('pasien-pindah/{id}', [PasienController::class, 'pasien_pindah'])->name('pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::post('pasien-keluar/{id}', [PasienController::class, 'pasien_keluar'])->name('pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT']);


// Laporan
Route::get('laporan/shri/{id}', [Laporan::class, 'rekapitulasiSHRI'])->name('laporan_shri')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
Route::get('laporan/ris', [Laporan::class, 'rekapitulasiIndikatorRI'])->name('laporan_ris')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
Route::get('laporan/penyakit', [Laporan::class, 'rekapitulasiLaporanPenyakit'])->name('laporan_penyakit')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
