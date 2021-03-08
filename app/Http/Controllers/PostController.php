<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(){
        $posts = Post::query()->with('category')->orderBy('id','desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show($slug){

        $messages = Message::query()->where('slug','=',"$slug")->orderBy('id', 'DESC')->paginate(5);
        $post = Post::query()->where('slug',$slug)->firstOrFail();
        $post->views +=1;
        $post->update();
        $posts = Post::query()->with('category')->orderBy('views','desc')->limit(2)->get();
     return view('posts.show', compact('post','messages','slug','posts'));
    }
}
