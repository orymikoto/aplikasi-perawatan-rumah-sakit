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
    for ($i = 0; $i < 4; $i++) {
      array_push($data, [
        "nama_penyakit" => "penyakit " . $faker->sentence(4),
        "kode_penyakit" => strtoupper($faker->randomLetter()) . "." . str($faker->numberBetween(10, 9999)),
      ]);
    }
    Penyakit::insert($data);
  }
}
