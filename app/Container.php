<?php

namespace App;

class Container
{
    protected $bindings = [];

    public function bind($key, $value)
    {
        # when this method gets called push to binding array.
        $this->bindings[$key] = $value;
    }

    public function resolve($key)
    {
        # if we have anything in that bidding array then return it
        if (isset($this->bindings[$key])) {
            return call_user_func($this->bindings[$key]);
        }
    }
}
