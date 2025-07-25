<?php

namespace Database\Seeders;

use App\Models\DataRuangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class DataRuanganSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $data = [
      [
        "nama_ruangan" => 'Anggrek I',
        "jumlah_tempat_tidur" => 0,
        "kelas" => "Isolasi"
      ],
      [
        "nama_ruangan" => 'Anggrek 1',
        "jumlah_tempat_tidur" => 9,
        "kelas" => "Isolasi"
      ],
      [
        "nama_ruangan" => 'Anggrek 2',
        "jumlah_tempat_tidur" => 3,
        "kelas" => "Isolasi"
      ],
    ];
    $kelas =  ['Paviliun', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Non Kelas', 'Isolasi'];
    for ($i = 0; $i < 12; $i++) {
      array_push($data, [
        "nama_ruangan" => $faker->name(),
        "jumlah_tempat_tidur" => $faker->numberBetween(4, 10),
        "kelas" => $kelas[$faker->numberBetween(0, 5)]
      ]);
    }
    DataRuangan::insert($data);
  }
}
