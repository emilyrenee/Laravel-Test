<?php

namespace App\Providers;

use App\Developer;
use App\Policies\DeveloperPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate::policy(Developer::class, DeveloperPolicy::class);
        Gate::define('assignTeam', 'App\Policies\DeveloperPolicy@assignTeam');
    }
}
