<?php

use App\Models\Penyakit;
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
    Schema::create('laporan_penyakit_pasiens', function (Blueprint $table) {
      $table->id();
      $table->string('kode_penyakit');
      $table->string('jenis_penyakit');
      $table->integer('tni_ad_mil');
      $table->integer('tni_ad_pns');
      $table->integer('tni_ad_kel');
      $table->integer('tni_al_mil');
      $table->integer('tni_al_pns');
      $table->integer('tni_al_kel');
      $table->integer('bpjs');
      $table->integer('pasien_umum');
      $table->integer('jumlah_pasien');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('laporan_penyakit_pasiens');
  }
};
