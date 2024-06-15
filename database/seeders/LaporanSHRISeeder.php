<?php

namespace Database\Seeders;

use App\Models\DataRuangan;
use App\Models\RekapitulasiSHRI;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;



class LaporanSHRISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $data_ruangan = DataRuangan::all();

        for ($i = 0; $i < $data_ruangan->count(); $i++) {
            # code...
            for ($j = 10; $j > 1; $j--) {
                $check_before_shri = RekapitulasiSHRI::whereDataRuanganId($data_ruangan[$i]->id)->whereDate('tanggal', Carbon::now()->subDays($j + 1))->first();

                $pasien_baru = $faker->numberBetween(4, 10);
                $pasien_pindahan = $faker->numberBetween(0, 4);
                $pasien_keluar = $faker->numberBetween(0, 8);
                $pasien_dipindah = $faker->numberBetween(0, 4);
                $pasien_meninggal = $faker->numberBetween(0, 1);
                $pasien_meninggal_48 = $faker->numberBetween(0, 1);
                if ($check_before_shri) {
                    $pasien_masuk =
                        RekapitulasiSHRI::create([
                            'data_ruangan_id' => $data_ruangan[$i]->id,
                            'tanggal' => Carbon::now()->subDays($j),
                            'pasien_awal' => $check_before_shri->pasien_sisa,
                            'pasien_baru' => $pasien_baru,
                            'pindahan' => $pasien_pindahan,
                            'jumlah_pasien_masuk' => $pasien_baru + $pasien_pindahan,
                            'pasien_keluar_hidup' => $pasien_keluar,
                            'pasien_dipindahkan' => $pasien_dipindah,
                            'pasien_mati_belum_48_jam' => $pasien_meninggal,
                            'pasien_mati_sudah_48_jam' => $pasien_meninggal_48,
                            'jumlah_pasien_keluar' => $pasien_keluar + $pasien_dipindah + $pasien_keluar + $pasien_meninggal + $pasien_meninggal_48,
                            'pasien_sisa' => $check_before_shri->pasien_sisa + $pasien_baru + $pasien_pindahan - $pasien_keluar - $pasien_dipindah - $pasien_meninggal - $pasien_meninggal_48

                        ]);
                } else {
                    $pasien_masuk = RekapitulasiSHRI::create([
                        'data_ruangan_id' => $data_ruangan[$i]->id,
                        'tanggal' => Carbon::now()->subDays($j),
                        'pasien_awal' => 0,
                        'pasien_baru' => $pasien_baru,
                        'pindahan' => $pasien_pindahan,
                        'jumlah_pasien_masuk' => $pasien_baru + $pasien_pindahan,
                        'pasien_keluar_hidup' => $pasien_keluar,
                        'pasien_dipindahkan' => 0,
                        'pasien_mati_belum_48_jam' => 0,
                        'pasien_mati_sudah_48_jam' => 0,
                        'jumlah_pasien_keluar' => 0,
                        'pasien_sisa' => $pasien_baru + $pasien_pindahan
                    ]);
                }
            }
        }
    }
}
