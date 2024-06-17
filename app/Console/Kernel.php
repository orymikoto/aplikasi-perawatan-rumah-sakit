<?php

namespace App\Console;

use App\Models\DataRuangan;
use App\Models\PasienDirawat;
use App\Models\RekapitulasiIndikatorRI;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        commands\LaporanBulanan::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('laporan:cron')->lastDayOfMonth('23:50');
        // $schedule->command('laporan:harian')->dailyAt('00:01');
        $schedule->command('laporan:cron')->everyMinute();
        $schedule->command('laporan:harian')->everyMinute();
        // $schedule->call('laporan');
    }

    /**
     * Register the commands for the application.
     */

    protected function penyakit(): void
    {
        $jumlah_tt = DataRuangan::all()->sum('jumlah_tempat_tidur');
    }


    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
