<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Hash;

class DataPetugasSeeder extends Seeder
{
  /**
   * Run the database seeds.po
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $role = ["ADMIN", "KEPALA", "PERAWAT", "PETUGAS"];
    $data = [
      [
        'nama' => "Bagas Febriansyah",
        'email' => "adminbagas@dkt.com",
        'role' => "ADMIN",
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
      [
        'nama' => "Bagas Febriansyah",
        'email' => "petugasbagas@dkt.com",
        'role' => "PETUGAS",
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
      [
        'nama' => "Bagas Febriansyah",
        'email' => "kepalabagas@dkt.com",
        'role' => "KEPALA",
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
      [
        'nama' => "Bagas Febriansyah",
        'email' => "perawatbagas@dkt.com",
        'role' => "PERAWAT",
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
    ];
    for ($i = 0; $i < 8; $i++) {
      array_push($data, [
        'nama' => $faker->name(),
        'email' => $faker->email(),
        'role' => $role[$faker->numberBetween(0, 2)],
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ]);
    }

    Pengguna::insert($data);
  }
}
