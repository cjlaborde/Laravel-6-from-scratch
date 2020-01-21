### Routing to Controllers
1. php artisan make:controller PostsController


### Setup a Database Connection
1. mysql -u root
2. create database laravel6;
3. https://github.com/dbeaver/dbeaver/wiki/New-Table-creation
4. Get data from Database table with   `$post = \DB::table('posts')->where('slug', $slug)->first();`
5. inspect variable with `dd($post);`
6. output post from the database in view with `<p>{{ $post->body }}</p>`


### Hello Eloquent
1. If page doesn't appear abort(404);
2. The "\" from \DB means we are accessing DB class from the global namespace group. Without it you would get error.
3.  or use DB to import it.
4. This is a query builder `DB::table('posts')->where('slug', $slug)->first();`
5.  php artisan make:model Post -m
6. Model provide same API to perform sql queries and to stop business logic.
7. You can even clean it more after refractoring by using technique you will learn later called route model bidding

### Migrations 101
1. `php artisan make:migration create_posts_table`
2. go to create_posts_table.php and recreate table in laravel
3. when you create new post the published_at is optional using `nullable();`
4. `php artisan migrate`
5. To push a new column to production app `php artisan make:migration add_title_to_posts_table`
6. But we on Development mode so we do a `php artisan migrate:rollback`
7. `php artisan migrate`
8. `php artisan migrate:fresh` delete all data makes all tables from scratch

### Generate Multiple Files in a Single Command
1. `php artisan make:migration`
2. `php artisan make:controller`
3. `php artisan make:model Project`
4. You can see all extra commands by using help with `php artisan help make:model`
5.  -a, --all             Generate a migration, seeder, factory, and resource controller for the model
6.  Get model with migration and controller without having to use the above multiple commands.
7. `php artisan make:model Project -mc`

### Business Logic
1. `php artisan make:model Assigment -mc`
2. `fill create_assigment_table` create boolean for completion
3. tinker
4. app(); check all paths in container
5. $assigment = new App\Assigment;
6. Add default false since a New task should not be added as completed $table->boolean('completed')->default(false);
7. `php artisan migrate:rollback`
8. `php artisan migrate`
9. `php artisan tinker`
10. $assigment = new App\Assigment;
11. `$assigment->body = 'Finish school work';`
12. `$assignment->save();` Save to the actual database
13. Get everything from a table in tinker with `App\Assigment::all();`
14. Get first on from a table in tinker with `App\Assigment::first();`
15. Get all assigment where completed is false `App\Assignment::where('completed', false)->get();`
16. all(); would not work above since we are constructing a full query
17. Get all completed assignments `App\Assigment::where('completed', true)->get();`
18. $assigment = App\Assigment::first();
19. When you can make the code the way you would normally speak
20. for example: An user can complete an assigment. So we create method `$assigment->complete();`
21. Create the complete(); method in Assigment Model
22. Update completed table to true `$this->completed = true;`
23. Then save it. Then use tinker
24. `$assigment = App\Assigment::first();`
25. `$assigment->complete();`
26. Reason you create function is because you save steps and is more readable

### Layout Pages
1. create layout.blade.php
2.  Organize views, put all layout code in layout.blade.php and leave body content only in welcome.blade.php
3. use extends('layout') in welcome.blade.php to use the layout.
4. in layout.blade.php use     @yield ('content') to output welcome.blade.php view.
5. on welcome.blade use 
```
@extends('layout')

@section('content')
    # put HTML code here
@endsection

```
6. Link the <script></script> on layout.blade.php

### Integrate a Site Template
1. Download template from `https://templated.co/simplework`
2. Move theme files inside public folder
3. use `<link href="{{ asset('css/default.css') }}" rel="stylesheet" >` to link to files in the public folder
4. Create about.blade.php and create link for it.
5. Only add Features to Home page

### Set an Active Menu Link
1. Create dynamic navbar links to add the selected current page from nav menu item
2. {{ Request::path() === '/about' ? 'current_page_item' : '' }} path = what goes after the / example /about
3. if we on about page only then should be echo out the CSS class otherwise don't echo the class
4. There are 2 ways show here to activate the selected css class
5. a) `{{ Request::path() === '/' ? 'current_page_item' : '' }}` and
6. b) `{{ Request::is('about') ? 'current_page_item' : '' }}`
7. b) `{{ Request::is('about*') ? 'current_page_item' : '' }}` or using wildcard so other subpages keep the about option selected

### Asset Compilation with Laravel Mix and webpack
1. Put same footer code on all pages. By moving it to layout only
2. Remove Content and only leave featured on home page.
3. public folder is for vanilla css and js
4. resource folder is for preprocessed code like sass/vue.js etc. Files you put on resources are compiled into public directory
5. Open webpack.mix.js file
6. npm -v
7. npm install
8. import them in layout.blade.php
9.  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
10. <script src="/js/app.js"></script>

### Render Dynamic Data
1.  `php artisan make:model Article -m`
2. go to `create_article_table` and add what you need 1) title 2) body 3) excerpt
3. `php artisan migrate`
4. use tinker to write article in articles table
5. tinker
6. $article = new App\Article;
7. $article->title = 'Getting to know us';
8.  $article->excerpt = ' Erat enium,Pellentesque viverra vulputate enim. Aliquam erat volutpat.';      
9. 
```
 $article->body = 'Fusce odio. Etiam arcu dui, faucibus eget, placerat vel, 
sodales eget, orci. Donec ornare neque ac sem. Mauris aliquet. Aliquam sem leo, 
vulputate sed, convallis at, ultricies quis, justo. Donec nonummy magna quis risus.
 Quisque eleifend. Phasellus tempor vehicula justo. Aliquam lacinia metus ut elit. 
Suspendisse iaculis mauris nec lorem. Donec leo. Vivamus fermentum nibh in augue. 
Praesent a lacus at urna congue rutrum. 
Nulla enim eros, porttitor eu, tempus id, varius non, nibh.'; 
```
9. $article->save();
10. Check database for article
11. Render the data on the page.
12. Routes file web.php and set the articles to a variable and return them in the page in JSON mode.
```angular2
Route::get('/about', function () {
    $article = App\Article::all();
    return $article;
    return view('about');
});
```
13. check page `http://laravel6.test/about`
14. When you using all(); is fetching every record from the table.
15. But when is a big Data with 100+ of articles is better to take the most recents by
```php
Route::get('/about', function () {
    $article = App\Article::take(2)->get();
    return $article;
    return view('about');
});
```
15. You can also paginate them
```php
Route::get('/about', function () {
    $article = App\Article::paginate(2);
    return $article;
    return view('about');
});
```
16. Show the latest articles first based on date created.
```php
Route::get('/about', function () {
    $article = App\Article::latest()->get();
    return $article;
    return view('about');
});
```
17. You can also order it by updated, published
`$article = App\Article::latest('updated')->get();`, `$article = App\Article::latest('published`)->get();`
18. Pass articles to our view
```php
# pass Data to our view
Route::get('/about', function () {
    $article = App\Article::latest()->get();

    return view('about', [
        'articles' => $article
    ]);
});
```

19. You can inline it to keep it cleaner.
```php
# pass Data to our view
Route::get('/about', function () {
    $article = App\Article::latest()->get();

    return view('about', [
        'articles' => $article
    ]);
});
```
20. You can inline it to keep it cleaner
```php
Route::get('/about', function () {
    return view('about', [
        'articles' => App\Article::latest()->get()
    ]);
});
```

21. visit about.blade.php
```blade
<ul class="style1">
@foreach ($articles as $article)
    <li>
        <h3>{{ $article->title }}</h3>
        <p><a href="#">{{ $article->excerpt }}</a></p>
    </li>
