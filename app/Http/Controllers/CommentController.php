<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * We're validating the request, creating a new comment, and then redirecting back to the page with
     * a success message
     * 
     * @param Request request This is the request object that contains the data that was submitted from
     * the form.
     * @param User user This is the user model that we are passing to the route.
     * @param Post post The post we're commenting on.
     * 
     * @return The comment is being returned.
     */
    public function store(Request $request, User $user , Post $post) {
         $this->validate($request, [
            'comment' => 'required|max:255',
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);

        return back()->with('message', 'Comentario agregado correctamente');
    }
}
