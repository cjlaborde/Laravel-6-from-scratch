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
    public function show($slug)
    {
        $post = \DB::table('posts')->where('slug', $slug)->first();

        # inspect the variable with
        // dd($post);
        # Pass Some Data


    return view('post', [
        'post' => $post
    ]);

    }
  
}
