<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function cache()
    {
        # fn() is arrow functions in PHP 7.4
        #Here we written foo to the cache
      Cache::remember('foo', 60, fn() => 'foobar');

        # Read from the cache
        return Cache::get('foo');
    }


    # once again going to Request what I need.
    /*
    public function home()
    {
        # normal
//        return view('welcome');
        # Alternative Using View Facade
        return View::make('welcome');
    }
    */
/* Request Facade
    public function home()
    {
        # We going to fetch some item in the query string
        return request('name');
        return Request::input('name');
    }

    # File Facades
    public function home(Filesystem $file)
    {
        # we going to read a file then output it as a response.

        # Both are the same result.
//       return File::get(public_path('index.php'));
        return $file->get(public_path('index.php'));
    }
*/


    # Lesson 39
    /*
    public function home()
    {
//        ddd($example);
        ddd(resolve('App\Example'), resolve('App\Example'));
    }
    */
}
