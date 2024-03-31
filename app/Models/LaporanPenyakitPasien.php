<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPenyakitPasien extends Model
{
  use HasFactory;

  protected $fillable = [
    'penyakit_id',
    'icd',
    'ad_mil',
    'ad_pns',
    'ad_kel',
    'al_mil',
    'al_pns',
    'al_kel',
    'bpjs',
    'pasien_umum',
    'jumlah_pasien',
  ];

  public function penyakit(): BelongsTo
  {
    return $this->belongsTo(Penyakit::class);
  }
}
