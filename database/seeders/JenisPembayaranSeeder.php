<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPembayaranSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data_jenis_pembayaran = [
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - ANGKATAN LAIN MILITER',
        'kategori_pasien' => 'tni_al_mil',
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - ANGKATAN LAIN KELUARGA',
        'kategori_pasien' => 'tni_al_kel',
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - ANGKATAN LAIN PNS',
        'kategori_pasien' => 'tni_al_pns',
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - TNI AD KELUARGA',
        'kategori_pasien' => 'tni_ad_kel'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - TNI AD MILITER',
        'kategori_pasien' => 'tni_ad_mil'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - TNI AD MILITER BANMIN',
        'kategori_pasien' => 'tni_ad_mil'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - TNI AD MILITER SATPUR',
        'kategori_pasien' => 'tni_ad_mil'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS DINAS - TNI AD PNS',
        'kategori_pasien' => 'tni_ad_pns'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS MANDIRI',
        'kategori_pasien' => 'bpjs'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS PBI',
        'kategori_pasien' => 'bpjs'
      ],
      [
        'nama_jenis_pembayaran' => 'BPJS PENSIUNAN TNI',
        'kategori_pasien' => 'bpjs'
      ],
      [
        'nama_jenis_pembayaran' =>
        'BPJS PENSIUNAN UMUM',
        'kategori_pasien' => 'bpjs'
      ],
      [
        'nama_jenis_pembayaran' =>
        'UMUM',
        'kategori_pasien' => 'pasien_umum'
      ],
      [
        'nama_jenis_pembayaran' => 'YANKES TELKOM',
        'kategori_pasien' => 'pasien_umum'
      ]
    ];

    JenisPembayaran::insert($data_jenis_pembayaran);
  }
}
