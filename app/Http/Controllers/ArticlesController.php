<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    # check how id works
    /*
    public function show($articleId)
    {
        dd($articleId);
    }
    */

    // Render a list of resources.
    public function index()
    {
        $articles = Article::latest()->paginate(3);

        return view('articles.index', ['articles' => $articles]);
    }

    // Show a single resource.
    public function show($id)
    {
        //  return 'hello'; to test that if you don't put proper order of routes create will call show instead since show using wild card for ids
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    // Show a view to create a new resource
    public function create()
    {
        return view('articles.create');
    }

    // Persist the create form
    // check how Request() works to get data from the form.
    /*
    public function store()
    {
//        die('hello');
        // perists the new article
        // 1. Fetch request data
        dump(request()->all());
    }
    */

    public function store()
    {
        // validation

        // There are more clean ways to write this code.
        $article = new Article();

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        // Persist the data
        $article->save();
        // Redirect data
        return redirect('/articles');
    }

    // Show a view to edit an existing resource
    public function edit()
    {

    }

    // Persist the edited resource
    public function update()
    {

    }

    // Delete the resource
    public function destroy()
    {

    }

}
