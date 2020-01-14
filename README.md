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