@endforeach
</ul>
```
22. Be more specific and only display the latest 3 articles only.
```php
Route::get('/about', function () {
    return view('about', [
        'articles' => App\Article::take(3)->latest()->get()
    ]);
});
```

### Render Dynamic Data: Part 2
1. Change article nav item from career to articles
2. Create a route but this time link to a controller instead 
3.`Route::get('/articles/{article}', 'ArticleController@show');`
4. Create `ArticlesController`
5. `php artisan make:controller ArticlesController`
6. Add method show on ArticlesController to create page
7. test articleid in ArticlesController
```php
class ArticlesController extends Controller
{
    public function show($articleId)
    {
        dd($articleId);
    }
}
```
8. create the show method to find the article and show it
```php
    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }
```

9. Create views/articles/show.blade.php and output article body content
```
    <div id="content">
        <div class="title">
            <h2>About Us: This is our History</h2>
            <span class="byline">Mauris vulputate dolor sit amet nibh</span> </div>
        <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
        {{ $article->body }}
    </div>
```

10. Create link for articles so that any article will activate select class in navbar
`<li class="{{ Request::is('articles/*') ? 'current_page_item' : '' }}"><a href="/articles" accesskey="4" title="">Articles</a></li>`
11. Link Sidebar to each individual article
```php
    @foreach ($articles as $article)
        <li>
            <h3>
                <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
            </h3>
            <p>{{ $article->excerpt }}</p>
        </li>
    @endforeach
```
### Homework Solutions
1. Create Route
2. Create controller function index
3. Create views for all articles
4. Add Navbar link to articles

### The Seven Restful Controller Actions
1. index() = Should render a lists of items
2. show() = To show a specific item.
3. create() = Show a view to create a new resource
4. store() = Persist the create form
5. edit() = Show a view to edit an existing resource
6. update() = Persist the update from
7. destroy() = Delete the resource

1. `php artisan help make:controller`
2. Will Create controller with all 7 Restful Controller Actions `php artisan make:controller ProjectsController -r`
3. Automatically create controller with 7 Restful controller actions depending on the associated model and referencing that modal where ever is appropriate
4. create routes for edit and update
```php
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::post('/articles/{article}', 'ArticlesController@update');
```
### Restful Routing
1. REST (GET,POST,PUT,PATCH,DELETE)

```php
// GET /articles          # Index
// GET /articles/:id      # Show
// POST /articles         # Store

// PUT /articles/:id      # Update
// DELETE /articles/:id/  # Delete
```
2.
```php
// GET /videos          # Index
// GET /videos/2        # Show
// GET /videos/create   # Create
// POST /videos         # Store
// GET /videos/2/edit   # Edit
// PUT /videos/2        # Update
// Delete /videos/2     # Delete

// GET /videos/subscribe

// POST /videos/subscriptions => VideosSubscriptionsController@store


```
### Form Handling
1. Create route for create `Route::get('/articles/create', 'ArticlesController@create');`
2. If you visit `http://laravel6.test/articles/create` It will try to load show.blade.php
3. return 'hello'; to test that if you don't put proper order of routes create will call show instead since show using wild card for ids
4. Because routes order matters This the proper order
```php
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show');

```
5. Create method create in ArticlesController.php
```php
    public function create()
    {
        return view('articles.create');
    }
```
6. Create create.blade.php view and Create a form to create new articles
7. `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css">`
8. Submit button should call `Route::post('/articles/', 'ArticlesController@store');`
9. Connect the form to call the route.
```blade
    <form method="POST" action="/articles">
        @csrf
```
10. You need to add @csrf or you will get 419 error message.
11. @csrf adds `<input type="hidden" name="_token" value="ZPtUhthKSGeEVTVSVbgs9rvx0LTyiePcJsrMPoIl">` with a token this protects you by verifying you on the server from malicious users faking form requests.
12. Persist the Article in ArticlesController with store() method.
13. Test the request respond by using request()->all();
```php
    public function store()
    {
//        die('hello');
        // perists the new article
        // 1. Fetch request data
        dump(request()->all());
    }
```
14. Result of the dump after submitting form
```php
array:4 [▼
  "_token" => "ZPtUhthKSGeEVTVSVbgs9rvx0LTyiePcJsrMPoIl"
  "title" => "Pizza Food"
  "excerpt" => "reerrefef erewded"
  "body" => "ererfe eref erewrw frwfwf."
]
```
15. Then you can assed the request data this way in the controller. This is the long way to show you how it works.
```php
    public function store()
    {
        // persist the new article
        $article = new Article();

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        
        // Persist the data
        $article->save();
        // Redirect data
        return redirect('/articles');
    }

```
16. Add CSS to only the contact page. Go to layout.blade.php and add `yield('head')`
17.  then in create.blade.php
```php
    @section('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css">
    @endsection
```

### Forms That Submit PUT Requests
1. `http://laravel6.test/articles/3/edit`
2. create route `Route::get('/articles/{article}/edit', 'ArticlesController@edit');`
3. Create controller for edit() in ArticlesController.php
4. create view edit.blade.php
5. show the values to edit on the view with
```php
 <input class="input" type="text"  name="title" id="title" value="{{ $article->title }}">
<textarea class="textarea" name="body" id="excerpt">{{ $article->excerpt }}</textarea>
<textarea class="textarea" name="body" id="body">{{ $article->body }}</textarea>

```
6. declare $article object in controller
```php
    public function edit($id)
    {
        $article = Article::find($id);

//        return view('articles.edit', ['article' => $article]);
        // compact does the same but shorter
        return view('articles.edit', compact('article'));
    }
```
7. Create route now for update `Route::put('/articles/{article}', 'ArticlesController@update');`
8. Create the update() method in the Articles Controller
```php
    public function update($id)
    {
        $article = Article::find($id);

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles/' . $article->id);
    }
```
9. In the edit.blade.php to make form update use PUT. Modern browsers still don't understand Put so you have set it up this way. So that Laravel understand you submitting a Put Request instead of a POST Request.
```blade
    <form method="POST" action="/articles/{{ $article->id }}">
        @csrf
        @method('PUT')
```

