<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use App\Models\PostUserLike;

class PersonalController extends Controller
{
    public function __invoke()
    {
        $data = [];
        $data['likedCount'] = auth()->user()->LikedPosts()->count();
        $data['commentsCount'] = auth()->user()->comments()->count();

        return view('personal.main.index', compact('data'));
    }
}
