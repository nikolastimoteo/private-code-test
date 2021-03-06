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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('view-edit-delete-phone', function ($user) {
            return $user->can('view-phone') || $user->can('edit-phone') || $user->can('delete-phone');
        });
    }
}
