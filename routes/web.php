<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenggunaController;
use App\Models\DataRuangan;
use App\Models\Dokter;
use App\Models\Pasien;
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

Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'nochace']);

// Route::group(['middleware' => ['login', 'admin', 'kepala', ]])

Route::get('login', [AuthController::class, 'login_view'])->name('login_view')->middleware(['guest', 'nochace']);
Route::get('lupa-password', [AuthController::class, 'lupa_password_view'])->name('lupa_password_view')->middleware(['guest', 'nochace']);
Route::post('login', [AuthController::class, 'login_post'])->name('login_post')->middleware(['guest', 'nochace']);
Route::post('lupa-password', [AuthController::class, 'lupa_password_post'])->name('lupa_password_post')->middleware(['guest', 'nochace']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('login', [PenggunaController::class, 'login'])->name('login');
Route::resource('pengguna', PenggunaController::class)->middleware(['role:ADMIN,KEPALA', 'nochace']);
Route::resource('ruangan', DataRuanganController::class)->middleware(['role:ADMIN,KEPALA,PETUGAS', 'nochace']);

// Pasien 
Route::resource('pasiens', PasienController::class)->middleware('role:ADMIN,KEPALA,PERAWAT', 'nochace');
Route::resource('daftar-dokter', DokterController::class)->middleware('role:ADMIN,KEPALA,PERAWAT', 'nochace');
Route::get('pasiens/check-rm/{no_rm}', [PasienController::class, 'cek_rm'])->name('check_rm')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasiens/check-kode-penyakit/{kode_penyakit}', [PasienController::class, 'cek_kode_penyakit'])->name('check_kode_penyakit')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('daftar-pasien', [PasienController::class, 'daftar_pasien'])->name('daftar_pasien')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('tambah-pasien', [PasienController::class, 'tambah_pasien'])->name('tambah_pasien')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('edit-pasien', [PasienController::class, 'edit_pasien'])->name('edit_pasien')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasien-pindah', [PasienController::class, 'daftar_pindah'])->name('daftar_pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasien-pindah/diminta', [PasienController::class, 'daftar_pasien_diminta_pindah'])->name('daftar_pasien_diminta_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasien-pindah/setujui-pindah/{pasien_pindah_id}', [PasienController::class, 'setujui_pindah'])->name('setujui_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasien-pindah/tolak-pindah/{pasien_pindah_id}', [PasienController::class, 'tolak_pindah'])->name('tolak_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::get('pasien-keluar', [PasienController::class, 'daftar_keluar'])->name('daftar_pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::post('pasien-pindah/{id}', [PasienController::class, 'pasien_pindah'])->name('pasien_pindah')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::post('pasien-keluar/{id}', [PasienController::class, 'pasien_keluar'])->name('pasien_keluar')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::post('pasien/import', [PasienController::class, 'import_pasien'])->name('import_pasien')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::post('tambah-pasien/post', [PasienController::class, 'tambah_pasien_post'])->name('tambah_pasien_post')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);
Route::delete('hapus-pasien/{id}', [PasienController::class, 'hapus_pasien'])->name('hapus_pasien')->middleware(['role:ADMIN,KEPALA,PERAWAT', 'nochace']);

// Laporan
Route::get('laporan/shri/{id}', [LaporanController::class, 'rekapitulasiSHRI'])->name('laporan_shri')->middleware(['role:ADMIN,KEPALA,PETUGAS', 'nochace']);
Route::get('laporan/ris', [LaporanController::class, 'rekapitulasiIndikatorRI'])->name('laporan_ris')->middleware(['role:ADMIN,KEPALA,PETUGAS', 'nochace']);
Route::get('laporan/penyakit', [LaporanController::class, 'rekapitulasiLaporanPenyakit'])->name('laporan_penyakit')->middleware(['role:ADMIN,KEPALA,PETUGAS', 'nochace']);
Route::get('laporan/ruangan', [LaporanController::class, 'laporanDataRuangan'])->name('laporan_ruangan')->middleware(['role:ADMIN,KEPALA,PETUGAS', 'nochace']);
Route::get('laporan/export-penyakit/{tanggal}', [LaporanController::class, 'exportLaporanPenyakit'])->name('export-penyakit')->middleware(['role:ADMIN,KEPALA,PETUGAS']);
Route::get('laporan/export-indikator-ri/{tanggal}', [LaporanController::class, 'exportLaporanIndikatorRI'])->name('export-indikator-ri')->middleware(['role:ADMIN,KEPALA,PETUGAS']);

Route::get('ganti-password', [AuthController::class, 'ganti_password'])->name('ganti_password_view')->middleware('auth', 'nochace');
Route::post('ganti-password', [AuthController::class, 'ganti_password_store'])->name('ganti_password_store')->middleware('auth', 'nochace');
