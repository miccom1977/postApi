<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is_admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('is_editor', function ($user) {
            return $user->role === 'editor';
        });

        Gate::define('is_user', function ($user) {
            return $user->role === 'user';
        });
    }
}