### Form Validation Essentials
1. Innocent till proven guilty you need to validate in store() method
2. add some basic to store() method in ArticlesController
```php
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);
```
3. You can also add validate to the front end. `<input class="input" type="text"  name="title" id="title" required>`
4. if any validation fails it will redirect, without validation it would give laravel error message instead.
5. create helper message so that error message appear in the view
```blade
    <input class="input" type="text"  name="title" id="title">
    <p class="help is-danger">{{ $errors->first('title') }}</p>
```
6. but would rather not have the element there unless there was error
```blade
    @if ($errors->has('title'))
        <p class="help is-danger">{{ $errors->first('title') }}</p>
    @endif
```
7. add more feedback by making input red as well
`<input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text"  name="title" id="title">`
8. You can also do it with @error which is simpler and easier to read.
```blade
    <div class="control">
        <input class="input @error('title') is-danger @enderror" type="text"  name="title" id="title">
        @error('title')
            <p class="help is-danger">{{ $errors->first('title') }}</p>
        @enderror
    </div>
```
9. Keep last value on form that was there before form error appeared.
```blade
    <input
        class="input @error('title') is-danger @enderror"
        type="text"
        name="title"
        id="title"
        value="{{ old('title') }}"
    >

    <div class="control">
        <textarea
            class="textarea @error('excerpt') is-danger @enderror"
            name="excerpt"
            id="excerpt"
        >{{ old('excerpt') }}</textarea>
        @error('excerpt')
            <p class="help is-danger">{{ $errors->first('excerpt') }}</p>
        @enderror
    </div>
```
10. Do the same now add the validation in update($id) method from ArticlesController.php

### Leverage Route Model Binding
1. use `$article = Article::findOrFail($id);` instead of `$article = Article::find($id);` that way you get 404 instead of error page.
2. you can use `return $articles;` inside the method of ArticlesController to get the return of the data in JSON
3.  You can make it simpler instead of using
```php
   public function show($id)
   {
       //  return 'hello'; to test that if you don't put proper order of routes create will call show instead since show using wild card for ids
       $article = Article::findOrFail($id);

      return view('articles.show', ['article' => $article]);
   }
```
4. Use this refactored code instead.
```php
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }
```
5. How Laravel knows which the id is? 
6. Route::get('/articles/{article}', 'ArticlesController@show'); Laravel knows the id is from the router {article}
7. Then when we request article `public function show(Article $article)` and the matching card for this variable is.
8. So is the equivalent of doing Article::where('id', 1)->first();
9. That result will be pass to show method, this happens behind the scenes automatically.
10. But be careful because your wild card name is important
11. So make sure wild card named same as the variable you use in the show method
```php
Route::get('/articles/{foobar}', 'ArticlesController@show');
```
```php
    public function show(Article $foobar)
    {
        return view('articles.show', ['article' => $foobar]);
    }

```
12. to make slugs work instead of an ID go to Article.php Model then use in PHPStorm option called `Override Method` `Alt` + `Insert` and Overwrite `getRouteKeyName`
13. 
```php
class Article extends Model
{
    public function getRouteKeyName()
    {
        return 'slug'; // Article::where('slug', $article)->first();
    }

}
```
14. Do the same you did in show() method to edit() and update method
```php
    // Refactored edit method
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

```
```php
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
```

### EXTRA:  look stuff up by either the ID or the slug
```php
    class Article extends Model
    {
        /**
         * Retrieve the model for a bound value.
         *
         * @param  mixed  $value
         * @return \Illuminate\Database\Eloquent\Model|null
         */
        public function resolveRouteBinding($value)
        {
            return $this->where('id', $value)
                ->orWhere('slug', $value)
                ->first();
        }
    }
```
### Reduce Duplication
1. Refractor the store() method in ArticlesController From:
```php
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

```

To

```php
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

        // Persist the data
        $article->save();
        // Redirect data
        return redirect('/articles');
    }
```
2. It will fill since laravel protect you from mass assigment = Refer to situations when unexpected and undeclared parameter is pass from request and
ultimately changes a record in your table
3. To fix mass assigment use `protected $fillable = ['title', 'excerpt', 'body'];` in the Article.php modal.

4. As long as you not using code as `User::create(request->all()) // ['name' => 'newname', 'subscriber' => true];` which can be dangerous
5. Just use `protected $guarded = [];` instead to deactivate the protection inside the modal Article.php
6. After validation is valid it will return the validated attributes from the function call.
7. See the return of the validator
```php
    public function store()
    {
        // validation
        $validatedAttributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        return $validatedAttributes;

```
```json
    {
        title: "validated Attributes",
        excerpt: "validated Attributes",
        body: "validated Attributes"
    }
```
8. Which means I can replace this array inside create with variable with $validatedAttributes
```php
        // Will Create it and assign it at the same time.
        Article::create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        ]);
```
9. you can replace the array with `Article::create($validatedAttributes);`
10. Or we can go Further and indent `Article::create($validatedAttributes);` the $validatedAttributes variable.
```php
    public function store()
    {
        Article::create(request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]));
        // Redirect data
        return redirect('/articles');
    }
```
11. Do the Same with update() method in ArticlesController
```php
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
```

refractor code to 

```php
    public function update(Article $article)
    {
        $article->update(request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]));
        
        return redirect('/articles/' . $article->id);
    }
```
12. This method of refactoring is great since it assign the attributes, persist them all in one go.

13. Now both request for store() and update method are identical so you can refractor it.
```php
request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]));
```
14. so exact it to a method select it and Refractor this and Method
15. turn this
```php
        $article->update(request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]));
```
16. Into this
```php
    public function store()
    {
        Article::create($this->validateArticle());
        // Redirect data
        return redirect('/articles');
    }
```
17. now you only have to update validations in one place.
```php
    protected function validateArticle(): array
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }
```
### Consider Named Routes
1. `Route::get('/articles/{article}', 'ArticlesController@show');`
2. `Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');`
3. Now you can replace in views/articles/index.blade.html `<h2><a href="/articles/{{ $article->id }}">`
4. With the named route `<a href="{{ route('articles.show', $article->id)}}">`
5. Also you can just provide ``<a href="{{ route('articles.show', $article }}">` and laravel will know it's id automatically.
6. In articles controller  use the named routes as well ArticlesController.php
```php
    public function update(Article $article)
    {
        $article->update($this->validateArticle());

//        return redirect('/articles/' . $article->id);
        return redirect(route('articles.show', $article));
    }
```
7. We do this since if we ever change the actual route, it will be dynamic and you only need to make the change in the route since we will use an dynamic address instead
8. we do same with `Route::get('/articles', 'ArticlesController@index')->name('articles.index');`
9. ArticlesController.php
```php
    public function store()
    {
        Article::create($this->validateArticle());
        // Redirect data
//        return redirect('/articles');
        return redirect(route('articles.index'));
    }
```
10. Another option for named routes is to go to model Article.php and add method called path
```php
    public function path()
    {
        return route('articles.show', $this);
    }
```
11. Use `tinker`
12. `$article = App\Article::first();` declare article as the first article created.
13. `$article->path()` and the result is the path of the first one `"http://localhost/articles/1"`
14. Then you can replace on ArticlesController.php
```php
    public function update(Article $article)
    {
        $article->update($this->validateArticle());

//        return redirect('/articles/' . $article->id);
//        return redirect(route('articles.show', $article));
        return redirect($article->path());
    }
```
15. Replace in views/articles/index.blade.php the path again
```php
//{{--                      <a href="{{ route('articles.show', $article->id)}}">--}}
//{{--                      <a href="{{ route('articles.show', $article )}}">--}}
                            <a href="{{ $article->path() }}">
