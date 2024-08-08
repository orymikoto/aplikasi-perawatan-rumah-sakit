<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
    $this->call(DataRuanganSeeder::class);
    $this->call(DataPetugasSeeder::class);
    $this->call(PasienSeeder::class);
    $this->call(DokterSeeder::class);
    $this->call(PenyakitSeeder::class);
    $this->call(JenisPembayaranSeeder::class);
    $this->call(PasienDirawatSeeder::class);
    //$this->call(LaporanSHRISeeder::class);
  }
}
