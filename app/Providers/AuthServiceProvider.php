<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Guards\AdminJWTGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->app['auth']->extend('jwt', function ($app, $name, array $config) {
            $guard = new AdminJWTGuard(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']);
            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        }
        );
        $this->app['auth']->setDefaultDriver('api');
    }
}
