<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user has many posts
     * 
     * @return A collection of posts.
     */
    public function posts() {
        /* A method that is part of the Eloquent ORM. It is saying that a user has many posts. */
        return $this->hasMany(Post::class);
    }

    /**
     * > The `likes` function returns all the likes that belong to the post
     * 
     * @return The likes relationship is being returned.
     */
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
