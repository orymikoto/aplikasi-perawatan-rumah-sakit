<?php


namespace App\Imports;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\Penyakit;
use Maatwebsite\Excel\Concerns\ToArray;
use Faker\Factory as FakerFactory;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class ImportPasienDirawat extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, WithCalculatedFormulas, ToArray
{
  use Importable;
  private $data;

  public function __construct()
  {
    $this->data = [];
  }

  public function array(array $rows)
  {
    foreach (array_slice($rows, 1) as $row) {
      // dd($row);
      $this->data[] = array(
        'no_rm' => $row[1],
        'nama' => $row[6],
        'umur' => $row[8],
        'alamat' => $row[11],
        'tanggal_masuk' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[2])),
        'tanggal_keluar' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[3])),
        'lama_dirawat' => $row[4],
        'hari_perawatan' => $row[5],
        'jenis_kelamin' => $row[9],
        'jenis_kunjungan' => $row[10],
        'nama_ruangan' => $row[24],
        'jenis_pembayaran' => $row[26],
        'nama_dokter' => $row[29],
        'kode_penyakit' => $row[38],
        'kondisi_keluar' => $row[43],
        'kondisi_mati' => $row[44],
        'dirujuk_ke' => $row[45]
      );
    }
  }

  public function getArray(): array
  {
    return $this->data;
  }
}
