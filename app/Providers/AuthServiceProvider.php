<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
            Category::class => CategoryPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
                        if ($user->type === 'super_admin') {
                            return true;
                        }
                    });

        Gate::define('dashboard.view',function($user) {
                        return $user->hasPermission('dashboard.view');
                });     
        Gate::define('settings.index',function($user) {
                        return $user->hasPermission('settings.index');
                });     
        Gate::define('settings.update',function($user) {
                        return $user->hasPermission('settings.update');
                });     
    }
}
