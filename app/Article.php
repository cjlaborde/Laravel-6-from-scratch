<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // You can modify getRouteKeyName() to find it you Generate->OverwriteMethod
//    public function getRouteKeyName()
//    {
//        return 'slug'; // Article::where('slug', $article)->first();
//    }

//    protected $fillable = ['title', 'excerpt', 'body'];
    // As long as you not using code as bellow which can be dangerous just use     protected $guarded = []; instead to deactivate the protection
    // User::create(request->all()) // ['name' => 'newname', 'subscriber' => true];
    protected $guarded = [];

    public function path()
    {
        return route('articles.show', $this);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
