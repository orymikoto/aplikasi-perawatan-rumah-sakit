<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataRuangan extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama_ruangan',
    'jumlah_tempat_tidur',
    'kelas'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