```
### Basic Eloquent Relationships
1. In the project we currently have 3 models Article.php|Project.php|User.php|
2. What connection there are? 
3. User can Connect an article
4. Imagine you want to access all articles of that specific user.
5. Ideally you can do something like give me current user articles `$user->articles`
6. So we need articles method on User.php Model
```php
    public function articles()
    {
        return $this->hasMany(Article::class); // SQL Query---- select * from articles where user_id = 1 // the 1 is the user_id of $this current user.
    }
```
7. but what about inverse? If I got an article and want to grab the user who wrote it. // `$article->user;` in `Article.php` Model
```php

    public function users()
    {
        return $this->belongsTo(User::class);
    }

```
8. What about projects and user? an user can create any number of projects. // `$user->projects` in `User.php` Model
```php
    public function projects()
    {
        return $this->hasMany(Project::class); // SQL Query---- select * from projects where user_id = 1 // the 1 is the user_id of $this current user.
    }
```
9. A Project belongs to an user `$project->user` in `Project.php` Model
```php
    public function user()
    {
        return $this->belongsTo(User::class); // SQL Query---- select * from user where project_id = 1 
    }
```
10. If we going to make this work we need an user_id column inside the Project and Article tablets so we can link them together with the user.

11. Give me user with id of 1  `$user = User::find(1)` // `select * from user where id = 1`
12. Next give me the user projects  `$user->projects;` // `select * from projects where id = $user->id`
13. This query will return as collection and assigned to this project.
14. Now when you access `$user->projects` You have what we call an eloquent collection.
15. you can grab first project `$user->projects->first()` and grab the last project `$user->projects->last()` 
16. you can find any project that meets some criteria `$user->projects->find` 
17. You can split in multiple queries `user->projects->slipt(3)`
18. You can group the projects `$user->projects->groupBy`
19. Here we learned 2 relationships `HasMany` and `BelongsTo`
20. There are others like users `hasOne` profile `hasMany` comments/projects/articles etc
21. There are more complex one like `belongsToMany` when you dealing with pivot tables.
22. When you dealing with polymorphism relationships `morphMany` `morphToMany`
23. In the end you mostly going to use only around 4 only `hasOne`, `hasMany`, `BelongsTo` and `belongsToMany`

### Understanding Foreign Keys and Database Factories
1. We decided that article belongs to an user.
2. And user has many articles.
3. In order to make that work we need some association between article and user.
4. Go to `create_articles_table.php`
5. Make sure that you are using bigIncrements in both articles and user tables. and add `$table->unsignedBigInteger('user_id');`
```php
    $table->bigIncrements('id');
    $table->unsignedBigInteger('user_id');
```
6. `php artisan migrate:fresh`
7. All data gets deleted so lets create factory to quickly regenerate data.
8. go to UserFactory.php Faker library allows us to generate any data
9. To load data from factory use `tinker`
10. `factory(App\User::class)->create();` will generate a user each time you use it.
11. `factory(App\User::class, 5)->create();`
12. If you want article ` factory(App\Article::class, 5)->create();` will not work since you have not created it yet.
13. `php artisan help make:factory`
14. `php artisan make:factory ArticleFactory` but doesn't know what Model we working with.
15. `php artisan make:factory ArticleFactory -m "Article"` so it will reference the Article
16. Check the Article table to see what data we want generated, you don't need to generate id or timestamps since they get generated automatically.
```php
$factory->define(Article::class, function (Faker $faker) {
    return [
        # Will generate a new user that will own this article.
        'user_id' => factory(\App\User::class),
        'title' => $faker->sentence,
        'excerpt' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
```
17. Now you can run `factory(App\Article::class, 5)->create` and create 5 articles
18. With each article a new user was created as well.
19. If you want to have your own attribute instead of using Faker random do this will create 5 articles with same title.
20. `factory(App\Article::class, 5)->create(['title' => 'Override the title']);`
21. But a Better way to do it is. Create Article and associate it with user.
`factory(App\Article::class, 5)->create(['user_id' => 1 ]);`
22. Problem is that if you delete user 1 all those articles end up without a user.
23. Foreign key constrain this will delete all Articles when the user gets deleted.
```php
    $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
});
```
24. `php artisan migrate:fresh`

25. So test it again create Articles from same user and delete user to see cascasde into action.
26. Create 2 new users `factory(App\User::class, 2)->create();`
27. `factory(App\Article::class, 5)->create(['user_id' => 1 ]);`
28. delete user one and see if all his articles were deleted.
29. tinker
30. `App\User::find(1);`
31 `$user = App\User::find(1);`
32. Article.php Model
```php
    public function articles()
    {
        return $this->hasMany(Article::class); // select * from articles where user_id = 1 // the 1 is the user_id of $this current user.
    }
```
33. `$user->articles;` Return all the User with Id 1 articles
34. `tinker` now find reverse.
35. `App\Article::find(4);`
36. `App\Article::first(1)->user;` It will return the user object that wrote the article.
37. if you use author instead of user it will get error single Laravel can recognize that user connects with user_id
```php
    public function author()
    {
        return $this->belongsTo(User::class);
    }

```
38. To make it work you have to pass it another argument
```php
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
```
39. `tinker` to test it again.
40. `App\Article::find(4);`
41. ` App\Article::find(4)->author;`

### EXTRA: When User Deleted Set Articles as Guest Author.
1. For another use case if you have articles but you don't want to delete them from your site when the user that wrote them is deleted.
2. Go to Article.php model and add this method.
```php
public function author()
{
    return $this->belongsTo(User::class, 'author_id')->withDefault([
        'name' => 'Guest Author',
    ]);
}
```

### Many to Many Relationships With Linking Tables
1. How to associate tags with an Article?
2. An Article has many tags example laravel Article could have tags of `php` `mvc` `framework` `back-end`
3. Or less do the inverse  does `tag belongs to an article`
4. If we have a Tag named `Learn Laravel`
5. We may have tags named `php` `laravel` `educating`
6. But does that means the `laravel` tag belongs to `Learn Laravel` tag?
7. Nope because this `laravel` tag could belong to many articles.
8. An article can have many Tags and a tag can belong to many articles as well.
9. in Article.php Model to represent this.
```php
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
```
10. Now you need to create Tag model. `php artisan make:model Tag -m` with a migration included -m
11. Move to that migration `create_tags_table.php`
12. Add string column for the name of the tag
```php
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
```
13. Where do we create association between the article and the tag?
14. We can't use ~~$table->unsignedBigInteger('article_id'); // laravel~~ since we would went back to just using Belongs to many.
14. Since we can't make `laravel` tag only belong to an article. `laravel` tag show belong to Many Articles how to make this work?
15. To make this work we need 3 different tables. `Article.php` & `Tag.php` and we Create a separate Pivot Table/Linking table to link them together. 
16. article_tag convention on how to name it. First singular as the Table you want to create tag for and then tag same as this create_tags_table
17. in create_tags_table.php
```php
class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            # 1) Add string column for the name of the tag
            # 2) Set the name unique to prevent duplicates.
            $table->string('name')->unique();
            $table->timestamps();
        });

        // article_tag convention on how to name it. First singular as the Table you want to create tag for and then tag same as this create_tags_table
        Schema::create('article_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            # 1) connection to article in question
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            # 3) Combination of the article_id and tag_id must be unique. That way don't have duplicates
            $table->unique(['article_id', 'tag_id']);
            # 4) Set the foreign key for both.
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }
```
18. `php artisan migrate`
 
19. Enter some tags `php` `laravel` `education`
20. Add some row data to article_tag table, made sure the id of both Article and Tag exist or you get error.
21. add method to `Article.php` Model
```php
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
```
21. `tinker`
22. `$article = App\Article::first();`
23. `$article->tags;`
24. Only get name of the tag with `$article->tags->pluck('name');`
```php
     all: [
       "php",
       "laravel",
       "education",
     ],
   }

