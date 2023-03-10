<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;

class LikedController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->LikedPosts;
        return view('personal.liked.index', compact('posts'));
    }
}
