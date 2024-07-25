<?php

namespace App\Http\Controllers;

use App\Exports\LaporanIndikatorRIExport;
use App\Exports\LaporanPenyakitExport;
use App\Models\DataRuangan;
use App\Models\LaporanPenyakitPasien;
use App\Models\PasienDirawat;
use App\Models\RekapitulasiIndikatorRI;
use App\Models\RekapitulasiSHRI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
  //
  public function rekapitulasiSHRI(Request $request, $id_ruangan)
  {
    $laporan = RekapitulasiSHRI::whereDataRuanganId($id_ruangan)->whereBetween(
      'tanggal',
      [
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->startOfMonth()  : Carbon::now()->startOfMonth(),
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->endOfMonth()  : Carbon::now()->endOfMonth(),
      ]
    )->orderBy('tanggal', 'asc')->get();

    $data_ruangan = DataRuangan::all();
    $ruangan_saat_ini = DataRuangan::whereId($id_ruangan)->first();

    // dd($laporan);

    return view('laporan.shri', compact('laporan', 'data_ruangan', 'ruangan_saat_ini'));
  }

  public function rekapitulasiIndikatorRI(Request $request)
  {
    $laporan = RekapitulasiIndikatorRI::whereBetween(
      'created_at',
      [
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->startOfMonth()  : Carbon::now()->subMonth()->startOfMonth(),
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->endOfMonth()  : Carbon::now()->subMonth()->endOfMonth(),
      ]
    )->first();
    $data_ruangan = DataRuangan::all();


    return view('laporan.indikator-ri', compact('laporan', 'data_ruangan'));
  }

  public function rekapitulasiLaporanPenyakit(Request $request)
  {
    $laporan = LaporanPenyakitPasien::whereBetween(
      'created_at',
      [
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->startOfMonth()  : Carbon::now()->startOfMonth(),
        $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->endOfMonth()  : Carbon::now()->endOfMonth(),
      ]
    )->orderBy('jumlah_pasien', 'desc')->paginate(10);
    $data_ruangan = DataRuangan::all();


    return view('laporan.penyakit', compact('laporan', 'data_ruangan'));
  }

  public function laporanDataRuangan(Request $request)
  {
    $data_ruangan = DataRuangan::all();

    $pasien_dirawat = PasienDirawat::whereBetween('tanggal_masuk', [
      $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->startOfMonth()  : Carbon::now()->startOfMonth(),
      $request->query('tanggal') ? Carbon::parse($request->query('tanggal'))->endOfMonth()  : Carbon::now()->endOfMonth(),
    ])->with('dataRuangan')->get();

    $laporan_ruangan = ["Umum" => 0, "Kelas 1" => 0, "Kelas 2" => 0, "Kelas 3" => 0, 'Jumlah' => 0];

    foreach ($pasien_dirawat as $key => $value) {
      // dd($value->dataRuangan->kelas);
      if ($value->dataRuangan->kelas == "Umum") {
        $laporan_ruangan["Umum"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      } else if ($value->dataRuangan->kelas == "Kelas 1") {
        $laporan_ruangan["Kelas 1"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      } else if ($value->dataRuangan->kelas == "Kelas 2") {
        $laporan_ruangan["Kelas 2"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      } else if ($value->dataRuangan->kelas == "Kelas 3") {
        $laporan_ruangan["Kelas 3"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      }
    }

    return view('laporan.ruangan', compact('data_ruangan', 'laporan_ruangan'));
  }

  public function exportLaporanIndikatorRI($tanggal)
  {
    $filename = "laporan-indikator-ri-" . $tanggal . '.xlsx';
    return Excel::download(new LaporanIndikatorRIExport($tanggal), $filename);
  }

  public function exportLaporanPenyakit($tanggal)
  {
    // $laporan = LaporanPenyakitPasien::whereBetween(
    //   'created_at',
    //   [
    //     Carbon::now()->startOfMonth(),
    //     Carbon::now()->endOfMonth()
    //   ]
    // )->orderBy('jumlah_pasien', 'desc')->paginate(10);

    // return view('export.laporan-penyakit', compact('laporan'));
    $filename = "laporan-penyakit-" . $tanggal . '.xlsx';
    return Excel::download(new LaporanPenyakitExport($tanggal), $filename);
  }
}
