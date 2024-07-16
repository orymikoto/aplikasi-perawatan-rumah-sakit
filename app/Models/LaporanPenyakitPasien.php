<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPenyakitPasien extends Model
{
  use HasFactory;
  use SoftDeletes;


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
    'created_at'
  ];

  public function penyakit(): BelongsTo
  {
    return $this->belongsTo(Penyakit::class);
  }
}
