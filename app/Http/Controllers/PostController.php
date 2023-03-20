<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * The __construct() function is a special function that is automatically called when an object is
     * created. 
     */
    public function __construct(){
        /* A middleware that is used to protect the routes. */
        $this->middleware('auth');
    }

    public function index (User $user){
        return view('dashboard', ['user' => $user]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request ){
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
