<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $data = [
            'posts' => Post::all()
        ];

        return view("posts.index", $data);
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }
}
