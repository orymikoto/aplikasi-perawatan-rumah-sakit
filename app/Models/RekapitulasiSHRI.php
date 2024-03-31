<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiSHRI extends Model
{
  use HasFactory;

  protected $fillable = [
    'tanggal',
    'pasien_awal',
    'pindahan',
    'jumlah_pasien_masuk',
    'pasien_keluar_hidup',
    'pasien_dipindahkan',
    'pasien_mati_belum_48_jam',
    'pasien_mati_sudah_48_jam',
    'jumlah_pasien_keluar',
    'lama_dirawat',
    'pasien_sisa',
  ];
}
