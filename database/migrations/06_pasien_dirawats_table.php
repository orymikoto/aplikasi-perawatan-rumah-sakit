<?php

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
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
    Schema::create('pasien_dirawats', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Pasien::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(DataRuangan::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(JenisPembayaran::class)->nullable()->nullOnDelete();
      $table->string('kode_penyakit');
      $table->time('tanggal_masuk');
      $table->time('tanggal_keluar');
      $table->boolean('pasien_pindahan');
      $table->boolean('pasien_mati');
      $table->enum('keadaan_keluar', ['Sembuh', 'Belum Sembuh',  'Mati < 48 Jam', '> 48 Jam']);

      // Foreign Key Relation
      $table->foreign('kode_penyakit')->references('kode_penyakit')->on('penyakits')->onDelete('cascade');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pasien_dirawats');
  }
};
