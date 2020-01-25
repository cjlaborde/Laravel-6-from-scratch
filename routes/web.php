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


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'PagesController@home');
Route::get('/cache', 'PagesController@cache');

# Lessons 38
Route::get('/container', function () {
    ###  This data usually goes to what is called a service provider.
    # 1) Instantiate a container.
    $container = new \App\Container();

    # 2) If we want to store things we can use any method we want.
    # 3) When you call bind you need to give it some key and some kind of data.
    # 4) Create new Class App/Example.php to bind to.
    $container->bind('example', function () {
        #5) Here we instantiate the example class.
        return new \App\Example();
    });
    //    ddd($container);

    $example = $container->resolve('example');

    //    ddd($example);

    $example->go();
});

#Lesson 39 Automatically Resolve Dependencies
/*
app()->bind('example', function () {
    # By providing filename `services.php` and key name `foo`
    $foo = config('services.foo');
    return new \App\Example($foo);
});
*/

//app()->bind('example', function () {
//    return new \App\Example();
//});

/*
Route::get('/resolve', function () {
//    $example = resolve(App\Example::class);
    $example = app()->make(App\Example::class);
    ddd($example);
});
*/
# watch what happens when I simply ask for it.
Route::get('/resolve', function (App\Example $example) {
//    $example = app()->make(App\Example::class);
    ddd($example);
});

//Route::get('/resolve', function () {
//    $example = resolve('example');
//
//    ddd($example);
//});


Route::get('/pages', 'PagesController@home');




//Route::get('/contact', function () {
//    return view('contact');
//});

Route::get('/contact', 'ContactController@show');

Route::post('/contact', 'ContactController@store');

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

Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');



//Route::get('/articles/{article}/edit', 'ArticlesController@edit');
//Route::post('/articles/{article}', 'ArticlesController@update');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
