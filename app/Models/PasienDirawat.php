<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasienDirawat extends Model
{
  use HasFactory;

  protected $fillable = [
    'pasien_id',
    'data_ruangan_id',
    'jenis_pembayaran_id',
    'kode_penyakit',
    'jenis_penyakit',
    'tanggal_masuk',
    'tanggal_keluar',
    'pasien_pindahan',
    'pasien_mati',
    'rumah_sakit_baru',
  ];

  protected $casts = [
    'tanggal_masuk' => 'datetime',
    'tanggal_keluar' => 'datetime',
  ];

  public function pasien(): BelongsTo
  {
    return $this->belongsTo(Pasien::class);
  }

  public function dataRuangan(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class);
  }

  public function jenisPembayaran(): BelongsTo
  {
    return $this->belongsTo(JenisPembayaran::class);
  }

  public function penyakit(): BelongsTo
  {
    return $this->belongsTo(Penyakit::class, 'kode_penyakit', 'kode_penyakit');
  }
}
