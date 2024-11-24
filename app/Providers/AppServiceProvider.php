<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\Customer\Services\CustomerService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind UserService to UserServiceInterface
        $this->app->bind(UserServiceInterface::class, UserService::class);

        // Bind CustomerService to a specific key
        $this->app->bind('customer.service', CustomerService::class);

        // app()->bind(
        //     UserServiceInterface::class,
        //     function ($app) {
        //         return collect([
        //             'user' => app(UserService::class),
        //             'customer' => app(CustomerService::class),
        //         ]);
        //     }
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superAdmin') ? true : null;
        });
    }
}
