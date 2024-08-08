<?php

namespace Database\Seeders;

use App\Models\DataRuangan;
use App\Models\Pengguna;
use App\Models\RuanganPerawat;
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
    $role = ["ADMIN", "PERAWAT", "PETUGAS"];
    $data_ruangan = DataRuangan::all()->count();
    $data = [
      [
        'nama' => "Bagas Febriansyah",
        'email' => "adminbagas@dkt.com",
        'role' => "ADMIN",
        'no_hp' => "08123456789",
        // 'data_ruangan_id' => null,
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
      [
        'nama' => "Bagas Febriansyah",
        'email' => "petugasbagas@dkt.com",
        'role' => "PETUGAS",
        'no_hp' => "08987654321",
        // 'data_ruangan_id' => null,
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
      [
        'nama' => "Bagas Febriansyah",
        'email' => "perawatbagas@dkt.com",
        'no_hp' => "08987654123",
        'role' => "PERAWAT",
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ],
    ];
    for ($i = 0; $i < 8; $i++) {
      $role_index = $faker->numberBetween(0, 2);
      array_push($data, [
        'nama' => $faker->name(),
        'email' => $faker->email(),
        'no_hp' => null,
        'role' => $role[$role_index],
        // 'data_ruangan_id' => $role_index == 2 ? $faker->numberBetween(1, $data_ruangan) : null,
        'password' => Hash::make('12345678'),
        'foto_profil' => $faker->imageUrl()
      ]);
    }

    Pengguna::insert($data);

    RuanganPerawat::insert([
      [
        'pengguna_id' => 3,
        'data_ruangan_id' => 1
      ],
      [
        'pengguna_id' => 3,
        'data_ruangan_id' => 2
      ],
    ]);
  }
}
