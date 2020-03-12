<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class ApiPostsController extends Controller
{
    public function index()
    {
        return Post::with(['user', 'tags', 'comments' => function ($query) {
            $query->with(['user'])->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->get();
    }
}
