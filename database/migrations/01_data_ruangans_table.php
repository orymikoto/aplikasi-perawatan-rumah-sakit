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
    Schema::create('data_ruangans', function (Blueprint $table) {
      $table->id();
      $table->string("nama_ruangan");
      $table->integer("jumlah_tempat_tidur");
      $table->enum("kelas", ['Paviliun', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Non Kelas', 'Isolasi']);
      $table->timestamps();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('data_ruangans');
  }
};
