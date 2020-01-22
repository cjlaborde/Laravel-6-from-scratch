<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        # Here we being explicit on how to create Example.php
//        app()->bind('App\Example', function () {
            $this->app->singleton('App\Example', function () {
            # build up our collaborator
            $collaborator = new \App\Collaborator();

            $foo = 'foobar';

            # then we would pass the collaborator
            return new \App\Example($collaborator , $foo);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
