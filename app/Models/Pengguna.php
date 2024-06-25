<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends User
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'penggunas';
  // protected $primary_key = 'id';
  protected $fillable = [
    'nama',
    'email',
    'role',
    'data_ruangan_id',
    'password',
    'foto_profil',
  ];

  protected $hidden = [
    'password'
  ];

  public function dataRuangan(): BelongsTo
  {
    return $this->belongsTo(DataRuangan::class);
  }
}
