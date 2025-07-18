<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
  use HasFactory;
  use SoftDeletes;


  protected $fillable = [
    'nama_dokter',
    'No_hp',
    'Alamat',
    'DIKUM',
    
  ];

  public function pasienDirawat(): HasMany
  {
    return $this->hasMany(PasienDirawat::class);
  }
}
