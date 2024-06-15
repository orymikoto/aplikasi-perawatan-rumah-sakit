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
    Schema::create('jenis_pembayarans', function (Blueprint $table) {
      $table->id();
      $table->string('nama_jenis_pembayaran');
      $table->string('kategori_pasien');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jenis_pembayarans');
  }
};
