<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

   /* Telling the model that these are the only fields that can be mass assigned. */
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    //Con estas funciones ya los valores de Post se pasan a los demas sin necesidad de enviarlos

    /**
     * > This function returns a relationship between the Post and User model
     * 
     * @return The name and username of the user who created the post.
     */
    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

   /**
    * > The comments() function returns all the comments that belong to a post
    * 
    * @return A collection of comments
    */
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * > The `likes` function returns all the likes that belong to the post
     * 
     * @return The likes relationship is being returned.
     */
    public function likes(){
        return $this->hasMany(Like::class);
    }

    /**
     * If the user_id of the user who liked the post is the same as the user_id of the user who is
     * logged in, then return true
     * 
     * @param User user The user that we want to check if they liked the post.
     * 
     * @return A boolean value.
     */
    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
