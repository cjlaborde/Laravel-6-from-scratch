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
18. 
