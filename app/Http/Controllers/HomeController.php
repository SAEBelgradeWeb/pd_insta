<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['user', 'tags', 'comments' => function($query){
            $query->with(['user']);
        }])->get();

        return view('home', compact('posts'));
    }
}