```
25. Now we do the inverse and we get all the Articles that have certain tag.
```php
    class Tag extends Model
    {
        public function articles()
        {
            return $this->belongsToMany(Article::class);
        }
    }
```
26. `tinker`
27. ` $tag = App\Tag::first();`
28. `$tag->articles;`
29. `$tag->articles->pluck('title');`
```php
     all: [
       "Learn Laravel",
     ]
```


### Display All Tags Under Each Article

1. Tags are more tricky since a tag doesn't belong to a single article. One Tag could Belongs to Many Articles and one Article could belongs to many tags.
2. We will show all Tags that belong to an article. Go to `views/articles/show.blade.php`
```blade
        @foreach ($article->tags as $tag)
{{--         <a href="/tags/laravel"> {{ $tag->name }}</a> --}}
            <a href="/articles?tag={{ $tag->name }}"> {{ $tag->name }}</a>
        @endforeach
```
3. `http://laravel6.test/articles?tag=laravel`
4.  
```php
    public function index(Article $article)
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;

            return $articles;
        }
```
5. visit http://laravel6.test/articles?tag=laravel to see the json.

```json
    [
        {
            id: 1,
            user_id: 1,
            title: "Learn Laravel",
            excerpt: "Modi enim sequi impedit autem aliquam numquam qui.",
            body: "Eum corrupti laboriosam ut voluptas sit aut eos sit. Itaque ducimus quos aut et ex ab. Voluptate ut magni nihil qui in cum ducimus.",
            created_at: "2020-01-19 00:55:03",
            updated_at: "2020-01-19 00:55:03",
            pivot: {
              tag_id: 2,
              article_id: 1
            }
        }
    ]
```
6. Simple Filtering in ArticlesController.php
```php
        public function index(Article $article)
        {
            if (request('tag')) {
                $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
            } else {
                $articles = Article::latest()->paginate(3);
            }
            return view('articles.index', ['articles' => $articles]);
        }
```
7. But if we visit page with a tag where we have no article the page will be empty to fix it go to `views/articles/index.blade.php`
8. with forelse is same as foreach but also include if statement
```blade
            @forelse ($articles as $article)
                <div id="content">
                    <div class="title">
                        <h2>
                            <a href="{{ $article->path() }}">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <span class="byline">{{ $article->excerpt }}</span> </div>
                    <p><img src="/images/banner.jpg" alt="" class="image image-full" /></p>
                </div>
            @empty
                <p>No revelant articles yet.</p>
            @endforelse
```
9. Go to `views/article/show.blade.php`  replace link with the route name
```blade
            @foreach ($article->tags as $tag)
{{--                        <a href="/articles?tag={{ $tag->name }}"> {{ $tag->name }}</a>--}}
                <a href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
            @endforeach
```
### Attach and Validate Many-to-Many Inserts
1. Add menu so that people can select the tags of their Article
2 Got to `/views/articles/create.blade.php`
3. Reuse the Body field for the tags
4. A shortcut way to get error messages is using `<p class="help is-danger">{{ $message }}</p>` As long as you use.
```blade
    @error('tags')
<!--        <p class="help is-danger">{{ $errors->first('tags') }}</p>-->
        <p class="help is-danger">{{ $message }}</p>
    @enderror
```
5. @message will render the error message what ever the key is in @error('tags')
6. here is the Tags field
```blade
    <div class="field">
        <label class="label" for="body">Tags</label>

        <div class="control">
            <select
                name="tags[]"
            >
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

            @error('tags')
                <p class="help is-danger">{{ $errors->first('tags') }}</p>
            @enderror
        </div>
    </div>
```
7. You will get error since it can't find tags so go to `ArticleController.php`
```php
        public function create()
        {
            return view('articles.create', [
                'tags' => Tag::all()
            ]);
        }
```
8. Check the select element with inspect and notice the value is the id.
9. After we submit the form we would submit the store() method.
10. Go to ArticlesController.php
```php
    public function store()
    {
        dd(request()->all());
        $article = Article::create($this->validateArticle());
        return redirect(route('articles.index'));
    }
```
11. This is the request as you see the is an array.
```json
    array:5 [
      "_token" => "3onuZscIZUzTS7UleijbGu489sVrNMPGe3KuxksP"
      "title" => "Pizza Food"
      "excerpt" => "Pizza Food"
      "body" => "Pizza Food"
      "tags" => array:1 [
        0 => "1"
      ]
    ]
```
12. The reason is because we have `name="tags[]"` if we remove   `name="tags"` we would have single number but in this case we dealing with a belongs to many.
13. Since we plan to have multiple tags. so we use
```blade
    <select
        name="tags[]"
        multiple
    >
```
14. Then when I submitted it. All those tags can be attached to single array.
```json
array:5 [
  "_token" => "3onuZscIZUzTS7UleijbGu489sVrNMPGe3KuxksP"
  "title" => "My Second Project"
  "excerpt" => "My Second Project"
  "body" => "My Second Project"
  "tags" => array:3 [
    0 => "1"
    1 => "2"
    2 => "3"
  ]
]
```
15. We can not create Article yet since there is no user_id since we will deal with that when we work with authentication so this is what we will do instead.
16. We are hardcoding the user_id since we will work with that in next chapter.
```php
    public function store()
    {
        $article = new Article($this->validateArticle());
        $article->user_id = 1; // we normally set the id with who ever is signed in // auth()->id();
        $article->save();

        # you can attach or detach records on a pivot/linking table
        $article->tags()->attach(request('tags'));
        
        return redirect(route('articles.index'));
    }

```
17. you can attach or detach records on a pivot/linking table. 
18. To see how this work lets use `tinker`
19. `App\Article::find(3);`
20. `$article = App\Article::find(3);`
21. `$article->tags()->attach(1);`
22. You can pass array as well to select multiple tags `$article->tags()->attach([2, 4]);`
23. You can also remove `$article->tags()->detach(2);`
24. `tinker`
25. `$tag = App\Tag::find(1);`
26. `$article->tags()->attach($tag);` You can attach the first tag to the article.
27. `$tag = App\Tag::findMany([1,2]);` will find many and put then in array of the collection of those tags.
28. `$article->tags()->attach($tag);`
29. Now that you understand the basics on how it works.
30. Now go to ArticleController.php in store method to use what we learned.
```php
    public function store()
    {
        $article = new Article($this->validateArticle());
        $article->user_id = 1; // we normally set the id with who ever is signed in // auth()->id();
        $article->save();

        # you can attach or detach records on a pivot/linking table
        $article->tags()->attach(request('tags')); // [1,2,3]

        return redirect(route('articles.index'));
    }

```
31. Create new Post and check that the new post has multiple tags.
32. Now what if someone adds a tag that is not supported?
33. Add new option in browser using the web development inspect tools in the browser and add ` <option value="5">acme</option>`
34. The page show error, so it would be better if we stop it at it's tract at the validation layer in ArticleController.php
```php
    protected function validateArticle(): array
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required',
            # exist on the tags table looking at the id column. The tag id needs to exist in the tag table.
            'tags' => 'exists:tags,id'
        ]);
    }
```
35. `ErrorException Array to string conversion` you get error since tags not part of Article is a relationship so we need to make some changes.
36. Go to Articles controller and modify ArticlesController.php
```php
    public function store()
    {
        # build article and pass what I need from the request.
        $article = new Article(request(['title', 'excerpt', 'body']));
        # set user id
        $article->user_id = 1; // we normally set the id with who ever is signed in // auth()->id();
        # save it
        $article->save();
        # attach the tags.
        # you can attach or detach records on a pivot/linking table
        $article->tags()->attach(request('tags')); // [1,2,3]

        return redirect(route('articles.index'));
    }
```
37. Notice in database timestamps are not saved to relationships so to fix this go to Article.php
```php
        public function tags()
        {
            return $this->belongsToMany(Tag::class)->withTimestamps();
        }
```
### Build a Registration System in Mere Minutes
1. `composer require laravel/ui --dev`
2. `php artisan` you will see 2 new commands ui and ui:auth
3. `php artisan help ui`
4. `php artisan ui vue --auth`
5. `npm install && npm run dev`
6. It will install views for auth|password recovery and route for dashboard and all the auth routes.
7. `php artisan route:list` will show list of all routes.
8. to install boostrap `php artisan ui boostrap`
9. Register and log in
10. Notice that the Dashboard `Route::get('/home', 'HomeController@index')->name('home');` can only be assessed if logged in.
11. Go to HomeController to see why.
```php
    public function __construct()
    {
        $this->middleware('auth');
    }
```
12. If you remove this `$this->middleware('auth');` any guest will be able to access the dashboard section.
13. Before user can get to index() it needs to pass the __construct() method. You must be signed it to be allowed pass the `middleware('auth)`
14. Alternatively you can also add the middleware to the route. `Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');`
15. got to `home.blade.php`, then You can access Database fields in the views by
16. You are logged in, `{{ Auth::user() }}` You have access to the entire User model.
```json
{"id":2,"name":"John","email":"john@gmail.com","email_verified_at":null,"created_at":"2020-01-20 01:01:32","updated_at":"2020-01-20 01:01:32"}
```
17. So to only access the name use `{{ Auth::user()->name }}` 
18. Alternatively you can use `{{ auth()->user()->name }}`
19. You can also use it, in public pages so, depending if user logged in or not shows different message
```blade
    <div id="banner" class="container">
        <a href="#" class="button">
            @if (Auth::check())
                Welcome, {{ Auth::user()->name }}
            @else
                Welcome
            @endif
        </a>
    </div>
```
20. But since this is so common Laravel provides a directive for this very purpose.
```blade
    <div id="banner" class="container">
        <a href="#" class="button">
            @auth
                Welcome, {{ Auth::user()->name }}
            @else
                Welcome
            @endauth
            @guest 
                Please Sign-in
            @endguest
        </a>
    </div>

```
21. Sometimes you want to use the opposite. The opposite of @auth is @guest
```blade
    @guest
        Please Sign-in
    @endguest
``` 
### The Password Reset Flow| How to See Laravel Under the hood.
    1. Click "Forget Password"
    2. Fill out a form with their email address.
    3. Prepare a unique token and associate it with user's account.
    4. Send an email with a unique link back to our site that confirms email ownership.
    5. Link back to website, conform the token, and set a new password.

