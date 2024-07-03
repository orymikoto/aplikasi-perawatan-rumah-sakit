<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class PasienSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $data = [];
    for ($i = 0; $i < 175; $i++) {
      array_push($data, [
        "no_RM" => str($faker->numberBetween(100000, 999999)),
        "nama" => $faker->name(),
        "jenis_kelamin" => ["PEREMPUAN", "LAKI - LAKI"][$faker->numberBetween(0, 1)],
        "alamat" => $faker->address(),
        "umur" => $faker->numberBetween(10, 60),
      ]);
    }
    Pasien::insert($data);
  }
}
