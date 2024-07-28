<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuanganPerawat extends Model
{
  use HasFactory;

  protected $table = 'ruangan_perawats';
  // protected $primary_key = 'id';
  protected $fillable = [
    'pengguna_id',
    'data_ruangan_id'
  ];

  public function pengguna(): BelongsTo
  {
    return $this->belongsTo(Pengguna::class);
  }

  public function dataRuangan(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class);
  }
}
