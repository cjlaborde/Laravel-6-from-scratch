<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    # once again going to Request what I need.
    public function home()
    {
//        ddd($example);
        ddd(resolve('App\Example'), resolve('App\Example'));
    }
}
