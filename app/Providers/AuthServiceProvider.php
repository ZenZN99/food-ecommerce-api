<?php

namespace App\Providers;

use App\Models\Restaurant;
use App\Policies\RestaurantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Restaurant::class => RestaurantPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /**
         * Optional Gates (useful later)
         */

        // Admin full access
        Gate::define('is-admin', function ($user) {
            return $user->role === 'Admin';
        });

        // Restaurant owner role
        Gate::define('is-restaurant-owner', function ($user) {
            return $user->role === 'restaurant_owner';
        });

        // Delivery role
        Gate::define('is-delivery', function ($user) {
            return $user->role === 'Delivery';
        });
    }
}
