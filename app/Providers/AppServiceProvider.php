<?php

namespace App\Providers;

use App\Example2;
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
        /*
        # bind this key called `example` into the container, now we have key into the container
        $this->app->bind('example', function () {
            # if you resolve() it is going to return new instance of that example class.
            return new Example2();
        });
        */
        # Example::class is same as 'example` since it's still a string.
        $this->app->bind(Example2::class, function () {
            # return what ever is necessary
            return  new Example2('api-key-here');
        });
    }

    /*
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
    */
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
