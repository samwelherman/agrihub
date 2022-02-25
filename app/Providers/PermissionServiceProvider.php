<?php

namespace App\Providers;

use App\Permission;
use App\SystemModule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Permission::get()->map(function ($permission) {
            Gate::define($permission->slug, function ($user) use ($permission) {
                return $user->hasPermissionTo($permission);
            });
        });

        // Module
        SystemModule::get()->map(function ($module) {
            Gate::define($module->slug, function ($user) use ($module) {
                return $user->hasModuleTo($module);
            });
        });

     
    }
}
