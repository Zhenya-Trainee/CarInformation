<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){

        $request->validate([
            's'=>'required'
        ]);
        $s = $request->s;
        $posts = Post::getPostWithSearch($s);
        return view('posts.search', compact('posts', 's'));
    }
}
