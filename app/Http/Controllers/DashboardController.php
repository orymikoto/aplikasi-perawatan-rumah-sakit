<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyakitPasien;
use App\Models\PasienDirawat;
use App\Models\Pengguna;
use App\Models\RekapitulasiIndikatorRI;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {
        $pasien_dirawats = PasienDirawat::with(['dataRuangan', 'jenisPembayaran'])->paginate(10);
        $indikator_ri = RekapitulasiIndikatorRI::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->first();
        $laporan_penyakit = $laporan = LaporanPenyakitPasien::whereBetween(
            'created_at',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]
        )->orderBy('jumlah_pasien', 'desc')->paginate(10);

        $total_pasien_masuk = PasienDirawat::whereMonth('tanggal_masuk', Carbon::now()->month)->get()->count();
        // dd($total_pasien_masuk);
        $total_pasien_keluar = PasienDirawat::whereMonth('tanggal_keluar', Carbon::now()->month)->get()->count();
        // dd($indikator_ri);
        $total_petugas = Pengguna::all()->count();

        return view('welcome', compact('total_pasien_masuk', 'total_pasien_keluar', 'pasien_dirawats', 'indikator_ri', 'laporan_penyakit', 'total_petugas'));
    }
}
