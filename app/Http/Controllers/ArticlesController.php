<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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
    /*
    public function index()
    {
        $articles = Article::latest()->paginate(3);

//        return $articles;

        return view('articles.index', ['articles' => $articles]);
    }
    */

    // Render a list of resources.
    public function index(Article $article)
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->paginate(3);
        }
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

    /*
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
    */

    /*
    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        // Will Create it and assign it at the same time.
        Article::create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        ]);
        // Redirect data
        return redirect('/articles');
    }
    */

/*
    public function store()
    {
        // validation
        $validatedAttributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

//        return $validatedAttributes;
        // Will Create it and assign it at the same time.
        Article::create($validatedAttributes);
        // Redirect data
        return redirect('/articles');
    }
*/

    public function store()
    {
        Article::create($this->validateArticle());
        // Redirect data
//        return redirect('/articles');
        return redirect(route('articles.index'));
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
        $article->update($this->validateArticle());

//        return redirect('/articles/' . $article->id);
//        return redirect(route('articles.show', $article));
        return redirect($article->path());
    }

    // Delete the resource
    public function destroy()
    {

    }

    /**
     * @return array
     */
    protected function validateArticle(): array
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }
}


