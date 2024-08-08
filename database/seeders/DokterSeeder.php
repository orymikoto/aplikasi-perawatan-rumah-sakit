<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = [
      [
        "nama_dokter" => "Dr. Supa Bagas"
      ],
      [
        "nama_dokter" => "Dr. Bagus Saputra"
      ],
      [
        "nama_dokter" => "Dr. Saputra Ramadhan"
      ],
    ];

    Dokter::insert($data);
  }
}
