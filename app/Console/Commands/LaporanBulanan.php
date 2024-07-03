<?php

namespace App\Console\Commands;

use App\Models\DataRuangan;
use App\Models\LaporanPenyakitPasien;
use App\Models\PasienDirawat;
use App\Models\RekapitulasiIndikatorRI;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Log;

class LaporanBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laporan:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    protected function indikatorRI(): void
    {
        //Mengambil dari database pasien yang telah dirawat bulan ini
        $pasien_bulan_ini = PasienDirawat::where(
            'tanggal_keluar',
            '>=',
            Carbon::now()->startOfMonth()->toDateString()
        )->get();

        //Mengambil dari database pasien yang telah keluar bulan ini
        $pasien_keluar_bulan_ini = PasienDirawat::where(
            'tanggal_keluar',
            '>=',
            Carbon::now()->startOfMonth()->toDateString()
        )->whereNotNull('tanggal_keluar')->get();


        //Mengambil dari database pasien yang Meninggal lebih dari 48 jam bulan ini
        $pasien_meninggal_48jam_bulan_ini = PasienDirawat::where(
            'tanggal_keluar',
            '>=',
            Carbon::now()->startOfMonth()->toDateString()
        )->whereKeadaanKeluar('Mati > 48 Jam')->get();

        //Mengambil dari database pasien seluruh yang meninggal bulan ini
        $pasien_meninggal_bulan_ini = PasienDirawat::where('tanggal_masuk', '>=', Carbon::now()->startOfMonth()->toDateString())
            ->where(function ($query) {
                $query->where('keadaan_keluar', 'Mati > 48 Jam')
                    ->orWhere('keadaan_keluar', 'Mati < 48 Jam');
            })->get();

        // Jumlah Tempat Tidur
        $jumlah_tt = DataRuangan::all()->sum('jumlah_tempat_tidur');

        // Menampung total jumlah hari perawatan
        $jumlah_hari_perawatan = 0;

        // Menampung total jumlah lama dirawat
        $jumlah_lama_dirawat = 0;

        // Menghitung total hari perawatan dan lama dirawat
        foreach ($pasien_bulan_ini as $key => $value) {
            $jumlah_hari_perawatan += $value->tanggal_keluar->diffInDays($value->tanggal_masuk) + 1;
            $jumlah_lama_dirawat += $value->tanggal_keluar->diffInDays($value->tanggal_masuk);
        }

        // Kalkulasi nilai berdasarkan rumus
        $BOR = ($jumlah_hari_perawatan  / ($jumlah_tt * Carbon::now()->daysInMonth)) * 100;
        $BTO = ($pasien_keluar_bulan_ini->count() / $jumlah_tt) / 100 * 100;
        $ALOS = ($jumlah_lama_dirawat / $pasien_keluar_bulan_ini->count()) / 100 * 100;
        $TOI = (($jumlah_tt * Carbon::now()->daysInMonth - $jumlah_hari_perawatan) / $pasien_keluar_bulan_ini->count()) / 100 * 100;
        $GDR = ($pasien_meninggal_bulan_ini->count() / $pasien_keluar_bulan_ini->count()) * 1000;
        $NDR = ($pasien_meninggal_48jam_bulan_ini->count() / $pasien_keluar_bulan_ini->count()) * 1000;

        Log::info('jumlahtt ' . $jumlah_tt . ', jumlah_hari_perawatan ' . $jumlah_hari_perawatan . ', jumlah_lama_dirawat ' . $jumlah_lama_dirawat . ' pasien_keluar ' . $pasien_keluar_bulan_ini->count() . ', 48jam ' . $pasien_meninggal_48jam_bulan_ini->count() . ', <48 ' . $pasien_meninggal_bulan_ini->count());

        $laporan_IRI = RekapitulasiIndikatorRI::create([
            'tanggal' => Carbon::today(),
            'nama_fktl' => 'RUMKIT TK. III BALADHIKA HUSADA JEMBER',
            'jumlah_tempat_tidur' => $jumlah_tt,
            'nilai_bor' => $BOR,
            'nilai_bto' => $BTO,
            'nilai_alos' => $ALOS,
            'nilai_toi' => $TOI,
            'nilai_gdr' => $GDR,
            'nilai_ndr' => $NDR
        ]);
    }

    // protected function penyakit() 
    // {
    //     $laporan = LaporanPenyakitPasien::create([
    //         'icd' => 
    //     ]);
    // }

    public function handle()
    {
        try {
            //code...
            $this->indikatorRI();
        } catch (Exception $e) {
            Log::alert($e);
        }
        Log::info('HELLO');
        Log::info('Laporan Bulanan Telah Ditambahkan');
    }
}
