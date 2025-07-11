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
    Schema::create('pasiens', function (Blueprint $table) {
      $table->id();
      $table->string("no_RM")->unique();
      $table->string("nama");
      $table->enum("jenis_kelamin", ["PEREMPUAN", "LAKI - LAKI"]);
      $table->string("alamat");
      $table->integer("umur");
      $table->timestamps();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pasiens');
  }
};
