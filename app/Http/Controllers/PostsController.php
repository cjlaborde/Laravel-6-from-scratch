<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        # Pass Some Data

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

    }
  
}
