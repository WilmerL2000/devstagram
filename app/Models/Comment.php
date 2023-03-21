<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    /**
     * The user() function returns the user that owns the post
     * 
     * @return A user object
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
