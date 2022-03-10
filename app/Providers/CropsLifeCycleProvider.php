<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LandPreparation;

class CropsLifeCycleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Services\CropsLifeCycleInterface', function ($app) {
            return new LandPreparation();
          });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
