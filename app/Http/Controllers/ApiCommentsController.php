<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class ApiCommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());
        $comment = Comment::with(['user'])->where('id', $comment->id)->first();
        return [
            'comment' => $comment,
            'index' => $request->index,
        ];
    }
}
