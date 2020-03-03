<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->merge(['user_id' => \Auth::user()->id]);
        Comment::create($request->all());
        return redirect('/#post_' . $request->post_id);
    }
}
