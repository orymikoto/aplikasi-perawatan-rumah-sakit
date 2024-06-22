<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\LaporanController;
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

Route::get('/', [DashboardController::class, 'dashboard'])->middleware('auth');

// Route::group(['middleware' => ['login', 'admin', 'kepala', ]])

Route::get('login', [AuthController::class, 'login_view'])->name('login_view');
Route::post('login', [AuthController::class, 'login_post'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('login', [PenggunaController::class, 'login'])->name('login');
Route::resource('pengguna', PenggunaController::class)->middleware(['role:ADMIN,KEPALA']);
Route::resource('ruangan', DataRuanganController::class)->middleware(['role:ADMIN,KEPALA,PETUGAS']);

// Pasien 
Route::resource('pasiens', PasienController::class)->middleware('role:ADMIN,KEPALA,PERAWAT');
Route::get('pasien-pindah', [PasienController::class, 'daftar_pindah'])->name('daftar_pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::get('pasien-keluar', [PasienController::class, 'daftar_keluar'])->name('daftar_pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::post('pasien-pindah/{id}', [PasienController::class, 'pasien_pindah'])->name('pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT']);
Route::post('pasien-keluar/{id}', [PasienController::class, 'pasien_keluar'])->name('pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT']);


// Laporan
Route::get('laporan/shri/{id}', [LaporanController::class, 'rekapitulasiSHRI'])->name('laporan_shri')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
Route::get('laporan/ris', [LaporanController::class, 'rekapitulasiIndikatorRI'])->name('laporan_ris')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
Route::get('laporan/penyakit', [LaporanController::class, 'rekapitulasiLaporanPenyakit'])->name('laporan_penyakit')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
