<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPenyakitPasien extends Model
{
  use HasFactory;

  protected $fillable = [
    'kode_penyakit',
    'jenis_penyakit',
    'tni_ad_mil',
    'tni_ad_pns',
    'tni_ad_kel',
    'tni_al_mil',
    'tni_al_pns',
    'tni_al_kel',
    'bpjs',
    'pasien_umum',
    'jumlah_pasien',
  ];

  public function penyakit(): BelongsTo
  {
    return $this->belongsTo(Penyakit::class);
  }
}
