<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug){
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('id','desc')->paginate(5);
        return view('categories.show', compact('category', 'posts'));
    }
}
