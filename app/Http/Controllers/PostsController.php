<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($slug)
    {
        // without model---> $post = DB::table('posts')->where('slug', $slug)->first();
        // With modal eloquent
//        $post = Post::where('slug', $slug)->first();
        $post = Post::where('slug', $slug)->firstOrFail();

        # inspect the variable with
        // dd($post);

        // not needed since we use firstOrFail();
//        if (! $post) {
//            abort(404);
//        }


    # Pass Some Data
    return view('post', [
        'post' => $post
    ]);

    }
    */
    public function show($slug)
    {
        # Inlined Version
        return view('post', [
            'post' => Post::where('slug', $slug)->firstOrFail()
        ]);
    }

}
