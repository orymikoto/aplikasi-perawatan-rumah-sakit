<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataRuangan extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'id',
    'nama_ruangan',
    'jumlah_tempat_tidur',
    'kelas'
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
