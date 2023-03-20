<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
