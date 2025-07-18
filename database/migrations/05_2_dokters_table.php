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
    Schema::create('dokters', function (Blueprint $table) {
      $table->id();
      $table->string('nama_dokter');
      $table->string('No_hp');
      $table->string('Alamat');
      $table->string('DIKUM');
      $table->timestamps();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('dokters');
  }
};
