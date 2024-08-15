<?php

namespace App\Http\Controllers;

use App\Exports\LaporanIndikatorRIExport;
use App\Exports\LaporanPenyakitExport;
use App\Models\DataRuangan;
use App\Models\LaporanPenyakitPasien;
use App\Models\PasienDirawat;
use App\Models\RekapitulasiIndikatorRI;
use App\Models\RekapitulasiSHRI;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF;

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

    $laporan_ruangan = ["Paviliun" => 0, "Kelas 1" => 0, "Kelas 2" => 0, "Kelas 3" => 0, 'Non Kelas' => 0, 'Isolasi' => 0, 'Jumlah' => 0];

    foreach ($pasien_dirawat as $key => $value) {
      // dd($value->dataRuangan->kelas);
      if ($value->dataRuangan->kelas == "Paviliun") {
        $laporan_ruangan["Paviliun"] += 1;
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
      } else if ($value->dataRuangan->kelas == "Non Kelas") {
        $laporan_ruangan["Non Kelas"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      } else if ($value->dataRuangan->kelas == "Isolasi") {
        $laporan_ruangan["Isolasi"] += 1;
        $laporan_ruangan["Jumlah"] += 1;
      }
    }

    return view('laporan.ruangan', compact('data_ruangan', 'laporan_ruangan'));
  }

  public function exportLaporanIndikatorRI($tanggal, Request $request)
  {
    $jenis_file = $request->jenis_file;

    if ($jenis_file == "pdf") {
      $filename = "laporan-indikator-ri-" . $tanggal . ".pdf";
      $laporan = RekapitulasiIndikatorRI::whereBetween(
        'created_at',
        [
          Carbon::parse($tanggal)->startOfMonth(),
          Carbon::parse($tanggal)->endOfMonth()
        ]
      )->first();

      $pdf = FacadePdf::setOption(['dpi' => 1024])->loadView('export/pdf-laporan-indikator-ri', ['tanggal' => $tanggal, 'laporan' => $laporan]);

      return $pdf->download($filename);
    }
    $filename = "laporan-indikator-ri-" . $tanggal . '.xlsx';
    return Excel::download(new LaporanIndikatorRIExport($tanggal), $filename);
  }

  public function exportLaporanPenyakit($tanggal, Request $request)
  {
    $jenis_file = $request->jenis_file;
    if ($jenis_file == "pdf") {
      $filename = "laporan-penyakit-" . $tanggal . ".pdf";
      $laporan = LaporanPenyakitPasien::whereBetween(
        'created_at',
        [
          Carbon::parse($tanggal)->startOfMonth(),
          Carbon::parse($tanggal)->endOfMonth()
        ]
      )->orderBy('jumlah_pasien', 'desc')->paginate(10);

      $jumlah = ["tni_ad_mil" => 0, "tni_ad_pns" => 0, "tni_ad_kel" => 0, "tni_al_mil" => 0, "tni_al_pns" => 0, "tni_al_kel" => 0, "bpjs" => 0, "umum" => 0, "jumlah" => 0];

      foreach ($laporan as $key => $value) {
        $jumlah["tni_ad_mil"] += $value->tni_ad_mil;
        $jumlah["tni_ad_kel"] += $value->tni_ad_kel;
        $jumlah["tni_ad_pns"] += $value->tni_ad_pns;
        $jumlah["tni_al_pns"] += $value->tni_al_pns;
        $jumlah["tni_al_kel"] += $value->tni_al_kel;
        $jumlah["tni_al_mil"] += $value->tni_al_mil;
        $jumlah["bpjs"] += $value->bpjs;
        $jumlah["umum"] += $value->pasien_umum;
        $jumlah["jumlah"] += $value->tni_ad_mil + $value->tni_ad_kel + $value->tni_ad_pns + $value->tni_al_pns + $value->tni_al_kel + $value->tni_al_mil + $value->bpjs + $value->pasien_umum;
      }


      $pdf = FacadePdf::setOption(['dpi' => 1024])->loadView('export/pdf-laporan-penyakit', ['tanggal' => $tanggal, 'laporan' => $laporan, 'jumlah' => $jumlah]);

      return $pdf->download($filename);
    }

    $filename = "laporan-penyakit-" . $tanggal . '.xlsx';
    return Excel::download(new LaporanPenyakitExport($tanggal), $filename);
  }
}
