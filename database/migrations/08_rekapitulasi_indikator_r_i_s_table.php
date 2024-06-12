<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('rekapitulasi_indikator_r_i_s', function (Blueprint $table) {
      $table->id();
      $table->dateTime('tanggal');
      $table->string('nama_fktl');
      $table->integer('jumlah_tempat_tidur');
      $table->float('nilai_bor');
      $table->float('nilai_bto');
      $table->float('nilai_alos');
      $table->float('nilai_toi');
      $table->float('nilai_gdr');
      $table->float('nilai_ndr');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('rekapitulasi_indikator_r_i_s');
  }
};
