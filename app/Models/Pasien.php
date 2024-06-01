<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
  use HasFactory;

  protected $fillable = [
    'no_RM',
    'nama',
    'jenis_kelamin',
    'tanggal_daftar',
    'alamat',
    'umur'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
