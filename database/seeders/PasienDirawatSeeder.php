<?php

namespace Database\Seeders;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\LaporanPenyakitPasien;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB as FacadesDB;
use Carbon\Carbon;


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
      $id_penyakit = $faker->numberBetween(0, $penyakit->count() - 1);
      $id_jenis_pembayaran = $faker->numberBetween(0, $jenis_pembayaran->count() - 1);
      $tanggal_masuk = $faker->dateTimeBetween("-4 weeks", "-3 days");
      array_push($data, [
        'pasien_id' => $value->id,
        'data_ruangan_id' => $faker->numberBetween(1, 10),
        'jenis_pembayaran_id' => $jenis_pembayaran[$id_jenis_pembayaran]->id,
        'kode_penyakit' => $penyakit[$id_penyakit]->kode_penyakit,
        'tanggal_masuk' => $tanggal_masuk,
        'tanggal_keluar' => $faker->boolean() ? Carbon::parse($tanggal_masuk)->addDays($faker->numberBetween(0, 7)) : null,
        'nama_dokter' => $faker->name(),
        'pasien_pindahan' => false,
        'pasien_mati' => false,
        'keadaan_keluar' => ['Keluar - Sembuh', 'Keluar - Belum Sembuh'][$faker->numberBetween(0, 1)]
      ]);

      $check_laporan_penyakit = LaporanPenyakitPasien::whereKodePenyakit(strtoupper($penyakit[$id_penyakit]->kode_penyakit))->whereBetween('created_at', [
        Carbon::parse($tanggal_masuk)->startOfMonth(),
        Carbon::parse($tanggal_masuk)->endOfMonth()
      ])->first();

      if ($check_laporan_penyakit) {
        // dd($check_laporan_penyakit);
        $check_laporan_penyakit->increment(
          $jenis_pembayaran[$id_jenis_pembayaran]->kategori_pasien,
          1
        );
        LaporanPenyakitPasien::whereKodePenyakit($penyakit[$id_penyakit]->kode_penyakit)->increment('jumlah_pasien', 1);

        // $check_laporan_penyakit->update([
        //   $jenis_pembayaran[$id_jenis_pembayaran]->kode_penyakit => DB::raw($jenis_pembayaran[$id_jenis_pembayaran]->kode_penyakit . ' + 1'),
        //   'jumlah_pasien'  => DB::raw('jumlah_pasien + 1'),
        // ]);
      } else {
        LaporanPenyakitPasien::create([
          'kode_penyakit' => $penyakit[$id_penyakit]->kode_penyakit,
          'jenis_penyakit' =>  $penyakit[$id_penyakit]->nama_penyakit,
          'tni_ad_mil' => 0,
          'tni_ad_kel' => 0,
          'tni_ad_pns' => 0,
          'tni_al_pns' => 0,
          'tni_al_kel' => 0,
          'tni_al_mil' => 0,
          'bpjs' => 0,
          'pasien_umum' => 0,
          'jumlah_pasien' => 1,
          'created_at' => $tanggal_masuk
        ]);

        LaporanPenyakitPasien::whereKodePenyakit(strtoupper($penyakit[$id_penyakit]->kode_penyakit))->increment(
          $jenis_pembayaran[$id_jenis_pembayaran]->kategori_pasien,
          1
        );
      }
    }
    PasienDirawat::insert($data);
  }
}
