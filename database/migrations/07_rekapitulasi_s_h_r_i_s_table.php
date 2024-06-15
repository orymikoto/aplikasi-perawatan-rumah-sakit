<?php

use App\Models\DataRuangan;
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
    Schema::create('rekapitulasi_s_h_r_i_s', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(DataRuangan::class)->constrained()->onDelete('cascade');
      $table->dateTime('tanggal');
      $table->integer('pasien_awal');
      $table->integer('pasien_baru');
      $table->integer('pindahan');
      $table->integer('jumlah_pasien_masuk');
      $table->integer('pasien_keluar_hidup');
      $table->integer('pasien_dipindahkan');
      $table->integer('pasien_mati_belum_48_jam');
      $table->integer('pasien_mati_sudah_48_jam');
      $table->integer('jumlah_pasien_keluar');
      $table->integer('pasien_sisa');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('rekapitulasi_s_h_r_i_s');
  }
};
