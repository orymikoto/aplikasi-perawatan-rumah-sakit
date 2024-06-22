<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekapitulasiIndikatorRI extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'tanggal',
    'nama_fktl',
    'jumlah_tempat_tidur',
    'nilai_bor',
    'nilai_bto',
    'nilai_alos',
    'nilai_toi',
    'nilai_gdr',
    'nilai_ndr',
  ];
}
