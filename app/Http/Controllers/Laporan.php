<?php

namespace App\Http\Controllers;

use App\Models\RekapitulasiIndikatorRI;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Laporan extends Controller
{
  //
  public function rekapitulasiSHRI()
  {
  }

  public function rekapitulasiIndikatorRI()
  {
    $laporan = RekapitulasiIndikatorRI::where('created_at', '>=', Carbon::now()->subMonth()->toDateString())->first();

    return view('laporan.indikator-ri', compact('laporan'));
  }

  public function rekapitulasiLaporanPenyakit()
  {
  }
}
