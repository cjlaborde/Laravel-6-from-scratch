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
        $articles = Article::paginate(3);

        return view('articles.index', ['articles' => $articles]);
    }

    // Show a single resource.
    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    // Show a view to create a new resource
    public function create()
    {

    }

    // Persist the create form
    public function store()
    {

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