1. if you try  send email to reset password but get error message
2. You need to configure your mail first in the `.env`  or `config/mail.php`
3. in `.env` change driver to `MAIL_DRIVER=log`  this means it will log to a file in `storage/logs`
4. Then go to database and delete password_reset table data since the email failed for not been configured yet.
5. Check the log file `storage/logs/laravel.log` and you will see
```blade
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below
into your web browser: [http://localhost/password/reset/6d1e924885c?email=john%40gmail.com](http://localhost/password/reset/6d1e97790380ffb88233ad9c?email=john%40gmail.com)
```
6. In the password_reset table you will see token but that one is the hash version of this one since laravel automatically generate one for security.
7. Notice that link is localhost that is because we have not set localhost yet.
8. The token must be exact or you get error. After password gets reset the password_resets should delete itself.
9. Lets figure out how it works. `php artisan route:list` To see the routes leading to controllers and how it works.
10. `ForgotPasswordController.php`  click on  ---> `use SendsPasswordResetEmails;`
11. It goes to SendsPasswordResetEmails.php
```php
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
```
12. Which return the view that has the password reset `email.blade.php`
13. There you will find form that submits to `<form method="POST" action="{{ route('password.email') }}">`
14. Then check `php artisan route:list` to see where that route for `password.email` is at
15. which it links to the controller `ForgotPasswordController@sendResetLinkEmail`
16.  Where it validate email 
```php
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

```
17. Validate email using
```php
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
```
18. Then laravel uses concept of password broker and it calls  the sndResetLink and then provides user credentials.

```php
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );
```
19. The credentials is the email address in this case.
```php
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
```
20. Then we check `sendResetLink` method inside `PasswordsBroker.php` class, you can reach here by clicking.
21. Checks the user `$user = $this->getUser($credentials);`
22. here is where the notification gets fired off
```php
        $user->sendPasswordResetNotification(
            $this->tokens->create($user)
        );
```
22. Notice is calling the `sendPasswordResetNotification` directly on the $user model.
23. go to User.php model to figure our how. The reason is that User.php Model `use Notifiable;` trait and also extend this Authenticatable class.
24. `use Illuminate\Foundation\Auth\User as Authenticatable;`
25. You will see trait called `CanResetPassword` follow it and click it.
```php
    class User extends Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
    {
        use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    }
```
26.  So in PasswordBroker.php this is the method we actually calling
```php
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
```
27. All it does is notify user and sends through a notification class. Follow it `ResetPasswordNotification`
28. Then follow `use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;`
29. This is basically the blueprint of an email
```php
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::get('Reset Password Notification'))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
```
30. The key here is we adding button to reset password. Then we sending the url back to our website.
```php
 ->action(Lang::get('Reset Password'), url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
```
31. What is going here is we fill up the form, and setup the token. Then fire up an email, then when the user click on that email.
32. Then when user click on that email they go to the route 
33. `GET|HEAD | password/reset/{token}  | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm`
34. Then goes to the ResetPasswordController controller.
35. Then click on `use ResetsPasswords;` trait
36. Where we show a view to reset the password.
```php
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
```
37. Then here is were we finally finish up
```php
    public function reset(Request $request)
    {
        //#-- 1) Validate Request
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.

        //#-- 2) Then we use password browser to reset email.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
        
        //#-- 3) Then we pass this closure that actually update the user. Click resetPassword
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }
```
38. click on resetPassword `$this->resetPassword($user, $password);`
```php
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        # 1) We set Token
        $user->setRememberToken(Str::random(60));
        # 2) We Persist it
        $user->save();
        # 3) File off an event
        event(new PasswordReset($user));
        # 4) Then log in the user.
        $this->guard()->login($user);
    }
```
39. You don't need to do any of this since laravel does it for you and just works.

