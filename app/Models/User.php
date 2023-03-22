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
        /* Saying that a user can have many likes. */
        return $this->hasMany(Like::class);
    }

   /**
    * A user can have many followers
    * Stores the followers of a user

    * @return A collection of users.
    */
    public function followers(){
        /* Saying that a user can have many followers. */
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * > The followings() function returns a collection of all the users that the current user is
     * following
     * 
     * @return A collection of users that the current user is following.
     */
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * If the user is following the given user, return true
     * Check if a user already follows another
     * 
     * @param User user The user we are following.
     * 
     * @return A boolean value.
     */
    public function following(User $user){
        /* Checking if the user is following the given user. */
        return $this->followers->contains($user->id);
    }
}
