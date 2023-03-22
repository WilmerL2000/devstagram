<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        return view('profile.index');
    }

    /**
     * It validates the username, creates a unique name for the image, creates an image object, resizes
     * the image, creates a path to the image, saves the image to the path, updates the user's username
     * and image, and redirects the user to the posts index page
     * 
     * @param Request request This is the request object.
     * 
     * @return The user's username and image.
     */
    public function store(Request $request) {
        
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username'=> ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,edit-profile'],
        ]);

        if($request->image){
            $image = $request->file('image');

            /* Creating a unique name for the image. */
            $image_name = Str::uuid() . "." . $image->extension();
    
            /* Creating an image object. */
            $image_server = Image::make($image);
    
            /* Resizing the image to 1000x1000. */
            $image_server->fit(1000, 1000);
    
            /* Creating a path to the image. */
            $image_path = public_path('profiles') . '/' . $image_name;
            /* Saving the image to the path. */
            $image_server->save($image_path);
        }

        /* This is updating the user's username and image. */
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        /* Setting the user's image to the image name if it exists, otherwise it is setting the user's
        image to the current user's image if it exists, otherwise it is setting the user's image to
        an empty string. */
        $user->image = $image_name ?? auth()->user()->image ?? '';
        $user->save();

        return redirect()->route('posts.index',$user->username);
    }
}
