<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    Sanctum::ignoreMigrations();

    if (App::isLocal()) {
      $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
