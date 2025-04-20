<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Event;
use App\Policies\EventPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Event::class => EventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define an administrator user role */ 
        Gate::define('isAdmin', function($user) { 
            return $user->role == 'admin'; 
        }); 

        /* define an author user role */ 
        Gate::define('isRequester', function($user) { 
            return $user->role == 'requester'; 
        }); 

        /* define a user role */ 
        Gate::define('isOrganiser', function($user) { 
            return $user->role == 'organiser'; 
        });
    }
}
