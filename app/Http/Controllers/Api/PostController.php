<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        
        //$posts = Post::all();

        //Con il with possiamo andare a pescare già nell prima chiamata anche i dati esportati da altre tabelle correlate, come 
        //categories e tags
        
        $posts = Post::with("category")->with("tags")->get();

        return response()->json([
            'results' => $posts
        ]);
    }
}
