<?php

use App\Models\Pasien;
use App\Models\PasienDirawat;
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
    Schema::create('pasien_pindahs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('ruangan_lama_id');
      $table->unsignedBigInteger('ruangan_baru_id');
      $table->foreignIdFor(PasienDirawat::class)->constrained()->onDelete('cascade');
      $table->boolean('disetujui')->default(false);
      $table->dateTime('tanggal_pindah');

      $table->foreign('ruangan_lama_id')->references('id')->on('data_ruangans')->onDelete('cascade');
      $table->foreign('ruangan_baru_id')->references('id')->on('data_ruangans')->onDelete('cascade');

      $table->timestamps();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pasien_pindahs');
  }
};
