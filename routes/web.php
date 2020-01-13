<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $name = request('name');

//     return $name;
//     // http://laravel6.test/?name=john
// });

// Route::get('/', function () {
//     $name = request('name');

//     return view('test', [
//         'name' => $name
//     ]);
// });


//Inline
Route::get('/', function () {
    return view('test', [
        'name' => request('name')
    ]);
});
