<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class DataPetugasSeeder extends Seeder
{
  /**
   * Run the database seeds.po
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $role = ["ADMIN", "PERAWAT", "PETUGAS"];
    $data = [];
    for ($i = 0; $i < 8; $i++) {
      array_push($data, [
        'nama' => $faker->name(),
        'email' => $faker->email(),
        'role' => $role[$faker->numberBetween(0, 2)],
        'password' => "12345678",
        'foto_profil' => $faker->imageUrl()
      ]);
    }

    Pengguna::insert($data);
  }
}
