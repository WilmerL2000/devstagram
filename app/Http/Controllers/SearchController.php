<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{

    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        return view('search');
    }

    public function show(Request $request){

        $users = DB::table('users')
        ->select('name', 'username', 'image')
        ->where('name', 'LIKE', '%'.$request->search.'%')
        ->orWhere('username', 'LIKE', '%'.$request->search.'%')
        ->paginate(10);
        return view('search', ['users' => $users]);
    }
}
