<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * It gets the ids of the users that the current user is following, then gets all the posts from the
     * users that the current user is following, and finally returns the view with the posts
     * 
     * @return The view home.blade.php is being returned.
     */
    public function __invoke() {
        /* Getting the ids of the users that the current user is following. */
        $ids = auth()->user()->followings->pluck('id')->toArray();
        /* Getting all the posts from the users that the current user is following. */
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', ['posts' => $posts]);
    }
}
