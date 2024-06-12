<?php

namespace Database\Seeders;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class PasienDirawatSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = FakerFactory::create();
    $data = [];
    // $ruangan = DataRuangan::all();
    $penyakit = Penyakit::all();
    $jenis_pembayaran = JenisPembayaran::all();
    $pasien = Pasien::all();
    foreach ($pasien as $value) {
      $id_penyakit = $faker->numberBetween(1, $penyakit->count() - 1);
      array_push($data, [
        'pasien_id' => $value->id,
        'data_ruangan_id' => $faker->numberBetween(1, 10),
        'jenis_pembayaran_id' => $jenis_pembayaran[$faker->numberBetween(0, $jenis_pembayaran->count() - 1)]->id,
        'kode_penyakit' => $penyakit[$id_penyakit]->kode_penyakit,
        'jenis_penyakit' => $penyakit[$id_penyakit]->nama_penyakit,
        'tanggal_masuk' => $faker->dateTimeBetween("-4 weeks", "-3 days"),
        'tanggal_keluar' => $faker->boolean() ? now() : null,
        'pasien_pindahan' => false,
        'pasien_mati' => false,
        'keadaan_keluar' => ['Keluar - Sembuh', 'Keluar - Belum Sembuh'][$faker->numberBetween(0, 1)]
      ]);
    }
    PasienDirawat::insert($data);
  }
}
