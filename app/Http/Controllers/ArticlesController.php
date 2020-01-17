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

        return $articles;

        return view('articles.index', ['articles' => $articles]);
    }

    // Show a single resource.
//    public function show($id)
//    {
//        //  return 'hello'; to test that if you don't put proper order of routes create will call show instead since show using wild card for ids
//        $article = Article::findOrFail($id);
//
//        return view('articles.show', ['article' => $article]);
//    }

    // Refactored show method
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }


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
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

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
    /*
    public function edit($id)
    {
        $article = Article::find($id);

        // return view('articles.edit', ['article' => $article]);
        // return compact does the same as above but shorter
        return view('articles.edit', compact('article'));
    }
    */

    // Refactored edit method
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // Persist the edited resource
    /*
    public function update($id)
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article = Article::find($id);

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles/' . $article->id);
    }
    */

    public function update(Article $article)
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles/' . $article->id);
    }

    // Delete the resource
    public function destroy()
    {

    }

}
