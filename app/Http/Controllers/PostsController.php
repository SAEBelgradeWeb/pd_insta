<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function store(Request $request)
    {
        
        $validateData = $request->validate([
           'post_image' => 'required',
           'content' => 'required'
        ]);


        $path = $request->file('post_image')->store('public/images');

        $request->merge(['user_id' => \Auth::user()->id, 'image' => substr($path, 7)]);

        $post = Post::create($request->all());

        return redirect('/');

    }


}
