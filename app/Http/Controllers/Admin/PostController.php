<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()->with('category','tags')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $userror = [
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required|integer',
            'thumbnail'=>'nullable|image'
        ];
        $ruerror = [
            'title.required'=>'Название должно быть заполнено',
            'description.required'=>'Заполните краткое содержание',
            'content.required'=>'Вы не заполнили контент',
            'category_id.required'=>'Вы не выбрали категорию',
            'category_id.integer'=>'Выберите другую категорию',
            'thumbnail.image'=>'Неподходящий формат изображения'
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        $data = $request->all();
        $data['thumbnail'] = Post::uploadImage($request);

        $post = Post::query()->create($data);
        $post->tags()->sync($request->tags);

        $request->session()->flash('success','Статья добавлена');
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::query()->find($id);
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('categories','tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userror = [
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required|integer',
            'thumbnail'=>'nullable|image'
        ];
        $ruerror = [
            'title.required'=>'Название должно быть заполнено',
            'description.required'=>'Заполните краткое содержание',
            'content.required'=>'Вы не заполнили контент',
            'category_id.required'=>'Вы не выбрали категорию',
            'category_id.integer'=>'Выберите другую категорию',
            'thumbnail.image'=>'Неподходящий формат изображения'
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        $post = Post::query()->find($id);
        $data = $request->all();
        if ($file = Post::uploadImage($request, $post->thumbnail)){
            $data['thumbnail'] = $file;
        }

        $post->update($data);
        $post->tags()->sync($request->tags);

        $request->session()->flash('success','Изменения сохранены');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('posts.index')->with('success','Статья удалена');
    }
}
