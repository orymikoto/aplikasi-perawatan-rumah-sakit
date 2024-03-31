<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPembayaran extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama_jenis_pembayaran'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
