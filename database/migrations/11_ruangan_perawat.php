<?php

use App\Models\DataRuangan;
use App\Models\Pengguna;
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
    Schema::create('ruangan_perawats', function (Blueprint $table) {
      $table->id();

      $table->foreignIdFor(Pengguna::class)->nullable()->constrained()->cascadeOnDelete();
      $table->foreignIdFor(DataRuangan::class)->nullable()->constrained()->cascadeOnDelete();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ruangan_perawat');
  }
};
