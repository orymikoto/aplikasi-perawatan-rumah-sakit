<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasienPindah extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'pasien_dirawat_id',
    'ruangan_lama_id',
    'ruangan_baru_id',
    'disetujui',
    'tanggal_pindah',
  ];

  protected $casts = [
    'tanggal_pindah' => 'datetime',
  ];

  public function pasienDirawat(): BelongsTo
  {
    return $this->belongsTo(PasienDirawat::class);
  }

  public function ruanganLama(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class, 'ruangan_lama_id', 'id')->withTrashed();
  }

  public function ruanganBaru(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class, 'ruangan_baru_id', 'id')->withTrashed();
  }
}
