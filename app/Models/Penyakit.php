<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyakit extends Model
{
  use HasFactory;

  protected $fillable = [
    'kode_penyakit',
    'nama_penyakit'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class, 'kode_penyakit', 'kode_penyakit');
  }

  public function laporanPenyakitPasien(): HasMany
  {
    return $this->hasMany(LaporanPenyakitPasien::class);
  }
}
