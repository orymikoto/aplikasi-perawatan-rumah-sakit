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
Route::resource('pasiens', PasienController::class);
