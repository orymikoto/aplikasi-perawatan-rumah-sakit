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
    Schema::create('penggunas', function (Blueprint $table) {
      $table->id();
      $table->string("nama");
      // $table->foreignIdFor(DataRuangan::class)->nullable()->constrained();
      $table->string("email")->unique();
      $table->string("no_hp")->nullable();
      $table->enum("role", ["ADMIN", "KEPALA", "PERAWAT", "PETUGAS"]);
      $table->string("password");
      $table->string("foto_profil");
      $table->boolean("minta_reset_password")->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('penggunas');
  }
};
