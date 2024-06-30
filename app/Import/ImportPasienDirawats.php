<?php


namespace App\Imports;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\Penyakit;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportPasienDirawat implements ToArray
{
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $kode_penyakit = "";
            if (substr($row[44], 0, 1) == "Z") {
                $array_of_kode_penyakit = explode(";", $row[44]);
                $kode_penyakit = $array_of_kode_penyakit[1];
            } else {
                $array_of_kode_penyakit = explode(";", $row[44]);
                $kode_penyakit = $array_of_kode_penyakit[0];
            }
            $check_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($row[29])->first();
            $check_penyakit = Penyakit::whereKodePenyakit($row[44])->first();
            $jumlah_ruangan = DataRuangan::all()->count();
            $new_pasien = Pasien::create([
                'no_RM' => $row[1],
                'nama' => $row[9],
                'jenis_kelamin' => $row[12] == "L" ? "LAKI - LAKI" : "PEREMPUAN",
                'umur' => $row[11],
                'alamat' => $row[14],
            ]);

            PasienDirawat::create([
                'pasien_id' => $new_pasien->id,
                'jenis_pembayaran_id' => $check_pembayaran->id,
                'kode_penyakit' => $check_penyakit->id,
                'data_ruangan' =>  $jumlah_ruangan,
            ]);
        }
    }
}
