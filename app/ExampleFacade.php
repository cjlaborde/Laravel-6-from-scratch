<?php


namespace App;


use Illuminate\Support\Facades\Facade;

class ExampleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        # will return a key to the container and we can define it as any string we want.
//        return 'example';
        return Example2::class;
    }

}
