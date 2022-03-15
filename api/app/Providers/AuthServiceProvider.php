<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use App\PublicGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('public', function (Container $app) {
            return new PublicGuard($app['request']);
        });

        $this->registerPolicies();

        //
    }
}
