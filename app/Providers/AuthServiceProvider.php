<?php

namespace App\Providers;

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

        Gate::define('admin', function($user) {
            return $user->role == 'admin' ? true : false;
        });
        Gate::define('writer', function($user) {
            return $user->role == 'writer' ? true : false;
        });     
        Gate::define('seo', function($user) {
            return $user->role == 'seo' ? true : false;
        });           
    }
}
