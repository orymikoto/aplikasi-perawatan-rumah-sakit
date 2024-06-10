<?php

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
    Schema::create('pasien_pindahs', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('ruangan_lama_id');
      $table->unsignedInteger('ruangan_baru_id');
      $table->foreignIdFor(Pasien::class)->constrained()->onDelete('cascade');
      $table->date('tanggal_pindah');
      $table->timestamps();
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
