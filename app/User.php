<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class); // select * from articles where user_id = 1 // the 1 is the user_id of $this current user.
    }

    public function projects()
    {
        return $this->hasMany(Project::class); // SQL Query---- select * from projects where user_id = 1 // the 1 is the user_id of $this current user.
    }

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }

    public function conversations() 
    {
        return $this->hasMany(Conversation::class);
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
           $role = Role::whereName($role)->firstOrFail();
        }
        // $this->roles()->save($role);
        // What it will do is basically replace all existing methods in the pivot method with this collection
        // any that are not included in collection but included in database will be drop
        // yet we don't want to drop anything so set it to false.
        $this->roles()->sync($role, false);
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();        
    }
}

