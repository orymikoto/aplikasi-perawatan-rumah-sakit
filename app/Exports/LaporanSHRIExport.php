<?php

namespace App\Exports;

use App\Models\LaporanPenyakitPasien;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanSHRIExport implements FromView
{
    protected $tanggal;
    function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        $laporan = LaporanPenyakitPasien::whereBetween(
            'created_at',
            [
                Carbon::parse($this->tanggal)->startOfMonth(),
                Carbon::parse($this->tanggal)->endOfMonth()
            ]
        )->orderBy('jumlah_pasien', 'desc')->paginate(10);

        $jumlah = ["tni_ad_mil" => 0, "tni_ad_pns" => 0, "tni_ad_kel" => 0, "tni_al_mil" => 0, "tni_al_pns" => 0, "tni_al_kel" => 0, "bpjs" => 0, "umum" => 0, "jumlah" => 0];

        foreach ($laporan as $key => $value) {
            $jumlah["tni_ad_mil"] += $value->tni_ad_mil;
            $jumlah["tni_ad_kel"] += $value->tni_ad_kel;
            $jumlah["tni_ad_pns"] += $value->tni_ad_pns;
            $jumlah["tni_al_pns"] += $value->tni_al_pns;
            $jumlah["tni_al_kel"] += $value->tni_al_kel;
            $jumlah["tni_al_mil"] += $value->tni_al_mil;
            $jumlah["bpjs"] += $value->bpjs;
            $jumlah["umum"] += $value->pasien_umum;
            $jumlah["jumlah"] += $value->tni_ad_mil + $value->tni_ad_kel + $value->tni_ad_pns + $value->tni_al_pns + $value->tni_al_kel + $value->tni_al_mil + $value->bpjs + $value->pasien_umum;
        }

        return view('export.laporan-penyakit', [
            'laporan' => $laporan, 'jumlah' => $jumlah, 'tanggal' => $this->tanggal
        ]);
    }
}
