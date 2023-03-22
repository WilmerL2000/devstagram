<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    /**
     * The __construct() function is a special function that is automatically called when an object is
     * created. 
     */
    public function __construct(){
        /* A middleware that is used to protect the routes. */
        $this->middleware('auth')->except(['show', 'index']);
    }

    /**
     * The index function takes a user object as a parameter, and returns a view of the dashboard with
     * the user and their posts
     * 
     * @param User user The user object that was passed in from the route.
     * 
     * @return A view called dashboard.
     */
    public function index (User $user){
        $posts = Post::where('user_id', $user->id)->latest()->paginate(15);
        return view('dashboard', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * The create function returns the view posts.create
     * 
     * @return The view posts/create.blade.php
     */
    public function create(){
        return view('posts.create');
    }

    /**
     * This function is used to create a post
     * 
     * @param Request request This is the request object that is sent to the server.
     * 
     * @return The user is being redirected to the posts.index page.
     */
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

        /* This is a method that is used to create a post. */
        // $request->user()->posts()->create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id,
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * If the user is logged in and the user's id matches the post's user_id, then show the post
     * 
     * @param User user The user object that was resolved by the RouteServiceProvider.
     * @param Post post The post that we're trying to show.
     * 
     * @return A view called 'posts.show' with the post and user passed in as variables.
     */
    public function show(User $user, Post $post) {
        return view('posts.show', ['post' => $post, 'user' => $user]);
    }

    public function destroy(Post $post) {
        /* This is a method that is used to check if the user is authorized to delete the post. */
        $this->authorize('delete', $post);
        $post->delete();

        //delete image
        $image_path = public_path('uploads/' . $post->image);

        if(File::exists($image_path)){
            /* Deleting the image from the server. */
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