### Collections "Linking Together Laravel Collection.php methods"

> Our first core concept is collection chaining. As you've surely learned by now, when fetching multiple records from a database, a Collection instance is returned. Not only does this object serve as a wrapper around your result set, but it also provides dozens upon dozens of useful manipulation methods that you'll reach for in every project you build.

1. `tinker`
2. `App\Article::first();` Because we only fetching 1 article. We get article instance which means we have access to all those attributes.
3. Here you get a Article instead of Collection. `App\Article {#3045`
```json
 App\Article {#3045
     id: 1,
     user_id: 1,
     title: "Learn Laravel",
     excerpt: "Modi enim sequi impedit autem aliquam numquam qui.",
     body: "Eum corrupti laboriosam ut voluptas sit aut eos sit. Itaque ducimus quos aut et ex ab. Voluptate ut magni nihil qui in cum ducimus.",
     created_at: "2020-01-19 00:55:03",
     updated_at: "2020-01-19 00:55:03",
   }
```
3. `App\Article::first()->title;` => `"Learn Laravel"`
4. Fetch All Articles. `App\Article::all();` Instead of a single one.
5. > When you use all(); You don't get a response, you get a `Collection` in Instead => Illuminate\Database\Eloquent\Collection {#3051}`
```json
=> Illuminate\Database\Eloquent\Collection {#3051
     all: [
       App\Article {#3052
         id: 1,
         user_id: 1,
         title: "Learn Laravel",
         excerpt: "Modi enim sequi impedit autem aliquam numquam qui.",
         body: "Eum corrupti laboriosam ut voluptas sit aut eos sit. Itaque ducimus quos aut et ex ab. Voluptate ut magni nihil qui in cum ducimus.",
         created_at: "2020-01-19 00:55:03",
         updated_at: "2020-01-19 00:55:03",
       },
       App\Article {#3053
         id: 2,
         user_id: 1,
         title: "Et consequatur eveniet nam quas.",
         excerpt: "Ipsum magnam aut fuga architecto quibusdam voluptatem modi.",
         body: "Maxime nostrum ut sapiente vitae. Mollitia omnis voluptate eos. Assumenda alias laborum sequi.",
         created_at: "2020-01-19 00:55:03",
         updated_at: "2020-01-19 00:55:03",
       },
       App\Article {#3054
         id: 3,
         user_id: 1,
         title: "Dolor possimus reprehenderit reiciendis delectus voluptatibus eveniet soluta.",
         excerpt: "Omnis harum assumenda consequuntur beatae.",
         body: "Mollitia fuga autem voluptate facere fuga libero odio earum. Ipsam nulla nostrum quibusdam sunt doloremque qui molestias. Libero repellat vero voluptas rem deleniti est. Omnis repudiandae eaque velit aut velit non.",
         created_at: "2020-01-19 00:55:03",
         updated_at: "2020-01-19 00:55:03",
       },
     ],
   }
```
6. Collection is not just wrapper around a series of items.
7. `$tags = App\Article::first()->tags;`  The tags of the first Article.
8. `$tags->first();` Get the first tag.
9. `$tags->last();` Get the last tag.
10. Filter the one where name is laravel `$tags->where('name', 'laravel')` This one use `Collection`. Here is not a Database Query.
```json
=> Illuminate\Database\Eloquent\Collection {#3060
     all: [
       1 => App\Tag {#3052
         id: 2,
         name: "laravel",
         created_at: "2020-01-18 20:56:17",
         updated_at: "2020-01-18 20:56:20",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3050
           article_id: 1,
           tag_id: 2,
           created_at: "2020-01-18 21:07:55",
           updated_at: "2020-01-18 21:07:57",
         },
       },
     ],
   }
```
11. `App\Tag::where('name', 'laravel')->first()` Is not the same, it's an SQL query instead.
```json
=> App\Tag {#3061
     id: 2,
     name: "laravel",
     created_at: "2020-01-18 20:56:17",
     updated_at: "2020-01-18 20:56:20",
   }
>>> 
```
12. Go to the collection class. At `Illuminate/Support/Collection.php`
13. Check the Structure and see all methods it contains.
14. Lets check it's first method, which gets first item from collection.
15. Notice that first() also accepts an optional callback `callable $callback = null`
```php
    public function first(callable $callback = null, $default = null)
    {
        return Arr::first($this->items, $callback, $default);
    }
```
16. in `tinker` We have our `$tags` collection
17.  Give me tag where the length of the name is greater than 5`$tags->first(function ($tag) { return strlen($tag->name) > 5; });`
18. Give me tag where the length of the name is less than 5`$tags->first(function ($tag) { return strlen($tag->name) < 5; });`
19. Will flatten a nested array into a single one.
```php
    public function flatten($depth = INF)
    {
        return new static(Arr::flatten($this->items, $depth));
    }
```
20. Now we will learn how to create a collection from scratch. in `tinker` use `collect(['one', 'two', 'three'])`
21. `collect(['one', 'two', 'three'])->first()` Here return first one `'one'`
22. Now using nested array. `collect(['one', 'two', 'three', ['four', 'five'], 'six']);`
```json
=> Illuminate\Support\Collection {#3067
     all: [
       "one",
       "two",
       "three",
       [
         "four",
         "five",
       ],
       "six",
     ],
   }
```
23. `collect(['one', 'two', 'three', ['four', 'five'], 'six'])->flatten();` Here flatten it out to single level.
```json
=> Illuminate\Support\Collection {#3059
     all: [
       "one",
       "two",
       "three",
       "four",
       "five",
       "six",
     ],
   }
```
24. The main methods used on Collection.php are 

        1. filter()
        2. map()
        3. flatMap()
        4. where()
        5. merge()
