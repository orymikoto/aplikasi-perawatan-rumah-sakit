<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPembayaran extends Model
{
  use HasFactory;
  use SoftDeletes;


  protected $fillable = [
    'nama_jenis_pembayaran',
    'kategori_pasien'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
