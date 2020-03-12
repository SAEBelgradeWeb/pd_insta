<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class ApiCommentsController extends Controller
{
    public function store(Request $request)
    {
        return Comment::create($request->all());
    }
}
