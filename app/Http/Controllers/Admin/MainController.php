<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(){
        $posts = Post::query()->with('category')->orderBy('views','desc')->paginate(10);
        $sumViews = Post::query()->sum('views');
        return view('admin.index', compact('posts','sumViews'));
    }
}