25. There is also zip() but takes time to understand the correct use for it.
26. > filter()
27. ` $items = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);`
```json
=> Illuminate\Support\Collection {#3076
     all: [
       1,
       2,
       3,
       4,
       5,
       6,
       7,
       8,
       9,
       10,
     ],
   }
```
28. Filter items that are equal or greater than 5 `$items->filter(function ($item) {return $item >= 5; });`
```json
=> Illuminate\Support\Collection {#3036
     all: [
       4 => 5,
       5 => 6,
       6 => 7,
       7 => 8,
       8 => 9,
       9 => 10,
     ],
   }
```
29. It's not destructive since it didn't rewrite original variable.
30. `$items`
```json
=> Illuminate\Support\Collection {#3076
     all: [
       1,
       2,
       3,
       4,
       5,
       6,
       7,
       8,
       9,
       10,
     ],
   }
```
31. Which means if you want to keep it filter it you have to save it to a variable.
32. `$greaterThan4 = $items->filter(function ($item) {return $item >= 5; });`
33. If item divided by 2 no remainder "%" `$items->filter(function ($item) { return $item % 2 === 0; });`
```json
=> Illuminate\Support\Collection {#3064
     all: [
       1 => 2,
       3 => 4,
       5 => 6,
       7 => 8,
       9 => 10,
     ],
   }
```
34. Notice that we get a Collection as response `=> Illuminate\Support\Collection `
35. Which means all these methods are perfectly chainable.
36. > map()
37. After we filter them, we will map over them for 'each one' and perform a return the item * 3 on each of the items.
38. `$items->filter(function ($item) { return $item % 2 === 0; })->map(function ($item) { return $item * 3; });`
```json
=> Illuminate\Support\Collection {#3060
     all: [
       1 => 6,
       3 => 12,
       5 => 18,
       7 => 24,
       9 => 30,
     ],
   }
```
39. `$items->filter(function ($item) { return $item % 2 === 0; })->map(function ($item) { return $item * 3; })->last();` and you get `30`
40. `$articles = App\Article::all();` and I want to group them based on their Tags.
41. Now we will iger loaded the Tag relationship. ` $articles = App\Article::with('tags')->get();`
```json
=> Illuminate\Database\Eloquent\Collection {#3063
     all: [
       App\Article {#3062
         id: 1,
         user_id: 1,
         title: "Learn Laravel",
         excerpt: "Modi enim sequi impedit autem aliquam numquam qui.",
         body: "Eum corrupti laboriosam ut voluptas sit aut eos sit. Itaque ducimus quos aut et ex ab. Voluptate ut magni nihil qui in cum ducimus.",
         created_at: "2020-01-19 00:55:03",
         updated_at: "2020-01-19 00:55:03",
         tags: Illuminate\Database\Eloquent\Collection {#3085
           all: [
             App\Tag {#3096
               id: 1,
               name: "php",
               created_at: "2020-01-18 20:56:02",
               updated_at: "2020-01-18 20:56:04",
               pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3095
                 article_id: 1,
                 tag_id: 1,
                 created_at: "2020-01-18 21:02:11",
                 updated_at: "2020-01-18 21:02:13",
               },
             },
           ],
         },
       },
     ],
   }
```
42. `$articles = App\Article::with('tags')->get();` the tags is corresponding with the tags() method inside the model `Article.php`
43. What if we want to plug all the tags that are included as part of this collection. For example build a tag tree on the sidebar.
44. `$articles` we want to pluck the name of each article. But will not work as you think.
45.  If wanted to pluck the title that would work. `$articles->pluck('title')`
```json
=> Illuminate\Support\Collection {#3122
     all: [
       "Learn Laravel",
       "Et consequatur eveniet nam quas.",
       "Dolor possimus reprehenderit reiciendis delectus voluptatibus eveniet soluta.",
       "Post Three3",
       "google",
       "Pizza Food",
     ],
   }

```
46.  But if we use `$articles->pluck('tags')` that would give me collection of various collections. Because for each article there is a number of tags.
47. What we can do is pluck the tags and then flatten it all down. by using `$articles->pluck('tags')->collapse()`
48. So that would give me a list of all tags used instead of grouped for each Article.
49. Then from that point we can pluck the name of the tags. `$articles->pluck('tags')->collapse()->pluck('name')`
```json
     all: [
       "php",
       "laravel",
       "education",
       "php",
       "laravel",
       "php",
       "laravel",
       "education",
       "php",
       "education",
     ],
   }
```
50. But there are duplicates we only want unique items.
51. So we use `$articles->pluck('tags')->collapse()->pluck('name')->unique();`
```json
=> Illuminate\Support\Collection {#3082
     all: [
       "php",
       "laravel",
       "education",
     ],
   }

```
52. This is great when you want to build a sidebar menu.
53. Laravel has '.' Dot Notation for example view('articles.show')
54. You can also use it for `$articles->pluck('tags.name')`
55. But will not work because we got collection of tags.
56. What we can do is sudo flatten by using the star here.
57. `$articles->pluck('tags.*.name')`
58. Now you get new one but you get empty arrays. Since some articles have no tags.
59. so we need to collapse and flatten then down as well add unique items.
60. $articles->pluck('tags.*.name')->collapse()->unique()
61. So what we can do is save it to something like `$revelantTags =$articles->pluck('tags.*.name')->collapse()->unique();`
62. But what if you want the tags to be Uppercase
63. `$articles->pluck('tags.*.name')->collapse()->unique()->map(function ($item) { return ucwords($item); })`
```json
     all: [
       "Php",
       "Laravel",
       "Education",
     ],
   }
```
64. What is the difference between flatten() and collapse()
> collapse only goes one level deep on the collection, and flatten is a recursive function that goes to the deepest level of the collection, you may optionally pass to flatten function an argument that controls the "depth".

### CSRF Attacks, With Examples
>In a CSRF attack an innocent end user is tricked by an attacker into submitting a web request that they did not intend. This may cause actions to be performed on the website that can include inadvertent client or server data leakage, change of session state, or manipulation of an end user's account.

1. Laravel uses `419` for a failed CSRF authentication. You can find the error codes on `Response.php`
2. Go to the `Kernel.php` There are all the middleware that is run when a new request is form.
```json
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]
```
3. There is section called   `\App\Http\Middleware\VerifyCsrfToken::class`
4. Click it and follow it and follow `VerifyCartToken.php'
5. see the handle() method inside `VerifyCartToken.php` 
5. Then it checks with `$this->tokensMatch($request);` 
6. So is trying to fetch a token from request `$token->getTokenFromRequests($request);`
7. Then compares it with token in the session that laravel creates automatically `hash_equals($request->session()->token(), $token);`
8. If those don't match is going to `throw new TokenMismatchException('CSRF token mismatch.');` and that is converted to 419 error.
9. `@csrf` is a helper thant will expand to a hidden input.
10. `<input type="hidden" name="_token" value="l9mYJPocp8ho8iiwerkGSbJtHLzjUsM0ZnMrgLHb">`
11. Notice that the value is equal to that token from the session.
12. So when submit the token the token is included as part of the request.
13. There will be situations you don't want automatically Csrf Exceptions.
14. So go to `class VerifyCsrfToken extends Middleware` and edit the '$except = [`
15. A common situation where you don't want CSRF is for stripe webhost.
16. Example when a charge is performed at Laracast. It will hit stripe server and payment is created.
17. Then Stripe will ping a url to the server with a big payload data that I can use to update user and record something in database.
18. This is called Stripe web hooks.
19. In these situations I want to exclude my stripe webhost.
20. Remember when ever you create a form always include the `@csrf`  yet even if you forget the browser will receive error `419`
```blade
<form>
    @csrf
</form>
```
> Another alternative to CSRF, check for origin/referer header, this will prevent CSRF attacks, You may also set SameSite cookie property to lax or strict. Using a hidden CSRF token can be problematic when the form requires too much time to fill or when you leave a page open too long then try to submit the form.
