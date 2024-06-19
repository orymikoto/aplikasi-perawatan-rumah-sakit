<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\LaporanPenyakitPasien;
use App\Models\RekapitulasiIndikatorRI;
use App\Models\RekapitulasiSHRI;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
  //
  public function rekapitulasiSHRI($id_ruangan)
  {
    $laporan = RekapitulasiSHRI::whereDataRuanganId($id_ruangan)->whereBetween(
      'tanggal',
      [
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()
      ]
    )->orderBy('tanggal', 'desc')->get();

    $data_ruangan = DataRuangan::all();
    $ruangan_saat_ini = DataRuangan::whereId($id_ruangan)->first();

    // dd($laporan);

    return view('laporan.shri', compact('laporan', 'data_ruangan', 'ruangan_saat_ini'));
  }

  public function rekapitulasiIndikatorRI()
  {
    $laporan = RekapitulasiIndikatorRI::where('created_at', '>=', Carbon::now()->subMonth()->toDateString())->first();
    $data_ruangan = DataRuangan::all();


    return view('laporan.indikator-ri', compact('laporan', 'data_ruangan'));
  }

  public function rekapitulasiLaporanPenyakit()
  {
    $laporan = LaporanPenyakitPasien::whereBetween(
      'created_at',
      [
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()
      ]
    )->orderBy('jumlah_pasien', 'desc')->paginate(10);
    $data_ruangan = DataRuangan::all();


    return view('laporan.penyakit', compact('laporan', 'data_ruangan'));
  }
}
