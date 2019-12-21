<?php

namespace App\Providers;

use App\Developer;
use Illuminate\Support\ServiceProvider;

class DeveloperServiceProvider extends ServiceProvider
{
     /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('developer', function()
        {
            return new Developer();
        });
    }
}
