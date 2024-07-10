<?php


namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Faker\Factory as FakerFactory;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class ImportPasien extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, WithCalculatedFormulas, ToArray
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
        'jenis_kelamin' => $row[9],
        'alamat' => $row[11],
      );
    }
  }

  public function getArray(): array
  {
    return $this->data;
  }
}
