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

//Route::get('/posts/{post}', 'PostsController@show');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

# Show the data in API from AJAX.
//Route::get('/about', function () {
////    $article = App\Article::all();
////    $article = App\Article::take(2)->get();
////    $article = App\Article::paginate(2);
////    $article = App\Article::latest('published')->get();
////    $article = App\Article::latest('updated')->get();
//    $article = App\Article::latest()->get();
//    return $article;
//    return view('about');
//});



# pass Data to our view
/*
Route::get('/about', function () {
    $article = App\Article::latest()->get();

    return view('about', [
        'articles' => $article
    ]);
});
*/

# pass Data to our view and inline article variable
/*
Route::get('/about', function () {
    return view('about', [
        'articles' => App\Article::latest()->get()
    ]);
});
*/

# Be more specific and only display the latest 3 articles only.
Route::get('/about', function () {
    return view('about', [
        'articles' => App\Article::take(3)->latest()->get()
    ]);
});

Route::get('/articles', 'ArticlesController@index');
Route::get('/articles/{article}', 'ArticlesController@show');


