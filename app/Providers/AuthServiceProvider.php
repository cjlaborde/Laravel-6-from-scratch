<?php

namespace App\Providers;

use App\Conversation;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $this->registerPolicies();
        // Gate::define('update-conversation', function (User $user, Conversation $conversation) {
        //     return $conversation->user->is($user);
        // });
        Gate::before(function (User $user) {
            if ($user->id === 2) { // admin
                return true;
            }
         });
    

         Gate::before(function ($user, $ability) {
             // we have array of all their abilities so lets read that array to see if it contains that ability
            if ($user->abilities()->contains($ability)) {
                return true;   
            }
        });
    }
}
