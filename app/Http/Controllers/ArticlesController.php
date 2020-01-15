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

    public function index()
    {
        $articles = Article::paginate(3);

        return view('articles.index', ['articles' => $articles]);
    }

    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }
}
