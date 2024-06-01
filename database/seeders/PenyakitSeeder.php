<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class PenyakitSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $data = [];
    for ($i = 0; $i < 10; $i++) {
      array_push($data, [
        "nama_penyakit" => "penyakit " . $faker->name(),
        "kode_penyakit" => "PNYKT" . str($faker->numberBetween(100, 9999)),
      ]);
    }
    Penyakit::insert($data);
  }
}
