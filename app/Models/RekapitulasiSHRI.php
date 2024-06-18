<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekapitulasiSHRI extends Model
{
  use HasFactory;

  protected $table = 'rekapitulasi_s_h_r_i_s';

  protected $fillable = [
    'data_ruangan_id',
    'tanggal',
    'pasien_awal',
    'pasien_baru',
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

  protected $casts = [
    'tanggal' => 'datetime',
  ];

  public function dataRuangan(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class);
  }
}
