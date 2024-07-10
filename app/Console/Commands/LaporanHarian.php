<?php

namespace App\Console\Commands;

use App\Models\DataRuangan;
use App\Models\RekapitulasiSHRI;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Log;

class LaporanHarian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laporan:harian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected function TambahHarianSHRI()
    {
        $data_ruangan = DataRuangan::all();

        foreach ($data_ruangan as $key => $value) {
            // Cek apakah SHRI Hari sebelumnya ada
            $day_before = RekapitulasiSHRI::whereDataRuanganId($value->id)->whereDate('created_at', Carbon::yesterday())->first();

            // Kalau ada
            if ($day_before) {
                # code...
                $new_row = RekapitulasiSHRI::create([
                    'tanggal' => Carbon::today(),
                    'data_ruangan_id' => $day_before->data_ruangan_id,
                    'pasien_awal' => $day_before->pasien_sisa,
                    'pasien_baru' => 0,
                    'pindahan' => 0,
                    'jumlah_pasien_masuk' => 0,
                    'pasien_keluar_hidup' => 0,
                    'pasien_dipindahkan' => 0,
                    'pasien_mati_belum_48_jam' => 0,
                    'pasien_mati_sudah_48_jam' => 0,
                    'jumlah_pasien_keluar' => 0,
                    'pasien_sisa' => $day_before->pasien_sisa,
                ]);
                // Kalau tidak ada
            } else {
                $new_row = RekapitulasiSHRI::create([
                    'tanggal' => Carbon::today(),
                    'data_ruangan_id' => $value->id,
                    'pasien_awal' => 0,
                    'pasien_baru' => 0,
                    'pindahan' => 0,
                    'jumlah_pasien_masuk' => 0,
                    'pasien_keluar_hidup' => 0,
                    'pasien_dipindahkan' => 0,
                    'pasien_mati_belum_48_jam' => 0,
                    'pasien_mati_sudah_48_jam' => 0,
                    'jumlah_pasien_keluar' => 0,
                    'pasien_sisa' => 0,
                ]);
            }
        }
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->TambahHarianSHRI();
            Log::info("Aman");
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
