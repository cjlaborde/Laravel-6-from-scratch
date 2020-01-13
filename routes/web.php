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
# Wild card {post}
/*
Route::get('/posts/{post}', function($post) {
    return $post;
});
*/

/*
# Pass Some Data
Route::get('/posts/{post}', function($post) {
    $posts = [
        'my-first-post' => 'Hello, this is my first blog post!',
        'my-second-post' => 'How I am getting the hang of this blogging thing'
    ];

    return view('post', [
        'post' => $posts[$post] ?? "Nothing here yet."
    ]);
});

*/

# Pass Some Data
Route::get('/posts/{post}', function($post) {
    $posts = [
        'my-first-post' => 'Hello, this is my first blog post!',
        'my-second-post' => 'How I am getting the hang of this blogging thing'
    ];

    if (! array_key_exists($post, $posts)) {
        abort(404, 'Sorry, that post not found');
    }

    return view('post', [
        'post' => $posts[$post] ?? "Nothing here yet."
    ]);
});
