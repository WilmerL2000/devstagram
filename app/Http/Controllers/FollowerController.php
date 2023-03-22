<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /**
     * Attach the authenticated user's id to the followers relationship of the user passed in.
     * 
     * @param User user This is the user that we are following.
     * 
     * @return The user is being returned.
     */
    public function store(User $user) {
        //Add this follower to the user we passed on
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    /**
     * The user's followers are detached from the user's id
     * 
     * @return The user is being returned.
     */
    public function destroy(User $user) {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
