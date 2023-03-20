<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        /* Checking if the user is authenticated. If not, it will return back to the login page with a
        message. */
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        /* Redirecting the user to the posts.index page. */
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
