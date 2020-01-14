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






