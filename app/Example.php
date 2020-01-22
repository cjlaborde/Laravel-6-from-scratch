<?php

namespace App;

class Example
{

    protected $collaborator;
    protected $foo;
    # Laravel will try to help you out here.
    # 1) It will think ok you need collaborator
    # 2) Looks  like I can instantiate collaborator
    # 3) Then you need $foo there is no type associated with that so can't inspect that
    # 4) Don't know if $foo a string, number or array.
    # 5) Can't help you here.
    public function __construct(Collaborator $collaborator, $foo)
    {
        $this->collaborator = $collaborator;
        $this->foo = $foo;
    }
    /*
    protected $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }


    public function go()
    {
        dump('it works!');
    }
    */
}
