<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Support\ServiceProvider;

class LaravelCivicrmServiceProvider extends ServiceProvider
{
  
  /**
   * Publishes configuration file.
   *
   * @return  void
   */
  public function boot(): void
  {
    $this->publishes([
      __DIR__ . '/../config/laravel_civicrm.php' => config_path('laravel_civicrm.php'),
    ], 'laravel-migration-builder-config');
  }

  /**
   * Make config publishment optional by merging the config from the package.
   *
   * @return  void
   */
  public function register(): void
  {
    // config
    $this->mergeConfigFrom(
      __DIR__ . '/../config/laravel_civicrm.php',
      'laravel_civicrm'
    );
    // commands
    // $this->commands([
    //   Commands\ExampleCommand::class
    // ]);
  }
}
