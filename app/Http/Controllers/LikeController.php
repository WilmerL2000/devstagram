<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * It creates a new like for the post, and then redirects the user back to the previous page
     * 
     * @param Request request This is the request object that was sent to the route.
     * @param Post post This is the post that we're liking.
     * 
     * @return The user is being returned to the previous page.
     */
    public function store(Request $request, Post $post) {
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    /**
     * It deletes the like from the database where the user_id is equal to the authenticated user's id
     * and the post_id is equal to the post's id
     * 
     * @param Request request The request object.
     * @param Post post The post that the user is liking.
     */
    public function destroy(Request $request, Post $post) {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
