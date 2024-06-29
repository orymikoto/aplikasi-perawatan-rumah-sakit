<?php

namespace App\Exports;

use App\Models\LaporanPenyakitPasien;
use App\Models\RekapitulasiIndikatorRI;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanIndikatorRIExport implements FromView
{
  protected $tanggal;
  function __construct($tanggal)
  {
    $this->tanggal = $tanggal;
  }

  public function view(): View
  {
    $laporan = RekapitulasiIndikatorRI::whereBetween(
      'created_at',
      [
        Carbon::parse($this->tanggal)->startOfMonth(),
        Carbon::parse($this->tanggal)->endOfMonth()
      ]
    )->first();

    return view('export.laporan-indikator-ri', [
      'laporan' => $laporan, 'tanggal' => $this->tanggal
    ]);
  }
}
