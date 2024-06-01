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
      'BPJS DINAS - ANGKATAN LAIN KELUARGA',
      'BPJS DINAS - ANGKATAN LAIN PNS',
      'BPJS DINAS - TNI AD KELUARGA',
      'BPJS DINAS - TNI AD MILITER',
      'BPJS DINAS - TNI AD MILITER BANMIN',
      'BPJS DINAS - TNI AD MILITER SATPUR',
      'BPJS DINAS - TNI AD PNS',
      'BPJS MANDIRI',
      'BPJS PBI',
      'BPJS PENSIUNAN TNI',
      'BPJS PENSIUNAN UMUM',
      'UMUM',
      'YANKES TELKOM'
    ];
    $data = [];
    foreach ($data_jenis_pembayaran as $value) {
      array_push($data, [
        "nama_jenis_pembayaran" => $value
      ]);
    }

    JenisPembayaran::insert($data);
  }
}
