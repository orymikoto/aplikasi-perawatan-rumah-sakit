<?php

use App\Models\DataRuangan;
use App\Models\Dokter;
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
      $table->foreignIdFor(Pasien::class)->constrained();
      $table->foreignIdFor(DataRuangan::class)->constrained();
      $table->foreignIdFor(JenisPembayaran::class)->nullable()->nullOnDelete();
      $table->string('kode_penyakit');
      $table->dateTime('tanggal_masuk');
      $table->dateTime('tanggal_keluar')->nullable();
      $table->string('jam_dirujuk')->nullable();
      $table->foreignIdFor(Dokter::class)->nullable()->nullOnDelete();
      $table->boolean('pasien_pindahan')->nullable();
      $table->boolean('pasien_mati')->nullable();
      $table->enum('keadaan_keluar', ['Pulang Paksa', 'Keluar - Dirujuk', 'Keluar - Sembuh', 'Keluar - Belum Sembuh',  'Mati < 48 Jam', 'Mati > 48 Jam'])->nullable();
      $table->string('rumah_sakit_baru')->nullable();

      $table->foreign('kode_penyakit')->references('kode_penyakit')->on('penyakits')->onDelete('cascade');

      $table->timestamps();
      $table->softDeletes();
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
