<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function new()
    {
        return view('post.NewPost');
    }
}
